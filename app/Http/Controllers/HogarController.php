<?php

namespace App\Http\Controllers;

use App\Hogar;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class HogarController extends Controller
{
    public function __construct(){
       $this->middleware('auth');
   }
    public function index(Request $request )
    {   
        $user = Auth::user()->id;
        if ($user==1) {

            if($request){
                $query = trim($request->get('search'));
                   $hogares= Hogar::where('nombreHogar','LIKE', '%'. $query .'%')
                   ->orderBy('id_hogar','asc')
                   ->paginate(5);


                   return view('hogar.index',['user'=> $user, 'search'=>$query, 'hogares' => $hogares]);
               }
            
        }else{
            $query = trim($request->get('search'));
            $hogar =  $hogares= Hogar::where('nombreHogar','LIKE', '%'. $query .'%')
            ->orderBy('id_hogar','asc')
            
            ->where('usuario_id','=',$user)->paginate(5);
        return view('hogar.index',['hogares'=> $hogar, 'user'=>$user,'search'=>$query]);
        }
        
    }


  
    public function edit($id_hogar)
    {
        return view('hogar.edit',['hogar' => Hogar::findOrFail($id_hogar)]);
    }


    public function update(Request $request ,$id_hogar){
   
        $hogar =  Hogar::findOrFail($id_hogar);
        $hogar->nombreHogar= request('nombreHogar');
        $hogar->direccion= request('direccion');
        $hogar->numeroPersonas= request('numeroPersonas');
        $hogar->numeroGrifos= request('numeroGrifos');
        $hogar->update();
           
         back()->with('data' ,'Actualizado con éxito');
         return redirect('/hogar');
        
    
    }

    public function destroy(Hogar $hogar){
        //
    }
}
