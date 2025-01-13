@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title with Pagination Arrows -->
        <div class="planes-header">
            <!-- Left Arrow -->
            @if ($planes->onFirstPage())
                <span class="arrow disabled"><</span>
            @else
                <a href="{{ $planes->previousPageUrl() }}" class="arrow"><</a>
            @endif

            <h1>Planes</h1>

            <!-- Right Arrow -->
                @if(Auth::user()->worker && Auth::user()->worker->is_admin)
                    <a href="{{ route('planes.create') }}" class="btn" style="margin-right: 10px">Add a Plane</a>
                @endif
            @if ($planes->hasMorePages())
                <a href="{{ $planes->nextPageUrl() }}" class="arrow">></a>
            @else
                <span class="arrow disabled">></span>
            @endif
        </div>

        <!-- Plane List -->
        <ul class="plane-list">
            @foreach ($planes as $plane)
                <li class="plane-item">
                    <a href="{{ route('planes.show', $plane->id) }}">{{ $plane->plane_name }}</a>
                    <span class="plane-info">Model: {{ $plane->model }} | Capacity: {{ $plane->capacity }}</span>
                    @if ($isAdmin)
                        <a href="{{ route('planes.edit', $plane->id) }}" class="btn">Edit</a>
                        <form method="POST" action="{{ route('planes.destroy', $plane->id) }}" class="btn" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>

        <!-- Page Numbers using Copilot AI assistant -->
        <div class="page-numbers">
            @foreach ($planes->links()->elements as $element)
                @if (is_string($element))
                    <span class="dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $planes->currentPage())
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
