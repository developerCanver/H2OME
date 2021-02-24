@extends('layouts.app')

@section('content')



<div class="d-flex flex-wrap justify-content-around">
  @include('notas.todas.modal')

@foreach ($notas as $nota)
        

    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">{{$nota->titulo}}</div>
        <p class="small float-right">{{$nota->created_at}}.</p>
        <div class="card-body">
        {{-- <h5 class="card-title">Dark card title</h5> --}}
        <p class="card-text">{{$nota->texto}}.</p>
        </div>
    </div>
  @endforeach
</div>
@endsection