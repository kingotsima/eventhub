<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Notifications\BookingConfirmedNotification;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'failed'])
            ->with('event');

        if ($eventId = $request->input('event_id')) {
            $query->where('event_id', $eventId);
        }

        $bookings = $query->latest()->paginate(10);

        // Get all events this user has booked
        $userEventIds = Booking::where('user_id', auth()->id())
            ->pluck('event_id')->unique()->toArray();
        $events = Event::whereIn('id', $userEventIds)->get();

        return view('bookings.index', compact('bookings', 'events'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type' => 'required|in:regular,vip,vvip',
            'quantity' => 'required|integer|min:1',
        ]);

        $price = match ($request->ticket_type) {
            'vvip' => $event->vvip_price,
            'vip' => $event->vip_price,
            default => $event->regular_price,
        };

        $totalAmount = $price * $request->quantity;
        $paymentReference = Str::uuid(); // base reference for all tickets

        $placeholder = Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_type' => $request->ticket_type,
            'quantity' => $request->quantity,
            'total_price' => $totalAmount,
            'payment_reference' => $paymentReference,
            'booking_code' => 'PLACEHOLDER',
            'status' => 'pending',
        ]);

        try {
            $response = Http::withToken(config('services.paystack.secret_key'))
                ->timeout(10)
                ->post('https://api.paystack.co/transaction/initialize', [
                    'email' => Auth::user()->email,
                    'amount' => $totalAmount * 100,
                    'reference' => $paymentReference,
                    'callback_url' => route('bookings.verify'),
                ])
                ->throw();

            $paystackData = $response->json();

            if (!$paystackData['status']) {
                return back()->with('error', 'Payment initialization failed. Please try again.');
            }

            return redirect($paystackData['data']['authorization_url']);
        } catch (\Exception $e) {
            Log::error('Paystack Init Error: ' . $e->getMessage());

            $placeholder->update([
                'status' => 'failed',
                'failure_reason' => 'Network or Paystack error: ' . $e->getMessage(),
            ]);

            $placeholder->delete();

            return back()->with('error', 'Please connect to the internet and try again.');
        }
    }

    public function verify(Request $request)
    {
        $reference = $request->query('reference');

        $response = Http::withToken(config('services.paystack.secret_key'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        $data = $response->json();

        $original = Booking::where('payment_reference', $reference)->firstOrFail();

        if (!$data['status']) {
            $original->update(['status' => 'failed', 'failure_reason' => 'Paystack verification failed.']);
            $original->delete();
            return redirect('/')->with('error', 'Payment verification failed.');
        }

        if ($data['data']['status'] === 'success') {
            $quantity = $original->quantity;
            $unitPrice = $original->total_price / $quantity;
            $user = $original->user;
            $event = $original->event;

            $bookingIds = [];

            for ($i = 1; $i <= $quantity; $i++) {
                do {
                    $bookingCode = 'EVT-' . rand(1000, 9999) . strtoupper(Str::random(4));
                } while (Booking::where('booking_code', $bookingCode)->exists());

                $newBooking = Booking::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'ticket_type' => $original->ticket_type,
                    'quantity' => 1,
                    'total_price' => $unitPrice,
                    'payment_reference' => $original->payment_reference . '-' . $i,
                    'booking_code' => $bookingCode,
                    'status' => 'paid',
                ]);

                $bookingIds[] = $newBooking->id;
            }

            $original->delete();

            // ✅ Send one summary notification
            $user->notify(new BookingConfirmedNotification(
                "You successfully booked {$quantity} " . strtoupper($original->ticket_type) . " ticket(s) for \"{$event->title}\".",
                route('bookings.index')
            ));

            // Send confirmation email (only first booking as example)
            $firstBooking = Booking::find($bookingIds[0]);
            Mail::to($user->email)->send(new BookingConfirmationMail($firstBooking));


            return redirect()->route('bookings.index')->with('success', 'Payment successful. Tickets generated!');
        }

        $original->update([
            'status' => 'failed',
            'failure_reason' => $data['data']['gateway_response'] ?? 'Unknown',
        ]);

        return redirect('/')->with('error', 'Payment failed or was cancelled.');
    }

    public function retry(Request $request, Booking $booking)
    {
        if ($booking->status !== 'failed' || $booking->user_id !== Auth::id()) {
            abort(403);
        }

        $newReference = Str::uuid();
        $booking->update([
            'payment_reference' => $newReference,
            'status' => 'pending',
            'failure_reason' => null,
        ]);

        $response = Http::withToken(config('services.paystack.secret_key'))
            ->post('https://api.paystack.co/transaction/initialize', [
                'email' => Auth::user()->email,
                'amount' => $booking->total_price * 100,
                'reference' => $newReference,
                'callback_url' => route('bookings.verify'),
            ]);

        $data = $response->json();

        if (!$data['status']) {
            return back()->with('error', 'Retry failed: Unable to initialize payment.');
        }

        return redirect($data['data']['authorization_url']);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function downloadTicket($bookingId)
    {
        $booking = Booking::with('event')->findOrFail($bookingId);

        $qrCodeSvg = base64_encode(QrCode::format('svg')->size(200)->generate($booking->payment_reference));

        return Pdf::loadView('bookings.ticket-pdf', [
            'booking' => $booking,
            'qrCodeSvg' => $qrCodeSvg,
        ])->stream('ticket.pdf');
    }

    public function handleCheckIn(Request $request)
    {
        $booking = Booking::where('booking_code', $request->booking_code)->first();

        if (!$booking) {
            return back()->with('error', 'Invalid booking code.');
        }

        $booking->attendance_status = 'attended';
        $booking->save();

        return back()->with('success', 'Attendee checked in successfully.');
    }
}
