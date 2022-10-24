@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card d-flex" style="width: 40rem;">
            <div class="card-body justify-content-center">
                <h5 class="card-title">{{ $review->guest_name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $review->guest_email }}</h6>
                <p>
                    @for ($i = 0; $i < $review->rating; $i++)
                        <i class="fa-solid fa-star text-warning"></i>
                    @endfor
                    @for ($i = 0; $i < 5 - $review->rating; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </p>
                <p class="card-text">{{ $review->content }}</p>
                <a href="{{ route('admin.users.reviews.index', $review->id) }}" class="btn btn-primary mr-4">Torna
                    indietro</a>
            </div>
        </div>
    </section>
@endsection
