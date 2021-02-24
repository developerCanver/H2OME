<?php

namespace App\Http\Controllers;

use App\UserTipo;
use Illuminate\Http\Request;

class UserTipoController extends Controller
{
    
   //primero cg¿heque sei el usuario ingreso login
   public function __construct(){
    $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request){
            $query = trim($request->get('search'));
               $users= UserTipo::where('nombreTipo','LIKE', '%'. $query .'%')
               ->orderBy('id_usuario','asc')
               ->paginate(5);
            //->paginate(5); PAGINACION DE LOS LISTADS O ->simplePaginate
    
               return view('userTipo.index', ['users' => $users, 'search'=>$query]);
           }
    }

    public function create()
    {
        //
        return view ('userTipo.create');
    }

    
    public function store(Request $request)
    {
        $tipousu = new UserTipo();
        $tipousu->nombreTipo= request('nombreTipo');
       
         $tipousu->save();
         back()->with('data' ,'inresado con éxito');
         return redirect('/userTipo');
    }

   
    public function show( $id_usuarioTipo)
    {
        //
        return view('userTipo.show',['user' => UserTipo::findOrFail($id_usuarioTipo)]);
    }

    
    public function edit( $id_usuarioTipo)
    {
          //llega de index.blade y envia edit.blade 
        //la consulta mientras cumple el id
        return view('userTipo.edit',['user' => UserTipo::findOrFail($id_usuarioTipo)]);
    }

  
    public function update(Request $request,  $id_usuarioTipo)
    {
        $usuario =  UserTipo::findOrFail($id_usuarioTipo);
        // $usuario es la consulta cuando cumple id
        $usuario->nombreTipo= request('nombreTipo');

        $usuario->update();
        back()->with('data' ,'Actualizado con éxito');
        return redirect('/userTipo');
    }

    
    public function destroy($id_usuarioTipo)
    {
        //
        $usuario = UserTipo::findOrFail($id_usuarioTipo);
        $usuario->delete();
        back()->with('data' ,'Eliminado con éxito');
        return  redirect('/userTipo');
    }

}
