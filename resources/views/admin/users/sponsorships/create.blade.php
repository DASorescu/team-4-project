@extends('layouts.app')

@section('content')
    <section id="payment_details">
        <div class="container">
            <div class="text-align-center mt-5">
                <form action="{{ route('admin.users.sponsorships.store') }}" method="POST">
                    @csrf
                    <h3>Dr. {{ $user->userDetail->first_name }} {{ $user->userDetail->last_name}}</h3>
                    {{-- @if($payment_methods) --}}
                    <select name="payment_method" id="payment_method">
                        <option value="">Seleziona metodo di pagamento</option>
                        <option>carta1</option>
                        <option>carta2</option>
                    </select>

                    <div class="mt-5">
                        <h3>Seleziona Abbonamento:</h3>
                        <div class="d-flex">
                            @foreach ($sponsor_plans as $plan)
                            <input type="radio" id="{{$plan->name}}" name="plan_id" value="{{$plan->name}}">
                            <label for="{{$plan->name}}">{{$plan->name}}, {{ $plan->cost }}&euro;, {{ $plan->duration }} ore</label><br>     
                            @endforeach
                        </div>
                    </div>
                </form>
                    
                    {{-- @else
                    <h3 class="text-muted">Nessun metodo di pagamento disponibile, aggiungine uno.</h3>
                    @endif --}}
                </div>
            </div>
        </section>
@endsection