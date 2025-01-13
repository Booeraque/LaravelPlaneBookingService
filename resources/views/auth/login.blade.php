@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       class="form-control" value="{{ old('username') }}" required>
                <span class="error-message" id="usernameError"></span>
                @error($field = 'username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <span class="error-message" id="passwordError"></span>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
<!-- Made with help of Copilot AI, because I had no time to copy the validation from backend to frontend -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            let valid = true;

            // Username validation
            const username = document.getElementById('username').value;
            if (username.length < 3 || username.length > 50) {
                valid = false;
                document.getElementById('usernameError').innerText = 'Username must be between 3 and 50 characters.';
            } else {
                document.getElementById('usernameError').innerText = '';
            }

            // Password validation
            const password = document.getElementById('password').value;
            if (password.length < 6) {
                valid = false;
                document.getElementById('passwordError').innerText = 'Password must be at least 6 characters.';
            } else {
                document.getElementById('passwordError').innerText = '';
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
@endsection
