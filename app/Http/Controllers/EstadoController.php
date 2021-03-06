<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Models\Carpeta;
use App\Models\Acusacion;
use App\Models\ExtraAbogado;
use App\Models\ExtraAutoridad;
use App\Models\ExtraDenunciado;
use App\Models\ExtraDenunciante;
use App\Models\DirNotificacion;
use App\Models\TipifDelito;
use App\Models\VariablesPersona;

use App\Models\uatuipj\ConCarpeta;
use App\Models\uatuipj\ConAcusacion;
use App\Models\uatuipj\ConExtraAbogado;
use App\Models\uatuipj\ConExtraAutoridad;
use App\Models\uatuipj\ConExtraDenunciado;
use App\Models\uatuipj\ConExtraDenunciante;
use App\Models\uatuipj\ConNotificacion;
use App\Models\uatuipj\ConTipifDelito;
use App\Models\uatuipj\ConVariablesPersona;

use App\Models\CatEscolaridad;
use App\Models\CatEstadoCivil;
use App\Models\CatEtnia;
use App\Models\CatLengua;
use App\Models\CatNacionalidad;
use App\Models\CatOcupacion;
use App\Models\CatEstatusCaso;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use DB;
use Alert;

class EstadoController extends Controller
{
    //



    public function index($id){
    // $idCarpeta=session('carpeta');
     
    // $casoNuevo = Carpeta::where($id, $idCarpeta)->get();
    // $carpetaNueva = Carpeta::find($idCarpeta);
// dd($carpetaNueva);

//    $idEstadocarpeta = $carpetaNueva->idEstadoCarpeta;//id direccion

  
        
        
    $estatus=DB::table('carpeta') //id's de domicilios (municipio,localidad)
       ->join('cat_estatus_casos','cat_estatus_casos.id','=','carpeta.idEstadoCarpeta') 
       ->select('cat_estatus_casos.nombreEstatus as estatus', 'carpeta.id as id')
       ->where('carpeta.id','=', $id)
        ->get();
        

      $informacion = CatEstatusCaso::orderBy('nombreEstatus', 'ASC')
      ->pluck('nombreEstatus','id');
        return view('forms.turnar-carpeta')->with('informacion', $informacion)->with('estatus', $estatus);
    }


