@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Plane</h1>
        <form method="POST" action="{{ route('planes.update', $plane->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="plane_name">Plane Name</label>
                <input type="text" id="plane_name" name="plane_name" class="form-control" value="{{ $plane->plane_name }}" required>
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ $plane->model }}" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="form-control" value="{{ $plane->capacity }}" required>
            </div>
            <div class="form-group">
                <label for="speed">Speed</label>
                <input type="number" id="speed" name="speed" class="form-control" value="{{ $plane->speed }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $plane->status }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Plane</button>
        </form>
    </div>
@endsection
