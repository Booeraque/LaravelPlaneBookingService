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
            @if ($planes->hasMorePages())
                <a href="{{ $planes->nextPageUrl() }}" class="arrow">></a>
            @else
                <span class="arrow disabled">></span>
            @endif
        </div>

        <!-- Plane List -->
        <ul class="plane-list">
            @foreach($planes as $plane)
                <li class="plane-item">
                    <a href="{{ route('planes.show', $plane->id) }}">{{ $plane->plane_name }}</a>
                    <span class="plane-info">Status: {{ $plane->status }} | Capacity: {{ $plane->capacity }}</span>
                </li>
            @endforeach
        </ul>

        <!-- Page Numbers -->
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
