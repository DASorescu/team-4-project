@extends('layouts.app')

@section('content')

<div class="container bg-white">

    @if ( session( 'message' ) )
    <div class="alert alert-info">
        {{ session( 'message' ) }}
    </div>
    @endif

    <h3 class="p-3">I miei messaggi</h3>

    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col text-center">Inviato da</th>
            <th scope="col text-center">Email</th>
            <th scope="col ">Testo</th>
            <th scope="col text-center">Inviato</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        
            @forelse($messages as $message) 

            <tr>
            <td class="col-2">{{$message->name}}</td>
            <td class="col-2">{{$message->email}}</td>
            <td class="col-4">{{ substr($message->content, 0, 50) }}...</td>
            <td class="col-2">{{$user->created_at->format('d M h:m:s')}}</td>
            <td class="d-flex col-1">
                <a class="btn btn-warning btn-small border-dark d-flex align-items-center" href="{{ route('admin.users.messages.show', $message) }}">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i> Dettagli
                </a>
            </td>
            </tr>

            @empty

            <tr>
            <td scope="row">Nessun Messaggio</td>
            </tr>

            @endforelse
            
        </tbody>
    </table>
</div>

<footer>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.home') }}" class="btn btn-info border-dark mt-2 mr-3">
            Torna Indietro
        </a>
    </div>
</footer>

@endsection