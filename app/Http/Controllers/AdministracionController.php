<?php

namespace App\Http\Controllers;
use App\dispositivo;
use App\tipoSensor;
use App\consumo;
use App\administracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministracionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(Request $request)
    {
        if($request){
        
            $sql = 'SELECT id_dispositivo, nombreDispositivo, marca, utilizado,nombreTipoSensor,id_administracion,estado,fechaAdministracion
            FROM administracions
            inner join estancias on administracions.estancia_id=estancias.id_estancia
            inner join	dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
            inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
            where utilizado=1';
            $administracions = DB::select($sql);
            
    
              // return view('dispositivo.index', ['dispositivos' => $dispositivos, 'search'=>$query, 'tipoSensores'=>$tipoSensores]);
              return view('administracion.index', ['administracions' => $administracions ]);
            } 
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request, $id_administracion)
    {
        
    //    //dd($request->get('tags_id'));
    //    $sql = 'select * from consumos
    //    WHERE administracion_id='.$id_administracion;
    //    $administracion = DB::select($sql);
       
        //$administracion =  consumo::findOrFail($id_administracion)->first();
       
        for ($i=0; $i < 100 ; $i++) { 

            $administracion = new consumo();
            $consumos=(rand(10,100));
            $administracion->consumo=$consumos;
            $administracion->stock_id='1';
            $administracion->administracion_id =$id_administracion;
            $administracion->fechaConsumo = now()->toDateString();
            $administracion->save();
            sleep(10);
           //DELETE FROM `consumos` WHERE administracion_id=13
           //set_time_limit(100);

        }
    }

    public function show(dispositivo $dispositivo)
    {
        //
    }

    
    public function edit(dispositivo $dispositivo)
    {
        //
    }

   
    public function update(Request $request, $id_administracion)
    {
       
        $administracion =  administracion::findOrFail($id_administracion);
      
        if ($request->get('estado')=="1") {
                $administracion->estado='0';  

        }else{
            $administracion->estado='1'; 
        }

        $administracion->update();
        $sql = 'SELECT id_dispositivo, nombreDispositivo, marca, utilizado,nombreTipoSensor,id_administracion,estado,fechaAdministracion
        FROM administracions
        inner join estancias on administracions.estancia_id=estancias.id_estancia
        inner join	dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
        where utilizado=1';
        $administracions = DB::select($sql);

          return view('administracion.index', ['administracions' => $administracions ]);
    }

 
    
}
