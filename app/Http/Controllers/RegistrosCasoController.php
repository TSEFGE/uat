<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Preregistro;
use App\Models\CatMunicipio;
use App\Models\Domicilio;
use Alert;
use App\Models\CatLocalidad;
use App\Models\CatColonia;
use App\Models\CatEstado;
use App\Models\Razon;
use Carbon\Carbon;
use App\Models\Carpeta;
use App\Models\CatEscolaridad;
use App\Models\CatEstadoCivil;
use App\Models\CatEtnia;
use App\Models\CatLengua;
use App\Models\CatNacionalidad;
use App\Models\CatOcupacion;
use App\Models\CatReligion;

class RegistrosCasoController extends Controller
{
    

    
    public function lista(){
        $preregistros = Preregistro::where('statusCola', null)
        ->where('conViolencia', 0)
        ->orderBy('id','desc')
        ->paginate(10);
        $municipios = CatMunicipio::where('idEstado',30)
        ->where('nombre', '!=', 'SIN INFORMACION')
        ->orderBy('nombre','asc')
        ->get();
        // return view('orientador.denunciante.fields-denunciante.filtroBusqueda')
        return view('servicios.recepcion.fiscalSinRecepcion')->with('registros',$preregistros)->with('municipios', $municipios);
        
       }


       public function editRegistros($id)
       {
           $estados=CatEstado::orderBy('nombre', 'ASC')
           ->pluck('nombre','id');
           $preregistro = Preregistro::find($id);
           $idDireccionPregistro =$preregistro->idDireccion;//id direccion
           $direccionTB=DB::table('domicilio') //id's de domicilios (municipio,localidad)
           ->where('domicilio.id','=',$idDireccionPregistro)
           ->get();
   
           $municipio=DB::table('cat_municipio')//nombre municipio
           ->where('cat_municipio.id','=',$direccionTB[0]->idMunicipio)
           ->get();
           $coloniaRow=DB::table('cat_colonia')//nombre municipio
           ->where('cat_colonia.id','=',$direccionTB[0]->idColonia)
           ->get();
           $idMunicipioSelect = $municipio[0]->id;
           $idEstadoSelect = $municipio[0]->idEstado; 
           $idLocalidadSelect = $direccionTB[0]->idLocalidad;
           $idColoniaSelect = $direccionTB[0]->idColonia;
           $idCodigoPostalSelect = $coloniaRow[0]->codigoPostal;
             
           /* inicio pruebas */
           //nombre del estado
           $nombreEstado=DB::table('cat_estado')
           ->where('cat_estado.id','=',$municipio[0]->idEstado)
           ->get();
           $nombreEstado=$nombreEstado[0]->nombre;
           
           //nombre del municipio
           $nombreMunicipio=DB::table('cat_municipio')
           ->where('cat_municipio.id','=',$municipio[0]->id)
           ->get();
           $nombreMunicipio=$nombreMunicipio[0]->nombre;
   
           //nombre del localidad
           $nombreLocalidad=DB::table('cat_localidad')
           ->where('cat_localidad.id','=',$direccionTB[0]->idLocalidad)
           ->get();
           $nombreLocalidad=$nombreLocalidad[0]->nombre;
   
           //nombre del colonia
           $Colonia=DB::table('cat_colonia')
           ->where('cat_colonia.id','=',$direccionTB[0]->idColonia)
           ->get();
           $nombreColonia=$Colonia[0]->nombre;
           $nombreCP=$Colonia[0]->codigoPostal;
           /* FIN DE PRUEBAS PARA NOMBRES DE DIRECCIONES */
           $catMunicipios=DB::table('cat_municipio')
           ->where('cat_municipio.idEstado','=',$idEstadoSelect)
           ->orderBy('nombre','asc')
           ->pluck('nombre','id');
           $catLocalidades=DB::table('cat_localidad')
           ->where('cat_localidad.idMunicipio','=',$municipio[0]->id)
           ->orderBy('nombre','asc')
           ->pluck('nombre','id');
           $catColonias=DB::table('cat_colonia')
           ->where('cat_colonia.codigoPostal','=',$coloniaRow[0]->codigoPostal)
           ->orderBy('nombre','asc')
           ->pluck('nombre','id');
           $catCodigoPostal=DB::table('cat_colonia')
           ->where('cat_colonia.idMunicipio','=',$idMunicipioSelect)
           ->where('cat_colonia.codigoPostal','!=',0)
           ->orderBy('codigoPostal','asc')
           ->groupBy('codigoPostal')
           ->pluck('codigoPostal','codigopostal');
           //dd($idCodigoPostalSelect);                     
           $persona= $preregistro->esEmpresa;//persona fisica o empresa
           if($persona==1){
               return view('orientador.denunciante.fields-denunciante.editadosPreregistro-empresa', compact('idEstadoSelect', 'idMunicipioSelect' ,'idLocalidadSelect', 'idColoniaSelect', 'catMunicipios', 'catLocalidades', 'catColonias', 'estados', 'preregistro','direccionTB', 'idCodigoPostalSelect', 'catCodigoPostal','nombreEstado','nombreMunicipio','nombreLocalidad', 'nombreColonia','nombreCP' ));
           }
           else{
               return view('orientador.denunciante.fields-denunciante.editadosPreregistro-persona', compact('idEstadoSelect', 'idMunicipioSelect' ,'idLocalidadSelect', 'idColoniaSelect', 'catMunicipios', 'catLocalidades', 'catColonias', 'estados', 'preregistro','direccionTB', 'idCodigoPostalSelect', 'catCodigoPostal','nombreEstado','nombreMunicipio','nombreLocalidad', 'nombreColonia','nombreCP' ));
           }
       }


       
    public function updateregistros(Request $request, $id)
    {
        //dd($request);
        $idDireccion=Preregistro::select('idDireccion')->where('id','=',$id)->get();
        $idDireccion=$idDireccion[0]->idDireccion;
        //dd($idDireccion);
        
        if ($request->esEmpresa==0){
            $domicilio = Domicilio::find($idDireccion);
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
            
            $preregistro = Preregistro::find($id);
            $preregistro->nombre = $request->nombres;
            $preregistro->primerAp = $request->primerAp;
            $preregistro->segundoAp = $request->segundoAp;
            $preregistro->telefono = $request->telefono;
            $preregistro->narracion = $request->narracion;
            $preregistro->idDireccion = $idD1;
            $preregistro->fechaNac = $request->fechaNacimiento;
            $preregistro->edad = $request->edad;
            if (!is_null($request->rfc2)){
                $preregistro->rfc = $request->rfc2;
            }
            $preregistro->curp = $request->curp;
            if (!is_null($request->sexo)){
                $preregistro->sexo = $request->sexo;
            }
            $preregistro->docIdentificacion = $request->docIdentificacion;
            $preregistro->numDocIdentificacion = $request->numDocIdentificacion;
            
            $preregistro->save();
            $id = $preregistro->id;
            
        }elseif($request->esEmpresa==1){
            $domicilio = Domicilio::find($idDireccion);
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
            
            $preregistro =Preregistro::find($idDireccion);
            $preregistro->esEmpresa = 1;    
            $preregistro->nombre = $request->nombres;
            $preregistro->idDireccion = $idD1;
            $preregistro->rfc = $request->rfc;
            $preregistro->representanteLegal = $request->repLegal;
            $preregistro->telefono = $request->telefono;
            $preregistro->conViolencia = $request->conViolencia;
            $preregistro->narracion = $request->narracion;
            $preregistro->save();
            $id = $preregistro->id;   
        }
        Alert::success('Registro modificado con exito','Hecho');
        return redirect('registros/'.$id.'/edit');
    }


