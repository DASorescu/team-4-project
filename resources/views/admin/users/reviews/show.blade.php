@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card d-flex" style="width: 18rem;">
            <div class="card-body justify-content-center">
                <h5 class="card-title">{{ $review->guest_name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $review->guest_email }}</h6>
                <p class="card-text">{{ $review->rating }}</p>
                <p class="card-text">{{ $review->content }}</p>
                <a href="{{ route('admin.users.reviews.index', $review->id) }}" class="btn btn-primary mr-4">Torna
                    indietro</a>
            </div>
        </div>
    </section>
@endsection
