@extends('layouts.app') 

@section('content')
<div class="container py-4">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold text-primary">My Bookings</h1>
        @if($bookings->count())
            <span class="badge bg-primary rounded-pill">{{ $bookings->total() }} booking(s)</span>
        @endif
    </div>

    {{-- Filter Dropdown --}}
    @if(isset($events) && $events->count())
        <form method="GET" class="mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Filter by Event</label>
                    <select name="event_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Events</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    @endif

    @if($bookings->count())
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($bookings as $booking)
                        <div class="list-group-item list-group-item-action p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1 me-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <h5 class="mb-0 fw-semibold">{{ $booking->event->title }}</h5>
                                        @if($booking->status === 'paid')
                                            <span class="badge bg-success ms-2">Paid</span>
                                        @elseif($booking->status === 'failed')
                                            <span class="badge bg-danger ms-2">Failed</span>
                                        @endif
                                    </div>
                                    
                                    <div class="d-flex flex-wrap gap-3 mb-2">
                                        <div class="text-muted">
                                            <i class="fas fa-ticket-alt me-2"></i>
                                            {{ ucfirst($booking->ticket_type) }} × {{ $booking->quantity }}
                                        </div>
                                        <div class="text-muted">
                                            <i class="far fa-calendar-alt me-2"></i>
                                            {{ $booking->created_at->format('M d, Y h:i A') }}
                                        </div>
                                    </div>
                                    
                                    @if($booking->status === 'failed' && $booking->failure_reason)
                                        <div class="alert alert-light p-2 mt-2 mb-0 small">
                                            <i class="fas fa-exclamation-circle me-2 text-danger"></i>
                                            <strong>Reason:</strong> {{ $booking->failure_reason }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="d-flex flex-column align-items-end">
                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary mb-2">
                                        View Details <i class="fas fa-chevron-right ms-1"></i>
                                    </a>
                                    @if($booking->status === 'paid')
                                        <span class="text-success small">
                                            <i class="fas fa-check-circle me-1"></i> Confirmed
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $bookings->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-calendar-times fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">No Bookings Yet</h4>
                <p class="text-muted mb-4">You haven't made any bookings. Explore our events to get started!</p>
                <a href="{{ route('events.index') }}" class="btn btn-primary px-4">
                    <i class="fas fa-search me-2"></i> Browse Events
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .list-group-item {
        transition: all 0.2s ease;
    }
    .list-group-item:hover {
        background-color: blue;
        transform: translateX(2px);
    }
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
</style>
@endpush
