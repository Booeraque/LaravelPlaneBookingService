@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add a New Plane</h1>
        <form method="POST" action="{{ route('planes.store') }}">
            @csrf
            <div class="form-group">
                <label for="plane_name">Plane Name</label>
                <input type="text" id="plane_name" name="plane_name"
                       class="form-control @error('plane_name') is-invalid @enderror"
                       value="{{ old('plane_name') }}" required>
                @error('plane_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" id="model" name="model"
                       class="form-control @error('model') is-invalid @enderror"
                       value="{{ old('model') }}" required>
                @error('model')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" id="capacity" name="capacity"
                       class="form-control @error('capacity') is-invalid @enderror"
                       value="{{ old('capacity') }}" required>
                @error('capacity')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="speed">Speed</label>
                <input type="number" id="speed" name="speed"
                       class="form-control @error('speed') is-invalid @enderror"
                       value="{{ old('speed') }}" required>
                @error('speed')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Plane</button>
        </form>
        <a href="{{ route('planes.index') }}" class="btn">Back to Planes</a>
    </div>
@endsection
