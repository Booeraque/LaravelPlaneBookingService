@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" required>
        </div>
        <div class="form-group button-group">
            <a href="{{ url('/') }}" class="btn">Go Back</a>
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
</div>
@endsection
