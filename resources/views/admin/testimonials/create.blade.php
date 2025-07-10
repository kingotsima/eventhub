@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white border-bottom-0 py-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h4 mb-0">
                            <i class="fas fa-plus-circle text-primary me-2"></i>Create New Testimonial
                        </h2>
                        <p class="mb-0 text-muted small">Add a new customer testimonial to showcase on your website</p>
                    </div>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-lg rounded-3" 
                                           value="{{ old('name') }}" required
                                           placeholder="Customer's full name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Position</label>
                                    <input type="text" name="position" class="form-control rounded-3" 
                                           value="{{ old('position') }}"
                                           placeholder="E.g. CEO, Company Name">
                                    @error('position')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control rounded-3" rows="6" required
                                              placeholder="What did they say about your product/service?">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
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
                                            <div class="image-preview-container">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                                     style="width: 150px; height: 150px;">
                                                    <i class="fas fa-user text-muted fa-3x preview-icon"></i>
                                                    <img id="imagePreview" src="#" alt="Image preview" 
                                                         class="rounded-circle shadow-sm preview-image" 
                                                         style="display: none; width: 150px; height: 150px; object-fit: cover;">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label small">Upload Image (Optional)</label>
                                                <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*">
                                                <div class="form-text small">Max 2MB. JPG, PNG, or GIF.</div>
                                                @error('image')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Create Testimonial
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
    </div>
</div>

@section('scripts')
<script>
    // Image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageUpload = document.getElementById('imageUpload');
        const imagePreview = document.getElementById('imagePreview');
        const previewIcon = document.querySelector('.preview-icon');
        
        if (imageUpload) {
            imageUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        previewIcon.style.display = 'none';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endsection

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
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .was-validated .form-control:invalid ~ .invalid-feedback {
        display: block;
    }
    .preview-image {
        transition: opacity 0.3s ease;
    }
</style>
@endsection