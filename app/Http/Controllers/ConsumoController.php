<?php

namespace App\Http\Controllers;

use App\consumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ConsumoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
      
         if ($request->get('id_hogar')) {
      
          $id=$request->get('id_hogar');


        //consumo promedio factura
            $sqlFactura = 'SELECT id_factura, medidor, codigo, consumoPromedio, (saldoPromedio), 
             fechaFactura,hogar_id FROM facturas WHERE hogar_id='.$id;
           $consumoFactura = DB::select($sqlFactura);
         
         
           
            $sql = 'SELECT id_consumo, consumo,fechaConsumo,capacidadAlmacenamiento,nivel,administracion_id,
            id_hogar,id_almacenamiento,numeroGrifos,maximo,minimo,media
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
             id_tipoSensor!=4 and id_tipoSensor!=5 AND id_hogar='.$id;
           $consumos = DB::select($sql);


           $sqlCunsumoH2ome='SELECT  (sum(consumo))consumo
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
             id_tipoSensor=4 AND id_hogar='.$id;
           $CunsumoH2ome = DB::select($sqlCunsumoH2ome);


           $sqlCunsumoEmpo='SELECT (sum(consumo))consumo
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
             id_tipoSensor=5 AND id_hogar='.$id;
           $CunsumoEmpo = DB::select($sqlCunsumoEmpo);


           // return view('consumo.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
            return view('consumo.index',['consumos' => $consumos,'CunsumoH2ome' => $CunsumoH2ome,
            'CunsumoEmpo' => $CunsumoEmpo, 'consumoFactura' => $consumoFactura]);

          
        }

    }
    public function miconsumo(){

        $id = Auth::user()->id;
      //consumo promedio factura
          $sqlFactura = 'SELECT usuario_id,id_factura, medidor, codigo, consumoPromedio, (saldoPromedio), 
           fechaFactura,hogar_id FROM facturas
           inner join  hogars on facturas.hogar_id = hogars.id_hogar 
            WHERE usuario_id='.$id;
         $consumoFactura = DB::select($sqlFactura);

      
          $sql = 'SELECT id_consumo, consumo,fechaConsumo,capacidadAlmacenamiento,nivel,administracion_id,
          id_hogar,id_almacenamiento,numeroGrifos,maximo,minimo,media
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
           id_tipoSensor!=4 and id_tipoSensor!=5 AND usuario_id='.$id;
         $consumos = DB::select($sql);


         $sqlCunsumoH2ome='SELECT  (sum(consumo))consumo
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
           id_tipoSensor=4 AND usuario_id='.$id;
         $CunsumoH2ome = DB::select($sqlCunsumoH2ome);


         $sqlCunsumoEmpo='SELECT (sum(consumo))consumo
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
           id_tipoSensor=5 AND usuario_id='.$id;
         $CunsumoEmpo = DB::select($sqlCunsumoEmpo);


         // return view('consumo.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
          return view('consumo.index',['consumos' => $consumos,'CunsumoH2ome' => $CunsumoH2ome,
          'CunsumoEmpo' => $CunsumoEmpo, 'consumoFactura' => $consumoFactura]);

        
      


    }
    
    
    public function store(Request $request)
    {
        //$user = Auth::user()->id;
        // $hogar = Hogar::where('usuario_id','=',$user)->firstOrFail();
      
        $estancia = new estancia();
        $estancia->nombreEstancia= request('nombreEstancia');
        $estancia->destinoEstancia= request('destinoEstancia');
        $estancia->hogar_id= request('hogar_id');
        $estancia->dispositivo_id=request('dispositivo_id');
        $estancia->save();
        back()->with('data' ,'inresado con éxito');

        //almacenas la foranea de estancia id con la promaria de estancia en admininistracion
        $administracion = new administracion(); 
        $ultimo_id = estancia::latest('id_estancia')->first();
        $fechaAdministracion = now()->toDateString();

        $administracion->estancia_id = ($ultimo_id->id_estancia);
        $administracion->estado ='0';
        $administracion->fechaAdministracion =$fechaAdministracion;
        $administracion->descripcionAdministracion='';
        $administracion->save();

        //actualizar dispositico ocupado enviar parammetreo =1
        $dispositivoOcupado=request('dispositivo_id');
        $dispositivosUsados= dispositivo::findOrFail($dispositivoOcupado);
        $dispositivosUsados->utilizado='1';
        $dispositivosUsados->update();


        //estancia agregar a taabla consumo por que ya esta lis para arrojar datos de flujo
        //siempre y cuando sea sensor de fljo en este caso tiposensor =1
       
        $consumo = new consumo(); 
        $ultimo_id = administracion::latest('id_administracion')->first();
        $consumo->administracion_id = ($ultimo_id->id_administracion);
        $consumo->fechaConsumo = now()->toDateString();
        $consumo->consumo='0';  
        $consumo->save();

        //consultas que se utilizar lar index
        $dispositivos= dispositivo::where('utilizado', '=',0)->paginate(10);  
         $tipoSensores= tipoSensor::all(); 
         $id= request('hogar_id');
         $hogar = Hogar::findOrFail($id);
        
         $sql='SELECT 
         id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
         FROM                 
         estancias
         inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
         inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
         WHERE
         hogar_id='.$id;
         $estancias = DB::select($sql);

            return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
           
    }
    
    public function update(Request $request,  $id_estancia)
    {
        $estancia =  estancia::findOrFail($id_estancia);
       
        $estancia->nombreEstancia= request('nombreEstancia');
        $estancia->destinoEstancia= request('destinoEstancia');
        $estancia->hogar_id= request('hogar_id');
        
        $estancia->update();
        back()->with('data' ,'Actualizado con éxito');
       
         //consultas que se utilizar lar index
         $dispositivos= dispositivo::where('utilizado', '=',0)->paginate(10);  
         $tipoSensores= tipoSensor::all(); 
         $id= request('hogar_id');
         $hogar = Hogar::findOrFail($id);
        
            $sql = 'SELECT 
            id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
            FROM                 
            estancias
            inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
            inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
            WHERE
            hogar_id='.$id;
            $estancias = DB::select($sql);

            return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
        

    }

    
    public function destroy(Request $request, $id_estancia){


         //select * from administracions WHERE estancia_id=47
        //eliminar la foranea de adminisatrcion estancia_id
        //$administracion = administracion::findOrFail($id_estancia);
        //$administracion->delete();
        
       

        $estancia = estancia::findOrFail($id_estancia);
        $estancia->delete();
        back()->with('data' ,'Eliminado con éxito');

        //actualizar dispositico ocupado enviar parammetreo =1 

        $dispositivoOcupado=request('dispositivo_id');
        $dispositivosUsados= dispositivo::findOrFail($dispositivoOcupado);
        $dispositivosUsados->utilizado='0';
        $dispositivosUsados->update();

       

             //consultas que se utilizar lar index
             $dispositivos= dispositivo::where('utilizado', '=',0)->paginate(10);  
             $tipoSensores= tipoSensor::all(); 
             $id= request('hogar_id');
             $hogar = Hogar::findOrFail($id);
            
                $sql = 'SELECT 
                id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
                FROM                 
                estancias
                inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
                inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
                WHERE
                hogar_id='.$id;
                $estancias = DB::select($sql);
    
                return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
            
    }
}
