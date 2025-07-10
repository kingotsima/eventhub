@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>Edit Testimonial
                </h2>
                <p class="mb-0 text-muted">Update the testimonial details below</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3" 
                                   value="{{ old('name', $testimonial->name) }}" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Position</label>
                            <input type="text" name="position" class="form-control rounded-3" 
                                   value="{{ old('position', $testimonial->position) }}"
                                   placeholder="E.g. CEO, Company Name">
                            @error('position')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control rounded-3" rows="5" required
                                      placeholder="What did they say about your product/service?">{{ old('message', $testimonial->message) }}</textarea>
                            @error('message')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="h6 mb-3 fw-semibold">
                                    <i class="fas fa-image text-muted me-2"></i>Profile Image
                                </h5>
                                
                                <div class="text-center mb-3">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                             class="rounded-circle shadow-sm mb-3" 
                                             style="width: 150px; height: 150px; object-fit: cover;"
                                             alt="{{ $testimonial->name }}'s photo">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                             style="width: 150px; height: 150px;">
                                            <i class="fas fa-user text-muted fa-3x"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label small">Change Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="form-text small">Max 2MB. JPG, PNG, or GIF.</div>
                                    @error('image')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update Testimonial
                            </button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1.05rem;
    }
    .card {
        border-radius: 0.75rem;
    }
    .form-label {
        font-weight: 500;
    }
    textarea.form-control {
        min-height: 150px;
    }
</style>
@endsection