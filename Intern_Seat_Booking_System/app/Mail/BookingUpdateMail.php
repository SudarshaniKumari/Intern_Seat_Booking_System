<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }


    public function build()
    {
        return $this->subject('Booking Updated Successfully')
            ->view('emails.booking_update')
            ->with([
                'bookingId' => $this->booking->id,
                'trainingId' => $this->booking->training_id,
                'seatNo' => $this->booking->seat_no,
                'bookingDate' => $this->booking->booking_date,
            ]);
    }
   
}
