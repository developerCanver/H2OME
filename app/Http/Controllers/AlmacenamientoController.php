<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\Hogar;
use App\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AlmacenamientoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->get('stock_id')) {
            //dd($request->get('tags_id'));
            $id=$request->get('stock_id');

           $hogar = Hogar::findOrFail($id);
           // $estancias = Estancia::where("hogar_id","=",$id);

           $sql = 'SELECT id_hogar, nombreHogar,id_stock,maximo,minimo,media,id_almacenamiento,
           nombreAlmacenamiento,capacidadAlmacenamiento, nivel
           FROM  hogars
           inner join almacenamientos on hogars.id_hogar=almacenamientos.hogar_id
           inner JOIN stocks on almacenamientos.id_almacenamiento=stocks.almacenamiento_id           
           WHERE
           id_hogar='.$id;
           $stocks = DB::select($sql);
 
            return view('almacenamiento.index',['stocks' => $stocks,'hogar'=>$hogar]);
           
             }
         
      
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request, $id_stock)
    {
       
    }

   
    public function show(almacenamiento $almacenamiento)
    {
        //
    }

   
    public function edit(almacenamiento $almacenamiento)
    {
        //
    }

   
    public function update(Request $request, $id_stock)
    {
        if ($request->get('boton')=="1") {
            //si es boton 1 se cambi los valores para tanque
            $id_almacenamiento= request('id_almacenamiento');
            $almacenamiento=almacenamiento::findOrFail($id_almacenamiento);
            $almacenamiento->nombreAlmacenamiento= request('nombreAlmacenamiento');
            $almacenamiento->capacidadAlmacenamiento= request('capacidadAlmacenamiento');
            $almacenamiento->update();
        
           
       }else{
            //si es boton 2 se cambi los valores para stock

            $stock = stock::findOrFail($id_stock);
            $stock->maximo= request('maximo');
            $stock->minimo= request('minimo');
            $stock->media= request('media');

            $stock->update();

       }
       back()->with('data' ,'Actualizado con éxito');

       $stocks= request('hogar_id');
     
       // return view('almacenamiento.index',['stock_id' => $stocks]);
        return redirect('almacenamiento?stock_id='.$stocks);
    
           
    }

  
    public function destroy(almacenamiento $almacenamiento)
    {
        //
    }
}