       public function buscarmunicipio($id){
        // dd($id);
        $preregistros = DB::table('preregistros')
        ->join('domicilio', 'preregistros.idDireccion', '=', 'domicilio.id')
        ->where('domicilio.idMunicipio',$id)
        ->where('statusCola', null)
        ->where('conViolencia', 0)
        ->orderBy('id','desc')
        ->select('preregistros.id', 'preregistros.folio', 'preregistros.esEmpresa', 'preregistros.nombre', 'preregistros.primerAp', 'preregistros.segundoAp', 'preregistros.representanteLegal', 'preregistros.docIdentificacion')
        ->paginate(10);

         $municipios = CatMunicipio::where('idEstado',30)
        ->where('nombre', '!=', 'SIN INFORMACION')
        ->orderBy('nombre','asc')
        ->get();
        return view('servicios.recepcion.fiscalSinRecepcion')->with('registros',$preregistros)->with('municipios', $municipios)->with('idMunicipioSelect',$id);
    }


    public function buscarfolio(Request $request){
        if($request->input("folio")){
            $folio = $request->input("folio");
            $request->session()->flash('folio', $folio);
        }
        else{
            $folio = $request->session()->get('folio');
            $request->session()->flash('folio', $folio);

        }
        $preregistros = Preregistro::where('conViolencia', 0)
        ->where('folio', $folio)
        // ->orWhere('nombre', 'like', '%' . $folio . '%')
        // ->orWhere('primerAp', 'like', '%' . $folio . '%')
        // ->orWhere('segundoAp', 'like', '%' . $folio . '%')
        ->orWhere(DB::raw("CONCAT(nombre,' ',primerAp,' ',segundoAp)"), 'LIKE', '%' . $folio . '%')
        ->orWhere('representanteLegal', 'like', '%' . $folio . '%')
        ->orderBy('id','desc')
        ->paginate(10);
        //->toSql();
        $municipios = CatMunicipio::where('idEstado',30)
        ->where('nombre', '!=', 'SIN INFORMACION')
        ->orderBy('nombre','asc')
        ->get();
        //dd($preregistros);
        return view('servicios.recepcion.fiscalSinRecepcion')->with('registros',$preregistros)->with('municipios', $municipios);
    }
}
