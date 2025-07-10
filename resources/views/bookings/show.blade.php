@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary mb-3">Booking Details</h1>
        @if($booking->status === 'paid')
            <div class="d-inline-block bg-success bg-opacity-10 px-4 py-2 rounded-pill">
                <i class="fas fa-check-circle text-success me-2"></i>
                <span class="text-success fw-semibold">Payment Confirmed</span>
            </div>
        @endif
    </div>

    <div class="row g-4">
        <!-- User Info Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle fs-4 text-primary me-3"></i>
                        <h3 class="h5 mb-0 fw-bold text-primary">User Information</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Name</p>
                            <p class="mb-0 fw-semibold">{{ $booking->user->name }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Email</p>
                            <p class="mb-0 fw-semibold">{{ $booking->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Info Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt fs-4 text-success me-3"></i>
                        <h3 class="h5 mb-0 fw-bold text-success">Event Information</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-heading text-success"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Title</p>
                            <p class="mb-0 fw-semibold">{{ $booking->event->title }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-clock text-success"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Date & Time</p>
                            <p class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($booking->event->date_time)->format('F j, Y g:i A') }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-map-marker-alt text-success"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Venue</p>
                            <p class="mb-0 fw-semibold">{{ $booking->event->venue }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Details Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-receipt fs-4 text-info me-3"></i>
                        <h3 class="h5 mb-0 fw-bold text-info">Booking Details</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-ticket-alt text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Ticket Type</p>
                            <p class="mb-0 fw-semibold text-capitalize">{{ $booking->ticket_type }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-hashtag text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Quantity</p>
                            <p class="mb-0 fw-semibold">{{ $booking->quantity }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-money-bill-wave text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Total Paid</p>
                            <p class="mb-0 fw-semibold">₦{{ number_format($booking->total_price) }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-info-circle text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Status</p>
                            <span class="badge rounded-pill {{ $booking->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-barcode text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0 small text-muted">Booking Code</p>
                            <p class="mb-0 fw-semibold text-uppercase">{{ $booking->booking_code }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($booking->status === 'paid')
        <!-- QR Code and Ticket Download -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-qrcode fs-4 text-dark me-3"></i>
                        <h3 class="h5 mb-0 fw-bold text-dark">Your Ticket</h3>
                    </div>
                </div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="p-4 border border-2 border-dashed border-primary rounded-3 mb-4">
                        {!! QrCode::size(180)->generate($booking->payment_reference) !!}
                    </div>
                    <div class="text-center mb-4">
                        <p class="mb-1 small text-muted">Reference Number</p>
                        <p class="mb-0 fw-bold text-primary">{{ $booking->payment_reference }}</p>
                    </div>
                    <a href="{{ route('bookings.download', $booking) }}" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-download me-2"></i> Download Ticket (PDF)
                    </a>
                    <p class="small text-muted mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i> Present this QR code at the event entrance
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Back Button -->
    <div class="text-center mt-5">
        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary px-4 py-2">
            <i class="fas fa-arrow-left me-2"></i> Back to My Bookings
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.75rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    .rounded-circle {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endpush