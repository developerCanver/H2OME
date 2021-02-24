<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTipo extends Model
{
    protected $fillable = [
        'nombreTipo',
    ];
    
    protected $primaryKey = 'id_usuarioTipo';
}
