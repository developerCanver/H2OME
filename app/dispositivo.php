<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dispositivo extends Model
{
    
    protected $fillable = [
        'nombreDispositivo', 'marca', 'utilizado', 'descripcionDispositivo',             
       ];
       protected $primaryKey = 'id_dispositivo';
}
