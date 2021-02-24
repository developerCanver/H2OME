<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class administracion extends Model
{
    protected $fillable = [
        'estado', 'fechaAdministracion', 'descripcionAdministracion', 'estancia_id',           
       ];
       protected $primaryKey = 'id_administracion';
}
