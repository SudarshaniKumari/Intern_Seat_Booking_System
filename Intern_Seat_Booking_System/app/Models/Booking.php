<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'seat_no', 'booking_date' ,'is_present'];


    
    public function user()
    {
        return $this->belongsTo(User::class, 'training_id', 'training_id');
    }



    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
   
}
