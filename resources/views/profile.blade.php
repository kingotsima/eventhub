@extends('layouts.app')

@section('content')
<style>
    /* Scoped profile styles - won't affect other components */
    .profile-page-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Profile Header */
    .profile-page-container .profile-header {
        background: linear-gradient(135deg, #4299e1, #3182ce);
        color: white;
        border-radius: 12px;
        overflow: hidden;
    }

    .dark .profile-page-container .profile-header {
        background: linear-gradient(135deg, #2b6cb0, #2c5282);
    }

    .profile-page-container .profile-avatar {
        width: 100px;
        height: 100px;
        border: 3px solid rgba(255,255,255,0.2);
        object-fit: cover;
    }

    /* Cards */
    .profile-page-container .profile-card {
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .dark .profile-page-container .profile-card {
        background: #2d3748;
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .profile-page-container .profile-card-header {
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .dark .profile-page-container .profile-card-header {
        border-bottom-color: rgba(255,255,255,0.05);
    }

    .profile-page-container .profile-card-body {
        padding: 1.5rem;
    }

    /* Form Elements - Scoped but keeping original colors */
    .profile-page-container .profile-form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    .dark .profile-page-container .profile-form-label {
        color: #cbd5e0;
    }

    /* IMPORTANT: Keeping original input colors */
    .profile-page-container .profile-card-body .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        /* Original light mode colors */
        background-color: #ffffff;
        border-color: #ced4da;
        color: #495057;
    }

    .dark .profile-page-container .profile-card-body .form-control {
        /* Original dark mode colors */
        background-color: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
    }

    /* Buttons */
    .profile-page-container .btn-update {
        background-color: #4299e1;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .profile-page-container .btn-change-pw {
        background-color: #ed8936;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .profile-page-container .btn-upload {
        background-color: #718096;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .dark .profile-page-container .btn-upload {
        background-color: #4a5568;
    }

    /* Password Toggle */
    .profile-page-container .toggle-password {
        border-top-right-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }

    /* Danger Zone */
    .profile-page-container .danger-zone {
        border-left: 4px solid #e53e3e;
    }

    .dark .profile-page-container .danger-zone {
        border-left-color: #fc8181;
    }

    .profile-page-container .btn-delete {
        background-color: #e53e3e;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-page-container .profile-avatar {
            width: 80px;
            height: 80px;
        }
        
        .profile-page-container .profile-card-body {
            padding: 1rem;
        }
    }
</style>

<div class="container py-5 profile-page-container">
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="mb-4 fw-bold">My Profile</h1>

    {{-- Profile Overview --}}
    <div class="card mb-4 profile-header border-0">
        <div class="card-body d-flex align-items-center">
            @if (auth()->user()->profile_image)
                <img src="{{ Storage::url(auth()->user()->profile_image) }}" class="rounded-circle me-4 profile-avatar">
            @else
                <div class="rounded-circle me-4 profile-avatar d-flex align-items-center justify-content-center bg-white">
                    <i class="bi bi-person-fill fs-1 text-primary"></i>
                </div>
            @endif
            <div>
                <h3 class="mb-1 text-white">{{ auth()->user()->name }}</h3>
                <p class="mb-0 text-white-50">{{ auth()->user()->email }}</p>
                <small class="text-white-50">Member since {{ auth()->user()->created_at->format('M Y') }}</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            {{-- Update Profile Info --}}
            <div class="card profile-card mb-4">
                <div class="profile-card-header">
                    <i class="bi bi-person-lines-fill me-2"></i> Profile Information
                </div>
                <div class="profile-card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="profile-form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="profile-form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>
                        <button class="btn btn-primary btn-update" type="submit">
                            <i class="bi bi-check-circle me-1"></i> Update Profile
                        </button>
                    </form>
                </div>
            </div>

            {{-- Upload Profile Picture --}}
            <div class="card profile-card mb-4">
                <div class="profile-card-header">
                    <i class="bi bi-camera-fill me-2"></i> Profile Photo
                </div>
                <div class="profile-card-body">
                    <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="profile-form-label">Upload New Photo</label>
                            <input type="file" name="profile_image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Max 2MB (JPG, PNG, GIF)</small>
                        </div>
                        <button class="btn btn-secondary btn-upload" type="submit">
                            <i class="bi bi-upload me-1"></i> Upload Photo
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            {{-- Change Password --}}
            <div class="card profile-card mb-4">
                <div class="profile-card-header">
                    <i class="bi bi-shield-lock-fill me-2"></i> Change Password
                </div>
                <div class="profile-card-body">
                    <form action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="profile-form-label">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current-password" class="form-control" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current-password">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="profile-form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new-password" class="form-control" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new-password">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="profile-form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" id="confirm-password" class="form-control" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="confirm-password">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>

                        <button class="btn btn-warning btn-change-pw" type="submit">
                            <i class="bi bi-key-fill me-1"></i> Change Password
                        </button>
                    </form>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card profile-card danger-zone">
                <div class="profile-card-header text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Danger Zone
                </div>
                <div class="profile-card-body">
                    <p class="text-muted mb-3">Once you delete your account, there is no going back. Please be certain.</p>
                    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-delete" type="submit">
                            <i class="bi bi-trash-fill me-1"></i> Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        });
    });
</script>
@endsection