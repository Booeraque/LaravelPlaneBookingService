@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title with Pagination Arrows -->
        <div class="planes-header">
            <!-- Left Arrow -->
            @if ($users->onFirstPage())
                <span class="arrow disabled"><</span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="arrow"><</a>
            @endif

            <h1>Users</h1>

            <!-- Right Arrow -->
            <a href="{{ route('users.create') }}" class="btn" style="margin-right: 10px">Add a User</a>
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="arrow">></a>
            @else
                <span class="arrow disabled">></span>
            @endif
        </div>

        <!-- User List -->
        <ul class="plane-list">
            @foreach ($users as $user)
                <li class="plane-item">
                    <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                    <span class="plane-info">Email: {{ $user->email }}</span>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn">Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                          class="btn" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <!-- Page Numbers using Copilot AI assistant -->
        <div class="page-numbers">
            @foreach ($users->links()->elements as $element)
                @if (is_string($element))
                    <span class="dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $users->currentPage())
                            <span class="current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection
