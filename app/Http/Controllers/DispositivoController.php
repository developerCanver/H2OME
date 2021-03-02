<?php

namespace App\Http\Controllers;

use App\dispositivo;
use App\tipoSesor;
use Illuminate\Http\Request;
use App\tipoSensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DispositivoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(Request $request)
    {
        if($request){
            // $query = trim($request->get('search'));
            //    $dispositivos= dispositivo::where('utilizado','LIKE', '%'. $query .'%')
            //    ->orderBy('id_dispositivo ','asc')
            //    ->paginate(5);
            //->paginate(5); PAGINACION DE LOS LISTADS O ->simplePaginate
            $dispositivos = dispositivo::all();
            $tipoSensores = tipoSensor::all();

            
    
              // return view('dispositivo.index', ['dispositivos' => $dispositivos, 'search'=>$query, 'tipoSensores'=>$tipoSensores]);
              return view('dispositivo.index', ['dispositivos' => $dispositivos, 'tipoSensores'=>$tipoSensores]);
            } 
    }

    public function misensores()
    {
            //$dispositivos = dispositivo::all();
            $tipoSensores = tipoSensor::all();
            $user = Auth::user()->id;

             $dispositivos = DB::table('dispositivos')
           ->join('estancias', 'estancias.dispositivo_id', '=', 'dispositivos.id_dispositivo')
           ->join('hogars', 'hogars.id_hogar', '=', 'estancias.hogar_id')
           ->join('users', 'users.id', '=', 'hogars.usuario_id')
           ->where('users.id','=',$user)
           ->get() ;

           //dd($dispositivos);

            
    
              // return view('dispositivo.index', ['dispositivos' => $dispositivos, 'search'=>$query, 'tipoSensores'=>$tipoSensores]);
              return view('dispositivo.index', ['dispositivos' => $dispositivos, 'tipoSensores'=>$tipoSensores]);
            
    }


   
    public function store(Request $request)
    { 
        $dispositivo = new dispositivo();
        $ultimo_id = dispositivo::latest('id_dispositivo')->first();
        $id_dispositivo=($ultimo_id->id_dispositivo)+1;
           
        $nombreDispositivo=request('nombreDispositivo');
        $dispositivo->nombreDispositivo=($nombreDispositivo."-".$id_dispositivo);
        $dispositivo->tipoSensor_id= request('tipoSensor_id');
        $dispositivo->utilizado= request('utilizado');
        $dispositivo->marca=request('marca');
        $dispositivo->descripcionDispositivo=request('descripcionDispositivo');     
        $dispositivo->save();
         back()->with('data' ,'inresado con éxito');
         return redirect('/sensores');
    }

 
    public function update(Request $request, $id_dispositivo)
    {
        $dispositivo =  dispositivo::findOrFail($id_dispositivo);
        $dispositivo->nombreDispositivo= request('nombreDispositivo');
        $dispositivo->tipoSensor_id= request('tipoSensor_id');
        $dispositivo->utilizado= request('utilizado');
        $dispositivo->marca=request('marca');
        $dispositivo->descripcionDispositivo=request('descripcionDispositivo');     
        $dispositivo->update();

         back()->with('data' ,'Actualizado con éxito');
         return redirect('/sensores');
    }

 
    public function destroy( $id_dispositivo)
    {
        $dispositivo = dispositivo::findOrFail($id_dispositivo);
        $dispositivo->delete();
        back()->with('data' ,'Eliminado con éxito');
        return  redirect('/sensores');
    }
}
