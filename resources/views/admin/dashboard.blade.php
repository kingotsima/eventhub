@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Dashboard Overview</h2>
        <div class="text-muted">
            <i class="bi bi-calendar me-1"></i>
            {{ now()->format('M j, Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <!-- Users Card -->
        <div class="col-md-3 mb-4">
            <div class="card border-start border-primary border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Users</h6>
                            <h3 class="mb-0">{{ $userCount + $adminCount }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Card -->
        <div class="col-md-3 mb-4">
            <div class="card border-start border-success border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Events</h6>
                            <h3 class="mb-0">{{ $eventCount }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-calendar-event text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="col-md-3 mb-4">
            <div class="card border-start border-info border-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Bookings</h6>
                            <h3 class="mb-0">{{ $bookingCount }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-ticket-perforated text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0">User Types</h6>
                </div>
                <div class="card-body d-flex flex-column">
                    <canvas id="usersChart" class="w-100"></canvas>
                    <div class="mt-3 text-center small">
                        <span class="me-2">
                            <i class="bi bi-circle-fill text-primary me-1"></i>Admins
                        </span>
                        <span>
                            <i class="bi bi-circle-fill text-success me-1"></i>Users
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Events</h6>
                </div>
                <div class="card-body">
                    <canvas id="eventsChart" class="w-100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Bookings</h6>
                </div>
                <div class="card-body">
                    <canvas id="bookingsChart" class="w-100"></canvas>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.checkin.form') }}" class="btn btn-success">Check-In Attendees</a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Chart
    const usersCtx = document.getElementById('usersChart').getContext('2d');
    const usersChart = new Chart(usersCtx, {
        type: 'doughnut',
        data: {
            labels: ['Admins', 'Regular Users'],
            datasets: [{
                data: [{{ $adminCount }}, {{ $userCount }}],
                backgroundColor: ['#4e73df', '#1cc88a'],
                borderWidth: 0,
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Events Chart
    const eventsCtx = document.getElementById('eventsChart').getContext('2d');
    const eventsChart = new Chart(eventsCtx, {
        type: 'bar',
        data: {
            labels: ['Events'],
            datasets: [{
                label: 'Total',
                data: [{{ $eventCount }}],
                backgroundColor: ['#f6c23e'],
                borderWidth: 0,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Bookings Chart
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: ['Bookings'],
            datasets: [{
                label: 'Total',
                data: [{{ $bookingCount }}],
                backgroundColor: ['#e74a3b'],
                borderWidth: 0,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection