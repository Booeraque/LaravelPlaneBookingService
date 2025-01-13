@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username') }}" required>
                <span class="error-message" id="usernameError"></span>
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required>
                <span class="error-message" id="emailError"></span>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       class="form-control @error('password') is-invalid @enderror" required>
                <span class="error-message" id="passwordError"></span>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror" required>
                <span class="error-message" id="passwordConfirmationError"></span>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                <span class="error-message" id="nameError"></span>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let valid = true;

            // Username validation
            const username = document.getElementById('username').value;
            if (username.length < 3 || username.length > 50) {
                valid = false;
                document.getElementById('usernameError').innerText = 'Username must be between 3 and 50 characters.';
            } else {
                document.getElementById('usernameError').innerText = '';
            }

            // Email validation
            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                valid = false;
                document.getElementById('emailError').innerText = 'Invalid email address.';
            } else {
                document.getElementById('emailError').innerText = '';
            }

            // Password validation
            const password = document.getElementById('password').value;
            const passwordPattern = /[A-Z]/;
            if (password.length < 6 || !passwordPattern.test(password)) {
                valid = false;
                document.getElementById('passwordError').innerText = 'Password must be at least 6 characters and contain at least one uppercase letter.';
            } else {
                document.getElementById('passwordError').innerText = '';
            }

            // Password confirmation validation
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            if (password !== passwordConfirmation) {
                valid = false;
                document.getElementById('passwordConfirmationError').innerText = 'Passwords do not match.';
            } else {
                document.getElementById('passwordConfirmationError').innerText = '';
            }

            // Name validation
            const name = document.getElementById('name').value;
            if (name.length < 3 || name.length > 50) {
                valid = false;
                document.getElementById('nameError').innerText = 'Name must be between 3 and 50 characters.';
            } else {
                document.getElementById('nameError').innerText = '';
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
@endsection
