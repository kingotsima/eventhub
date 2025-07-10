<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->generate($this->booking->payment_reference));

        $pdf = Pdf::loadView('bookings.ticket-pdf', [
            'booking' => $this->booking,
            'qrCodeSvg' => $qrCode
        ])->output();

        return $this->subject('Your Event Ticket Confirmation')
            ->markdown('emails.booking_confirmation')
            ->with(['booking' => $this->booking])
            ->attachData($pdf, 'ticket.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
