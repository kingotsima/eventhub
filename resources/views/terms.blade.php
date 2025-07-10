@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Terms & Conditions</h1>

    <p class="lead">Welcome to EventHub! Please read these terms carefully before using our platform.</p>

    <h5 class="mt-5 fw-semibold">1. Acceptance of Terms</h5>
    <p>By accessing or using EventHub, you agree to comply with and be bound by these Terms & Conditions. If you do not agree, please do not use our services.</p>

    <h5 class="mt-4 fw-semibold">2. User Responsibilities</h5>
    <ul>
        <li>You must provide accurate and complete registration information.</li>
        <li>You are responsible for keeping your account credentials secure.</li>
        <li>You agree not to misuse the platform or engage in fraudulent activity.</li>
    </ul>

    <h5 class="mt-4 fw-semibold">3. Event Listings and Bookings</h5>
    <ul>
        <li>EventHub connects users to third-party event organizers.</li>
        <li>We are not responsible for changes, cancellations, or the quality of listed events.</li>
        <li>All bookings are final unless the event organizer specifies otherwise.</li>
    </ul>

    <h5 class="mt-4 fw-semibold">4. Payments</h5>
    <p>All payments are processed securely via Paystack. EventHub does not store your card details.</p>

    <h5 class="mt-4 fw-semibold">5. Refund Policy</h5>
    <p>Refunds are subject to the policy of each event organizer. Please contact them directly for refund inquiries.</p>

    <h5 class="mt-4 fw-semibold">6. Intellectual Property</h5>
    <p>All content on EventHub — including logos, designs, and text — is the property of EventHub or its partners and may not be reused without permission.</p>

    <h5 class="mt-4 fw-semibold">7. Termination</h5>
    <p>We reserve the right to suspend or terminate your account if you violate any of these terms.</p>

    <h5 class="mt-4 fw-semibold">8. Changes to Terms</h5>
    <p>We may update these Terms & Conditions at any time. Continued use of the platform indicates acceptance of any changes.</p>

    <h5 class="mt-4 fw-semibold">9. Contact</h5>
    <p>If you have any questions about these terms, please <a href="{{ route('contact') }}">contact us</a>.</p>

    <hr class="my-5">
    <p class="text-muted">Last updated: {{ now()->format('F d, Y') }}</p>
</div>
@endsection
