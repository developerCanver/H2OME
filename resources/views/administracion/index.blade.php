@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sensor
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #2196F3;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }

        </style>

        {{-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Agregar Sensor</button> --}}
    </h2>



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

        @foreach ($administracions as $administracion)
        {{-- <form action="{{ route('administracion.update', $administracion->id_administracion)}}" method="POST"> --}}
         
            <form action="{{ url('administracion/create', [$administracion->id_administracion])}}" method="POST">
            @csrf
            @method('PUT')

            <div class="card text-center" style="width: 260px;  margin: 5px; ">
                <div class="card-header p-3 mb-2 bg-primary text-white">
                    <strong>{{$administracion->nombreDispositivo}}</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Marca</h5>
                    <p class="card-text">{{$administracion->marca}}.</p>
                    <h5 class="card-title">utilizado</h5>
                    <div class="form-group">
                        <label for="name">
                            @if ($administracion->utilizado=='0')
                            NO
                            @else
                            SI
                            @endif

                        </label>
                    </div>




                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#editdispositivo{{$dispositivo->id_dispositivo}}" data-whatever="@mdo"><i
                        class="fas fa-edit"></i></button> --}}

                    <button type="submit" class="btn btn-black">
                        <label class="switch">


                            @if ($administracion->estado=='0')
                            <input type="checkbox">
                            @else
                            <input type="checkbox" checked>
                            @endif
                            <span class="slider round"></span>

                        </label>
                    </button>

                    @if ($administracion->estado=='0')
                    @else


                    <input type="text" value="<?php 
                  
                    // $a=10;
                    // for ($i=1; $i < $a; $i++) { 
                    //     echo(rand(10,100)." ");

                       // sleep(2);
                        
                    // }
                    
                    ?> ">
                    @endif

                    <input type="hidden" name="estado" id="estado" value="{{$administracion->estado}}">
                    <p class="num_tazas" id="sweetness">0</p>
        </form>




    </div>
    <div class="card-footer text-muted">
        {{-- <p class="card-text">{{$dispositivo->fechadispositivo}}.</p> --}}
    </div>
</div>

<script Language=Javascript>
    var estado = parseFloat(document.getElementById("estado").value);
    if (estado == '1') {

        var consumo = 0;
        for (i = 0; i < 5000; i++) {
            consumo = Math.floor(Math.random() * 101);
            //console.log(consumo);
            //setTimeOut(hazAlert,1000);
            // setInterval(function(){console.log(consumo);},3000);
            //setTimeout(() => {  document.getElementById('sweetness').innerHTML = consumo; console.log(consumo);}, 20000);
            setInterval(function () {
                consumo = Math.floor(Math.random() * 101);
                console.log(consumo);
                document.getElementById('sweetness').innerHTML = consumo;
            }, 1000);


        }

        console.log("prendido");
    } else {
        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds) {
                    break;
                }
            }
        }
    }


    // function hazAlert(){
    //     console.log(consumo);
    // }
    //LLamar aquí las funciones de miarchivocon30funciones.js   


    //     <?php
    // // definimos un array de valores en php
    // $arrayPHP=array("casa","coche","moto");
    // ?>

    //http://foros.cristalab.com/json-pasar-array-php-a-javascript-t102091/

</script>

@endforeach

</div>
</div>
</div>
@endsection
