@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Plane Booking Service</h1>
        <div class="buttons">
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </div>
@endsection
