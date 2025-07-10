@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Events
        </a>
    </div>

    <!-- Event Header -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="h2 fw-bold mb-3">{{ $event->title }}</h1>
            
            <div class="d-flex flex-wrap gap-3 mb-4">
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>{{ $event->venue }}</span>
                </div>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <span>{{ \Carbon\Carbon::parse($event->date_time)->format('F j, Y g:i A') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Content -->
    <div class="row">
        <div class="col-lg-8">
            @if($event->image)
            <div class="mb-4 rounded-3 overflow-hidden" style="max-height: 400px;">
                <img src="{{ asset('storage/' . $event->image) }}" 
                     alt="{{ $event->title }}" 
                     class="img-fluid w-100 h-100 object-fit-cover">
            </div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h5 fw-semibold mb-3">About This Event</h3>
                    <div class="event-description">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="h5 mb-0 fw-semibold">Book Tickets</h3>
                </div>
                <div class="card-body">
                    @auth
                    <form method="POST" action="{{ route('bookings.store', $event) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ticket Type</label>
                            <select name="ticket_type" class="form-select" required>
                                <option value="regular">Regular - ₦{{ number_format($event->regular_price) }}</option>
                                @if($event->vip_price)
                                <option value="vip">VIP - ₦{{ number_format($event->vip_price) }}</option>
                                @endif
                                @if($event->vvip_price)
                                <option value="vvip">VVIP - ₦{{ number_format($event->vvip_price) }}</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" name="quantity" min="1" value="1" 
                                class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                            <i class="fas fa-ticket-alt me-2"></i> Book Now
                        </button>
                    </form>
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">Please <a href="{{ route('login') }}" class="alert-link">login</a> to book tickets.</p>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Scoped styles that won't affect navbar */
    .event-description {
        line-height: 1.7;
        white-space: pre-line;
    }
    #event-show .form-select, 
    #event-show .form-control {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }
    #event-show .card {
        border-radius: 0.75rem;
    }
    #event-show .btn-success {
        transition: all 0.3s ease;
    }
    #event-show .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush