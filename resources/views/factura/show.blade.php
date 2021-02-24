@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="row cards" style="width: auto; margin: auto auto;">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mi Hogar</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 38rem;" src="img/users/hogar.png"
                            alt="">

                        <h5 class="card-title">Mis Datos...</h5>
                        @if(session('hogar'))

                        <div class="card-body">
                            <p class="card-text">{{ $hogar->nombreHogar }}</p>
                            <p class="card-text">{{ $hogar->direccion }}</p>
                            <p class="card-text">{{ $hogar->numeroPersonas }}</p>


                            {{-- <a href="/usuarios/{{$hogar->idHogar}}/edit" class="btn btn-primary">Actualizar</a>
                            --}}
                        </div>
                        @else
                        
                            <p class="card-title">Nombre Hogar</p>
                            <p class="card-text">Dirección</p>
                            <p class="card-text">No. de Personas</p>


                            <a href="{{ route('hogar.edit') }}" class="btn btn-primary">Actualizar</a>
                      
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
