<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;//para incriptar contraseña
use App\Hogar;
use App\UserTipo;
use App\almacenamiento;
use App\stock;


class UserLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search='';
    protected $queryString = ['search'];
    public $name,$email,$password,$id_tipo;



    public function render()
    {
 
                    $query = 'prueba';
                    $users= User::where('name','LIKE', '%'. $this->search .'%')
                    ->where("id","!=",1)
                    ->orderBy('id','asc')
                    ->paginate(5);
                    return view('livewire.user-livewire', ['users' => $users]);
                
    
   
       // return view('livewire.user-livewire');
    }

    public function store()
    {
        if ($this->id_tipo == '') {
            $this->id_tipo="2";
        }
       dd($this->id_tipo);
    
    }

    public function destroy($id)
    {
        //
        $usuario = User::findOrFail($id);
        $usuario->delete();
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Eliminado con Exito!  🌝']);
    }

}
