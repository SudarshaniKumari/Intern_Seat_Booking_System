<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailCode;
use App\Models\UserEmailCode;
use Exception;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasApiTokens, HasFactory, Notifiable, SoftDeletes ;

    // Other existing methods and properties

    protected $fillable = [
        'first_name',
        'last_name',
        'training_id',
        'dep_no',       // Add dep_no
        'dep_name',     // Add dep_name
        'phone_number',
        'email',
        'password',
        'last_active',
        'facebook_id',
        'google_id',
        'university_name',
    ];


    // Attributes to be hidden
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes to native types
    protected $casts = [
        'email_verified_at' => 'datetime', // <-- To handle email verification
    ];


    public function generateCode()
    {
        $code = rand(1000, 9999);

        // Store the code in the database, associated with the user
        UserEmailCode::updateOrCreate(
            ['user_id' => $this->id],
            ['code' => $code, 'created_at' => now()]
        );

        try {
            // Log the code and user email
            info("Generated code: " . $code);
            info("User email: " . $this->email);

            // Check if user email is set
            if (!$this->email) {
                throw new Exception('User email is not set.');
            }

            // Prepare the details for the email
            $details = [
                'title' => 'Your Authentication Code',
                'code' => $code
            ];

            // Log the email details
            info("Email details: " . json_encode($details));

            // Send the email with the generated code
            Mail::to($this->email)->send(new SendEmailCode($details));
        } catch (Exception $e) {
            // Log the error message
            info("Error sending email: " . $e->getMessage());
        }
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'training_id', 'training_id');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_no', 'dep_no');
    }


    public function isAdmin()
{
    return $this->is_admin;
}
}
