@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card p-3">
            <h3>{{$message->name}}</h3>
            <span>Da: {{$message->email}}</span>
            <span> Mandato il:  {{$message->created_at}}</span>
            <p>
                <div>
                    {{$message->name}}  <span> Scrive: </span>
                </div> 
                
                {{$message->content}}
            </p>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.users.messages.index') }}" class="btn btn-info mt-2">
                Torna Indietro
            </a>

            <form action="{{ route('admin.users.messages.destroy', $message->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-2" type="submit">
                    Elimina
                </button>
            </form>
        </div>
        
    </div>


@endsection