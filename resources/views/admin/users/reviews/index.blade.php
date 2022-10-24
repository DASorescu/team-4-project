@extends('layouts.app')

@section('content')
    <header>
        <h1 class="text-center">Reviews</h1>
    </header>
    <div class="container">
        <table class="table container-fluid">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Content</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <th scope="row">{{ $review->id }}</th>
                        <td>{{ $review->guest_name }}</td>
                        <td>{{ $review->guest_email }}</td>
                        <td>
                            @for ($i = 0; $i < $review->rating; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                            @for ($i = 0; $i < 10 - $review->rating; $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </td>
                        <td>{{ substr($review->content, 0, 20) }}...</td>
                        <td><a href="{{ route('admin.users.reviews.show', $review->id) }}"
                                class="btn btn-primary mr-4">Vedi</a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td scope="row">Nessuna Recensione</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
