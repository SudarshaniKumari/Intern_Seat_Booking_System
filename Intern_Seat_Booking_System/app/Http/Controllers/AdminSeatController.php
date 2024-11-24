<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;


class AdminSeatController extends Controller
{

    public function index(Request $request)
    {
        // Get current page for booked and available seats pagination
        $bookedPage = $request->input('booked_page', 1); 
        $availablePage = $request->input('available_page', 1); 
    
        // Get the search query
        $search = $request->input('search');
    
        // Modify queries to include search
        $bookedSeatsQuery = Seat::where('is_booked', true);
        $availableSeatsQuery = Seat::where('is_booked', false);
    
        if ($search) {
            // Apply search to both queries
            $bookedSeatsQuery->where('seat_no', 'like', '%' . $search . '%');
            $availableSeatsQuery->where('seat_no', 'like', '%' . $search . '%');
        }
    
        // Paginate results for booked and available seats
        $bookedSeats = $bookedSeatsQuery->paginate(5, ['*'], 'booked_page', $bookedPage);
        $availableSeats = $availableSeatsQuery->paginate(5, ['*'], 'available_page', $availablePage);
    
        return view('admin.seats.index', compact('bookedSeats', 'availableSeats'));
    }
    
    // Function to get booked seats
    private function getBookedSeats()
    {
        return Seat::where('is_booked', true)->paginate(10); // Adjust the pagination as needed
    }
    
    // Function to get available seats
    private function getAvailableSeats()
    {
        return Seat::where('is_booked', false)->paginate(10); // Adjust the pagination as needed
    }
    
    
    public function create()
    {
        return view('admin.seats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seat_count' => 'required|integer|min:1|max:50',
        ]);
    
        $seatCount = $request->input('seat_count');
        $existingSeats = Seat::pluck('seat_no')->toArray(); // Get existing seat numbers
    
        $seatsAdded = [];
        $currentMax = count($existingSeats); // Current count of existing seats
    
        for ($i = 1; $i <= $seatCount; $i++) {
            $seatNumber = sprintf('S-%03d', $currentMax + $i); // Generate seat number
    
            // Check if the seat number already exists
            if (in_array($seatNumber, $existingSeats)) {
                return redirect()->route('admin.seats.create')->withErrors(['seat_no' => "$seatNumber already exists."]);
            }
    
            Seat::create([
                'seat_no' => $seatNumber,
                'is_booked' => false,
            ]);
            $seatsAdded[] = $seatNumber; // Keep track of added seats
        }
    
        return redirect()->route('admin.seats.create')->with('success', 'Seats added successfully: ' . implode(', ', $seatsAdded));
    }
}
