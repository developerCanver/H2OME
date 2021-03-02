
@php
    
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

            if ($consumoTotal!=0) {
                $almacenamientoTanque=(($nivel ?? '' * 100)/$capacidadAlmacenamiento)*100;
            
               }else {
                $almacenamientoTanque=0;
               }
@endphp
<div>
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            {{-- <span class="badge badge-danger badge-counter">3+</span> --}}
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notificaciones
            </h6>
            <!-- mensaje de valvula -->
            @if ($notificacion=='ON')
            <div  class="dropdown-item d-flex align-items-center" >
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-burn text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">Valvula</div>
                    <span class="font-weight-bold">Valvula ahorro ON</span>
                </div>
            </div>
            <div class="dropdown-item d-flex align-items-center" >
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-burn text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">Destino Cocina</div>
                    <span class="font-weight-bold">Valvula ON </span>
                </div>
            </div>

            @else
            <div class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                  </div>
                </div>
                <div>
                    <div class="small text-gray-500">Destino Cocina</div>
                    <span class="font-weight-bold">Valvula ON </span>
                </div>
            </div>
            <div class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">Destino Cocina</div>
                    <span class="font-weight-bold">Valvula ON </span>
                </div>
            </div>                
            @endif
            <div class="dropdown-item d-flex align-items-center" >
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-archive  text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">Tanque</div>
                    <span class="font-weight-bold">{{$almacenamientoTanque}}% </span>
                    <div class="small text-gray-500">{{$nivel}} Litros</div>
                </div>
            </div>
            <a class="dropdown-item text-center small text-gray-500" href="#">Registro ultimo 1
                minutos</a>
        </div>
    </li>
</div>
