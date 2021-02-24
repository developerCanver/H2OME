<?php

namespace App\Http\Controllers;

use App\AdministracionHogar;
use Illuminate\Http\Request;
use App\Hogar;
use App\consumo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\almacenamiento;

class AdministracionHogarController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   

    public function index(Request $request)
    {
        $user = Auth::user()->id;
        if ($user==1) {

            if($request){
                $query = trim($request->get('search'));
                   $hogares= Hogar::where('nombreHogar','LIKE', '%'. $query .'%')
                   ->orderBy('id_hogar','asc')
                   ->paginate(5);

                   return view('administracionHogar.index',['user'=> $user, 'search'=>$query, 'hogares' => $hogares]);
               }
            
        }else{
            $hogar = Hogar::where('usuario_id','=',$user)->firstOrFail();
        return view('administracionHogar.index',['hogar'=> $hogar, 'user'=>$user]);
        }


        /*
          inner join administracions on  consumos.administracion_id=administracions.id_administracion
        inner join estancias	 on administracions.estancia_id=estancias.id_estancia
      	inner join hogars on estancias.hogar_id=hogars.id_hogar  
        inner join users on hogars.usuario_id=users.id
        inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
         */

        // $sql = 'SELECT  DISTINCT  id_hogar,nombreHogar
        // FROM
        // estancias
        // inner JOIN hogars on estancias.hogar_id=hogars.id_hogar
        // inner JOIN dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        // where utilizado=1';
        // $hogares = DB::select($sql);


        // return view('administracionHogar.index',['hogares' => $hogares]);
            
    }

  
    public function create()
    {
        //
    }

    
    public function store(Request $request, $id_dispositivo)
    {
         $id_hogar= request('id_hogar');
        //consultar consumo generado por los sensores tipo de servocio
        // $sqlConsultarConsumo = 'SELECT id_consumo, consumo,fechaConsumo,capacidadAlmacenamiento
        // FROM
        // consumos
        // inner join administracions on  consumos.administracion_id=administracions.id_administracion
        // inner join estancias	 on administracions.estancia_id=estancias.id_estancia
      	// inner join hogars on estancias.hogar_id=hogars.id_hogar        
        // inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        // inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        // inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        // inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
        // WHERE 
        //  id_tipoSensor !=4 AND id_tipoSensor !=5 and  id_hogar='.$id_hogar;
        // $ConsultarConsumo = DB::select($sqlConsultarConsumo);


         // selecionar la capacidad del hogar escogido
        //  $sqlCapacidad='SELECT DISTINCT capacidadAlmacenamiento
        //  FROM
        //  estancias
        //  inner join hogars on estancias.hogar_id=hogars.id_hogar        
        //  inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        //  inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        //  WHERE 
        //  id_hogar='.$id_hogar;


        //insertar consumo consultando el administracion_id con id del dispositivo
        $sqlInserarConsumo = 
        'SELECT id_consumo, consumo,fechaConsumo,capacidadAlmacenamiento,administracion_id,
        id_hogar,id_almacenamiento
        FROM
        consumos
        inner join administracions on  consumos.administracion_id=administracions.id_administracion
        inner join estancias	 on administracions.estancia_id=estancias.id_estancia
      	inner join hogars on estancias.hogar_id=hogars.id_hogar        
        inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
        WHERE 
         id_dispositivo='.$id_dispositivo;
        $InserConsumo = DB::select($sqlInserarConsumo);        
       
    //cuscar el administracion_id que pertenese al sensor que se hizo cllick
        foreach ($InserConsumo as $administracion) {
            $administracion_id = $administracion->administracion_id;
            $capacidad = $administracion->capacidadAlmacenamiento;
            $hogar = $administracion->id_almacenamiento;

        }

       // consultar id de administracion para ingresar el salida de agua h2ome
       //
        $sqlsensorH2ome = 'SELECT DISTINCT 
         administracion_id,id_hogar,id_almacenamiento,maximo,minimo,media
        FROM
        consumos
        inner join administracions on  consumos.administracion_id=administracions.id_administracion
        inner join estancias	 on administracions.estancia_id=estancias.id_estancia
      	inner join hogars on estancias.hogar_id=hogars.id_hogar        
        inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
        WHERE 
        id_tipoSensor=4 and id_hogar='.$id_hogar;     
        $sensorH2ome = DB::select($sqlsensorH2ome);  
        //consultar el array de administracion_id
        foreach ($sensorH2ome as $sensorH2o) {
            $sensorH2ome = $sensorH2o->administracion_id;
            $maximo = $sensorH2o->maximo;
            $media = $sensorH2o->media;
            $minimo = $sensorH2o->minimo;
        }

        // consultar id de administracion para ingresar el salida de agua Empo
        //tipo sensor =5
        $sqlsensorEmpo = 'SELECT DISTINCT 
        administracion_id,id_hogar,id_almacenamiento,maximo,minimo,media
       FROM
       consumos
       inner join administracions on  consumos.administracion_id=administracions.id_administracion
       inner join estancias	 on administracions.estancia_id=estancias.id_estancia
        inner join hogars on estancias.hogar_id=hogars.id_hogar        
       inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
       inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
       inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
       inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
       WHERE 
       id_tipoSensor=5 and id_hogar='.$id_hogar;     
       $sensorEmpo = DB::select($sqlsensorEmpo);  
       //consultar el array de administracion_id
       foreach ($sensorEmpo as $sensorEmp) {
           $sensorEmpo = $sensorEmp->administracion_id;
         
       }



        $stock=0;  
            
   
        if ($request->get('clima')=="1") {
             $stock=0;
        }
         if ($request->get('clima')=="2"){
            $stock=$minimo;
        }
        if ($request->get('clima')=="3"){
             $stock=$media;
         }

            $dia=date("d");
            $mes=date("m");
            $año=date("Y");
   
            for ($i=0; $i < 10000; $i++) { 

                $consumos=(rand(4,10)/100);
                if ($capacidad>$stock) {

                
                   if (($capacidad-$consumos)>=0) {

                       //consumo del tanque h2ome
                   //ingrese el consumo por h2ome
                    $administracionH2omw = new consumo();     
                    $administracionH2omw->consumo=$consumos;
                    $administracionH2omw->fechaConsumo=$año."-".$mes."-".$dia;              
                    $administracionH2omw->administracion_id=$sensorH2ome;                                
                    $administracionH2omw->save();
    
                    $capacidad=$capacidad-$consumos;
                    //actualizar almacenamiento
                    //return $hogar." ".$id_dispositivo;
                    $almacenamiento=almacenamiento::findOrFail($hogar);            
                    $almacenamiento->capacidadAlmacenamiento=$capacidad;
                    $almacenamiento->update();  
               
              

                } else {
                      //se termino agua de h2ome 
                      //consume normal y registramos
                $administracionH2omw = new consumo();     
                $administracionH2omw->consumo=$consumos;
                $administracionH2omw->fechaConsumo=$año."-".$mes."-".$dia;            
                $administracionH2omw->administracion_id=$sensorEmpo;                                
                $administracionH2omw->save();
                    
                }
            }
                
                //almacenar consumo total de todos los tipo de sensores de servicio
                $administracion = new consumo();                                    
                $administracion->consumo=$consumos;
                $administracion->fechaConsumo=$año."-".$mes."-".$dia;           
                $administracion->administracion_id=$administracion_id;                                
                $administracion->save();

              
                if ($dia>30) {
                    $dia=1;
                    $mes=$mes+1;
                   
                   
                } else {
                    $dia=$dia+1;
                }

                $sleep=0;
                
                if ($sleep>=60) {
                   return view('home');
                }else{
                    $sleep=$sleep+sleep(4);

                }
               
                
            }


            /*
              DELETE FROM `consumos` WHERE administracion_id=57;
               INSERT INTO `consumos` (`id_consumo`, `consumo`, `fechaConsumo`, `created_at`,
                `updated_at`, `administracion_id`) VALUES 
                (NULL, '0', '2020-06-06', '2020-06-09 13:00:09', '2020-03-16 10:30:25', '57');

                DELETE FROM `consumos` WHERE administracion_id=56;
               INSERT INTO `consumos` (`id_consumo`, `consumo`, `fechaConsumo`, `created_at`,
                `updated_at`, `administracion_id`) VALUES 
                (NULL, '0', '2020-06-06', '2020-06-09 13:00:09', '2020-03-16 10:30:25', '56');

                UPDATE `almacenamientos` SET `capacidadAlmacenamiento` = '500' 
                WHERE `almacenamientos`.`id_almacenamiento` = 8;
                 DELETE FROM `consumos` WHERE administracion_id=36;
               INSERT INTO `consumos` (`id_consumo`, `consumo`, `fechaConsumo`, `created_at`,
                `updated_at`, `administracion_id`) VALUES 
                (NULL, '0', '2020-06-06', '2020-06-09 13:00:09', '2020-03-16 10:30:25', '36');
                DELETE FROM `consumos` WHERE administracion_id=43;
               INSERT INTO `consumos` (`id_consumo`, `consumo`, `fechaConsumo`, `created_at`,
                `updated_at`, `administracion_id`) VALUES 
                (NULL, '0', '2020-06-06', '2020-06-09 13:00:09', '2020-03-16 10:30:25', '43');
                
             */

        //set_time_limit(100);
        // consulta el consumo de todos los dispositivos de servicio - h2ome y empo 
         /*
        SELECT id_consumo, sum(consumo),fechaConsumo,capacidadAlmacenamiento,administracion_id,
        id_hogar,id_almacenamiento
        FROM
        consumos
        inner join administracions on  consumos.administracion_id=administracions.id_administracion
        inner join estancias	 on administracions.estancia_id=estancias.id_estancia
      	inner join hogars on estancias.hogar_id=hogars.id_hogar        
        inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
        inner join stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id
        inner join dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
        WHERE 
        id_hogar=21 AND id_tipoSensor!=4 and id_tipoSensor!=5
             
        */
    }

 
    public function show( $id_hogar)
    {
        $sql = 'SELECT id_dispositivo, nombreDispositivo, marca, utilizado,nombreTipoSensor,
        id_administracion,estado,fechaAdministracion,id_tipoSensor,id_hogar
        FROM administracions
        inner join estancias on administracions.estancia_id=estancias.id_estancia
        inner join hogars on estancias.hogar_id=hogars.id_hogar
        inner join	dispositivos on estancias.dispositivo_id=dispositivos.id_dispositivo
        inner join tipo_sensors on dispositivos.tipoSensor_id=tipo_sensors.id_tipoSensor
         where 
        id_tipoSensor !=4 AND id_tipoSensor !=5 AND utilizado=1 and id_hogar='.$id_hogar;
        $dispositivos = DB::select($sql);

        return view('administracionHogar.show', ['administracions' => $dispositivos ]);

       
    }

    
    public function edit(AdministracionHogar $administracionHogar)
    {
        //
    }

    
    public function update(Request $request, AdministracionHogar $administracionHogar)
    {
        //
    }

    
    public function destroy(AdministracionHogar $administracionHogar)
    {
        //
    }
}
