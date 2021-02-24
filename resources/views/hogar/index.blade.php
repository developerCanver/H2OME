@extends('layouts.app')

@section('content')
<div class="container">
    @if($user==2)


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


                        <div class="card-body">

                            <p class="card-text">{{ $hogar->nombreHogar }}</p>
                            <p class="card-text">{{ $hogar->direccion }}</p>
                            <p class="card-text">{{ $hogar->numeroPersonas }}</p>


                            <a href="{{route('hogar.edit', $hogar->id_hogar)}}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            

                        </div>


                        {{-- <a href="{{ route('usuarios.destroy', $hogar->id_hogar)}}" class="btn
                        btn-primary">Actualizar</a> --}}


                    </div>

                </div>
            </div>

        </div>
    </div>


    @else


    <h2>Lista de hogares registrados    </h2>
    <h6>
        @if($search)
        <div class="alert alert-primary" role="alert">
            Los Resultasdos para tu busqueda {{$search}} son:
        </div>
        @endif
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
                <th scope="col">Nombre Hogar</th>
                <th scope="col">dirección</th>
                <th scope="col">N. Persnas</th>
                <th scope="col">Cantidad de Grifos</th>
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($hogares as $hogar)
            <tr>
                <th scope="row">{{$hogar->id_hogar}}</th>
                <td>{{$hogar->nombreHogar}}</td>
                <td>{{$hogar->direccion}}</td>
                <td>{{$hogar->numeroPersonas}}</td>
                <td>{{$hogar->numeroGrifos}}</td>

                <td>                 
                    <a href="{{ route('hogar.edit', $hogar->id_hogar)}}">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Actualizar">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    {{-- <a  href=”{{ (‘parametro/2’)}}”> --}}
                        @if ($hogar->numeroGrifos!="0")
                        <a href="{{route('estancia.index',  ['tags_id' => $hogar->id_hogar]) }}">
                            <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Estancia">
                                <i class="fab fa-houzz"></i>
                                {{-- <i class="fas fa-house-user"></i> --}}
                                {{-- <i class="fas fa-laptop-house"></i> --}}
                            </button>
                        </a>
    
                        <a href="{{route('consumo.index',  ['id_hogar' => $hogar->id_hogar]) }}">
                            <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Consumo">
                                <i class="fas fa-chart-area"></i>
                            </button>
    
                          
                        </a>
                            
                        @endif
                    

                    {{-- <a href="{{ action('estancia\'EstanciaController@index', ['tags_id' => $hogar->id_hogar]) }}" id="tags">ir</a> --}}

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="mx-auto">
            {{ $hogares->links() }}
            {{-- PAGINACION CON EL METODO LINKS --}}
        </div>

    </div> 
</div>
@endif
@endsection
