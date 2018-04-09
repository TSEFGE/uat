<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatRedireccion;
use App\Models\Atencion;
use App\Http\Requests\AtencionRequest;
use Alert;

class AtencionController extends Controller
{
    public function index(){
        $modulos1[''] = 'Seleccione un Modulo';
        $modulos2=CatRedireccion::orderBy('titulo', 'ASC')
        ->select('titulo','id')->get();
        foreach($modulos2 as $modulo){
            $modulos1[$modulo->id] = $modulo->titulo;
        }
        return view("servicios.atencion.atencion")->with('modulos',$modulos1);
    }

    public function addAtencion(AtencionRequest $request){
        $atencion = new Atencion;
        $atencion->nombre = $request->nombre." ".$request->primer_ap." ".$request->segundo_ap;
        $atencion->idRedireccion = $request->redireccion;
        $atencion->zona = session('zona');
        $atencion->unidad = session('unidad');
        $atencion->usuario = session('usuario');
        if($atencion->save()){
            Alert::success('Atención rápida creada con exito', 'Hecho')->persistent("Aceptar");
        }
        else{
            Alert::error('Se presento un problema al crear su atención rápida', 'Error');
        }
        return redirect("atencion"); 
    }
}
