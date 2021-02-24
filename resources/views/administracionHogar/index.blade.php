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
                    </div>
                </div>
            </div>

        </div>
    </div>

    @else

    <h2>Lista de hogares registrados </h2>
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
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($hogares as $hogar)
            <tr>
                <th scope="row">{{$hogar->id_hogar}}</th>
                <td>{{$hogar->nombreHogar}}</td>
                <td>{{$hogar->direccion}}</td>
                <td>
                    

                    {{-- <a href="{{route('consumo.index',  ['id_hogar' => $hogar->id_hogar]) }}">
                        <button type="button" class="btn btn-success">
                            <i class="fas fa-tint"></i>
                        </button>
                    </a> --}}
                    <a href="{{ route('administracionHogar.show', $hogar->id_hogar)}}">
                        <button type="button" class="btn btn-secondary">Generar consumo</button></a>
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

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Estancia



    </h2>

    @if(session('data'))
    <div class="alert alert-success" role="alert">

        <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
{{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif --}}


{{-- ingresar registro  --------------------------------------------          --}}


{{-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar Sensor</button> --}}




{{-- <div class="row">
        @if(session('data'))
        <div class="alert alert-success" role="alert">

            <strong>{{(session('data'))}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
</div> --}}


{{--

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre Hogar</th>
            <th scope="col">Consumo</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($hogares as $hogar)
        <tr>
            <th scope="row">{{$hogar->id_hogar}}</th>
<td>{{$hogar->nombreHogar}}</td>



<td>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editfactura{{$hogar->id_hogar}}"
        data-whatever="@mdo">
        <i class="fas fa-shower"></i>
    </button>

</td>

</tr>

<div class="modal fade" id="editfactura{{$hogar->id_hogar}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header p-3 mb-2 bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Editar Estancia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>




            <div class="modal-body">
                <div class="form-group">
                    <div class="text-center">
                        <form action="{{ url('administracionHogar/create', [$hogar->id_hogar])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="clima" value="1">
                            <button type="submit" class="btn btn-primary">Clima 1</button>
                        </form>

                        <form action="{{ url('administracionHogar/create', [$hogar->id_hogar])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="clima" value="2">
                            <button type="submit" class="btn btn-primary">Clima 2</button>
                        </form>

                        <form action="{{ url('administracionHogar/create', [$hogar->id_hogar])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="clima" value="3">
                            <button type="submit" class="btn btn-primary">Clima 3</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer">


            </div>

        </div>
    </div>
</div>


@endforeach

</tbody>
</table>

</div>
</div>

@endsection --}}
