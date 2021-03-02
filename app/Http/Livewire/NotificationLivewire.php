<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class NotificationLivewire extends Component
{
    public function render()
    {
        $id = Auth::user()->id;
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

        $sqlnotificacion ='SELECT id_consumo, consumo, consumos.created_at,administracion_id
        FROM
        consumos
        inner join administracions on  consumos.administracion_id=administracions.id_administracion
        inner join estancias	 on administracions.estancia_id=estancias.id_estancia
        inner join hogars on estancias.hogar_id=hogars.id_hogar       

        WHERE 
        consumos.created_at >= now() - interval 1 minute AND
        hogars.usuario_id ='.$id;
        $notificacion = DB::select($sqlnotificacion);
        if (empty($notificacion)) {
            $notificacion = 'OFF';
        }else{
            $notificacion = 'ON';
        }
        //dd($notificacion);
    

        return view('livewire.notification-livewire',[
            'consumos' => $consumos,
            'notificacion' => $notificacion,
        ]);
    }
}
