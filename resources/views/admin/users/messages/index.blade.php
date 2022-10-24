@extends('layouts.app')

@section('content')

<div class="container">

    @if ( session( 'message' ) )
    <div class="alert alert-info">
        {{ session( 'message' ) }}
    </div>
    @endif

    
    <h3>Lista Messaggi</h3>

    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Messaggio</th>
            <th scope="col">Mandato il</th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
        
            @forelse($messages as $message)

            <tr>
            <th scope="row">{{$message->id}}</th>
            <td>{{$message->name}}</td>
            <td>{{$message->email}}</td>
            <td>{{$message->content}}</td>
            <td>{{$message->date}}</td>
            <td>
                <a class="btn btn-primary btn-small" href="{{ route('admin.users.messages.show', $message) }}">
                    <i class="fa-solid fa-magnifying-glass"></i> Dettagli
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

    <div class="card-footer d-flex justify-content-end">
        <a class="btn btn-secondary mr-2 shadow-sm" href="{{ route('admin.users.edit') }}">
            <i class="fa-solid fa-rotate-left mr-2"></i>Torna indietro
        </a>
    </div>



</div>






@endsection