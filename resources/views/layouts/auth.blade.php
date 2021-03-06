<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bookflix') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/bootstrap-typeahead.min.js') }}"></script>
        {{--<script src="{{ asset('js/pdfThumbnails/pdfjs/build/pdf.js') }}"></script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.js"></script>
        <script src="{{ asset('js/pdfThumbnails/pdfThumbnails.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/pdfcover.css') }}" rel="stylesheet">

        <style>
        .card {
            background: inherit !important
        }
        </style>
    </head>
    <body oncontextmenu="return false;">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'Bookflix') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" role="button" href="{{ url('/home') }}">
                                    Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" role="button" href="{{ route('novedades.index') }}">
                                    Novedades
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" role="button" href="{{ url('admin/admins') }}">
                                    Administradores
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarGenero" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Metadatos
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('autores.index') }}">Autores</a>
                                    <a class="dropdown-item" href="{{ route('generos.index') }}">Generos</a>
                                    <a class="dropdown-item" href="{{ route('editoriales.index') }}">Editoriales</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" role="button" href="{{ route('libros.index') }}">
                                    Libros
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" role="button" href="{{ route('trailers.index') }}">
                                    Trailers
                                </a>
                            </li>
                        </ul>

                        <a class="btn btn-outline-primary ml-2" href="{{route('admin.cobrar')}}"
                            onclick="return confirm('Se efectuaran los cobros pendientes del mes. Aquellos usuarios que ya fueron cobrados no seran procesados hasta el mes siguiente')">Efectuar cobro</a>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Hi') }}, {{ Auth::user()->name }}! <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('register/admin') }}">
                                            Registrar Admin
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>