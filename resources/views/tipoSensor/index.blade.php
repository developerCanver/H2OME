@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Content here -->
    <h2>Lista Tipo de Sensor

        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar Tipo</button>

    </h2>
    <h6>
        @if($search ?? '')
        <div class="alert alert-primary" role="alert">
            Los Resultasdos para tu busqueda {{$search ?? ''}} son:
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

    {{-- modal para agregar registro --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tipoSensor/create" method="POST">
                        @csrf
                        <div class="form-group">
                            {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
                            <label for="recipient-name" class="col-form-label">Tipo Sensor:</label>
                            <input type="text" class="form-control" name="nombreTipoSensor" value="@flujo">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Descripcion :</label>
                            <input type="textarea" class="form-control" name="descripcionTipoSensor" value="@">
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
    
   
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">TipoSensor</th>
                <th scope="col">descripcion</th>
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>
            {{-- foreach espara recorrer el cilco de cuantos usuarios se tiene en la base de datos
        $users es la variable que traigo del controlador y recooro con la variable 
        que creo user  --}}
            @foreach ($tipoSensores as $tipoSensor)
            <tr>
                <th scope="row">{{$tipoSensor->id_tipoSensor}}</th>
                <td>{{$tipoSensor->nombreTipoSensor}}</td>
                <td>{{$tipoSensor->descripcionTipoSensor}}</td>
                <td>


                    <form action="{{ route('tipoSensor.destroy', $tipoSensor->id_tipoSensor)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#editfactura{{$tipoSensor->id_tipoSensor}}" data-whatever="@mdo"><i
                                class="fas fa-edit"></i></button>
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                        </button>
                    </form>

                </td>

            </tr>
            {{-- modal para editar cada tarjeta--}}

            <div class="modal fade" id="editfactura{{$tipoSensor->id_tipoSensor}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header p-3 mb-2 bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Sensor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('tipoSensor.update', $tipoSensor->id_tipoSensor)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="nombreTipoSensor" value="{{$tipoSensor->nombreTipoSensor}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Descripción:</label>
                                    <input type="text" class="form-control" name="descripcionTipoSensor" value="{{$tipoSensor->descripcionTipoSensor}}">
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

     
    <div class="row">
        <div class="mx-auto">
            {{ $tipoSensores->links() }}
            {{-- PAGINACION CON EL METODO LINKS --}}
        </div>

    </div>
</div>
@endsection
