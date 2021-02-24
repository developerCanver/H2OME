<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $fillable = [
        'id_stock', 'minimo', 'media','maximo',
               
       ];
       protected $primaryKey = 'id_stock';
}
