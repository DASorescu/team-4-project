@extends('layouts.app')

@section('content')
<section id="payment_details">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form action="{{ route('admin.users.sponsorships.store') }}" method="POST" id="payment-form">
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
                                <input id="card-holder-name" type="text">

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element" class="w-75 p-2 m-2 border-danger b-1"></div>

                                <div class="mt-5">
                                    <h3>Seleziona Abbonamento:</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <input type="radio" id="silver" name="plan" 
                                                value="price_1LzentDdebw56msOoppkEEQP" class="align-middle">
                                            <label for="silver">
                                                Silver,
                                                2,99 &euro;,
                                                24 ore</label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="radio" id="gold" name="plan" 
                                                value="price_1LzentDdebw56msO6LNW6c47" class="align-middle">
                                            <label for="gold">
                                                Gold,
                                                5,99 &euro;,
                                                72 ore</label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="radio" id="platinum" name="plan" 
                                                value="price_1LzentDdebw56msO04NaOxbz" class="align-middle">
                                            <label for="platinum">
                                                Platinum,
                                                9,99 &euro;,
                                                144 ore</label>
                                        </li>
                                    </ul>
                                </div>

                                
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
                                <button id="card-button" class="btn btn-success mt-2"
                                    data-secret="{{ $intent->client_secret }}">
                                    Aggiungi Sponsorizzazione
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://js.stripe.com/v3/"></script>

<script>
    // prendo la chiave pubblica
    const stripe = Stripe('pk_test_51LxnJDDdebw56msOLREOID2q2ZgUUGFYJIPS2O3tMPbTNiti4PPP89ZBdOk2QEqjphpyyC4fNqcPy0sYxpfvy16x00v1lXlH1T');
    
    // creo il campo delle informazioni richieste da stripe
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    function stripeTokenHandler(token) {

        const form = document.getElementById('payment-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type','hidden');
        hiddenInput.setAttribute('name','stripeToken');
        hiddenInput.setAttribute('value', token.payment_method);
        form.appendChild(hiddenInput);

        form.submit();
    }
 
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        stripe.confirmCardSetup(clientSecret, {
    payment_method: {
      card: cardElement,
      billing_details: { name: cardHolderName.value },
    },
  })
  .then(function(result) {
      console.log(result)
      stripeTokenHandler(result.setupIntent)
  });
});

</script>
@endsection