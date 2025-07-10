<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');

            $table->enum('ticket_type', ['regular', 'vip', 'vvip']);
            $table->integer('quantity')->default(1); // Always 1 per ticket
            $table->decimal('total_price', 10, 2);

            $table->string('payment_reference'); // No longer unique
            $table->string('booking_code')->unique(); // Unique ticket code

            $table->string('status')->default('pending'); // pending, paid, failed
            $table->string('attendance_status')->nullable(); // attended, absent, null

            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
