@extends('layouts.app')

@section('content')

<div class="container bg-white">

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
            <td class="d-flex">
                <a class="btn btn-primary btn-small d-flex align-items-center" href="{{ route('admin.users.messages.show', $message) }}">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i> Dettagli
                </a>

                <form action="{{ route('admin.users.messages.destroy', $message->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-small ml-2 d-flex align-items-center" type="submit">
                    <i class="fa-solid fa-trash mr-2"></i> Elimina
                </button>
            </form>
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








@endsection