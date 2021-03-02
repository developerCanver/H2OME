<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Homelivewire extends Component
{
    public function render()
    {
        
        $user = Auth::user()->id;
        $conHogar = '';
        $conUser = '';

        if ($user==1) {
            $conHogar = DB::table('hogars')->count();
            $conUser = DB::table('users')->count();
            $conDispositivo = DB::table('dispositivos')->count();
            $conEstancias = DB::table('estancias')->count();
            $dispositivosUsados = DB::table('dispositivos')->where('utilizado', '=', 1)->count();
            $dispositivosUsados =($dispositivosUsados*100)/$conDispositivo;
            $dispositivosUsados =round($dispositivosUsados, 2);
            return view('livewire.homelivewire', [
                'conHogar' => $conHogar, 
                'conUser' => $conUser,
                'conDispositivo' => $conDispositivo,
                'conEstancias' => $conEstancias,
                'dispositivosUsados' => $dispositivosUsados,
            ]);
        

        }else{
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
             id_tipoSensor!=4 and id_tipoSensor!=5 AND usuario_id='.$user;
           $consumos = DB::select($sql);

         
            $conDispositivo = DB::table('dispositivos')
            ->join('estancias', 'dispositivos.id_dispositivo', '=', 'estancias.dispositivo_id')
            ->join('hogars', 'hogars.id_hogar', '=', 'estancias.hogar_id')
            ->join('users', 'users.id', '=', 'hogars.usuario_id')
            ->where('users.id', $user)
            ->count();
            $conEstancias = DB::table('estancias')->count();
            $dispositivosUsados = DB::table('dispositivos')
            ->join('estancias', 'dispositivos.id_dispositivo', '=', 'estancias.dispositivo_id')
            ->join('hogars', 'hogars.id_hogar', '=', 'estancias.hogar_id')
            ->join('users', 'users.id', '=', 'hogars.usuario_id')
            ->where('users.id', $user)
            ->where('utilizado', '=', 1)
            ->count();
            $dispositivosUsados =($dispositivosUsados*100)/$conDispositivo;
            $dispositivosUsados =round($dispositivosUsados, 2);

            return view('livewire.homelivewire', [
                'conHogar' => $conHogar, 
                'conUser' => $conUser,
                'conDispositivo' => $conDispositivo,
                'conEstancias' => $conEstancias,
                'dispositivosUsados' => $dispositivosUsados,
                'consumos' => $consumos,
            ]);

        }
        
          
            
           
    
       
    }
}
