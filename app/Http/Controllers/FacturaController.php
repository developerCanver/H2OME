<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\factura;
use App\Hogar;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    
    }

    public function index(Request $request)
    {
        $user = Auth::user()->id;
       
        if ($user==1) {

        $id=$request->get('stock_id');

        $hogar = Hogar::findOrFail($id);
      //$hogar= Hogar::all();
       //$facturas= Factura::all();
       //$facturas = Factura::where('hogar_id','=',$id)->firstOrFail();
       $sql = 'SELECT id_factura, medidor, codigo, consumoPromedio, 
       saldoPromedio, fechaFactura,hogar_id
        FROM facturas WHERE hogar_id='.$id;
           $facturas = DB::select($sql);

        return view('factura.index',['facturas'=>$facturas,'hogar'=>$hogar]);
        }
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
     
       
        $id= request('hogar_id');
        $user = Auth::user()->id;
        // $hogar = Hogar::where('usuario_id','=',$user)->firstOrFail();

        $factura = new Factura();
        $factura->medidor= request('medidor');
        $factura->codigo= request('codigo');
        $factura->consumoPromedio= request('consumoPromedio');
        $factura->saldoPromedio=request('saldoPromedio');
        $factura->fechaFactura=request('fechaFactura');
        if ($user==1) {
            $factura->hogar_id=request('hogar_id');
        }else{
            $factura->hogar_id=($user);
        }

        
        $factura->save();

         back()->with('data' ,'ingresado con éxito');
         
         return redirect('factura?stock_id='.$id); 
    }

    
    public function show(factura $factura)
    {
        //
    }

    
    public function edit(factura $id_factura)
    {
       

    }

    
    public function update(Request $request,  $id_factura)
    {
        $factura =  Factura::findOrFail($id_factura);
        $id= request('hogar_id');

        $factura->medidor= request('medidor');
        $factura->codigo= request('codigo');
        $factura->consumoPromedio= request('consumoPromedio');
        $factura->saldoPromedio=request('saldoPromedio');
        $factura->fechaFactura=request('fechaFactura');
      


        $factura->update();
        back()->with('data' ,'Actualizado con éxito');

        return redirect('factura?stock_id='.$id); 
    }

    
    public function destroy( $id_factura)
    {
        $id= request('hogar_id');
        $factura = Factura::findOrFail($id_factura);
        $factura->delete();
        back()->with('data' ,'Eliminado con éxito');
        return redirect('factura?stock_id='.$id); 
    }
}
