@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="card mb-3">
            <img src="{{ asset('/img/users/goku.jpg')}}" class="card-img-top" alt="...">

            <form class="form-group" method="POST" action="/usuarios/{{$user->id}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <img style="height:150px; width:150px; background-color: #EFEFEF; margin: 20px"
                        class="card-img-top rounded-circle mx-auto d-block" src="/images/{{$user->photo}}">


                    <div class="form-group">
                        <label for="">Avatar</label>
                        <input type="file" name="photo">
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </div>
            </form>
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <p class="card-text">{{ $user->email }}</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>

    </div>
</div>

@endsection