    public function editar(Request $request){
        

        // DB::beginTransaction();
        // try{
             //Sacar el id del select  //EstadoCarpeta es variable del select
            $idCarpeta=$request->idCarpeta;  //id de Variable de sesion
            //$idCarpeta=session('carpeta');  //id de Variable de sesion
            //dd($idCarpeta);
            $id = Carpeta::find($idCarpeta); //seleccinar toda la fila del primer id con  el valor de idCarpeta 
            $id->idEstadoCarpeta = $request->EstadoCarpeta;  //cambiar el campo idEstadpCarpeta por el valor $nombre
            $id->observacionesEstatus = $request->narracion;  
            $id->save();   // para guardar el registro
            
            if ($request->EstadoCarpeta==3) {
                //datos de la carpeta
                $carpeta=Carpeta::where('id',$idCarpeta)->first();

                //datos del delitos
                $delitos=TipifDelito::where('idCarpeta',$idCarpeta)->get();


                //datos de autoridades

                $autoridades=DB::table('extra_autoridad')
                ->join('variables_persona','variables_persona.id','=','extra_autoridad.idVariablesPersona')
                ->where('variables_persona.idCarpeta',$idCarpeta)
                ->select(   'variables_persona.idPersona as variaidPersona',
                            'variables_persona.edad as variaedad',
                            'variables_persona.telefono as variatelefono',
                            'variables_persona.motivoEstancia as variamotivoEstancia',
                            'variables_persona.idOcupacion as variaidOcupacion',
                            'variables_persona.idEstadoCivil as variaidEstadoCivil',
                            'variables_persona.idEscolaridad as variaidEscolaridad',
                            'variables_persona.idReligion as variaidReligion',
                            'variables_persona.idDomicilio as variaidDomicilio',
                            'variables_persona.docIdentificacion as variadocIdentificacion',
                            'variables_persona.numDocIdentificacion as varianumDocIdentificacion',
                            'variables_persona.lugarTrabajo as varialugarTrabajo',
                            'variables_persona.idDomicilioTrabajo as variaidDomicilioTrabajo',
                            'variables_persona.telefonoTrabajo as variatelefonoTrabajo',
                            'variables_persona.representanteLegal as variarepresentanteLegal',
                            'extra_autoridad.antiguedad as autoantiguedad',
                            'extra_autoridad.rango as autorango',
                            'extra_autoridad.horarioLaboral as autohorarioLaboral',
                            'extra_autoridad.narracion as autonarracion')
                ->get();
                //dd($autoridades);

                //abogados

                $abogados=DB::table('extra_abogado')
                ->join('variables_persona','variables_persona.id','=','extra_abogado.idVariablesPersona')
                ->where('variables_persona.idCarpeta',$idCarpeta)
                ->select(   'variables_persona.idPersona as variaidPersona',
                            'variables_persona.edad as variaedad',
                            'variables_persona.telefono as variatelefono',
                            'variables_persona.motivoEstancia as variamotivoEstancia',
                            'variables_persona.idOcupacion as variaidOcupacion',
                            'variables_persona.idEstadoCivil as variaidEstadoCivil',
                            'variables_persona.idEscolaridad as variaidEscolaridad',
                            'variables_persona.idReligion as variaidReligion',
                            'variables_persona.idDomicilio as variaidDomicilio',
                            'variables_persona.docIdentificacion as variadocIdentificacion',
                            'variables_persona.numDocIdentificacion as varianumDocIdentificacion',
                            'variables_persona.lugarTrabajo as varialugarTrabajo',
                            'variables_persona.idDomicilioTrabajo as variaidDomicilioTrabajo',
                            'variables_persona.telefonoTrabajo as variatelefonoTrabajo',
                            'variables_persona.representanteLegal as variarepresentanteLegal',
                            'extra_abogado.id as aboid',
                            'extra_abogado.cedulaProf as abocedulaProf',
                            'extra_abogado.sector as abosector',
                            'extra_abogado.correo as abocorreo',
                            'extra_abogado.tipo as abotipo')
                ->get();
                //dd($abogados);
                
                $denunciados=DB::table('extra_denunciado')
                ->join('dirNotificacion','dirNotificacion.id','=','extra_denunciado.idNotificacion')
                ->join('variables_persona','variables_persona.id','=','extra_denunciado.idVariablesPersona')
                ->where('variables_persona.idCarpeta',$idCarpeta)
                ->select(   'variables_persona.idPersona as variaidPersona',
                            'variables_persona.edad as variaedad',
                            'variables_persona.telefono as variatelefono',
                            'variables_persona.motivoEstancia as variamotivoEstancia',
                            'variables_persona.idOcupacion as variaidOcupacion',
                            'variables_persona.idEstadoCivil as variaidEstadoCivil',
                            'variables_persona.idEscolaridad as variaidEscolaridad',
                            'variables_persona.idReligion as variaidReligion',
                            'variables_persona.idDomicilio as variaidDomicilio',
                            'variables_persona.docIdentificacion as variadocIdentificacion',
                            'variables_persona.numDocIdentificacion as varianumDocIdentificacion',
                            'variables_persona.lugarTrabajo as varialugarTrabajo',
                            'variables_persona.idDomicilioTrabajo as variaidDomicilioTrabajo',
                            'variables_persona.telefonoTrabajo as variatelefonoTrabajo',
                            'variables_persona.representanteLegal as variarepresentanteLegal',
                            'extra_denunciado.id as denunciadoid',
                            'extra_denunciado.idPuesto as denunciadoidPuesto',
                            'extra_denunciado.alias as denunciadoalias',
                            'extra_denunciado.senasPartic as denunciadosenasPartic',
                            'extra_denunciado.ingreso as denunciadoingreso',
                            'extra_denunciado.periodoIngreso as denunciadoperiodoIngreso',
                            'extra_denunciado.residenciaAnterior as denunciadoresidenciaAnterior',
                            'extra_denunciado.idAbogado as denunciadoidAbogado',
                            'extra_denunciado.personasBajoSuGuarda as denunciadopersonasBajoSuGuarda',
                            'extra_denunciado.perseguidoPenalmente as denunciadoperseguidoPenalmente',
                            'extra_denunciado.vestimenta as denunciadovestimenta',
                            'extra_denunciado.narracion as denunciadonarracion',
                            'dirnotificacion.idDomicilio as notifiidDomicilio',
                            'dirnotificacion.correo as notificorreo',
                            'dirnotificacion.telefono as notifitelefono',
                            'dirnotificacion.fax as notififax')
                ->get();
                //dd($denunciados);

                $denunciantes=DB::table('extra_denunciante')
                ->join('dirNotificacion','dirNotificacion.id','=','extra_denunciante.idNotificacion')
                ->join('variables_persona','variables_persona.id','=','extra_denunciante.idVariablesPersona')
                ->where('variables_persona.idCarpeta',$idCarpeta)
                ->select(   'variables_persona.idPersona as variaidPersona',
                            'variables_persona.edad as variaedad',
                            'variables_persona.telefono as variatelefono',
                            'variables_persona.motivoEstancia as variamotivoEstancia',
                            'variables_persona.idOcupacion as variaidOcupacion',
                            'variables_persona.idEstadoCivil as variaidEstadoCivil',
                            'variables_persona.idEscolaridad as variaidEscolaridad',
                            'variables_persona.idReligion as variaidReligion',
                            'variables_persona.idDomicilio as variaidDomicilio',
                            'variables_persona.docIdentificacion as variadocIdentificacion',
                            'variables_persona.numDocIdentificacion as varianumDocIdentificacion',
                            'variables_persona.lugarTrabajo as varialugarTrabajo',
                            'variables_persona.idDomicilioTrabajo as variaidDomicilioTrabajo',
                            'variables_persona.telefonoTrabajo as variatelefonoTrabajo',
                            'variables_persona.representanteLegal as variarepresentanteLegal',
                            'extra_denunciante.id as denuncianteid',
                            'extra_denunciante.idNotificacion as denuncianteidNotificacion',
                            'extra_denunciante.idAbogado as denuncianteidAbogado',
                            'extra_denunciante.reguardarIdentidad as denunciantereguardarIdentidad',
                            'extra_denunciante.victima as denunciantevictima',
                            'extra_denunciante.narracion as denunciantenarracion',
                            'dirnotificacion.idDomicilio as notifiidDomicilio',
                            'dirnotificacion.correo as notificorreo',
                            'dirnotificacion.telefono as notifitelefono',
                            'dirnotificacion.fax as notififax')
                ->get();
                //dd($abogados);

                $acusaciones=Acusacion::where('idCarpeta',$idCarpeta)->get();
                //dd($acusaciones);
                
                //dd($carpeta);
                if (count($carpeta)!=null) {
                    $concarpeta= new ConCarpeta;
                    $concarpeta->idUnidad = 11;
                    $concarpeta->fechaInicio = $carpeta->fechaInicio;
                    $concarpeta->conDetenido = $carpeta->conDetenido;
                    $concarpeta->esRelevante = $carpeta->esRelevante;
                    $concarpeta->idEstadoCarpeta = $carpeta->idEstadoCarpeta;
                    $concarpeta->horaIntervencion = $carpeta->horaIntervencion;
                    $concarpeta->npd = $carpeta->npd;
                    $concarpeta->fechaIph = $carpeta->fechaIph;
                    $concarpeta->numIph = $carpeta->numIph;
                    $concarpeta->narracionIph = $carpeta->narracionIph;
                    $concarpeta->descripcionHechos = $carpeta->descripcionHechos;
                    $concarpeta->nombreFiscalUat = Auth::user()->nombres;
                    $concarpeta->numCarpetaUat = $carpeta->numCarpeta;
                    $concarpeta->asignada = 0;
                    $concarpeta->observacionesEstatus = $carpeta->observacionesEstatus;
                    $concarpeta->save();
                    $idCarpetaTurnada=$concarpeta->id;
                    //dd($concarpeta);
                }
            
                
            
                // dd($delitos);

                if (count($delitos)!=null) {
                    $arraydelitos=array();
                    foreach ($delitos as $delito) {
                        $condelito = new ConTipifDelito;
                        $condelito->idCarpeta = $idCarpetaTurnada;
                        $condelito->idDelito = $delito->idDelito;
                        $condelito->idAgrupacion1 = $delito->idAgrupacion1;
                        $condelito->idAgrupacion2 = $delito->idAgrupacion2;
                        $condelito->conViolencia = $delito->conViolencia;
                        $condelito->idArma = 1;
                        $condelito->consumacion = 'SIN INFORMACION';
                        $condelito->idPosibleCausa = 1;
                        $condelito->idModalidad = 1;
                        $condelito->formaComision = $delito->formaComision;
                        $condelito->fecha = $delito->fecha;
                        $condelito->hora = $delito->hora;
                        $condelito->idZona = $delito->idZona;
                        $condelito->idLugar = $delito->idLugar;
                        $condelito->idDomicilio = $delito->idDomicilio;
                        $condelito->entreCalle = $delito->entreCalle;
                        $condelito->yCalle = $delito->yCalle;
                        $condelito->calleTrasera = $delito->calleTrasera;
                        $condelito->puntoReferencia = $delito->puntoReferencia;
                        $condelito->save();
                        array_push($arraydelitos,array('iduat'=>$delito->id,'idnuevo'=>$condelito->id));
                        // dd($arraydelitos);
                    }
                }



                if (count($autoridades)!=null) {
                    foreach ($autoridades as $autoridad) {
                        $convariables = new ConVariablesPersona;
                        $convariables->idCarpeta = $idCarpetaTurnada;
                        $convariables->idPersona = $autoridad->variaidPersona;
                        $convariables->edad = $autoridad->variaedad;
                        $convariables->telefono = $autoridad->variatelefono;
                        $convariables->motivoEstancia = $autoridad->variamotivoEstancia;
                        $convariables->idOcupacion = $autoridad->variaidOcupacion;
                        $convariables->idEstadoCivil = $autoridad->variaidEstadoCivil;
                        $convariables->idEscolaridad = $autoridad->variaidEscolaridad;
                        $convariables->idReligion = $autoridad->variaidReligion;
                        $convariables->idDomicilio = $autoridad->variaidDomicilio;
                        $convariables->docIdentificacion = $autoridad->variadocIdentificacion;
                        $convariables->numDocIdentificacion = $autoridad->varianumDocIdentificacion;
                        $convariables->lugarTrabajo = $autoridad->varialugarTrabajo;
                        $convariables->idDomicilioTrabajo = $autoridad->variaidDomicilioTrabajo;
                        $convariables->telefonoTrabajo = $autoridad->variatelefonoTrabajo;
                        $convariables->representanteLegal = $autoridad->variarepresentanteLegal;
                        $convariables->save();
                        $idvariablesauto=$convariables->id;
                        
                        $conautoridad = new ConExtraAutoridad;
                        $conautoridad->idVariablesPersona = $idvariablesauto;
                        $conautoridad->antiguedad = $autoridad->autoantiguedad;
                        $conautoridad->rango = $autoridad->autorango;
                        $conautoridad->horarioLaboral = $autoridad->autohorarioLaboral;
                        //$conautoridad->narracion = $autoridad->autonarracion;
                        $conautoridad->save();
                        $idextraauto=$conautoridad->id;
                        //dd($conautoridad);
                        
                        $narracion=DB::connection('uipj')->table('narracion')->insert([
                            'idInvolucrado'=>$idextraauto,
                            'idCarpeta'=>$idCarpetaTurnada,
                            'tipoInvolucrado'=>3,
                            'narracion'=>$autoridad->autonarracion
                        ]);
                        //$narracion->save();
                        //dd($narracion->id);

                    }
                }

                //datos de abogados
                

                
                if (count($abogados)!=null) {
                    $arrayabogados=array();
                    foreach ($abogados as $abogado) {
                        $convariables = new ConVariablesPersona;
                        $convariables->idCarpeta = $idCarpetaTurnada;
                        $convariables->idPersona = $abogado->variaidPersona;
                        $convariables->edad = $abogado->variaedad;
                        $convariables->telefono = $abogado->variatelefono;
                        $convariables->motivoEstancia = $abogado->variamotivoEstancia;
                        $convariables->idOcupacion = $abogado->variaidOcupacion;
                        $convariables->idEstadoCivil = $abogado->variaidEstadoCivil;
                        $convariables->idEscolaridad = $abogado->variaidEscolaridad;
                        $convariables->idReligion = $abogado->variaidReligion;
                        $convariables->idDomicilio = $abogado->variaidDomicilio;
                        $convariables->docIdentificacion = $abogado->variadocIdentificacion;
                        $convariables->numDocIdentificacion = $abogado->varianumDocIdentificacion;
                        $convariables->lugarTrabajo = $abogado->varialugarTrabajo;
                        $convariables->idDomicilioTrabajo = $abogado->variaidDomicilioTrabajo;
                        $convariables->telefonoTrabajo = $abogado->variatelefonoTrabajo;
                        $convariables->representanteLegal = $abogado->variarepresentanteLegal;
                        $convariables->save();
                        $idvariablesabo=$convariables->id;
                        
                        $conabogado = new ConExtraAbogado;
                        $conabogado->idVariablesPersona = $idvariablesabo;
                        $conabogado->cedulaProf = $abogado->abocedulaProf;
                        $conabogado->sector = $abogado->abosector;
                        $conabogado->correo = $abogado->abocorreo;
                        $conabogado->tipo = $abogado->abotipo;
                        $conabogado->save();
                        //dd($conabogado);
                        array_push($arrayabogados,array('iduat'=>$abogado->aboid,'idnuevo'=>$conabogado->id));
                        

                    }
                }
                
                /****DATOS DEL DENUNCIADO******/


                if (count($denunciados)!=null) {
                    $arraydenunciado=array();
                    foreach ($denunciados as $denunciado) {
                        $convariables = new ConVariablesPersona;
                        $convariables->idCarpeta = $idCarpetaTurnada;
                        $convariables->idPersona = $denunciado->variaidPersona;
                        $convariables->edad = $denunciado->variaedad;
                        $convariables->telefono = $denunciado->variatelefono;
                        $convariables->motivoEstancia = $denunciado->variamotivoEstancia;
                        $convariables->idOcupacion = $denunciado->variaidOcupacion;
                        $convariables->idEstadoCivil = $denunciado->variaidEstadoCivil;
                        $convariables->idEscolaridad = $denunciado->variaidEscolaridad;
                        $convariables->idReligion = $denunciado->variaidReligion;
                        $convariables->idDomicilio = $denunciado->variaidDomicilio;
                        $convariables->docIdentificacion = $denunciado->variadocIdentificacion;
                        $convariables->numDocIdentificacion = $denunciado->varianumDocIdentificacion;
                        $convariables->lugarTrabajo = $denunciado->varialugarTrabajo;
                        $convariables->idDomicilioTrabajo = $denunciado->variaidDomicilioTrabajo;
                        $convariables->telefonoTrabajo = $denunciado->variatelefonoTrabajo;
                        $convariables->representanteLegal = $denunciado->variarepresentanteLegal;
                        $convariables->save();
                        $idvariablesabo=$convariables->id;
                        
                        $conNotifi = new ConNotificacion;
                        $conNotifi->idDomicilio = $denunciado->notifiidDomicilio;
                        $conNotifi->correo = $denunciado->notificorreo;
                        $conNotifi->telefono = $denunciado->notifitelefono;
                        $conNotifi->fax = $denunciado->notififax;
                        $conNotifi->save();
                        $idnotificon=$conNotifi->id;

                        $condenunciado = new ConExtraDenunciado;
                        $condenunciado->idVariablesPersona = $idvariablesabo;
                        $condenunciado->idNotificacion = $idnotificon;
                        $condenunciado->idPuesto = $denunciado->denunciadoidPuesto;
                        $condenunciado->alias = $denunciado->denunciadoalias;
                        $condenunciado->senasPartic = $denunciado->denunciadosenasPartic;
                        $condenunciado->ingreso = $denunciado->denunciadoingreso;
                        $condenunciado->periodoIngreso = $denunciado->denunciadoperiodoIngreso;
                        $condenunciado->residenciaAnterior = $denunciado->denunciadoresidenciaAnterior;
                        for($cont=0; $cont<count($arrayabogados); $cont++){
                            if($arrayabogados[$cont]['iduat'] == $denunciado->denunciadoidAbogado){
                                $condenunciado->idAbogado = $arrayabogados[$cont]['idnuevo'];
                                break;
                            }
                        }
                        $condenunciado->personasBajoSuGuarda = $denunciado->denunciadopersonasBajoSuGuarda;
                        $condenunciado->perseguidoPenalmente = $denunciado->denunciadoperseguidoPenalmente;
                        $condenunciado->vestimenta = $denunciado->denunciadovestimenta;
                        $condenunciado->save();
                        $idextra=$condenunciado->id;
                        //dd($condenunciado);
                        $narracion=DB::connection('uipj')->table('narracion')->insert([
                            'idInvolucrado'=>$idextra,
                            'idCarpeta'=>$idCarpetaTurnada,
                            'tipoInvolucrado'=>2,
                            'narracion'=>$denunciado->denunciadonarracion
                        ]);
                        //$narracion->save();
                        //dd($narracion->id);
                        array_push($arraydenunciado,array('iduat'=>$denunciado->denunciadoid,'idnuevo'=>$condenunciado->id));
                        
                        //dd($arraydenunciado);

                    }
                }
                
                /****DATOS DEL DENUNCIANTE******/

                
                if (count($denunciantes)!=null) {
                    $arraydenunciante=array();
                    foreach ($denunciantes as $denunciante) {
                        $convariables = new ConVariablesPersona;
                        $convariables->idCarpeta = $idCarpetaTurnada;
                        $convariables->idPersona = $denunciante->variaidPersona;
                        $convariables->edad = $denunciante->variaedad;
                        $convariables->telefono = $denunciante->variatelefono;
                        $convariables->motivoEstancia = $denunciante->variamotivoEstancia;
                        $convariables->idOcupacion = $denunciante->variaidOcupacion;
                        $convariables->idEstadoCivil = $denunciante->variaidEstadoCivil;
                        $convariables->idEscolaridad = $denunciante->variaidEscolaridad;
                        $convariables->idReligion = $denunciante->variaidReligion;
                        $convariables->idDomicilio = $denunciante->variaidDomicilio;
                        $convariables->docIdentificacion = $denunciante->variadocIdentificacion;
                        $convariables->numDocIdentificacion = $denunciante->varianumDocIdentificacion;
                        $convariables->lugarTrabajo = $denunciante->varialugarTrabajo;
                        $convariables->idDomicilioTrabajo = $denunciante->variaidDomicilioTrabajo;
                        $convariables->telefonoTrabajo = $denunciante->variatelefonoTrabajo;
                        $convariables->representanteLegal = $denunciante->variarepresentanteLegal;
                        $convariables->save();
                        $idvariablesabo=$convariables->id;
                        
                        $conNotifi = new ConNotificacion;
                        $conNotifi->idDomicilio = $denunciante->notifiidDomicilio;
                        $conNotifi->correo = $denunciante->notificorreo;
                        $conNotifi->telefono = $denunciante->notifitelefono;
                        $conNotifi->fax = $denunciante->notififax;
                        $conNotifi->save();
                        $idnotificon=$conNotifi->id;

                        $condenunciante = new ConExtraDenunciante;
                        $condenunciante->idVariablesPersona = $idvariablesabo;
                        $condenunciante->idNotificacion = $idnotificon;
                        for($cont=0; $cont<count($arrayabogados); $cont++){
                            if($arrayabogados[$cont]['iduat'] == $denunciante->denuncianteidAbogado){
                                $condenunciante->idAbogado = $arrayabogados[$cont]['idnuevo'];
                                break;
                            }
                        }
                        $condenunciante->identidadResguarda = $denunciante->denunciantereguardarIdentidad;
                        $condenunciante->esVictima = $denunciante->denunciantevictima;
                        $condenunciante->save();
                        $idextra=$condenunciante->id;
                        //dd($condenunciante);

                        $narracion=DB::connection('uipj')->table('narracion')->insert([
                            'idInvolucrado'=>$idextra,
                            'idCarpeta'=>$idCarpetaTurnada,
                            'tipoInvolucrado'=>1,
                            'narracion'=>$denunciante->denunciantenarracion
                        ]);
                        array_push($arraydenunciante,array('iduat'=>$denunciante->denuncianteid,'idnuevo'=>$condenunciante->id));
                        // dd($arraydenunciante);
                    }

                }
                
                

                foreach ($acusaciones as $acusacion) {
                    $conacusacion= new ConAcusacion;
                    $conacusacion->idCarpeta=$idCarpetaTurnada;
                    for($cont=0; $cont<count($arraydelitos); $cont++){
                        if($arraydelitos[$cont]['iduat'] == $acusacion->idTipifDelito){
                            $conacusacion->idTipifDelito = $arraydelitos[$cont]['idnuevo'];
                            break;
                        }
                    }
                    for($cont=0; $cont<count($arraydenunciado); $cont++){
                        if($arraydenunciado[$cont]['iduat'] == $acusacion->idDenunciado){
                            $conacusacion->idDenunciado = $arraydenunciado[$cont]['idnuevo'];
                            break;
                        }
                    }
                    for($cont=0; $cont<count($arraydenunciante); $cont++){
                        if($arraydenunciante[$cont]['iduat'] == $acusacion->idDenunciante){
                            $conacusacion->idDenunciante = $arraydenunciante[$cont]['idnuevo'];
                            break;
                        }
                    }
                    $conacusacion->save();

                
                }
                
             
                // $del = array();
                // for($cont=1; $cont<=10; $cont++){
                //     array_push($del, array('idViejo'=>$cont,'idNuevo'=>$cont));
                // }
                // //Para consultar
                // for($cont=0; $cont<count($del); $cont++){
                //     if($del[$cont]['idViejo'] == 5){
                //         dump("hola".$cont);
                //     }
                // }
                // dump($del);
                Alert::success('La carpeta con numero '.$carpeta->numCarpeta.' ha sido turnada con éxito','Hecho')->persistent('Aceptar');
                return redirect(route('indexcarpetas'));
            }
            // DB::commit();
            Alert::success('Registro modificado con exito','Hecho');
            return back();
        // }catch (\PDOException $e){
        //     DB::rollBack();
        //     Alert::error('Se presentó un problema al guardar su los datos, intente de nuevo', 'Error');
        //     return back()->withInput();
        // }
    
  
   

       }


}



