@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            {{-- <h3>Editar Usuario:{{$hogar ?? ''->name}}</h3> --}}
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


         <form class="form-group" method="POST" action="/hogar/{{ $hogar->id_hogar}}" >
            @method('PUT')
                @csrf
           
                <div class="form-group">
                    <label for="name">Nombre Hogar</label>
                    <input type="text" class="form-control" value="{{$hogar->nombreHogar}}" name="nombreHogar" >
                    {{-- value="{{$hogar ?? ''->nombreHogar}}" --}}
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección </label>
                    <input type="text" class="form-control" value="{{$hogar->direccion}}" name="direccion" >
                </div>

                <div class="form-group">
                    <label for="direccion">No. Personas </label>
                    <input type="text" class="form-control" value="{{$hogar->numeroPersonas}}" name="numeroPersonas" >
                </div>
               
                

                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>

    </div>
</div>
@endsection
