@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sensor


        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar Sensor</button>
    </h2>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Sensor </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="sensores/create" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre Dispositivo:</label>
                            <input type="text" class="form-control" name="nombreDispositivo" value="@10000">
                        </div>
                        <div class="form-row">
                            {{-- 'id_dispositivo', 'nombreDispositivo', 'marca','utilizado','descripcionDispositivo','tipoSensor_id' --}}
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Tipo Dispositivo:</label>

                                <select class="select-css" name="tipoSensor_id">
                                    @foreach ($tipoSensores as $tipoSensor)
                                    <option value="{{$tipoSensor->id_tipoSensor}}">{{$tipoSensor->nombreTipoSensor}}
                                    </option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Utilizado:</label>

                                <select name="utilizado">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" value="@YF-S201">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Descripcion Dispositivo</label>
                            <input type="text" class="form-control" name="descripcionDispositivo" value="1/2 Pulgada">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        @if(session('data'))
        <div class="alert alert-success" role="alert">

            <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="row cards" style="width: auto; margin: auto auto;">
        {{-- 'id_dispositivo', 'nombreDispositivo', 'marca','utilizado','descripcionDispositivo','tipoSensor_id' --}}
        @foreach ($dispositivos as $dispositivo)
        <form action="{{route('sensores.destroy', $dispositivo->id_dispositivo)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="card text-center" style="width: 260px;  margin: 5px; ">
                <div class="card-header p-3 mb-2 bg-primary text-white">
                    <strong>{{$dispositivo->nombreDispositivo}}</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Marca</h5>
                    <p class="card-text">{{$dispositivo->marca}}.</p>
                    <h5 class="card-title">utilizado</h5>
                    <div class="form-group">
                        <label for="name">
                            @if ($dispositivo->utilizado=='0')
                            NO
                            @else
                            SI
                            @endif
                            {{-- {{$dispositivo->utilizado}}. --}}
                        </label>
                    </div>
                    <h6 class="card-title">Des:</h6>
                    <p class="card-text">{{$dispositivo->descripcionDispositivo}}.</p>


                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#editdispositivo{{$dispositivo->id_dispositivo}}" data-whatever="@mdo"><i
                            class="fas fa-edit"></i></button>

                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
        </form>




    </div>
    <div class="card-footer text-muted">
        <p class="card-text">{{$dispositivo->fechadispositivo}}.</p>
    </div>
</div>

{{-- modal para editar cada tarjeta--}}

<div class="modal fade" id="editdispositivo{{$dispositivo->id_dispositivo}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 mb-2 bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Editar dispositivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sensores.update', $dispositivo->id_dispositivo)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <form action="sensores/create" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre Dispositivo:</label>
                            <input type="text" class="form-control" name="nombreDispositivo"
                                value="{{$dispositivo->nombreDispositivo}}">
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
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Utilizado:</label>

                                <select class="form-control" name="utilizado">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                                {{-- <select class="form-control"  name="tipoSensor_id">
                                        @foreach ($tipoSensores as $tipoSensor)
                                            @if ($dispositivo->nombreDispositivo==$tipoSensor->nombreTipoSensor)
                                            <option value="{{$tipoSensor->id_tipoSensor}}
                                select">{{$tipoSensor->nombreTipoSensor}}
                                @else
                                <option value="{{$tipoSensor->id_tipoSensor}}">{{$tipoSensor->nombreTipoSensor}}
                                    @endif

                                </option>

                                @endforeach

                                </select> --}}

                                {{-- <select class="form-control" name="tipoSensor_id">
                                        <option value="">-- PILIH --</option>
                                        @foreach($tipoSensores as $id => $nama)
                                            @if(old('tipoSensor_id', $id->nombreTipoSensor) == $id )
                                            <option value="{{ $id }}" selected>{{ $nama }}</option>
                                @else
                                <option value="{{ $id }}">{{ $nama }}</option>
                                @endif
                                @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" value="{{$dispositivo->marca}}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Descripcion Dispositivo</label>
                            <input type="text" class="form-control" name="descripcionDispositivo"
                                value="{{$dispositivo->descripcionDispositivo}}">
                        </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach


</div>
</div>
@endsection
