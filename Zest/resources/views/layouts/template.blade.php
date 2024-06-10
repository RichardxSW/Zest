<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zest') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Zest') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Centered Title -->
                    <span class="navbar-text mx-auto">
                        Zest
                    </span>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <div class="d-flex flex-grow-1">
            <!-- Sidebar -->
            <nav class="bg-dark text-white sidebar">
                <h3 class="text-center my-4">Inventory System</h3>
                <ul class="nav flex-column">
                    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('categories.index') ? 'active' : '' }}">
                        <a class="nav-link text-white" href="{{ route('categories.index') }}">
                            <i class="fas fa-th-list"></i> Category
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-box"></i> Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-users"></i> Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-truck"></i> Supplier
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-shopping-cart"></i> Outgoing Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-receipt"></i> Purchase Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-users-cog"></i> System Users
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End of Sidebar -->

            <div class="main-content flex-grow-1">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
