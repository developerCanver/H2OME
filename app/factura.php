<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    protected $fillable = [
        'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura','hogar_id',
               
       ];
       protected $primaryKey = 'id_factura';
  

//    'hogar_id'

}
