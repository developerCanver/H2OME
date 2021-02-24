@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">


            <form action="/usuarios" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Pepito">

                </div>
                <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Usuario</label>

                    
                    <select class="select-css" name="id_tipo">
                        @foreach ($usersTipo as $user)
                        <option value="{{$user->id_usuario}}">{{$user->nombreTipo}}</option>

                        @endforeach
                  
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Pepito@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>

    </div>
</div>
@endsection
