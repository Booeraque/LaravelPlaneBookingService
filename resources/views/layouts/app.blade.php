<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="header-left">
            @auth
                <a href="{{ route('profile') }}" class="header-btn">Profile</a>
            @endauth
        </div>
        <div class="header-center">
            <h1 class="{{ Auth::check() ? 'centered' : '' }}">Plane Booking Service</h1>
        </div>
        <div class="header-right">
            @guest
                <a href="{{ route('login') }}" class="header-btn">Login</a>
                <a href="{{ route('register') }}" class="header-btn">Register</a>
            @else
                <div class="header-controls">
                    @auth
                        @if(Auth::user()->worker && Auth::user()->worker->is_admin)
                            <a href="{{ route('planes.index') }}" class="header-btn">Manage Planes</a>
                            <a href="{{ route('users.index') }}" class="header-btn">Manage Users</a>
                        @endif
                        @if(Auth::user()->customer)
                            @php
                                $latestCart = auth()->user()->customer->shoppingCarts()->latest('id')->first();
                                $planeCount = $latestCart->planes->count();
                            @endphp
                            <a href="{{ route('shopping-cart.show', $latestCart->id) }}" class="chosen-planes">
                                Chosen Planes: {{ $planeCount }}
                            </a>
                        @endif
                    @endauth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            @endguest
        </div>
    </header>
    <div class="layout-container">
        @yield('content')
    </div>
    <footer>
        <div class="footer-left">
            <p>Plane Booking Service</p>
        </div>
        <div class="footer-center">
            <p>Built by Yegor Burykin</p>
        </div>
    </footer>
</body>
</html>
