@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title with Pagination Arrows -->
        <div class="planes-header">
            <!-- Left Arrow -->
            @if ($bookings->onFirstPage())
                <span class="arrow disabled"><</span>
            @else
                <a href="{{ $bookings->previousPageUrl() }}" class="arrow"><</a>
            @endif

            <h1>My Bookings</h1>

            <!-- Right Arrow -->
            @if ($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}" class="arrow">></a>
            @else
                <span class="arrow disabled">></span>
            @endif
        </div>

        @if($bookings->isEmpty())
            <p>No bookings found.</p>
        @else
            <ul class="plane-list">
                @foreach($bookings as $booking)
                    <li class="plane-item">
                        <a href="{{ route('bookings.show', $booking->id) }}">Booking #{{ $booking->id }}</a>
                        <span class="plane-info">Date: {{ $booking->booking_date }} | Worker: {{ $booking->worker->user->name }}</span>
                    </li>
                @endforeach
            </ul>

            <!-- Page Numbers with Buttons -->
            <div class="page-numbers">
                @foreach ($bookings->links()->elements as $element)
                    @if (is_string($element))
                        <span class="dots">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $bookings->currentPage())
                                <span class="current">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection
