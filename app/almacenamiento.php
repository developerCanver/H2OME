<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class almacenamiento extends Model
{
    protected $fillable = [
        'nombreAlmacenamiento', 'capacidadAlmacenamiento', 'nivel'     
       ];
       protected $primaryKey = 'id_almacenamiento';
}
