@extends('layouts.app')

@section('content')

<header class="container">

<div class="d-flex justify-content-between">
    <h2>
        Lista Servizi
    </h2>

    <a class="nav-link btn btn-sm btn-success mt-2" @if(Route::is('admin.services.create')) 
    @endif href="{{ route('admin.services.create') }}">
    <i class="fa-solid fa-plus"></i>  Crea Servizio
    </a>
</div>



    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Cost</th>
      <th scope="col">description</th>
      <th scope="col">Funzionalità</th>
    </tr>
  </thead>
  <tbody>
    @forelse($services as $service)

        <tr>
        <th scope="row">{{$service->id}}</th>
        <td>{{$service->name}}</td>
        <td>{{$service->cost}}</td>
        <td>{{$service->description}}</td>
        <td>bottoni</td>
        </tr>

    @empty

        <tr>
        <td scope="row">Nessun Servizio</td>
        </tr>
      
    @endforelse
  </tbody>
</table>
</header>

@endsection