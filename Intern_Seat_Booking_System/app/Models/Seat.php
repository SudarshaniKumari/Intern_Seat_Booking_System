<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_no',
        'is_booked',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'seat_no', 'seat_no'); // Match bookings by seat_no
    }
}
