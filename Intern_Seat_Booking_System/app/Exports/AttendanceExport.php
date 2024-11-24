<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class AttendanceExport implements FromCollection
{
    use Exportable;

    protected $date;

    public function __construct($date)
    {
        $this->date = $date; // Assign the date to the class property
    }

    public function collection(): \Illuminate\Support\Collection
    {
        return DB::table('bookings')
            ->join('users', 'bookings.training_id', '=', 'users.training_id')
            ->where('bookings.booking_date', $this->date)
            ->select('bookings.*', 'users.first_name', 'users.last_name', 'users.email', 'bookings.seat_no', 'bookings.is_present')
            ->get();
    }
}
