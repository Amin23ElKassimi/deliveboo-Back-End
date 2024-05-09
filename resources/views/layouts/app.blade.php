<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Deliveboo') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-color shadow-sm">
            <div class="container">
                <img class="logo-img rounded-circle" src="/Logo_Deliveboo.jpg" alt="immagine logo">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Deliveboo') }}
                </a>
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- Link admin --}}
                        <div class="d-flex align-items-center">
                            @if (Auth::user()->restaurant == null)
                                
                            @else
                            <div>
                                <a href="{{ route('admin.restaurants.index') }}" class="list-group-item list-group-item-action list-group-item-primary p-2">Ristorante</a>
                            </div>
                            <div>
                                <a href="{{ route('admin.fooditems.index') }}" class="list-group-item list-group-item-action list-group-item-primary p-2">Menù</a>
                            </div>
                            @endif
                            
                        </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="p-5">
            @yield('content')
        </main>
    </div>
</body>
<style>
body {
    background-image: url('https://i.pinimg.com/originals/2b/8d/34/2b8d3481fd0855dfb0608f3198fd8adc.jpg');

}
div.welcome{
    background-color: white
}
</style>
</html>

<style>
    .bg-color{
        background-color: #57D0FF;
    }

    .logo-img{
        width: 33px;
        height: 33px;
        margin-right: .5rem;
    }
</style>
