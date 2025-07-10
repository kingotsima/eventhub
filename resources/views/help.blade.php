@extends('layouts.app')

@section('content')
<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<style>
    /* Base Styles */
    .faq-section {
        padding: 5rem 0;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Title */
    .faq-title {
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #1a365d;
        position: relative;
        text-align: center;
    }

    .dark .faq-title {
        color: #ebf8ff;
    }

    .faq-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #4299e1;
        margin: 1rem auto 0;
        border-radius: 2px;
    }

    .dark .faq-title::after {
        background: #63b3ed;
    }

    /* Accordion */
    .accordion {
        --bs-accordion-border-color: rgba(0, 0, 0, 0.08);
        --bs-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgba(66, 153, 225, 0.25);
    }

    .dark .accordion {
        --bs-accordion-bg: #2d3748;
        --bs-accordion-border-color: rgba(255, 255, 255, 0.08);
        --bs-accordion-color: #f7fafc;
        --bs-accordion-btn-color: #f7fafc;
        --bs-accordion-btn-bg: #2d3748;
        --bs-accordion-active-color: #f7fafc;
        --bs-accordion-active-bg: rgba(66, 153, 225, 0.2);
        --bs-accordion-body-padding-x: 1.5rem;
    }

    .accordion-button {
        font-weight: 600;
        padding: 1.25rem 1.5rem;
        border-radius: 8px !important;
        transition: all 0.2s ease;
    }

    .accordion-button:not(.collapsed) {
        background-color: #ebf5ff;
        color: #3182ce;
    }

    .dark .accordion-button:not(.collapsed) {
        background-color: rgba(66, 153, 225, 0.2);
        color: #90cdf4;
    }

    .accordion-body {
        padding: 1.25rem 1.5rem;
        color: #4a5568;
    }

    .dark .accordion-body {
        color: #cbd5e0;
    }

    .accordion-item {
        border-radius: 8px !important;
        overflow: hidden;
        margin-bottom: 1rem;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .dark .accordion-item {
        border-color: rgba(255, 255, 255, 0.08);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .faq-section {
            padding: 3rem 1rem;
        }
        
        .faq-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        
        .accordion-button {
            padding: 1rem;
            font-size: 1rem;
        }
    }
</style>

<div class="container faq-section">
    <h1 class="faq-title" data-aos="fade-up">Help Center</h1>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    <i class="bi bi-calendar-check me-3"></i> How do I book an event?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <p>Browse our events page to find what interests you. Click "View Details" on any event, then select "Book Now" to begin the reservation process. You'll need to:</p>
                    <ol>
                        <li>Select your preferred date and time</li>
                        <li>Choose the number of tickets</li>
                        <li>Complete the payment process</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    <i class="bi bi-ticket-perforated me-3"></i> How do I download my ticket?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    <p>Your tickets are available immediately after successful payment:</p>
                    <ul>
                        <li>Go to "My Bookings" in your account dashboard</li>
                        <li>Locate the specific event booking</li>
                        <li>Click "Download Ticket" to get a PDF version</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    <i class="bi bi-arrow-counterclockwise me-3"></i> Can I get a refund if I can't attend?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                <div class="accordion-body">
                <p>Our refund policy varies depending on the event type:</p>
                    <ul>
                        <li><strong>Standard Events:</strong> Full refund if cancellation is made at least <strong>48 hours before</strong> the event start time.</li>
                        <li><strong>Special or Premium Events:</strong> Refund policies may vary. Please check the specific event's terms before booking.</li>
                        <li><strong>No-Shows:</strong> Tickets are typically <strong>non-refundable</strong> if you do not attend the event.</li>
                        <li><strong>Event Cancellations:</strong> In the rare case that an event is canceled by the organizer, you will receive a full refund automatically.</li>
                    </ul>
                <p class="mt-2">If you believe you are eligible for a refund, please <a href="{{ route('contact') }}">contact our support team</a> with your booking reference.</p>
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="250">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    <i class="bi bi-envelope me-3"></i> I didn't receive a confirmation email
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                <div class="accordion-body">
                    <p>If your confirmation email isn't visible:</p>
                    <ol>
                        <li>Check your spam/junk folder</li>
                        <li>Verify the email address in your account</li>
                        <li>Wait 15 minutes (delays can occur during peak times)</li>
                        <li>Visit "My Bookings" - if the event appears, your booking is confirmed</li>
                        <li>Still missing? <a href="{{ route('contact') }}">Contact support</a> with your payment details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                    <i class="bi bi-credit-card me-3"></i> How do I know if my payment was successful?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                <div class="accordion-body">
                    <p>Payment confirmation indicators:</p>
                    <div class="d-flex">
                        <div class="me-4">
                            <h6 class="fw-bold">Immediate Signs</h6>
                            <ul>
                                <li>Confirmation page appears</li>
                                <li>Receipt email arrives</li>
                                <li>Email notification</li>
                            </ul>
                        </div>
                        <div>
                            <h6 class="fw-bold">Later Verification</h6>
                            <ul>
                                <li>Event appears in "My Bookings"</li>
                                <li>Bank/Payment app shows completed transaction</li>
                                <li>Ticket download available</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="350">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                    <i class="bi bi-headset me-3"></i> How can I contact customer support?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                <div class="accordion-body">
                    <p>We offer multiple support channels:</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <h6 class="fw-bold"><i class="bi bi-envelope me-2"></i> Email</h6>
                                <p class="mb-0">EventHub1000@gmail.com<br>Response time: 24 hours</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <h6 class="fw-bold"><i class="bi bi-telephone me-2"></i> Phone</h6>
                                <p class="mb-0">+234 808 854 7019<br>Mon-Fri, 9am-5pm WAT</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-chat-left-text me-2"></i> Use Contact Form
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 600,
            easing: 'ease-out-quad',
            once: true
        });
    });
</script>
@endsection