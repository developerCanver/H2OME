<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Homelivewire extends Component
{
    public function render()
    {
        
        $user = Auth::user()->id;
        $conHogar = '';
        $conUser = '';

        if ($user==1) {
            $conHogar = DB::table('hogars')->count();
            $conUser = DB::table('users')->count();
            $conDispositivo = DB::table('dispositivos')->count();
            $conEstancias = DB::table('estancias')->count();
            $dispositivosUsados = DB::table('dispositivos')->where('utilizado', '=', 1)->count();
            $dispositivosUsados =($dispositivosUsados*100)/$conDispositivo;
            $dispositivosUsados =round($dispositivosUsados, 2);
        }else{
         
            $conDispositivo = DB::table('dispositivos')
            ->join('estancias', 'dispositivos.id_dispositivo', '=', 'estancias.dispositivo_id')
            ->join('hogars', 'hogars.id_hogar', '=', 'estancias.hogar_id')
            ->join('users', 'users.id', '=', 'hogars.usuario_id')
            ->where('users.id', $user)
            ->count();
            $conEstancias = DB::table('estancias')->count();
            $dispositivosUsados = DB::table('dispositivos')
            ->join('estancias', 'dispositivos.id_dispositivo', '=', 'estancias.dispositivo_id')
            ->join('hogars', 'hogars.id_hogar', '=', 'estancias.hogar_id')
            ->join('users', 'users.id', '=', 'hogars.usuario_id')
            ->where('users.id', $user)
            ->where('utilizado', '=', 1)
            ->count();
            $dispositivosUsados =($dispositivosUsados*100)/$conDispositivo;
            $dispositivosUsados =round($dispositivosUsados, 2);

        }
        
          
            
           
    
            return view('livewire.homelivewire', [
                'conHogar' => $conHogar, 
                'conUser' => $conUser,
                'conDispositivo' => $conDispositivo,
                'conEstancias' => $conEstancias,
                'dispositivosUsados' => $dispositivosUsados,
            ]);
        
    }
}
