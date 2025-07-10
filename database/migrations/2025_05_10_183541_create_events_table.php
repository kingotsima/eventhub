<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('category');
            $table->text('description');
            $table->string('venue');
            $table->dateTime('date_time');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('vip_price', 10, 2)->nullable();
            $table->integer('capacity');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('events');
    }
};
