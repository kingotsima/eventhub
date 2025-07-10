<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class MarkAbsentBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-absent-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Booking::where('attendance_status', 'pending')
            ->whereHas('event', function ($query) {
                $query->where('end_date', '<', now());
            })
            ->update(['attendance_status' => 'absent']);

        $this->info('Marked all unchecked-in bookings as absent.');
    }

}
