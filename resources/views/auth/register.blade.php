@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="h3 font-weight-bold">Create Your Account</h2>
                        <p class="text-muted">Join our community in just a few steps</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="name" id="name" class="form-control" 
                                       placeholder="Enter your full name" required autofocus value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" class="form-control" 
                                       placeholder="Enter your email" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="register-password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" id="register-password" 
                                       class="form-control" placeholder="Create a password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" 
                                        data-toggle="register-password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>

                        <div class="mb-4">
                            <label for="register-password-confirm" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="register-password-confirm" 
                                       class="form-control" placeholder="Confirm your password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" 
                                        data-toggle="register-password-confirm">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="profile_image" class="form-label">Profile Picture (Optional)</label>
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-none" id="image-preview-container">
                                    <img src="" alt="Preview" id="image-preview" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" name="profile_image" id="profile_image" 
                                           class="form-control" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                            <small class="text-muted">JPG, PNG or GIF (Max 2MB)</small>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="{{ url('/terms') }}" target="_blank">Terms and Conditions</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            <i class="fas fa-user-plus me-2"></i> Create Account
                        </button>

                        <div class="text-center mt-4">
                            <p class="text-muted">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none">Sign in here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const previewContainer = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endsection