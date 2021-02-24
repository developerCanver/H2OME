@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">


            <form action="/userTipo" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre Tipo</label>
                    <input type="text" class="form-control" name="nombreTipo" placeholder="Tipo">

                </div>
               
               

                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>

    </div>
</div>
@endsection
