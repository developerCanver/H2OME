@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="/usuarios" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Pepito">
                    {{-- @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror --}}
                </div>
                <div class="form-group">
                    <label for="name">Usuario</label>


                    <select id="id_tipo" name="id_tipo">
                        <option value="2">User</option>
                        <option value="1">Admin</option>
                       
                        
                    </select>

                    {{-- <select class="select-css" name="id_tipo">
                        @foreach ($usersTipo as $user)
                        <option value="{{$user->id_usuario}}">{{$user->nombreTipo}}</option>

                        @endforeach

                    </select> --}}
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Pepito@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                    {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror --}}
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>

    </div>
</div>
@endsection
