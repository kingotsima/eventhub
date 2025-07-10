@component('mail::message')
# Booking Confirmed 🎉

Hi {{ $booking->user->name }},

Thank you for booking a ticket to **{{ $booking->event->title }}**.

**Details:**
- Booking Code: {{ $booking->booking_code }}
- Ticket Type: {{ ucfirst($booking->ticket_type) }}
- Event Date: {{ \Carbon\Carbon::parse($booking->event->date)->toFormattedDateString() }}

Your ticket is attached as a PDF with a QR code.

@component('mail::button', ['url' => route('bookings.index')])
View My Bookings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
