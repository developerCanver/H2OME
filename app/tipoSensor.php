<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoSensor extends Model
{
    protected $fillable = [
        'nombreTipoSensor', 'descripcionTipoSensor',                
       ];
       protected $primaryKey = 'id_tipoSensor';
}
