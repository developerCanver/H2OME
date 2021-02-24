@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        
        <div class="text-center">
            <div class="card mb-3">

                <img src="/img/users/{{$user->photo}}" class="card-img-top mx-auto d-block" alt="...">

                @if(session('data'))
                <div class="alert alert-success" role="alert">
            
                    <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="form-group">
                    {{-- <img style="height:150px; width:150px; background-color: #EFEFEF; margin: 20px"
                        class="card-img-top rounded-circle mx-auto d-block" src="/img/{{$user->photo}}"> --}}

                </div>



                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                    <a href="/usuarios/{{$user->id}}/edit" class="btn btn-primary">Actualizar</a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
