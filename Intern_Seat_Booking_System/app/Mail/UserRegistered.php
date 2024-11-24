<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $registrationDate;
    public $trainingId;
    public $universityName;

    public function __construct($user, $registrationDate)
    {
        $this->user = $user;
        $this->registrationDate = $registrationDate;
        $this->trainingId = $user->training_id;  // Add training_id
        $this->universityName = $user->university_name;  // Add university_name
    }

    public function build()
    {
        return $this->subject('Welcome to the Intern Seat Booking System!')
                    ->view('emails.user_registered')
                    ->with([
                        'user' => $this->user,
                        'registrationDate' => $this->registrationDate,
                        'trainingId' => $this->trainingId, // Pass training_id to the view
                        'universityName' => $this->universityName, // Pass university_name to the view
                    ]);
    }
}
