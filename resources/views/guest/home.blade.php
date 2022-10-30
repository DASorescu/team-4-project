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
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-main ">
            <div class="px-5 d-flex justify-content-between w-100">
                left side of navbar
                <div>
                    <a href="{{url('/')}}" class="d-flex align-items-center justify-content-between no-underline">
                        <img src="{{asset('img/site-logo.png')}}" alt="logo" class="img-fluid nav-image logo">
                        <h3 class="text-white px-2">BDoctors</h3>
                    </a>

                </div>
              Right Side Of Navbar 
                <ul class="navbar-nav ml-auto align-items-center">
                    Authentication Links 
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    </ul>
                </div>
            </nav> --}}
            <div id="root"></div>
    </body>
    
</html>

                
