<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--Importiamo Bootstrap-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- js --}}
    <script src="{{ asset('js/front.js') }}" defer></script>

    <title>BDoctors</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-main shadow">
        <div class="px-5 d-flex justify-content-between w-100">
            {{-- left side of navbar --}}
            <div class="d-flex align-items-center justify-content-between ">
                <img src="{{asset('img/site-logo.png')}}" alt="logo" class="img-fluid nav-image logo">
                <h3 class="text-white px-2">BDoctors</h3>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-center">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
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
    </nav>
    <div id="root">

    </div>
</body>

</html>
