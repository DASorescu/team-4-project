@extends('layouts.app')
@php
    // se non viene selezionata nessun elemento dallo storage ritorno quello alternativo
    function defaultPathStorage($path, $alternativePath)
    {
        $path = asset($path);
        $alternativePath = !empty($alternativePath) ? asset($alternativePath) : $alternativePath;
        return Str::endsWith($path, 'storage') ? $alternativePath : $path;
    }
    $imagePath = defaultPathStorage('storage/' . $user->userDetail->image, 'img/default-user-image.png');

@endphp
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-start">
                        <div class="form-group mr-3" style="width: 100px; height:100px" id="profileImg">
                            <img class="img-cover border rounded-circle bg-white shadow" src="{{ $imagePath }}"
                                alt="user image">
                        </div>
                        <div>
                            <h3>
                                <strong>Dr. {{ $user->userDetail->first_name }} {{ $user->userDetail->last_name }}</strong>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body shadow">
                        <ul class="list-group">
                            @forelse ($user->sponsorships as $sponsorship)
                                {{-- @dd($sponsorship) --}}
                                <li class="list-group-item list-group-item-secondary">
                                    Sponsorizzazione: <strong>{{ $sponsorship->name }}
                                        ({{ $sponsorship->duration }}h)
                                    </strong>
                                    <div>Costo: {{ $sponsorship->cost }}€</div>
                                    <div>Creato il: {{ $sponsorship->pivot->created_at }}</div>
                                    <div>Finisce il: {{ $sponsorship->pivot->ends_at }}</div>
                                </li>
                            @empty
                                <li class="list-group-item list-group-item-secondary">
                                    Nessuna Sponsorizzazione attiva!
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-secondary mr-2 shadow-sm" href="{{ route('admin.users.edit') }}">
                            <i class="fa-solid fa-rotate-left mr-2"></i>Torna indietro
                        </a>
                        <a class="btn btn-warning mr-2 shadow-sm" href="{{ route('admin.users.sponsorships.create') }}">
                            <i class="fa-solid fa-plus mr-2"></i>Aggiungi Sponsorizzazioni
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
