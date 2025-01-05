<!-- resources/views/bookings/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            <div class="form-group">
                <label for="worker_id">Choose Worker</label>
                <select id="worker_id" name="worker_id" class="form-control">
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}" {{ $worker->id == $booking->worker_id ? 'selected' : '' }}>{{ $worker->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="additional_comments">Additional Comments</label>
                <textarea id="additional_comments" name="additional_comments" class="form-control">{{ $booking->additional_comments }}</textarea>
            </div>
            <h2>Chosen Planes</h2>
            <ul class="plane-list">
                @foreach($booking->shoppingCart->planes as $plane)
                    <li class="plane-item">
                        <a href="{{ route('planes.show', $plane->id) }}" class="plane-name">{{ $plane->plane_name }}</a>
                        <span class="plane-info">Model: {{ $plane->model }} | Capacity: {{ $plane->capacity }}</span>
                        <button type="button" class="btn remove-btn">Remove</button>
                    </li>
                @endforeach
            </ul>
            <div class="form-group button-group">
                <button type="button" class="btn" onclick="history.back()">Cancel</button>
                <button type="submit" class="btn">Update Booking</button>
            </div>
        </form>
    </div>
@endsection
