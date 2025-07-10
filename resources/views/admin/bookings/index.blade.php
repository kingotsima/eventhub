@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Paid Bookings Management</h2>
            <a href="{{ route('admin.bookings.export', request()->query()) }}" class="btn btn-light">
                <i class="fas fa-file-export me-2"></i>Export CSV
            </a>
        </div>

        <div class="card-body">
            <!-- Search & Filter Card -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.bookings.index') }}">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" name="search" placeholder="Search by user name..." 
                                           value="{{ request('search') }}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <select name="event_id" class="form-select">
                                    <option value="">All Events</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">User Name</th>
                            <th>Event Title</th>
                            <th class="text-nowrap text-center">Quantity</th>
                            <th class="text-nowrap">Payment Ref</th>
                            <th class="text-nowrap">Booked At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                        <tr>
                            <td class="fw-bold">{{ $bookings->firstItem() + $index }}</td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                    {{ $booking->user->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                    {{ $booking->event->title ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill px-3 py-1">
                                    {{ $booking->quantity }}
                                </span>
                            </td>
                            <td>
                                <code>{{ $booking->payment_reference }}</code>
                            </td>
                            <td class="text-nowrap">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $booking->created_at->format('d M Y') }}
                                <br>
                                <small>{{ $booking->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                @if($booking->attendance_status === 'attended')
                                    <span class="badge bg-success">Attended</span>
                                @else
                                    <span class="badge bg-secondary">Absent</span>
                                @endif
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-calendar-times mb-2" style="font-size: 2rem;"></i>
                                        <h5>No paid bookings found</h5>
                                        @if(request()->has('search') || request()->has('event_id'))
                                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                                Clear filters
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} entries
                </div>
                <div>
                    {{ $bookings->withQueryString()->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    /* Dark mode table styles */
    body.dark-mode .table {
        color: var(--dark-text);
        background-color: var(--dark-card);
    }
    
    body.dark-mode .table th {
        background-color: var(--dark-header);
        border-color: var(--dark-border);
        color: var(--dark-text);
    }
    
    body.dark-mode .table td {
        background-color: var(--dark-card);
        border-color: var(--dark-border);
    }
    
    body.dark-mode .table-hover tbody tr:hover {
        background-color: rgba(15, 52, 96, 0.7) !important;
        color: white;
    }
    
    body.dark-mode code {
        background-color: var(--dark-input-bg);
        color: var(--dark-text);
        padding: 2px 4px;
        border-radius: 4px;
    }
    
    body.dark-mode .text-muted {
        color: #a1a1a1 !important;
    }
    
    body.dark-mode .card {
        background-color: var(--dark-card);
        border-color: var(--dark-border);
    }
    
    body.dark-mode .card-header {
        background-color: var(--dark-header) !important;
        border-bottom-color: var(--dark-border) !important;
        color: var(--dark-text) !important;
    }
    
    body.dark-mode .input-group-text {
        background-color: var(--dark-header);
        border-color: var(--dark-border);
        color: var(--dark-text);
    }
    
    body.dark-mode .form-control,
    body.dark-mode .form-select {
        background-color: var(--dark-input-bg);
        border-color: var(--dark-border);
        color: var(--dark-text);
    }
    
    body.dark-mode .table-light {
        background-color: var(--dark-header) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Listen for dark mode changes and update table styling
        document.addEventListener('darkModeToggle', function() {
            const isDarkMode = document.body.classList.contains('dark-mode');
            const table = document.querySelector('.table');
            
            if (isDarkMode) {
                table.classList.add('table-dark');
            } else {
                table.classList.remove('table-dark');
            }
        });
        
        // Initialize table state based on current mode
        if (document.body.classList.contains('dark-mode')) {
            document.querySelector('.table').classList.add('table-dark');
        }
    });
</script>
@endsection