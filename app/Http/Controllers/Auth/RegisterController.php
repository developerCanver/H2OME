<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Hogar;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  

    use RegistersUsers;

   
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
    }


    protected function create(array $data)
    {   

        User::create([
            'name' => $data['name'],            
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_tipo' => ('2'),
            'photo' => ('user.png'),
        ]);
        return Hogar::create([
            'usuario_id' => ('1'),            
            'nombreHogar' => ('Hogar'),
            'numeroPersonas' => ('0'),
            'direccion' => ('direccion'),
                    
        ]);
         

    }
}
