<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;


    public $trainingId;
    public $bookingDate;
    public $seatNo;
    


    public function __construct($trainingId, $bookingDate, $seatNo)
    {
        $this->trainingId = $trainingId;
        $this->bookingDate = $bookingDate;
        $this->seatNo = $seatNo;
    }


    

    public function build()
    {
        return $this->subject('Seat Booking Confirmation')
            ->view('emails.booking-confirmation')
            ->with([
                'trainingId' => $this->trainingId,
                'bookingDate' => $this->bookingDate,
                'seatNo' => $this->seatNo,
            ]);
    }

}
