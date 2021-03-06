<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatRedireccion;
use App\Models\Atencion;
use App\Http\Requests\AtencionRequest;
use Alert;
use DB;

class AtencionController extends Controller
{
    public function index(){
        $modulos1[''] = 'SELECCIONE UN MODULO';
        $modulos2=CatRedireccion::orderBy('titulo', 'ASC')
        ->select('titulo','id')->get();
        foreach($modulos2 as $modulo){
            $modulos1[$modulo->id] = $modulo->titulo;
        }
        return view("servicios.atencion.atencion")->with('modulos',$modulos1);
    }

    public function addAtencion(AtencionRequest $request){
        
        DB::beginTransaction();
        try{
            $atencion = new Atencion;
            $atencion->nombre = $request->nombre." ".$request->primer_ap." ".$request->segundo_ap;
            $atencion->idRedireccion = $request->redireccion;
            // $atencion->zona = session('zona');
            // $atencion->unidad = session('unidad');
            // $atencion->usuario = session('usuario');
            $atencion->zona = 1;
            $atencion->unidad = 1;
            $atencion->usuario = 1;
            if($atencion->save()){
                Alert::success('Atención rápida creada con éxito', 'Hecho');
            }
            else{
                Alert::error('Se presento un problema al crear su atención rápida', 'Error');
            }
            DB::commit(); 
            return redirect("atencion");
        }catch (\PDOException $e){
            DB::rollBack();
            Alert::error('Se presentó un problema al guardar su los datos, intente de nuevo', 'Error');
            return back()->withInput();
        }
    }
}
