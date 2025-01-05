@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>
        <p class="plane-item"><strong>Username:</strong> {{ auth()->user()->username }}</p>
        <p class="plane-item"><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p class="plane-item"><strong>Name:</strong> {{ auth()->user()->name }}</p>

        <a href="{{ route('profile.edit') }}" class="btn">Change Personal Information</a>
        @if ($userType === 'customer')
            <a href="{{ route('bookings.index') }}" class="btn">View Your Bookings</a>
        @elseif ($userType === 'worker')
            <a href="{{ route('worker.bookings') }}" class="btn">View Your Bookings</a>
        @endif
        <button onclick="history.back()" class="btn">Back</button>
    </div>
@endsection
