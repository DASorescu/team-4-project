@extends('layouts.app')

@section('content')
    <section id="payment_details">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <form action="{{ route('admin.users.sponsorships.store') }}" method="POST">
                        @csrf
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-center">
                                <h3 class="mt-3">Aggiungi Una Sponsorizzazione</h3>
                            </div>
                            <div class="card-body shadow">
                                <div class="form-group">
                                    <h3>
                                        Dr. {{ $user->userDetail->first_name }} {{ $user->userDetail->last_name }}
                                    </h3>
                                    {{-- @if ($payment_methods) --}}
                                    <select name="payment_method" id="payment_method" class="custom-select">
                                        <option value="">Seleziona metodo di pagamento</option>
                                        <option>carta1</option>
                                        <option>carta2</option>
                                    </select>
                                </div>

                                <div class="mt-5">
                                    <h3>Seleziona Abbonamento:</h3>
                                    <ul class="list-group">
                                        @foreach ($sponsor_plans as $plan)
                                            <li class="list-group-item">
                                                <input type="radio" id="{{ $plan->name }}" name="plan_id"
                                                    value="{{ $plan->id }}" class="align-middle">
                                                <label for="{{ $plan->name }}">{{ $plan->name }},
                                                    {{ $plan->cost }}&euro;,
                                                    {{ $plan->duration }} ore</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <div>
                                    <a class="btn btn-secondary shadow-sm"
                                        href="{{ route('admin.users.sponsorships.show') }}">
                                        <i class="fa-solid fa-rotate-left mr-2"></i>Torna indietro
                                    </a>
                                </div>
                                <div class="ml-2">
                                    <button type="submit" class="btn btn-success shadow-sm">
                                        <i class="fa-solid fa-check mr-2"></i>Conferma Pagamento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- @else
        <h3 class="text-muted">Nessun metodo di pagamento disponibile, aggiungine uno.</h3>
        @endif --}}
@endsection
