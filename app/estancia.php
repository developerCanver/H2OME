<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estancia extends Model
{
    protected $fillable = [
        'nombreEstancia', 'destinoEstancia', 'dispositivo_id',
               
       ];
       protected $primaryKey = 'id_estancia';
}
