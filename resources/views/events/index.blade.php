@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-primary mb-1">
                @if(!empty($searchQuery))
                    Search results for "{{ $searchQuery }}"
                @elseif($filter === 'past')
                    Past Events
                @elseif($filter === 'all')
                    All Events
                @else
                    Upcoming Events
                @endif
            </h1>
            <p class="text-muted mb-0">
                @if($events->count())
                    Showing {{ $events->count() }} {{ Str::plural('event', $events->count()) }}
                @endif
            </p>
        </div>
        
        @if(empty($searchQuery))
        <div class="btn-group" role="group">
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary {{ !$filter ? 'active' : '' }}">
                <i class="fas fa-calendar-day me-1"></i> Upcoming
            </a>
            <a href="{{ route('events.index', ['filter' => 'past']) }}" class="btn btn-outline-secondary {{ $filter === 'past' ? 'active' : '' }}">
                <i class="fas fa-history me-1"></i> Past
            </a>
            <a href="{{ route('events.index', ['filter' => 'all']) }}" class="btn btn-outline-dark {{ $filter === 'all' ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-1"></i> All
            </a>
        </div>
        @endif
    </div>

    {{-- UPCOMING + PAST SPLIT VIEW --}}
    @if($filter === 'all')
        @php
            $upcomingEvents = $events->filter(fn($e) => !$e->trashed());
            $pastEvents = $events->filter(fn($e) => $e->trashed());
        @endphp

        {{-- UPCOMING EVENTS --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 fw-semibold text-primary">
                    <i class="fas fa-calendar-day me-2"></i>Upcoming Events
                </h3>
                <span class="badge bg-primary rounded-pill">{{ $upcomingEvents->count() }}</span>
            </div>
            
            @if($upcomingEvents->count())
            <div class="row g-4">
                @foreach($upcomingEvents as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm event-card">
                            @if($event->image)
                                <div class="card-img-top overflow-hidden" style="height: 180px;">
                                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $event->title }}">
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0 fw-semibold">{{ $event->title }}</h5>
                                    <span class="badge bg-info text-dark">
                                        {{ Carbon\Carbon::parse($event->date_time)->format('M d') }}
                                    </span>
                                </div>
                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary stretched-link">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Upcoming Events</h4>
                    </div>
                </div>
            @endif
        </div>

        {{-- PAST EVENTS --}}
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 fw-semibold text-secondary">
                    <i class="fas fa-history me-2"></i>Past Events
                </h3>
                <span class="badge bg-secondary rounded-pill">{{ $pastEvents->count() }}</span>
            </div>
            
            @if($pastEvents->count())
            <div class="row g-4">
                @foreach($pastEvents as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm event-card past-event">
                            @if($event->image)
                                <div class="card-img-top overflow-hidden" style="height: 180px;">
                                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $event->title }}" style="opacity: 0.7;">
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0 fw-semibold">{{ $event->title }}</h5>
                                    <span class="badge bg-secondary">
                                        {{ Carbon\Carbon::parse($event->date_time)->format('M d, Y') }}
                                    </span>
                                </div>
                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <span class="badge bg-secondary">Past Event</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Past Events</h4>
                    </div>
                </div>
            @endif
        </div>

    @else
        {{-- DEFAULT (UPCOMING OR PAST) VIEW --}}
        @if($events->count())
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm event-card {{ ($filter === 'past') ? 'past-event' : '' }}">
                        @if($event->image)
                            <div class="card-img-top overflow-hidden" style="height: 180px;">
                                <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $event->title }}" @if($filter === 'past') style="opacity: 0.7;" @endif>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0 fw-semibold">{{ $event->title }}</h5>
                                <span class="badge {{ $filter === 'past' ? 'bg-secondary' : 'bg-info text-dark' }}">
                                    {{ Carbon\Carbon::parse($event->date_time)->format($filter === 'past' ? 'M d, Y' : 'M d') }}
                                </span>
                            </div>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            @if($filter === 'past')
                                <span class="badge bg-secondary">Past Event</span>
                            @else
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary stretched-link">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h4 class="text-muted mb-3">
                    @if(!empty($searchQuery))
                        No events found for "{{ $searchQuery }}"
                    @elseif($filter === 'past')
                        No past events found
                    @else
                        No upcoming events found
                    @endif
                </h4>
                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    <i class="fas fa-calendar-day me-1"></i> Browse Upcoming Events
                </a>
            </div>
        </div>
        @endif
    @endif

    {{-- PAGINATION --}}
    @if($events instanceof \Illuminate\Pagination\LengthAwarePaginator && $events->count())
        <div class="mt-5 d-flex justify-content-center">
            {{ $events->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    .past-event {
        opacity: 0.9;
    }
    .past-event:hover {
        opacity: 1;
    }
    .card-img-top {
        transition: transform 0.5s ease;
    }
    .event-card:hover .card-img-top {
        transform: scale(1.03);
    }
    .btn-outline-primary.active, .btn-outline-secondary.active, .btn-outline-dark.active {
        color: white !important;
    }
    .btn-outline-primary.active {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
    }
    .btn-outline-secondary.active {
        background-color: var(--bs-secondary) !important;
        border-color: var(--bs-secondary) !important;
    }
    .btn-outline-dark.active {
        background-color: var(--bs-dark) !important;
        border-color: var(--bs-dark) !important;
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>
@endpush