@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div>Nome</div>
                    <div>Cognome</div>
                    <div>Specializzazione</div>
                </div>

                <div class="card-body">
      
                </div>

                <div class="card-footer">
        
                </div>
            </div>
        </div>
    </div>

@if ($errors->any())
 <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
 </div>
@endif

{{-- rimosso il passaggio di $user perché lo prendiamo tramite autorizzazione --}}
<form class="mt-5" action="{{ route('admin.users.update')}}" enctype="multipart/form-data" method="POST">
    @method('PUT')
    @csrf
      <div class="row">

       <div class="col-6">
           <div class="form-group">
               <label for="first_name">Nome</label>
               <input type="text" class="form-control" id="first_name" name="first_name" @if($user->userDetail->first_name) value="{{ old('first_name', $user->userDetail->first_name) }}" @endif required minlength="3">
           </div>
       </div>

       <div class="col-6">
            <div class="form-group">
                <label for="last_name">Cognome</label>
                <input type="text" class="form-control" id="last_name" name="last_name" @if($user->userDetail->last_name) value="{{ old('last_name', $user->userDetail->last_name) }}" @endif required minlength="3">
            </div>
       </div>

       <div class="col-6">
            <div class="form-group">
                <select name="address" id="address">
                    <option value="">Scegli la città</option>
                    @foreach(config('cities') as $city)
                        
                        <option value="{{ $city }}" {{ old('address', $user->userDetail->address) == $city ? 'selected' : '' }}>
                      
                            {{$city}}
                            

                        </option>

                    @endforeach
    
    
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="phone">Numero di telefono</label>
                <input type="phone" class="form-control" id="phone" name="phone" @if($user->userDetail->phone) value="{{ old('phone', $user->userDetail->phone) }}" @endif required minlength="3">
            </div>
       </div>

       <div class="col-12">

           <div class="form-group">
           
                <label for="cv">Curriculum</label>
                <input type="file" id="cv" name="cv">
                <iframe src="{{ asset('storage/' . $user->userDetail->cv) }}" width=”100%” height=”100%”>
            </div>
       </div>

       <div class="col-12">

           <div class="form-group">
           
                <label for="image">Immagine</label>
                <input type="file" id="image" name="image">
                <img class="img-fluid" src="{{ asset('storage/' . $user->userDetail->image) }}" alt="user image preview" width="100px">

            </div>

       </div>
       

       
       
            
            

       
       
       
       
       
    </div>
</form>

<footer class="d-flex align-items-center justify-content-end">
    <div>
        <button class="btn btn-success" type="submit">
            <i class="fa-solid fa-floppy-disk mr-2"></i>Salva Modifiche
        </button>
    </div>
    
    <div class="ml-2">
        <a class="btn btn-primary" href="{{ route('admin.users.messages.index') }}">
        <i class="fa-solid fa-message mr-2"></i>Messaggi
        </a>
    </div>
    <div>
        <a class="btn btn-primary" href="{{route('admin.users.sponsorships.show')}}"> 
            <i class="fa-regular fa-file mr-2"></i>Dettagli
        </a>
    </div>
</footer>
</div>
    
@endsection