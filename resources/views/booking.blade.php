@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Booking Details</h1>
        <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
        <p><strong>Worker:</strong> {{ $booking->worker->user->name }}</p>
        <p><strong>Additional Comments:</strong> {{ $booking->additional_comments }}</p>

        <h2>Chosen Planes</h2>
        <ul class="plane-list scrollable">
            @foreach($booking->shoppingCart->planes as $plane)
                <li class="plane-item">
                    <a href="{{ route('planes.show', $plane->id) }}">{{ $plane->plane_name }}</a>
                    <span class="plane-info">Model: {{ $plane->model }} | Capacity: {{ $plane->capacity }}</span>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('planes.index') }}" class="btn">Back to Planes</a>

        @if(auth()->user()->worker !== null && $booking->worker_id === auth()->user()->worker->id)
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn">Edit Booking</a>
        @endif
    </div>
@endsection
