<?php

use App\Models\Event;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// ==============================
// Homepage (with countdown)
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==============================
// Static Pages
// ==============================
Route::view('/about', 'about')->name('about');
Route::view('/help', 'help')->name('help');
Route::view('/terms', 'terms')->name('terms');


// ==============================
// Contact Page (Authenticated Users Only)
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/contact', fn() => view('contact'))->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

// ==============================
// Events (Public)
// ==============================
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// ==============================
// Authentication (Guests Only)
// ==============================
Route::middleware('guest')->group(function () {
    // Login / Register
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password via OTP
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOTP'])->name('password.sendOtp');

    Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyOTPForm'])->name('password.verify');
    Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOTP'])->name('password.update');
});

// ==============================
// Logout
// ==============================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==============================
// Authenticated User Routes
// ==============================
// ==============================
// Authenticated User Routes
// ==============================
Route::middleware('auth')->group(function () {
    // Bookings
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/verify-payment', [BookingController::class, 'verify'])->name('bookings.verify');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/download', [BookingController::class, 'downloadTicket'])->name('bookings.download');
    Route::post('/bookings/{booking}/retry', [BookingController::class, 'retry'])->name('bookings.retry');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    

    
});


// ==============================
// Admin Routes (Auth + is_admin)
// ==============================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Event Management
    Route::resource('events', AdminEventController::class);

    // Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');

    // Testimonial Management
    Route::resource('testimonials', TestimonialController::class);

    // ✅ Check-In Routes
    Route::get('/checkin', function () {
        return view('admin.checkin');
    })->name('checkin.form');

    Route::post('/checkin', [BookingController::class, 'handleCheckIn'])->name('checkin');
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
    Route::post('/users/{user}/enable', [UserController::class, 'enable'])->name('users.enable');

});



//Suspended Users
Route::middleware(['auth', 'check.suspended'])->group(function () {
    // Bookings
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/verify-payment', [BookingController::class, 'verify'])->name('bookings.verify');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/download', [BookingController::class, 'downloadTicket'])->name('bookings.download');
    Route::post('/bookings/{booking}/retry', [BookingController::class, 'retry'])->name('bookings.retry');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    // Contact
    Route::get('/contact', fn() => view('contact'))->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});
