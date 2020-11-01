<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BSPI') }}</title>

    <!-- Icono de la Pestaña -->
    <link rel="shortcut icon" href="{{ asset('img/icono.png') }}">

    <!-- Plantilla General de los CSS -->
    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">

    <!-- Evitar ataques X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-6">
            <!-- Es para la barra superior, donde muestra el Dashboard -->
            @livewire('navigation-dropdown')
        </div>
    </div>

    <!-- Main Sidebar Container -->
    <div id="app">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-12 col-md-12 col-sm-4">
                    <aside class="main-sidebar sidebar-dark-primary elevation-4">
                        <!-- Brand Logo -->
                        <a href="{{ config('global.router_prefix') }}" class="brand-link">
                            <img src="{{ asset('img/icono.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                            <span class="brand-text font-weight-light"> {{ config('app.name', 'Laravel') }} </span>
                        </a>

                        <!-- Sidebar -->
                        <div class="sidebar">
                            <menu-componente></menu-componente>
                        </div>
                    </aside>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-8">
                    <!-- Contenido Principal -->
                    @yield('contenido')
                    <!-- Fin Contenido Principal -->
                </div>


            </div>
        </div>

    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2020-20121 <a href="https://www.bspi.org/inicio.html">BSPI</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 0.0.1
        </div>
    </footer>


    <!-- App JS de Vue -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Plantilla General de los JS -->
    <script src="{{ asset('js/plantilla.js') }}"></script>
</body>

</html>
