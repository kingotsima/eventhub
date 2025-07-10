<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_type',
        'quantity',
        'total_price',
        'payment_reference',
        'booking_code', // ✅ Add this
        'status',
        'failure_reason', // (optional: if you're saving this)
        'attendance_status', // (optional: for check-in)
    ];

    public function event()
    {
        return $this->belongsTo(Event::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
