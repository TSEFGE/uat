<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;
use Carbon\Carbon;
use App\Models\Carpeta;
use App\Models\CatEscolaridad;
use App\Models\CatEstado;
use App\Models\CatEstadoCivil;
use App\Models\CatEtnia;
use App\Models\CatLengua;
use App\Models\CatNacionalidad;
use App\Models\CatOcupacion;
use App\Models\CatReligion;
use App\Models\Razon;
use App\Models\Domicilio;
use App\Models\DirNotificacion;
use App\Models\Persona;
use App\Models\VariablesPersona;
use App\Models\ExtraDenunciante;

class DenuncianteController extends Controller
{
    public function crearCaso(){
        $caso=session('carpeta');
        //dd($caso);
        if (is_null($caso)){
            $caso = new Carpeta();
            $caso->numCarpeta = "UAT/D"."1"."/"."X"."/"."XX"."/".Carbon::now()->year;
            $caso->fechaInicio = Carbon::now();
            $caso->idEstadoCarpeta = 1;
            $caso->horaIntervencion = Carbon::now();
            $caso->fechaDeterminacion = Carbon::now();
            $caso->save();
            session(['carpeta' => $caso->id]);
            //dd($idCarpeta);
            Alert::success('Caso iniciado con éxito', 'Hecho');
            return redirect()->route('new.denunciante');
        } else {
            Alert::warning('Tiene un caso en curso debe terminarlo o cancelarlo para iniciar uno nuevo', 'Advertencia');
            return redirect()->back()->withInput();
        }
        

    }

//  public function create()
//     {

//     $razones=Razon::orderBy('nombre', 'ASC')
//         ->pluck('nombre','id');
//     $estados=CatEstado::orderBy('nombre', 'ASC')
//         ->pluck('nombre','id');
//         // $estadoscivil = CatEstadoCivil::orderBy('nombre', 'ASC')
//         // ->pluck('nombre', 'id');
         
//         // return view('orientador.denunciante.denunciante-orientador')->with('estados',$estados)->with('razones',$razones);
// }

public function showForm()
    {

        $idCarpeta=session('carpeta');
        //dd($idCarpeta);
        // if (is_null($idCarpeta)) {
        //     Alert::error('No puede acceder a este modulo sin un caso en especifico', 'Error');
        //     return redirect('registros');
        // }
        $casoNuevo = Carpeta::where('id', $idCarpeta)->get();
        //dd($idCarpeta);
        if(count($casoNuevo)>0){ 
            $denunciantes = CarpetaController::getDenunciantes($idCarpeta);
            $denunciados = CarpetaController::getDenunciados($idCarpeta);
            $acusaciones = CarpetaController::getAcusaciones($idCarpeta);
            $medidasP= CarpetaController::getMedidasP($idCarpeta);
            $delitos = CarpetaController::getDelitos($idCarpeta);
            $escolaridades = CatEscolaridad::orderBy('id', 'ASC')->pluck('nombre', 'id');
            $estados = CatEstado::select('id', 'nombre')->orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $estadoscivil = CatEstadoCivil::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $etnias = CatEtnia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $lenguas = CatLengua::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $nacionalidades = CatNacionalidad::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $ocupaciones = CatOcupacion::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            $religiones = CatReligion::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

            return view('forms.denunciante')->with('idCarpeta', $idCarpeta)
                ->with('denunciantes', $denunciantes)
                ->with('denunciados', $denunciados)
                ->with('acusaciones', $acusaciones)
                ->with('medidasP', $medidasP)
                ->with('delitos', $delitos)
                ->with('escolaridades', $escolaridades)
                ->with('estados', $estados)
                ->with('estadoscivil', $estadoscivil)
                ->with('etnias', $etnias)
                ->with('lenguas', $lenguas)
                ->with('nacionalidades', $nacionalidades)
                ->with('ocupaciones', $ocupaciones)
                ->with('religiones', $religiones);
        }else{
            return redirect(url('registros'));
         }
        
        // return view('orientador.modulo-orientador')->with('estados',$estados)->with('razones',$razones);
    }

