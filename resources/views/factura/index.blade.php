@extends('layouts.app')

@section('content')
<div class="container">
    @if ( Auth::user()->id_tipo=="1" )
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link " href="{{route('estancia.index',  ['tags_id' => $hogar->id_hogar]) }}">
                Estancia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{route('almacenamiento.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Almacenamiento
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('factura.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Facturas
            </a>
        </li>
    </ul>
    @endif

  
    <h2>Facturas


        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar factura</button>
    </h2>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="factura/create" method="POST">
                        @csrf
                        <div class="form-group">
                            {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
                            <label for="recipient-name" class="col-form-label">Codigo Factura:</label>
                            <input type="text" class="form-control" name="codigo" value="codigo">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Codigo Medidor:</label>
                            <input type="text" class="form-control" name="medidor" value="medidor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Consumo Agua M<sup>3</sup>:</label>
                                <input type="text" class="form-control" name="consumoPromedio" value="150">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Precio Factura</label>
                                <input type="text" class="form-control" name="saldoPromedio" value="150">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Fecha Factura:</label>
                                <input type="date" class="form-control" name="fechaFactura" required>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">

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
        {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
        @foreach ($facturas as $factura)
        <form action="{{route('factura.destroy', $factura->id_factura)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">
            <div class="card text-center" style="width: 260px;  margin: 5px; ">
                <div class="card-header p-3 mb-2 bg-primary text-white">
                    <strong>{{$factura->codigo}}</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <p class="card-text">{{$factura->consumoPromedio}}.</p>
                    <h5 class="card-title">Saldo </h5>
                    <div class="form-group">
                        <label for="name">{{$factura->saldoPromedio}}.</label>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#editfactura{{$factura->id_factura}}" data-whatever="@mdo"><i
                            class="fas fa-edit"></i></button>

                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
        </form>
    </div>
    <div class="card-footer text-muted">
        <p class="card-text">{{$factura->fechaFactura}}.</p>
    </div>
</div>

{{-- modal para editar cada tarjeta--}}

<div class="modal fade" id="editfactura{{$factura->id_factura}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 mb-2 bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Editar Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('factura.update', $factura->id_factura)}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" name="hogar_id" value="{{$hogar->id_hogar}}">
                <div class="modal-body">
                    <div class="form-group">
                        {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
                        <label for="recipient-name" class="col-form-label">Codigo Factura:</label>
                        <input type="text" class="form-control" name="codigo" value="{{$factura->codigo}}">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Codigo Medidor:</label>
                        <input type="text" class="form-control" name="medidor" value="{{$factura->medidor}}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">Consumo Agua M<sup>3</sup>:</label>
                            <input type="text" class="form-control" name="consumoPromedio"
                                value="{{$factura->consumoPromedio}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">Precio Factura</label>
                            <input type="text" class="form-control" name="saldoPromedio"
                                value="{{$factura->saldoPromedio}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">Fecha Factura:</label>
                            <input type="date" class="form-control" name="fechaFactura"
                                value="{{$factura->fechaFactura}}">
                        </div>
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
</div>
@endsection
