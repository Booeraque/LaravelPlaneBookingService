<!-- booking-proceed.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Confirm Your Booking</h1>
        <form method="POST" action="{{ route('booking.confirm') }}">
            @csrf
            <p><strong>Customer:</strong> {{ auth()->user()->name }}</p>
            <h2>Chosen Planes</h2>
            <ul class="plane-list scrollable">
                @foreach($cart->planes as $plane)
                    <li class="plane-item">
                        <a href="{{ route('planes.show', $plane->id) }}">{{ $plane->plane_name }}</a>
                        <span class="plane-info">Model: {{ $plane->model }} | Capacity: {{ $plane->capacity }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="form-group">
                <label for="worker_id">Choose Worker</label>
                <select id="worker_id" name="worker_id" class="form-control @error('worker_id') is-invalid @enderror" required>
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->user->name }}</option>
                    @endforeach
                </select>
                @error('worker_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="additional_comments">Additional Comments</label>
                <textarea id="additional_comments"
                          name="additional_comments"
                          class="form-control @error('additional_comments') is-invalid @enderror"></textarea>
                @error('additional_comments')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group button-group">
                <button type="button" class="btn" onclick="history.back()">Cancel</button>
                <button type="submit" class="btn">Confirm Booking</button>
            </div>
        </form>
    </div>
@endsection
