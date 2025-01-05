@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Plane Details</h1>
        <p><strong>Plane Name:</strong> {{ $plane->plane_name }}</p>
        <p><strong>Model:</strong> {{ $plane->model }}</p>
        <p><strong>Capacity:</strong> {{ $plane->capacity }}</p>
        <p><strong>Speed:</strong> {{ $plane->speed }}</p>
        <p><strong>Status:</strong> {{ $plane->status }}</p>

        <div class="button-group">
            @if($userType === 'customer')
            <form method="POST" action="{{ route('cart.add', $plane->id) }}">
                @csrf
                <button type="submit" class="btn {{ $inCart ? 'disabled' : '' }}" {{ $inCart ? 'disabled' : '' }}>Add to Cart</button>
            </form>
            <form method="POST" action="{{ route('cart.remove', $plane->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn {{ $inCart ? '' : 'disabled' }}" {{ $inCart ? '' : 'disabled' }}>Remove from Cart</button>
            </form>
            @endif
        </div>

        <a href="{{ route('planes.index') }}" class="btn">Back to Planes</a>
    </div>
@endsection
