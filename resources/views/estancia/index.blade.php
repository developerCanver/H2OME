@extends('layouts.app')

@section('content')
<div class="container">


    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('estancia.index',  ['tags_id' => $hogar->id_hogar]) }}">
                Estancia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('almacenamiento.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Almacenamiento
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('factura.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Facturas
            </a>
        </li>
    </ul>


    <h2>Estancia
        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar Estancia</button>
    </h2>
    @if($hogar ?? '')
    <div class="alert alert-primary" role="alert">
        Hogar
        {{$hogar->nombreHogar}}

    </div>
    @endif
    @if(session('data'))
    <div class="alert alert-success" role="alert">

        <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    {{-- ingresar registro  --------------------------------------------          --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Estancia a Hogar:
                        {{$hogar->nombreHogar}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="estancia/create" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nombre Estancia:</label>
                                <input type="text" class="form-control" name="nombreEstancia" value="@Cocina">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Destino:</label>
                                <input type="text" class="form-control" name="destinoEstancia" value="@Lavaplatos">
                            </div>
                            <div class="form-row">
                                {{-- 'id_dispositivo', 'nombreDispositivo', 'marca','utilizado','descripcionDispositivo','tipoSensor_id' --}}
                                <div class="form-group col-md-6">
                                    <label for="recipient-name" class="col-form-label">Tipo Dispositivo:</label>

                                    <select class="form-control" name="tipoSensor_id">
                                        @foreach ($tipoSensores as $tipoSensor)
                                        <option value="{{$tipoSensor->id_tipoSensor}}">{{$tipoSensor->nombreTipoSensor}}
                                        </option>

                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-16">
                                        {{-- 'id_dispositivo', 'nombreDispositivo', 'marca','utilizado','descripcionDispositivo','tipoSensor_id' --}}

                                        <label for="recipient-name" class="col-form-label"> Dispositivo:</label>

                                        <select class="form-control" name="dispositivo_id">
                                            @foreach ($dispositivos as $dispositivo)
                                            <option value="{{$dispositivo->id_dispositivo}}">
                                                {{$dispositivo->nombreDispositivo}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
    {{--  -------------  -------------------registros----------------------- --}}

    <div class="row cards" style="width: auto; margin: auto auto;">
        {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
        @foreach ($estancias as $estancia)

        <form action="{{route('estancia.destroy', $estancia->id_estancia)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="card text-center" style="width: 260px;  margin: 5px; ">
                <div class="card-header p-3 mb-2 bg-primary text-white">
                    <strong>{{$estancia->nombreDispositivo}}</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Estancia</h5>
                    <p class="card-text">{{$estancia->nombreEstancia }}.</p>
                    <h5 class="card-title">Destino </h5>
                    <div class="form-group">
                        <label for="name">{{$estancia->destinoEstancia}}.</label>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#editfactura{{$estancia->id_estancia}}" data-whatever="@mdo">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">
                    <input type="hidden" class="form-control" name="dispositivo_id"
                        value="{{$estancia->dispositivo_id}}">
        </form>


    </div>
    <div class="card-footer text-muted">
        <p class="card-text">{{$estancia->nombreDispositivo}}.</p>
    </div>
</div>

{{-- modal para editar cada tarjeta--}}

<div class="modal fade" id="editfactura{{$estancia->id_estancia}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header p-3 mb-2 bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Editar Estancia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form action="{{ route('estancia.update', $estancia->id_estancia)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre Estancia:</label>
                        <input type="text" class="form-control" name="nombreEstancia"
                            value="{{$estancia->nombreEstancia}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Destino:</label>
                        <input type="text" class="form-control" name="destinoEstancia"
                            value="{{$estancia->destinoEstancia}}">
                    </div>
                    {{-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">Tipo Dispositivo:</label>

                            <select class="form-control" name="tipoSensor_id">
                                @foreach ($tipoSensores as $tipoSensor)
                                <option value="{{$tipoSensor->id_tipoSensor}}">{{$tipoSensor->nombreTipoSensor}}
                    </option>

                    @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-16">
                        <label for="recipient-name" class="col-form-label"> Dispositivo:</label>
                        <select class="form-control" name="dispositivo_id">
                            @foreach ($dispositivos as $dispositivo)
                            <option value="{{$dispositivo->id_dispositivo}}">
                                {{$dispositivo->nombreDispositivo}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>

        </div> --}}
    </div>
    <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    </form>
</div>
</div>
</div>

@endforeach
</div>

@endsection
