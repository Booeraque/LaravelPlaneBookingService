@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>

        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="worker_id">Choose Worker</label>
                <select id="worker_id" name="worker_id" class="form-control @error('worker_id') is-invalid @enderror">
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}" {{ $worker->id == $booking->worker_id ? 'selected' : '' }}>{{ $worker->user->name }}</option>
                    @endforeach
                </select>
                @error('worker_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="additional_comments">Additional Comments</label>
                <textarea id="additional_comments" name="additional_comments" class="form-control @error('additional_comments') is-invalid @enderror">{{ $booking->additional_comments }}</textarea>
                @error('additional_comments')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="button-group form-group">
                <button type="submit" class="btn">Save Changes</button>
                <button type="button" onclick="history.back()" class="btn">Back</button>
            </div>
        </form>

        <h2>Chosen Planes</h2>
        <ul class="plane-list scrollable">
            @foreach($booking->shoppingCart->planes as $plane)
                <div class="plane-wrapper">
                    <li class="plane-item">
                        <a href="{{ route('planes.show', $plane->id) }}">{{ $plane->plane_name }}</a>
                        <span class="plane-info">Model: {{ $plane->model }} | Capacity: {{ $plane->capacity }}</span>
                        <form method="POST" action="{{ route('cart.remove', $plane->id) }}" class="btn" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Remove</button>
                        </form>
                    </li>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
