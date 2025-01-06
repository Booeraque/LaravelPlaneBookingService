@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>

        <a href="{{ route('users.index') }}" class="btn">Back to Users</a>
    </div>
@endsection
