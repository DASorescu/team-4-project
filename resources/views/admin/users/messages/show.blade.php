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

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.messages.index') }}" class="btn btn-info mt-2">
                Torna Indietro
            </a>
        </div>
        
    </div>


@endsection