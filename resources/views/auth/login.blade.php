@extends('layouts.login')

@section('content')


<!-- { Helper::strUp('mostrar este texto en mayúsculas!') }}
-@ php $stores = \Helper::getFeaturedStores();@ endphp

@ foreach($stores as $store)
            
<div class="col-md-6 col-lg-4">
    <a class="category-card flex-wrap flex-lg-nowrap"
                                       href="">
                 
        <div class="cardtienda text-center">                   
                <div class="card-body-inicio" >
                    <div class="align-items-center"><img src="{$store->codigo }}" class="rounded-circle" style="width: 13rem;" alt="Category">
                    </div>
                </div> 
            <div class="card-footer" style="background-color:rgb(47 43 43 / 92%);  border-radius: 0px 0px 40px 40px;
                    -moz-border-radius: 0px 0px 40px 40px;
                    -webkit-border-radius: 0px 0px 40px 40px;
                    border: 0px solid #000000;">
               <strong> <h2 class="card-title textotienda">{$store->saldoPromedio}}</h2></strong>{ $store->medidor }}
            </div>
        </div>                  
    </a>
</div>
@ endforeach

 -->


<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class=" w3l-form-group">
        <label>Usuario:</label>
        <div class="group">
            <i class="fas fa-user"></i>
            <input type="text" input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    </div> --}}

    <div class=" w3l-form-group">
        <label>Contraseña:</label>
        <div class="group">
            <i class="fas fa-unlock"></i>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    {{-- <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    </div> --}}

    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Recordarme') }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Ingresar') }}
            </button>

            
        </div>
    </div>
</form>
<p class=" w3l-register-p">
    Crear<a href="{{ url('/register')}}" class="register">
         cuenta?</a>
</p>
@endsection
