<?php

namespace App\Http\Controllers;
use App\Nota;
use Illuminate\Http\Request;


class NotaController extends Controller
{
    
    public function index(){
        return view('notas.todas.index',['notas'=> Nota::all()]);
    }
    public function store (Request $request){

        $nota = new Nota();
        $nota->titulo = request('titulo');
        $nota->texto = request('texto');
        $nota->user_id = auth()->id();
        
        $nota->save();
         return redirect('notas/todas');


    }

    public function favoritas(){
        return view('notas.favoritas');
    }
    
    public function archivadas(){
        return view('notas.archivadas');
    }
}
