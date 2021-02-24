<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;//para incriptar contraseña
use App\Http\Requests\UserCreateFormRequest;
use App\User;
use App\Hogar;
use App\UserTipo;
use App\almacenamiento;
use App\stock;

use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //primero cg¿heque sei el usuario ingreso login
   public function __construct(){
       $this->middleware('auth');
   }

    //mostrar un alista de registros
    public function index(Request $request)
    {
       
        $user = Auth::user()->id;
        if ($user==1) {
            if($request){
                    $query = trim($request->get('search'));
                    $users= User::where('name','LIKE', '%'. $query .'%')
                    ->where("id","!=",1)
                    ->orderBy('id','asc')
                    ->paginate(5);
                    return view('usuarios.index', ['users' => $users, 'search'=>$query]);
                }
       }else{
            if($request){
                $query = trim($request->get('search'));
                $users= User::where('name','LIKE', '%'. $query .'%')
                ->where("id","=",$user)
                ->orderBy('id','asc')
                ->paginate(5);
                return view('usuarios.index', ['users' => $users, 'search'=>$query]);

            }
        }
   


    }


    public function create()
    {
         $user = UserTipo::all();
        // $user es el array de toso los datos traidos 

        return view('usuarios.create',['usersTipo'=>$user]);
        
    }

     //almacenar los registro recien creados en la base de datos
    public function store(UserFormRequest $request)
    {
        $usuario = new User();
        $usuario->name= request('name');
        $usuario->email= request('email');
        $usuario->password= Hash::make(request('password'));
        $usuario->id_tipo=request('id_tipo');
        $usuario->photo=('user.png');
        $usuario->save();
        
        $usuarioHogar_fk = new Hogar();
         $usuarioHogar_fk->nombreHogar= request('name');
         $usuarioHogar_fk->direccion=('dirección');
         $usuarioHogar_fk->numeroPersonas=('0'); 
         $usuarioHogar_fk->numeroGrifos=('0');               
         $usuarioHogar_fk->usuario_id = ($usuario->id);         
         $usuarioHogar_fk->save();

         $almacenamiento = new almacenamiento();
        $almacenamiento->nombreAlmacenamiento=('Nombre Almacenamiento');
        $almacenamiento->capacidadAlmacenamiento=('0');  
        $almacenamiento->nivel=(''); 
        $ultimo_id = Hogar::latest('id_hogar')->first();   
        $almacenamiento->hogar_id=($ultimo_id->id_hogar);       
        $almacenamiento->save();

        $stock = new stock();        
        $stock->minimo= ('0');  
        $stock->media= ('0'); 
        $stock->maximo= ('0'); 
        $ultimo_id = almacenamiento::latest('id_almacenamiento')->first();   
        $stock->almacenamiento_id=($ultimo_id->id_almacenamiento );       
        $stock->save();


         back()->with('data' ,'inresado con éxito');
         return redirect('/usuarios');
    
    }

   

     //metodo un registro espesicifco
    public function show($id)
    {
        return view('usuarios.show',['user' => User::findOrFail($id)]);
    }
    
   

    

     //muestra el formulario con los datos a editar con un registro espesifico
    public function edit($id)
    {
        //llega de index.blade y envia edit.blade 
        //la consulta mientras cumple el id
        
        return view('usuarios.edit',['user' => User::findOrFail($id)]);
    }

    

     //actualizar un registro o muchos en la BD
    public function update(UserCreateFormRequest $request, $id)
    {
        //
        $usuario =  User::findOrFail($id);
        // $usuario es la consulta cuando cumple id
        $usuario->name= $request->get('name');

        if($request->hasFile('photo')){
            // tratar el archivo en datos planos
            $file =$request->file('photo');
    
            //para almacenar el archivo en una carpeta
            //cambiando el nombre con concatenacion con el nombre y la fecha
            $name = time().$file->getClientOriginalName();
            //move para mover el archivo en una carpeta
            $usuario->photo=$name;
            $file->move(public_path().'/img/users/', $name);
        }

           if ($request->get('password')) {
            $usuario->password= Hash::make($request->get('password'));
           }
           

        $usuario->update();
        back()->with('data' ,'Actualizado con éxito');
        return view('usuarios.show',['user' => User::findOrFail($id)]);

    }

  

     //eliminar registrados BD
    public function destroy($id)
    {
        //
        $usuario = User::findOrFail($id);
        $usuario->delete();
        back()->with('data' ,'Eliminado con éxito');
        return  redirect('/usuarios');
    }
}
