@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0 fw-bold">
                <i class="fas fa-quote-left me-2 text-primary"></i>Testimonials Management
            </h2>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Testimonial
            </a>
        </div>

        <div class="card-body">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Testimonials Table -->
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="100" class="text-center">Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Message</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr class="align-middle">
                                <td class="text-center">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                             class="rounded-circle object-fit-cover" 
                                             width="60" 
                                             height="60"
                                             alt="{{ $testimonial->name }}">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $testimonial->name }}</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $testimonial->position }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-inline-block text-truncate" style="max-width: 300px;">
                                        {{ $testimonial->message }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-circle"
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger rounded-circle"
                                                    data-bs-toggle="tooltip" 
                                                    title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-quote-right mb-3" style="font-size: 2rem;"></i>
                                        <h5>No testimonials found</h5>
                                        <p class="mb-4">Add your first testimonial to showcase customer feedback</p>
                                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Create Testimonial
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($testimonials->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="small">
                    Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} entries
                </div>
                <div>
                    {{ $testimonials->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection

<style>
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 0.75rem 1rem;
    }
    .table td {
        padding: 1rem;
        vertical-align: middle;
    }
    .rounded-circle {
        object-fit: cover;
    }
    .btn-outline-primary, .btn-outline-danger {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Dark mode styles */
    body.dark-mode .card {
        background-color: var(--dark-card);
    }
    
    body.dark-mode .card-header {
        background-color: var(--dark-header) !important;
        border-bottom: 1px solid var(--dark-border) !important;
        color: var(--dark-text) !important;
    }
    
    body.dark-mode .table {
        color: var(--dark-text);
    }
    
    body.dark-mode .table th,
    body.dark-mode .table td {
        border-color: var(--dark-border);
    }
    
    body.dark-mode .table-hover tbody tr:hover {
        background-color: rgba(15, 52, 96, 0.7);
    }
    
    body.dark-mode .alert-success {
        background-color: #1a3a1a;
        border-color: #2d4d2d;
        color: #c8e6c9;
    }
    
    body.dark-mode .bg-light {
        background-color: var(--dark-header) !important;
    }
    
    body.dark-mode .fas.fa-user {
        color: var(--dark-text);
    }
    
    body.dark-mode .badge {
        background-color: rgba(78, 115, 223, 0.2) !important;
        color: var(--primary-color) !important;
    }
    
    body.dark-mode .border {
        border-color: var(--dark-border) !important;
    }
</style>
@endsection