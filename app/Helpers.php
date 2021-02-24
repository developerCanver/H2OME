<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{

    protected $table = 'facturas';
    protected $fillable = [
        'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura','hogar_id',
               
       ];
       protected $primaryKey = 'id_factura';
  

//    'hogar_id'

}
