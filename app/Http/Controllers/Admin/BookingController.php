<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::where('status', 'paid')->with('event', 'user');

        // Filter by user name search
        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by event id
        if ($eventId = $request->input('event_id')) {
            $query->where('event_id', $eventId);
        }

        $bookings = $query->latest()->paginate(15);
        $events = Event::orderBy('title')->get();

        return view('admin.bookings.index', compact('bookings', 'events'));
    }

    public function export(Request $request)
    {
        $query = Booking::where('status', 'paid')->with('event', 'user');

        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($eventId = $request->input('event_id')) {
            $query->where('event_id', $eventId);
        }

        $bookings = $query->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="bookings_export.csv"',
        ];

        $columns = ['#', 'User Name', 'Event Title', 'Quantity', 'Payment Reference', 'Booked At'];

        $callback = function () use ($bookings, $columns) {
            $file = fopen('php://output', 'w');
            // Add BOM to fix UTF-8 in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header row
            fputcsv($file, $columns);

            foreach ($bookings as $index => $booking) {
                fputcsv($file, [
                    $index + 1,
                    $booking->user->name ?? 'N/A',
                    $booking->event->title ?? 'N/A',
                    $booking->quantity,
                    $booking->payment_reference,
                    $booking->created_at->format('d M Y, h:i A'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
