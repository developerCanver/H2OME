<title>Material Login Form a Responsive Widget Template :: w3layouts</title>
<!-- meta tags -->
<meta charset="UTF-8" />
<link rel="icon" type="img/png" href="{{ asset('img/favicon.png')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords"
    content="Art Sign Up Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, 
    Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />

<link href="{{ asset('css/login_style.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet" />

<link
    href="{{ asset('//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet') }}">


</head>


<body background="{{ asset('img/h2ome/fondo_h2o.svg') }}">
    {{-- <body background="{{ asset('img/login.jpg') }}"> --}}
    {{-- <h1>H<sub>2</sub>ome</h1> --}}
    <h1> <img src="/img/h2ome/h2o_logo.png" idth="50" height="100"alt=""></h1>
    <div class=" w3l-login-form">
        <h2>Iniciar sesión</h2>
        
        <section class="content">
            @yield('content')
        </section>

    </div>
    <footer>
        <!-- <p class="copyright-agileinfo"> &copy; 2018 Material Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p> -->
    </footer>

</body>

</html>
