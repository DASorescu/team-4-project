@extends('layouts.app')

@if ($user->userDetail)
@php
    // se non viene selezionata nessun elemento dallo storage ritorno quello alternativo
    function defaultPathStorage($path, $alternativePath)
    {
        $path = asset($path);
        $alternativePath = !empty($alternativePath) ? asset($alternativePath) : $alternativePath;
        return Str::endsWith($path, 'storage') ? $alternativePath : $path;
    }
    $imagePath = defaultPathStorage('storage/' . $user->userDetail->image, 'img/default-user-image.png');
    $curriculumPath = defaultPathStorage('storage/' . $user->userDetail->cv, '');
    @endphp
@endif

@section('content')
<div class="container">
    @if ($user->userDetail)
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <form action="{{ route('admin.users.update') }}" enctype="multipart/form-data" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card shadow">
                            {{-- rimosso il passaggio di $user perché lo prendiamo tramite autorizzazione --}}
                            <div class="card-header d-flex justify-content-center">
                                <div class="form-group" style="width: 100px; height:100px" id="profileImg"
                                    onclick="document.getElementById('image').click()">
                                    <input type="file" id="image" name="image" class="d-none">
                                    <img class="img-cover border rounded-circle bg-white shadow" src="{{ $imagePath }}"
                                        alt="user image">
                                    <div class="overlay"></div>
                                    <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                                </div>
                            </div>

                            <div class="card-body shadow">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        @if ($user->name) value="{{ old('username', $user->name) }}" @endif
                                        required minlength="3">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">Nome</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        @if ($user->userDetail->first_name) value="{{ old('first_name', $user->userDetail->first_name) }}" @endif
                                        required minlength="3">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Cognome</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        @if ($user->userDetail->last_name) value="{{ old('last_name', $user->userDetail->last_name) }}" @endif
                                        required minlength="3">
                                </div>
                                {{-- Unica pecca è che per selezionare più di una specializzazione devi schiacciare o ctrl o maiusc e cliccare si quella che vuoi.
                                    Non sono riuscita a trovare un modo alternativo per farlo, secondo me bisogna gestirla lato VUE MA BOH --}}
                                {{-- <div class="form-group">
                                    <label for="specialization">Specializzazioni</label>
                                    incredibile ma vero mettendo le quaddre al name mi permette di selezionare più specializzazioni. I was shocked 
                                    <select name="specializations[]" id="specialization" class="form-control" multiple>
                                        @foreach ($all_specialization as $specialization)
                                            <option value="{{ $specialization->id }}" utilizzo il metodo contains per selezionare le specializzazioni che l'utente possiede.
                                                {{ $user->specializations->contains($specialization->id) ? 'selected' : '' }}>
                                                {{ $specialization->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- modale specializzazioni --}}
                                <div class="btn-group w-50 my-2">
                                    {{-- <button class="btn btn-light dropdown-toggle w-75" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false"> --}}
                                    <button type="button" class="btn btn-light dropdown-toggle w-75 text-left" data-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
                                         Specializzazioni
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        @foreach ($all_specialization as $specialization)
                                            <div class="form-check form-check-inline d-flex align-items-center p-2 dropdown-item spec-checkbox w-100">
                                                <input 
                                                    class="form-check-input"
                                                    id="spec-{{$specialization->label}}" 
                                                    type="checkbox" 
                                                    name="specs[]"
                                                    value="{{ $specialization->id }}" 
                                                    @if(in_array($specialization->id, old('specs',[]))) checked @endif
                                                    @foreach ($user->specializations as $user_spec)
                                                        @if($specialization->id == $user_spec->id) checked @endif
                                                    @endforeach
                                                    >
                                                <label class="w-70 my-0 mx-1" for="spec-{{$specialization->label}}">{{ $specialization->label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="adress">Città</label>
                                    <select name="address" id="address" class="form-control">
                                        <option value="">Scegli la Città</option>
                                        @foreach (config('cities') as $city)
                                            <option value="{{ $city }}"
                                                {{ old('address', $user->userDetail->address) == $city ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Numero di telefono</label>
                                    <input type="phone" class="form-control" id="phone" name="phone"
                                        @if ($user->userDetail->phone) value="{{ old('phone', $user->userDetail->phone) }}" @endif
                                        required minlength="3">
                                </div>
                                <div class="form-group">
                                    <label for="cv">Curriculum</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="cv">Curriculum</label>
                                        <input type="file" name="cv" class="custom-file-input" id="cv">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-center">
                                <div>
                                    <button class="btn btn-success shadow-sm" type="submit">
                                        <i class="fa-solid fa-floppy-disk mr-2"></i>Salva Modifiche
                                    </button>
                                </div>
                                <div class="ml-2">
                                    <a class="btn btn-primary shadow-sm"
                                        href="{{ route('admin.users.sponsorships.show') }}">
                                        Sponsorizzazioni
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                @if (!empty($curriculumPath))
                    <div class="col-md-6">
                        <div class="card shadow h-100">
                            <iframe class="h-100 w-100 border border-0 rounded" src="{{ $curriculumPath }}"></iframe>
                        </div>
                    </div>
                @endif
            </div>
        @else()
            <div class="h-100 d-flex justify-content-center align-items-center">
                <h2 class="text-danger">Devi completare il profilo Dr. Strunz!</h2>
            </div>
    @endif()
</div>
@endsection
