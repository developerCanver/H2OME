@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Consumo Detallado</h2>
    <div class="row">



        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Consumo Diario por Mililitros</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                       
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChartarea"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Consumo Litros</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChartCirculo"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Consumo Total
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> H2OME
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> EMPO
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php

                $valoresy=array();//montos
                $valoresx=array();//ventas
                $consumoTotal=0;
                $con=0;
                $maximo=0;                   
                   $media=0;
                   $minimo=0;
                $nivel="Alto";

                $capacidadAlmacenamiento=0;
                foreach ($consumos as $consumo){
                $valoresx[]=$consumo->fechaConsumo;
                $valoresy[]=($consumo->consumo);
                    $consumoTotal=$consumoTotal+$consumo->consumo;
                    $con=$con+1;
                 $numeroGrifos=$consumo->numeroGrifos;
                 $capacidadAlmacenamiento =($consumo->capacidadAlmacenamiento);
                 $maximo=($consumo->maximo);
                 $media=($consumo->media);
                 $minimo=($consumo->minimo); 
                 
                 $nivel="Alto";
                }
                if ( $nivel=="Alto") {
                    $nivel=$maximo;
                   
                }else if ( $nivel=="Medio") {
                    $nivel=$media;
                   
                }else if ( $nivel=="Bajo") {
                    $nivel=$minimo;
                   
                }
               
                $datosx=json_encode($valoresx);
                $datosy=json_encode($valoresy);
                //echo(" capacidadAlmacenamiento ".$capacidadAlmacenamiento." maximo ".$maximo." media ".$media." minimo ".$minimo ." jnivel ".$nivel);
               if ($consumoTotal!=0) {
                $almacenamientoTanque=(($nivel ?? '' * 100)/$capacidadAlmacenamiento)*100;
                   # code...
               }else {
                $almacenamientoTanque=0;
               }
                
                //print_r ($datosx);
                // $CunsumoH2ome=CunsumoH2ome->consumo;
                // $CunsumoEmpo=CunsumoEmpo->consumo;

                foreach ($CunsumoH2ome as $H2ome){
                $CunsumoH2ome=$H2ome->consumo;                
                
                }
                foreach ($CunsumoEmpo as $Empo){
                $CunsumoEmpo=$Empo->consumo;
                
                }
                //echo($CunsumoH2ome);
                if ( $consumoTotal!="") {
                    $consumoTotal;
                $pro=$consumoTotal/$con;
                $promedio=round($pro, 2);
                }else {
                    $promedio=0;
                }
                //recorrer datos de factura
                $con=0;
                $consumoTotalPromedio=0;
                $consumoTotalsaldo=0;
                

                if ($consumoTotal!=0) {
                    foreach ($consumoFactura as $factura){
                    $con=$con+1;
                    $consumoPromedio=$consumoTotalPromedio+$factura->consumoPromedio;                   
                    $saldoPromedio=$consumoTotalsaldo+$factura->saldoPromedio; 
                
                    }
                    $consumoPromedio=$consumoPromedio/$con;
                    $saldoPromedio= $saldoPromedio/$con;
                  
               }else {
                $consumoPromedio=0;
                $saldoPromedio=0;
                $promedio=0;
               }


               
              
                echo("consumo fac ".$consumoPromedio);
                echo("consumo saldoPromedio ".$saldoPromedio);
                echo(" consumo pro ".$promedio);
               
?>
<div class="container">
    {{-- tanque % --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow  py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tanque</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$almacenamientoTanque}}%
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{$almacenamientoTanque}}%" aria-valuenow="100" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        {{-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> --}}
                        <i class="fas fa-archive fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fin line tanque --}}
    <div class="row cards" style="width: auto; margin: auto auto;">

        <div class="card text-white bg-primary mb-3" style="width: 260px;  margin: 5px; ">
            <div class="card-header p-3 mb-2 bg-primary text-white">
                <div class="col-sm-12 d-flex justify-content-center">
                    <strong class="text-center">Factura</strong>
                </div>

            </div>
            {{-- <div class="card text-white bg-info  mb-3" style="max-width: 18rem;"> --}}

            <div class="card-body">
                {{-- <h5 class="card-title">Consumo Promedio Factura</h5> --}}
                <strong>Mensual</strong>
                <p class="card-text">Consumo M<sup>3</sup> : {{$consumoPromedio}}</p>
                <p class="card-text">Litros: {{$consumoPromedio*1000}}</p>
                <strong>Diario</strong>
                <p class="card-text">Consumo M<sup>3</sup> : {{round(($consumoPromedio/30), 2)}}</p>
                <p class="card-text">Litros: {{round((($consumoPromedio*1000)/30), 2)}}</p>
                <p class="card-text">Promedio por Gifro</p>
                @isset($numeroGrifos)
                <p class="card-text">{{round(((($consumoPromedio*1000)/30)/$numeroGrifos), 2)}}</p>
                @endisset
                
            </div>
            {{-- </div> --}}
        </div>

        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header p-3 mb-2 bg-info text-white">
                <div class="col-sm-12 d-flex justify-content-center">
                    <strong class="text-center">Consumo Ahorrado</strong>
                </div>
            </div>
            <div class="card-body">
                <strong>Mensual</strong>
                {{-- <h5 class="card-title">Promedio Consumo Diario </h5> --}}
                <p class="card-text">Consumo M<sup>3</sup></p>
                <p class="card-text">
                    <?php echo($promedio); ?></p>
                <p class="card-text">Litros</p>
                <p class="card-text">
                    <?php echo($promedio); ?> </p>
            </div>
        </div>

        {{-- <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header p-3 mb-2 bg-success text-white">
                
                <div class="col-sm-12 d-flex justify-content-center">                 
                    <strong class="text-center">Ahorro Económico</strong>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Success card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div> --}}
    </div>
</div>

<script type="text/javascript">
    function crearCadenaLineal(json) {
        var parsed = JSON.parse(json);
        var arr = [];

        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }

</script>


<script type="text/javascript">
    datosx = crearCadenaLineal('<?php echo $datosx ?>');
    datosy = crearCadenaLineal('<?php echo $datosy ?>');


    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChartarea");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: datosx,
            datasets: [{
                label: "Mililitros",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: datosy,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

</script>


<script type="text/javascript">
    var consumoTotal = ('<?php echo $consumoTotal/1000 ?>');
    var CunsumoH2ome = ('<?php echo $CunsumoH2ome/1000 ?>');
    var CunsumoEmpo = ('<?php echo $CunsumoEmpo/1000 ?>');


    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChartCirculo");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Consumo Total", "Empo", "H2OME"],
            datasets: [{
                data: [consumoTotal, CunsumoEmpo, CunsumoH2ome],
                backgroundColor: ['#4e73df', '#36b9cc', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#2c9faf', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

</script>

@endsection


<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