    public function cancelarCaso(){
        $idCarpeta = session('carpeta');
        $comprobar= Carpeta::where('id',$idCarpeta)->get();
        //dd(count($comprobar));
        if(is_null($idCarpeta)){
            Alert::info('No tiene ningún  caso en proceso.', 'Advertiencia');
            return redirect(url('registros'));    
        }
        if (count($comprobar)==0) {
            session()->forget('carpeta');
            Alert::info('No tiene ningún  caso en proceso.', 'Advertiencia');
            return redirect(url('registros'));
        }
        $carpeta = Carpeta::find($idCarpeta);
        $carpeta->delete();
        session()->forget('carpeta');
        Alert::info('El caso ha sido cancelado con éxito.', 'Hecho');
        return redirect(url('registros'));
    }


    public function storeDenunciante(Request $request){
        //dd($request->all());
        $idCarpeta = session('carpeta');
        if(is_null($idCarpeta)){
            $idCarpeta = $request->idCarpeta;
        }

        if($request->esEmpresa==0){
            $comprobarPersona=Persona::where('curp',$request->curp)->get();
            if(count($comprobarPersona)>0){
                $comprobarPersona=$comprobarPersona[0];
                $idPersona = $comprobarPersona->id;
            }else{
                $persona = new Persona();
                $persona->nombres = $request->nombres;
                $persona->primerAp = $request->primerAp;
                $persona->segundoAp = $request->segundoAp;
                $persona->fechaNacimiento = $request->fechaNacimiento;
                $persona->rfc = $request->rfc;
                $persona->curp = $request->curp;
                if (!is_null($request->sexo)){
                    $persona->sexo = $request->sexo;
                }
                if (!is_null($request->idNacionalidad)){
                    $persona->idNacionalidad = $request->idNacionalidad;
                }
                if (!is_null($request->idEtnia)){
                    $persona->idEtnia = $request->idEtnia;
                }
                if (!is_null($request->idLengua)){
                    $persona->idLengua = $request->idLengua;
                }
                if (!is_null($request->idMunicipioOrigen)){
                    $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
                }
                $persona->save();
                $idPersona = $persona->id;
            }

            $domicilio = new Domicilio();
            if (!is_null($request->idMunicipio)){
                $domicilio->idMunicipio = $request->idMunicipio;
            }
            if (!is_null($request->idLocalidad)){
                $domicilio->idLocalidad = $request->idLocalidad;
            }
            if (!is_null($request->idColonia)){
                $domicilio->idColonia = $request->idColonia;
            }
            if (!is_null($request->calle)){
                $domicilio->calle = $request->calle;
            }
            if (!is_null($request->numExterno)){
                $domicilio->numExterno = $request->numExterno;
            }
            if (!is_null($request->numInterno)){
                $domicilio->numInterno = $request->numInterno;
            }
            $domicilio->save();
            $idD1 = $domicilio->id;

            $domicilio2 = new Domicilio();
            if (!is_null($request->idMunicipio2)){
                $domicilio2->idMunicipio = $request->idMunicipio2;
            }
            if (!is_null($request->idLocalidad2)){
                $domicilio2->idLocalidad = $request->idLocalidad2;
            }
            if (!is_null($request->idColonia2)){
                $domicilio2->idColonia = $request->idColonia2;
            }
            if (!is_null($request->calle2)){
                $domicilio2->calle = $request->calle2;
            }
            if (!is_null($request->numExterno2)){
                $domicilio2->numExterno = $request->numExterno2;
            }
            if (!is_null($request->numInterno2)){
                $domicilio2->numInterno = $request->numInterno2;
            }
            $domicilio2->save();
            $idD2 = $domicilio2->id;

            $domicilio3 = new Domicilio();
            if (!is_null($request->idMunicipio3)){
                $domicilio3->idMunicipio = $request->idMunicipio3;
            }
            if (!is_null($request->idLocalidad3)){
                $domicilio3->idLocalidad = $request->idLocalidad3;
            }
            if (!is_null($request->idColonia3)){
                $domicilio3->idColonia = $request->idColonia3;
            }
            if (!is_null($request->calle3)){
                $domicilio3->calle = $request->calle3;
            }
            if (!is_null($request->numExterno3)){
                $domicilio3->numExterno = $request->numExterno3;
            }
            if (!is_null($request->numInterno3)){
                $domicilio3->numInterno = $request->numInterno3;
            }
            $domicilio3->save();
            $idD3 = $domicilio3->id;

            $notificacion = new DirNotificacion();
            $notificacion->idDomicilio = $idD3;
            $notificacion->correo = $request->correo;
            $notificacion->telefono = $request->telefono;
            $notificacion->fax = $request->fax;
            $notificacion->save();
            $idNotificacion = $notificacion->id;

            $edad= Carbon::parse($request->fechaNacimiento)->age;

            $VariablesPersona = new VariablesPersona();
            $VariablesPersona->idCarpeta = $idCarpeta;
            $VariablesPersona->idPersona = $idPersona;
            $VariablesPersona->edad = $edad;
            if (!is_null($request->telefono)){
                $VariablesPersona->telefono = $request->telefono;
            }
            if (!is_null($request->motivoEstancia)){
                $VariablesPersona->motivoEstancia = $request->motivoEstancia;
            }
            if (!is_null($request->idOcupacion)){
                $VariablesPersona->idOcupacion = $request->idOcupacion;
            }
            if (!is_null($request->idEstadoCivil)){
                $VariablesPersona->idEstadoCivil = $request->idEstadoCivil;
            }
            if (!is_null($request->idEscolaridad)){
                $VariablesPersona->idEscolaridad = $request->idEscolaridad;
            }
            if (!is_null($request->idReligion)){
                $VariablesPersona->idReligion = $request->idReligion;
            }
            $VariablesPersona->idDomicilio = $idD1;
            if (!is_null($request->docIdentificacion)){
                $VariablesPersona->docIdentificacion = $request->docIdentificacion;
            }
            if (!is_null($request->numDocIdentificacion)){
                $VariablesPersona->numDocIdentificacion = $request->numDocIdentificacion;
            }
            if (!is_null($request->lugarTrabajo)){
                $VariablesPersona->lugarTrabajo = $request->lugarTrabajo;
            }
            $VariablesPersona->idDomicilioTrabajo = $idD2;
            if (!is_null($request->telefonoTrabajo)){
                $VariablesPersona->telefonoTrabajo = $request->telefonoTrabajo;
            }
            $VariablesPersona->representanteLegal = "NO APLICA";
            $VariablesPersona->save();
            $idVariablesPersona = $VariablesPersona->id;

            $ExtraDenunciante = new ExtraDenunciante();
            $ExtraDenunciante->idVariablesPersona = $idVariablesPersona;
            $ExtraDenunciante->idNotificacion = $idNotificacion;
            $ExtraDenunciante->idAbogado = null;
            $ExtraDenunciante->victima = $request->victima;
            if ($request->conoceAlDenunciado===1){
                $ExtraDenunciante->conoceAlDenunciado = 1;
            }
            $ExtraDenunciante->narracion = $request->narracion;
            $ExtraDenunciante->save();
        }elseif($request->esEmpresa==1){
            $comprobarPersona=Persona::where('nombres',$request->nombre2)->get();
            if(count($comprobarPersona)>0){
                $comprobarPersona=$comprobarPersona[0];
                $idPersona = $comprobarPersona->id;
            }else{
                $persona = new Persona();
                $persona->nombres = $request->nombres2;
                $persona->rfc = $request->rfc2;
                $persona->esEmpresa = 1;
                if (isset($request->idMunicipioOrigen)) {
                }else{
                    $persona->idMunicipioOrigen = 2493;
                }
                $persona->save();
                $idPersona = $persona->id;
            }

            $domicilio = new Domicilio();
            if (!is_null($request->idMunicipio)){
                $domicilio->idMunicipio = $request->idMunicipio;
            }
            if (!is_null($request->idLocalidad)){
                $domicilio->idLocalidad = $request->idLocalidad;
            }
            if (!is_null($request->idColonia)){
                $domicilio->idColonia = $request->idColonia;
            }
            if (!is_null($request->calle)){
                $domicilio->calle = $request->calle;
            }
            if (!is_null($request->numExterno)){
                $domicilio->numExterno = $request->numExterno;
            }
            if (!is_null($request->numInterno)){
                $domicilio->numInterno = $request->numInterno;
            }
            $domicilio->save();
            $idD1 = $domicilio->id;

            $domicilio3 = new Domicilio();
            if (!is_null($request->idMunicipio3)){
                $domicilio3->idMunicipio = $request->idMunicipio3;
            }
            if (!is_null($request->idLocalidad3)){
                $domicilio3->idLocalidad = $request->idLocalidad3;
            }
            if (!is_null($request->idColonia3)){
                $domicilio3->idColonia = $request->idColonia3;
            }
            if (!is_null($request->calle3)){
                $domicilio3->calle = $request->calle3;
            }
            if (!is_null($request->numExterno3)){
                $domicilio3->numExterno = $request->numExterno3;
            }
            if (!is_null($request->numInterno3)){
                $domicilio3->numInterno = $request->numInterno3;
            }
            $domicilio3->save();
            $idD3 = $domicilio3->id;

            $notificacion = new DirNotificacion();
            $notificacion->idDomicilio = $idD3;
            $notificacion->correo = $request->correo;
            $notificacion->telefono = $request->telefonoN;
            $notificacion->fax = $request->fax;
            $notificacion->save();
            $idNotificacion = $notificacion->id;

            $VariablesPersona = new VariablesPersona();
            $VariablesPersona->idCarpeta = $idCarpeta;
            $VariablesPersona->idPersona = $idPersona;
            $VariablesPersona->idDomicilio = $idD1;
            $VariablesPersona->idDomicilioTrabajo = $idD1;
            $VariablesPersona->representanteLegal = $request->representanteLegal;
            $VariablesPersona->save();
            $idVariablesPersona = $VariablesPersona->id;

            $ExtraDenunciante = new ExtraDenunciante();
            $ExtraDenunciante->idVariablesPersona = $idVariablesPersona;
            $ExtraDenunciante->idNotificacion = $idNotificacion;
            $ExtraDenunciante->idAbogado = null;
            $ExtraDenunciante->victima = $request->victima;            
            if ($request->reguardarIdentidad==1){
                $ExtraDenunciante->reguardarIdentidad = 1;
            }
            if ($request->reguardarIdentidad==0){
                $ExtraDenunciante->reguardarIdentidad = 0;
            }
            $ExtraDenunciante->narracion = $request->narracion;
            $ExtraDenunciante->save();
        }
        /*
        Flash::success("Se ha registrado ".$user->name." de forma satisfactoria")->important();
        //Para mostrar modal
        //flash()->overlay('Se ha registrado '.$user->name.' de forma satisfactoria!', 'Hecho');
        */
        Alert::success('Denunciante registrado con éxito', 'Hecho');
        //return redirect()->route('carpeta', $request->idCarpeta);
        return redirect()->route('new.denunciante');
    }


    public function delete($id){

        $ExtraDenunciante =  ExtraDenunciante::find($id);
        $ExtraDenunciante->delete();
        Alert::success('Registrado eliminado con éxito', 'Hecho');
        return back();


    }

    
}
