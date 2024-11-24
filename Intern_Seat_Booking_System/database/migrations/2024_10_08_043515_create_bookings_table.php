<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('training_id');
            $table->foreign('training_id')->references('training_id')->on('users')->onDelete('cascade');
            
            // Seat identifier
            $table->string('seat_no');
            
            // Date of booking
            $table->date('booking_date');
            
            $table->boolean('is_present')->default(false); 
            
            $table->timestamps();
            
            // Ensure a user cannot book the same seat on the same date more than once
            $table->unique(['training_id', 'seat_no', 'booking_date']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
