@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
            </div>
            <div class="button-group form-group">
                <button type="submit" class="btn">Save Changes</button>
                <button type="button" onclick="history.back()" class="btn">Back</button>
            </div>
        </form>
    </div>
@endsection
