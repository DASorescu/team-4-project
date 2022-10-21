@extends('layouts.app')

@section('content')
<div class="container">

    <form class="mt-5" action="{{ route('admin.users.store')}}" method="POST">
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
                        {{-- TODO Specialization --}}
           <footer class="d-flex align-items-center justify-content-between">
                <div>
    
                    <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Salve
                    </button>
    
                </div>
            </footer>
    
        </div>
    
    </form>
</div>
@endsection