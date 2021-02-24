<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;



class Homelivewire extends Component
{
    public function render()
    {
        
            $conHogar = DB::table('hogars')->count();
            $conUser = DB::table('users')->count();
            $conDispositivo = DB::table('dispositivos')->count();
            $conEstancias = DB::table('estancias')->count();
            $dispositivosUsados = DB::table('dispositivos')->where('utilizado', '=', 1)->count();
            $dispositivosUsados =($dispositivosUsados*100)/$conDispositivo;
           
    
            return view('livewire.homelivewire', [
                'conHogar' => $conHogar, 
                'conUser' => $conUser,
                'conDispositivo' => $conDispositivo,
                'conEstancias' => $conEstancias,
                'dispositivosUsados' => $dispositivosUsados,
            ]);
        
    }
}
