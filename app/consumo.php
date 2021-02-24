<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class consumo extends Model
{
    protected $fillable = [
        'consumo', 'fechaConsumo',              
       ];
       protected $primaryKey = 'id_consumo ';
}
