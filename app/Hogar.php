<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hogar extends Model
{
    protected $fillable = [
     'nombreHogar', 'direccion', 'numeroPersonas','numeroGrifos',
        	
    ];
    protected $primaryKey = 'id_hogar';
}
