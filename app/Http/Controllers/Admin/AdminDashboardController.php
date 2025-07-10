<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;

class AdminDashboardController extends Controller
{
    public function index()
{
    $adminCount = User::where('is_admin', true)->count();
    $userCount = User::where('is_admin', false)->count();
    $eventCount = Event::count();
    $bookingCount = Booking::count();

    return view('admin.dashboard', compact('adminCount', 'userCount', 'eventCount', 'bookingCount'));
}
}
