@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Editar Usuario:{{$user->name}}</h3>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


         <form class="form-group" method="POST" action="/usuarios/{{ $user->id}}"  enctype="multipart/form-data">
                 @method('PUT')
                @csrf
            <div class="form-group">
                <label for="">imagen</label>
                <input type="file" name="photo">
            </div>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Pepito">

                </div>

                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="Pepito@gmail.com" disabled>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Nueva Contraseña" name="password">
                   
                </div>
                

                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>

    </div>
</div>
@endsection
