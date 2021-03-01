<?php

namespace App\Http\Controllers;

use App\estancia;
use App\dispositivo;
use App\tipoSensor;
use App\Hogar;
use App\administracion;
use App\consumo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstanciaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      
        //return Request::all();
    
        // $id_hogar = Hogar::findOrFail($id_hogar);

        // $data = File::findOrFail($id_hogar);

        // $pdfdata = Hogar::table('id_hogar ')->get();


        // $estancias= estancia::all();
        
        // return view('estancia.index', compact('data', 'id_hogar', 'estancias'));

       
        
        // $estancias= Estancia::findOrFail($id);
        // $hogar_id = Hogar::findOrFail($id_hogar);
        // $user = Hogar::hogars('nombreHogar')->where('id_hogar', $id_hogar)->first();
        // $user = Hogar::with('posts')->findOrFail($id_hogar);

       
     
        // $user = Auth::user()->id;
        
         $dispositivos= dispositivo::where('utilizado', '=',0)->paginate(10);         
         $tipoSensores= tipoSensor::all();         
         if ($request->get('tags_id')) {
            //dd($request->get('tags_id'));
            $id=$request->get('tags_id');

            $hogar = Hogar::findOrFail($id);
           // $estancias = Estancia::where("hogar_id","=",$id);

            
            
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
            
        // if ($user==1) {        
         //return view('estancia.index',['estancias' => $estancias, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
            
        // }else{
        //     $hogar = Estancia::where('usuario_id','=',$user)->firstOrFail();
        // return view('hogar.index',['hogar'=> $hogar, 'user'=>$user]);
        
        //retornar todo
        //return Request::all();

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
        back()->with('data' ,'ingresado con éxito');

        //almacenas la foranea de estancia id con la promaria de estancia en admininistracion
        $administracion = new administracion(); 
        $ultimo_id = estancia::latest('id_estancia')->first();
        //$fechaAdministracion = now()->toDateString();= date("Y-m-d H:i:s"); 
        $fechaAdministracion = date("Y-m-d H:i:s"); 

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
        
         $sql = 'SELECT 
         id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
         FROM                 
         estancias
         inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
         inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
         WHERE
         hogar_id='.$id;
         $estancias = DB::select($sql);

          ///  return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
          return redirect('estancia?tags_id='.$id); 
    }

  
    public function show(estancia $estancia)
    {
        //
    }

    
    public function edit(estancia $estancia)
    {
        //
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
         //$hogar = Hogar::findOrFail($id);
        
            // $sql = 'SELECT 
            // id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
            // FROM                 
            // estancias
            // inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
            // inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
            // WHERE
            // hogar_id='.$id;
            // $estancias = DB::select($sql);

            // return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
            return redirect('estancia?tags_id='.$id); 

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
            // $hogar = Hogar::findOrFail($id);
            
                // $sql = 'SELECT 
                // id_estancia, nombreEstancia, destinoEstancia, hogar_id,dispositivo_id, nombreDispositivo,nombreHogar,usuario_id 
                // FROM                 
                // estancias
                // inner JOIN hogars ON estancias.hogar_id=hogars.id_hogar
                // inner join dispositivos on estancias.dispositivo_id= dispositivos.id_dispositivo
                // WHERE
                // hogar_id='.$id;
                // $estancias = DB::select($sql);
    
                // return view('estancia.index',['estancias' => $estancias, 'hogar' => $hogar, 'dispositivos' => $dispositivos, 'tipoSensores' => $tipoSensores]);
                return redirect('estancia?tags_id='.$id); 
    }
}
