<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;//para incriptar contraseña
use App\Hogar;
use App\UserTipo;
use App\almacenamiento;
use App\stock;
use App\User;


class UserLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search='';
    protected $queryString = ['search'];
    public $name,$email,$photo,$password,$id_tipo;



    public function render()
    {
 
                    $query = 'prueba';
                    $users= User::search($this->search)   
                    ->where("id","!=",1)
                    ->orderBy('id','asc')
                    ->paginate(5);
                    return view('livewire.user-livewire', ['users' => $users]);
                
    
   
       // return view('livewire.user-livewire');
    }

    public function store()
    {

        // $this->validate([
        //     'photo' => 'image|max:1024', // 1MB Max
        // ]);
        
        $usuario = new User();
        $usuario->name=$this->name;
        $usuario->email= $this->email;
        $usuario->password= Hash::make($this->password);

        if ($this->id_tipo == '') {
            $this->id_tipo="2";
        }
        $usuario->id_tipo=$this->id_tipo; 
        if ($this->photo == '') {
            $usuario->photo=('user.png');
        }else{
        
            $file=$this->photo;
            $name = time().$file->getClientOriginalName();
            $usuario->photo=$name;
            $file->storeAs('img/users/', $name, 'public_uploads');
        }
      
        
        $usuario->save();
        
        $usuarioHogar_fk = new Hogar();
         $usuarioHogar_fk->nombreHogar= $this->name;
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


         return redirect('/usuarios');
    
    }

    public function destroy($id){
        //
        $usuario = User::findOrFail($id);
        $usuario->delete();
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Eliminado con Exito!  🌝']);
    }


    public function edit($id){
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function update($id){

        $usuario =  User::findOrFail($id);
        // $usuario es la consulta cuando cumple id
        $usuario->name= $this->name;
       $usuario->email= $this->email;

        if ($this->photo != '') {
            $file=$this->photo;
            $name = time().$file->getClientOriginalName();
            $usuario->photo=$name;
            $file->storeAs('img/users/', $name, 'public_uploads');
        }

           if ($this->password) {
            $usuario->password= Hash::make($this->password);
           }
           

        $usuario->update();
        back()->with('data' ,'Actualizado con éxito');
        return redirect('/usuarios');
    }


}
