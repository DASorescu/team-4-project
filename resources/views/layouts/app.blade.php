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
        <div class="d-flex container">

            @if (!Route::is('admin.users.create'))
            <nav class="navbar navbar-expand-md" id="backend-navbar">
                <div class="container flex-column h-100">
                    <a class="navbar-brand text-center mx-0 my-4 " href="/">
                        BD
                    </a>
                    @auth
                        <div  id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                {{-- <li class="nav-item">
                                    <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.services.index') }}">Servizi</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.users.reviews.index') }}"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" @if (Route::is('admin.services.index'))  @endif
                                    href="{{ route('admin.users.messages.index') }}"><i class="fa-solid fa-message fa-2x"></i></a>
                                </li>
                                <!-- Authentication Links -->
                                <li class="nav-item">

                                    <a  class="nav-link" href="{{ route('admin.users.edit') }}">
                                        <i class="fa-solid fa-user fa-2x"></i>
                                    </a>
                                </li>
                                <li class="nav-item" id="logout">
                                    <a  class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            
                                            <i class="fa-solid fa-right-from-bracket fa-2x"></i>
                                    </a>
                                            
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>                            
                            </ul>
                        </div>
                    @endauth
                </div>
            </nav>
            @endif
            <main class="py-4" id="main">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
