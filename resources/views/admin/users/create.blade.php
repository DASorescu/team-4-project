@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
`   @endif
    <form class="mt-5" action="{{ route('admin.users.store')}}" method="POST" id="creation-form">
        @method('POST')
        @csrf
        <div class="row">
    
           <div class="col-6">
               <div class="form-group">
                   <label for="first_name">Nome</label>
                   <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ old('first_name') }}" required minlength="3">
               </div>
           </div>
    
           <div class="col-6">
                <div class="form-group">
                    <label for="last_name">Cognome</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required minlength="3">
                </div>
           </div>
    
           <div class="col-6">
                <div class="form-group">
                    <select name="address" id="address">
                        <option value="">Scegli la città</option>
                        @foreach(config('cities') as $city)
                            
                            <option value="{{ $city }}" {{ old('address') == $city ? 'selected' : '' }}>                      
                                {{$city}}                           
                            </option>
                        @endforeach    
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="btn-group w-100 my-2">
                    {{-- <button class="btn btn-light dropdown-toggle w-75" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false"> --}}
                    <button type="button" class="btn btn-light dropdown-toggle w-75 text-left" data-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
                         Specializzazioni
                    </button>
                    <div class="dropdown-menu w-100 h-400px overflowy">
                        @foreach ($all_specialization as $specialization)
                            <div class="form-check form-check-inline d-flex align-items-center p-2 dropdown-item spec-checkbox w-100">
                                <input 
                                    class="form-check-input"
                                    id="spec-{{$specialization->id}}" 
                                    type="checkbox" 
                                    name="specs[]"
                                    value="{{ $specialization->id }}" 
                                    @if(in_array($specialization->id, old('specs',[]))) checked @endif
                                    >
                                <label class="w-70 my-0 mx-1" for="spec-{{$specialization->label}}">{{ $specialization->label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



           <footer class="d-flex align-items-center justify-content-between">
                <div>
    
                    <button class="btn btn-success" type="submit">
                        {{-- Salve -> Salva --}}
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Salva
                    </button>
    
                </div>
            </footer>
    
        </div>
    
    </form>
</div>
@endsection