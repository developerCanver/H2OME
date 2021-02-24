@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Content here -->
    <h2>Tipo Usuarios
        <a href="userTipo/create">
            <button type="button" class="btn btn-success float-right">Agregar usuario</button>
        </a>
    </h2>
    <h6>

    </h6>
    @if(session('data'))
    <div class="alert alert-success" role="alert">

        <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tipo Usuario</th>


            </tr>
        </thead>
        <tbody>
            {{-- foreach espara recorrer el cilco de cuantos usuarios se tiene en la base de datos
        $users es la variable que traigo del controlador y recooro con la variable 
        que creo user  --}}
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id_usuarioTipo}}</th>
                <td>{{$user->nombreTipo}}</td>

                <td>


                    <form action="{{ route('userTipo.destroy', $user->id_usuarioTipo)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('userTipo.show', $user->id_usuarioTipo)}}">
                            <button type="button" class="btn btn-secondary">Ver</button></a>
                        <a href="{{ route('userTipo.edit', $user->id_usuarioTipo)}}">
                            <button type="button" class="btn btn-primary">Actualizar
                            </button>
                        </a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="mx-auto">
            {{ $users->links() }}
            {{-- PAGINACION CON EL METODO LINKS --}}
        </div>

    </div>
</div>
</div>scczxczx

@endsection
