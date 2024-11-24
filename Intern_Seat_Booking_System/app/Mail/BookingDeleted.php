<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingDeleted extends Mailable
{
    use Queueable, SerializesModels;


    public $booking;


     public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Booking Cancellation Notification')
                    ->view('emails.booking_deleted')
                    ->with([
                        'id' => $this->booking->id,
                        'trainingId' => $this->booking->training_id,
                        'seat_no' => $this->booking->seat_no,
                        'booking_date' => $this->booking->booking_date,
                    ]);
    }

   
}
