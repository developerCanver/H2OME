<!DOCTYPE html>
<html lang="en">

<head>


    <script src=""></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>H2ome</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- bootstrap template
  <link rel="stylesheet" href="{ asset('css/bootstrap/bootstrap.min.css')}}">-->


    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}"> --}}

    <!-- Ricksaw Css-->



    @livewireStyles
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                {{-- <div class="sidebar-brand-icon rotate-n-15"> --}}
                <div class="sidebar-brand-icon ">
                    {{-- <i class="fas fa-tint"></i> --}}
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <img src="/img/h2ome/h2o_logo_menu.png" idth="50" height="50" alt="">
                </div>
                {{-- <div class="sidebar-brand-text mx-3">H<sub>2</sub>ome</div> --}}
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('./')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                interfaz
            </div>

            <!-- Usuaris Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Crud:</h6>
                        <a class="collapse-item" href="{{ url('usuarios')}}">Usuarios</a>

                    </div>
                </div>
            </li>
            @if ( Auth::user()->id_tipo=="1" )

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-home"></i>
                    <span>Hogar</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Hogar:</h6>
                        <a class="collapse-item" href="{{ url('hogar')}}">Hogar</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->

            <div class="sidebar-heading">
                Administración
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesdispositivo"
                    aria-expanded="true" aria-controls="collapsePagesdispositivo">
                    <i class="fas fa-fw fa-cog"></i>

                    <span>Dispositivos</span>
                </a>
                <div id="collapsePagesdispositivo" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                        <h6 class="collapse-header">Sensores:</h6>
                        <a class="collapse-item" href="{{ url('tipoSensor')}}">Tipo Sensores</a>
                        <a class="collapse-item" href="{{ url('sensores')}}">Sensores</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>

            @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-home"></i>
                    <span>Hogar</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Hogar:</h6>
                        <a class="collapse-item" href="{{ url('hogar')}}">Hogar</a>

                        <a class="collapse-item" href="{{ url('mifactura')}}">Factura</a>
                        <a class="collapse-item" href="{{ url('miestancia')}}">Estancia</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Administración
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collpaseadminostracio"
                    aria-expanded="true" aria-controls="collpaseadminostracio">
                    <i class="fas fa-fw fa-cog"></i>

                    <span>Consumo</span>
                </a>
                <div id="collpaseadminostracio" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                        <h6 class="collapse-header">Consumo:</h6>
                        <a class="collapse-item" href="{{ url('miconsumo')}}">Consumo generado</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesdispositivo"
                    aria-expanded="true" aria-controls="collapsePagesdispositivo">
                    <i class="fas fa-fw fa-cog"></i>

                    <span>Dispositivos</span>
                </a>
                <div id="collapsePagesdispositivo" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                        <h6 class="collapse-header">Sensores:</h6>
                        <a class="collapse-item" href="{{ url('misensores')}}">Sensores</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>

            @endif


            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        @if ( Auth::user()->id_tipo!="1" )
                        @livewire('notification-livewire')
                        @endif

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="/img/users/{{Auth::user()->photo}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>

                    </ul>

                </nav>
                @yield('alertas')
                <div class="container-fluid">
                    <div class="row">


                        @yield('content')

                    </div>
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Contactos</span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>


            @livewireScripts
            <!-- notificacion para eliminar-->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            {{-- <script>
              window.addEventListener('alert', event => {
                  toastr[event.detail.type](event.detail.message,
                      event.detail.title ? ? ''), toastr.options = {
                      'closeButton': true,
                      'progressBar': true,
                  }
              });

          </script> --}}
            <!-- jquery para mensaje de enotificacion-->
            <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

            <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

            <!-- Page level plugins -->
            <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

            <!-- Page level custom scripts pastel y grafica de meses-->
            <script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
            {{-- circulo --}}
            <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
            <script src="{{ asset('js/demo/plotly-latest.min.js')}}"></script>
            <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>


</body>


</html>
