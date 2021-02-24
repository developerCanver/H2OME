<?php

namespace App\Http\Controllers;

use App\tipoSensor;
use Illuminate\Http\Request;

class TipoSensorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    //
    public function index(Request $request)
    {
        if($request){
            $query = trim($request->get('search'));
               $tipoSensor= tipoSensor::where('nombreTipoSensor','LIKE', '%'. $query .'%')
               ->orderBy('id_tipoSensor','asc')
               ->paginate(5);
            //->paginate(5); PAGINACION DE LOS LISTADS O ->simplePaginate
    
               return view('tipoSensor.index', ['tipoSensores' => $tipoSensor, 'search'=>$query]);
           }
        
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $tipoSensor = new tipoSensor();
        $tipoSensor->nombreTipoSensor= request('nombreTipoSensor');
        $tipoSensor->descripcionTipoSensor= request('descripcionTipoSensor');
       
        $tipoSensor->save();
       
         back()->with('data' ,'ingresado con éxito');
         return redirect('/tipoSensor');
    }

    
    public function show(tipoSensor $tipoSensor)
    {
        //
    }

   
    public function edit(tipoSensor $tipoSensor)
    {
        
    }

  
    public function update(Request $request,  $id_tipoSensor)
    {
        $tipoSensor =  tipoSensor::findOrFail($id_tipoSensor);

        $tipoSensor->nombreTipoSensor= request('nombreTipoSensor');
        $tipoSensor->descripcionTipoSensor= request('descripcionTipoSensor');

        $tipoSensor->update();
        back()->with('data' ,'Actualizado con éxito');

        $query = trim($request->get('search'));
               $tipoSensor= tipoSensor::where('nombreTipoSensor','LIKE', '%'. $query .'%')
               ->orderBy('id_tipoSensor','asc')
               ->paginate(5);
            //->paginate(5); PAGINACION DE LOS LISTADS O ->simplePaginate
    
               return view('tipoSensor.index', ['tipoSensores' => $tipoSensor, 'search'=>$query]);
    }

    public function destroy($id_tipoSensor)
    {
        $tipoSensor = tipoSensor::findOrFail($id_tipoSensor);
        $tipoSensor->delete();
        back()->with('data' ,'Eliminado con éxito');
        return  redirect('/tipoSensor');
    }
}
