<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Inicio CWMP</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
    <div class="container">
        <a class="navbar-brand" href="#!">Sistema de Gestion CWMP - COTEL RL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home2') }}">
                        Principal
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#!">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contactos</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="mt-5">COTEL RL</h1>
                <p>Sistema CWMP de monitoreo y gestion de equipos CPE de lado cliente.</p>
                <a class="btn btn-primary btn-lg active" href="{{ route('home2') }}" role="button" aria-pressed="true">
                    Entrar
                    <span class="sr-only">(current)</span>
                </a>
            </div>
        </div>
    </div>
</section>

</body>
</html>
