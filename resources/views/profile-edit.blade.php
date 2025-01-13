@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST" action="{{ route('profile.update') }}" id="profileEditForm">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                <span class="error-message" id="usernameError"></span>
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                <span class="error-message" id="emailError"></span>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                <span class="error-message" id="nameError"></span>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
<!-- Made with help of Copilot AI, because I had no time to copy the validation from backend to frontend -->
    <script>
        document.getElementById('profileEditForm').addEventListener('submit', function(event) {
            let valid = true;

            // Username validation
            const username = document.getElementById('username').value;
            if (username.length > 50) {
                valid = false;
                document.getElementById('usernameError').innerText = 'Username must not exceed 50 characters.';
            } else {
                document.getElementById('usernameError').innerText = '';
            }

            // Email validation
            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email) || email.length > 50) {
                valid = false;
                document.getElementById('emailError').innerText = 'Invalid email address or exceeds 50 characters.';
            } else {
                document.getElementById('emailError').innerText = '';
            }

            // Name validation
            const name = document.getElementById('name').value;
            if (name.length > 50) {
                valid = false;
                document.getElementById('nameError').innerText = 'Name must not exceed 50 characters.';
            } else {
                document.getElementById('nameError').innerText = '';
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
@endsection
