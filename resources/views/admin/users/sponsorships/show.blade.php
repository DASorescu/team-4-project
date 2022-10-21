@extends('layouts.app')

@section('content')
    

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <img src="" alt="doctor">
                    </div>
                    <div>
                        <div> <strong>Nome: </strong>{{$user->userDetail->first_name}}</div>
                        <div> <strong>Cognome: </strong>{{$user->userDetail->last_name}}</div>
                        <div> <strong>Indirizzo studio: </strong>{{$user->userDetail->address}}</div>
                    </div>
                </div>
                <div class="card-body">
                   <strong>Età:</strong> <span>47</span>
                   <strong>Titolo di studio:</strong> -
                </div>

                <div class="card-footer">
                    <p><strong>Contatti:</strong></p>
                    <div>
                        <i class="fa-solid fa-phone mr-2"></i> <span>: {{$user->userDetail->phone}}</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-envelope mr-2"></i> <span>: {{$user->email}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @if (!$user->specializations)
       <p>Nessuna specializzazione</p>
    @else
    <p class="text-center">Specializzazione 1 Specializzazione 2</p>
   @endif
   <hr>
   <footer class="d-flex align-items-center justify-content-end">
       <a class="btn btn-secondary mr-2" href="{{route('admin.users.edit')}}">
           <i class="fa-solid fa-rotate-left mr-2"></i>Torna indietro
       </a>
       <a class="btn btn-success" href="#">
             <i class="fa-solid fa-plus mr-2"></i>Aggiungi sponsorizzazione
        </a>
   </footer>
</div>


@endsection