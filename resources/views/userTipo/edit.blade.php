@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Editar Usuario:{{$user->nombreTipo}}</h3>
             
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


         <form action="{{ route('userTipo.update', $user->id_usuarioTipo)}}" method="POST">
            @method('PATCH')    
            @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" value="{{$user->nombreTipo}}" name="nombreTipo" placeholder="Pepito">

                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form> 
        </div>

    </div>
</div>
@endsection
