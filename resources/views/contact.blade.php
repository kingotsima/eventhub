@extends('layouts.app')

@section('content')
<style>
    .contact-card {
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 30px;
        transition: all 0.3s ease;
    }
    
    .dark .contact-card {
        box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        background-color: #2d3748;
    }
    
    .contact-icon {
        font-size: 1.5rem;
        margin-right: 10px;
        transition: color 0.3s ease;
    }
    
    .contact-icon.email {
        color: #007bff;
    }
    
    .dark .contact-icon.email {
        color: #60a5fa;
    }
    
    .contact-icon.phone {
        color: #28a745;
    }
    
    .dark .contact-icon.phone {
        color: #4ade80;
    }
    
    .contact-icon.address {
        color: #6f42c1;
    }
    
    .dark .contact-icon.address {
        color: #a78bfa;
    }
    
    .divider-text {
        color: #6c757d;
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }
    
    .dark .divider-text {
        color: #a0aec0;
    }
    
    .divider-text::before,
    .divider-text::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 45%;
        height: 1px;
        background-color: #dee2e6;
    }
    
    .dark .divider-text::before,
    .dark .divider-text::after {
        background-color: #4a5568;
    }
    
    .divider-text::before {
        left: 0;
    }
    
    .divider-text::after {
        right: 0;
    }
    
    @media (max-width: 768px) {
        .contact-card {
            padding: 20px;
        }
        
        .container.py-5 {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
    }
</style>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="container py-5">
    <h2 class="text-center mb-4">Contact Us</h2>

    <!-- Contact Info Card -->
    <div class="card mb-5 contact-card">
        <div class="card-body">
            <h5 class="card-title">We'd love to hear from you! Reach out using any of the channels below:</h5>
            <ul class="list-unstyled mt-3">
                <li class="mb-2"><i class="bi bi-envelope-fill contact-icon email"></i>Email: EventHub1000@gmail.com</li>
                <li class="mb-2"><i class="bi bi-telephone-fill contact-icon phone"></i>Phone: +234 808 854 7019</li>
            </ul>
        </div>
    </div>

    <div class="divider-text">— or —</div>

    <!-- Feedback Form -->
    <div class="card contact-card">
        <div class="card-body">
            <h5 class="card-title mb-4">Hello {{ Auth::user()->name }}, please send us your feedback</h5>

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Your Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="+234..." required>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection