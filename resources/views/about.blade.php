@extends('layouts.app')

@section('content')
<div class="about-page">
    <!-- Hero Section -->
    <section class="video-hero position-relative">
        <video autoplay muted loop class="position-absolute w-100 h-100 object-fit-cover">
            <source src="{{ asset('videos/event-intro.mp4') }}" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="video-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
            <div class="text-center px-3" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3 text-white">EventHub</h1>
                <p class="lead text-white mb-4">Your Gateway to Unforgettable Events</p>
                <a href="#about-content" class="btn btn-outline-light btn-lg">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5" id="about-content">
        <!-- Who We Are Section -->
        <section class="row align-items-center mb-5 py-4">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="/images/about-events.jpg" alt="Event planning" class="img-fluid rounded-3 shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <h2 class="fw-bold mb-4">Who We Are</h2>
                <p class="lead mb-4">EventHub is Nigeria’s trusted platform for discovering, booking, and managing events — all in one place.</p>
                <p>From concerts and conferences to weddings, festivals, and community gatherings, we connect people with experiences that matter. Whether you're attending or organizing, EventHub makes it easy, seamless, and memorable.</p>
                <p>With a focus on simplicity and reliability, we help bridge the gap between organizers and attendees, creating exciting moments across Nigeria every day.</p>
            </div>

        </section>

        <!-- Features Section -->
        <section class="py-5 my-4">
            <h2 class="text-center fw-bold mb-5">Why Choose EventHub?</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="about-icon text-center text-primary mb-3">
                            <i class="bi bi-calendar-event fs-1"></i>
                        </div>
                        <h4 class="text-center mb-3">Event Discovery</h4>
                        <p class="text-center mb-0">Browse through upcoming and past events in Abuja with ease, tailored to your interests and lifestyle.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="about-icon text-center text-primary mb-3">
                            <i class="bi bi-ticket-perforated fs-1"></i>
                        </div>
                        <h4 class="text-center mb-3">Easy Booking</h4>
                        <p class="text-center mb-0">Secure your spot with just a few clicks. Get digital tickets and QR codes instantly for hassle-free entry.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 h-100 shadow-sm p-4">
                        <div class="about-icon text-center text-primary mb-3">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>
                        <h4 class="text-center mb-3">Organize Events</h4>
                        <p class="text-center mb-0">Whether you're hosting a show, seminar, or celebration — EventHub provides the tools to manage it all.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section - Now with proper dark mode support -->
        <section class="text-center py-5 my-4 cta-section rounded-3" data-aos="zoom-in">
            <h3 class="fw-bold mb-3 cta-title">Join Our Growing Community</h3>
            <p class="lead mb-4 cta-text">Discover, connect, and celebrate with Abuja's finest event platform.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg px-4 cta-button">Browse Events</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4 cta-outline-button">Sign Up Free</a>
                @endguest
            </div>
        </section>
    </div>
</div>
@endsection

@push('styles')
<style>
    .about-page {
        --section-spacing: 5rem;
    }
    
    .video-hero {
        height: 70vh;
        min-height: 500px;
        overflow: hidden;
    }
    
    .video-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
    }
    
    .about-icon i {
        transition: transform 0.3s ease;
    }
    
    .card:hover .about-icon i {
        transform: scale(1.1);
    }

    /* CTA Section Styles */
    .cta-section {
        background-color: #f8f9fa; /* Light mode background */
        border: 1px solid #dee2e6; /* Light mode border */
        transition: all 0.3s ease;
    }

    .cta-title, .cta-text {
        color: #212529; /* Light mode text color */
    }

    /* Dark mode styles */
    body.dark-mode .cta-section {
        background-color: #212529;
        border-color: #495057;
    }

    body.dark-mode .cta-title,
    body.dark-mode .cta-text {
        color: #f8f9fa;
    }

    /* Button adjustments for dark mode */
    body.dark-mode .cta-outline-button {
        color: #f8f9fa;
        border-color: #f8f9fa;
    }

    body.dark-mode .cta-outline-button:hover {
        background-color: rgba(248, 249, 250, 0.1);
    }
    
    @media (max-width: 768px) {
        .video-hero {
            height: 60vh;
            min-height: 400px;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Listen for dark mode toggle if you have one
        const darkModeToggle = document.querySelector('.dark-mode-toggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                // You might want to save this preference to localStorage
            });
        }
    });
</script>
@endpush