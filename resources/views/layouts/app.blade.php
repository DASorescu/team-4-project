<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if (Route::is('register'))
        <script src="{{ asset('js/register_validation.js') }}" defer></script>
    @endif
    @if (Route::is('admin.users.create'))
        <script src="{{ asset('js/create_validation.js') }}" defer></script>
    @endif
    @if (Route::is('admin.users.edit'))
        <script src="{{ asset('js/edit_validation.js') }}" defer></script>
    @endif


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
        integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
        crossorigin='anonymous' />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer>
        window.addEventListener("load", function() {
            bsCustomFileInput.init()
        })
    </script>
</head>

<body>
    <div id="app">
        @if (!Route::is('admin.users.create'))
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        {{ config('app.name', 'BDoctors') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.services.index') }}">Servizi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.users.reviews.index') }}">Reviews</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.users.messages.index') }}">Messages</a>
                            </li>
                        </ul>

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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item d-flex justify-content-between"
                                            href="{{ route('admin.users.edit') }}">
                                            Profile <i class="fa-solid fa-user"></i>
                                        </a>

                                        <a class="dropdown-item d-flex justify-content-between"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
