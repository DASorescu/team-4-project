@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
         <nav class="navbar navbar-expand-md navbar-light bg-main ">
            <div class="px-5 d-flex justify-content-between w-100">
                {{-- left side of navbar --}}
                <div>
                    <a href="{{url('/')}}" class="d-flex align-items-center justify-content-between no-underline">
                        <img src="{{asset('img/site-logo.png')}}" alt="logo" class="img-fluid nav-image logo">
                        <h3 class="text-white px-2">BDoctors</h3>
                    </a>

                </div>
            </nav> 

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __("Bentornato Dr $user->name") }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
