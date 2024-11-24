<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\Booking;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use App\Mail\BookingUpdateMail;
use App\Mail\BookingDeleted;
use Carbon\Carbon;





class SeatBookingController extends Controller
{

   
    public function showSeatBookingForm(Request $request)
{
    // Get the selected booking date from the request, or set a default
    $selectedDate = $request->input('booking_date', now()->toDateString()); 

    // Automatically set `is_booked` to false for seats where the booking date has passed
    Seat::whereHas('bookings', function ($query) {
        $query->where('booking_date', '<', now()); // Unbook seats for past dates
    })->update(['is_booked' => false]);

    // Fetch seats that are not booked for the selected date
    $seats = Seat::whereDoesntHave('bookings', function ($query) use ($selectedDate) {
        $query->where('booking_date', $selectedDate); // Exclude seats booked for the selected date
    })->get();

    // Return the view with available seats
    return view('seat-booking', compact('seats'));
}




    public function fetchSeats()
    {
        $seats = Seat::where('is_booked', false)->get(); // Fetch only available seats
        return response()->json(['seats' => $seats]);
    }

    // Check seat availability
    public function checkAvailability(Request $request)
    {
        $seatNumber = $request->input('seat_no');
        $bookingDate = $request->input('booking_date');

        // Check if the seat is already booked for the selected date
        $isBooked = Booking::where('seat_no', $seatNumber)
            ->where('booking_date', $bookingDate)
            ->exists();

        return response()->json(['available' => !$isBooked]);
    }

    // Book the seat
    public function bookSeat(Request $request)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return response()->json(['redirect' => true, 'message' => 'Please log in to book a seat.']);
    }

    $user = Auth::user();
    $request->validate([
        'booking_date' => 'required|date',
        'seat_no' => 'required|string',
    ]);

    $date = $request->input('booking_date');
    $seatNumber = $request->input('seat_no');

    // Check if the seat is already booked for the selected date
    if (Booking::where('seat_no', $seatNumber)->where('booking_date', $date)->exists()) {
        return response()->json(['success' => false, 'message' => 'Seat already booked!']);
    }

    // Check if the user already booked a seat for the selected date
    if (Booking::where('training_id', $user->training_id)->where('booking_date', $date)->exists()) {
        return response()->json(['success' => false, 'message' => 'You have already booked a seat for this date.']);
    }

    // Create a booking record
    Booking::create([
        'training_id' => $user->training_id,
        'booking_date' => $date,
        'seat_no' => $seatNumber,
    ]);

    // Mark the seat as booked
    Seat::where('seat_no', $seatNumber)->update(['is_booked' => true]);

    // Send a confirmation email
    Mail::to($user->email)->send(new BookingConfirmationMail($user->training_id, $date, $seatNumber));

    return response()->json(['success' => true, 'message' => 'Seat successfully booked!']);
}





    public function userbookcreate(Request $request)
    {
        // Check if the booking date is provided
        $bookingDate = $request->input('booking_date', now()->toDateString()); // Default to today's date if not specified
    
        // Fetch seats that are not booked for the selected date
        $seats = Seat::whereDoesntHave('bookings', function ($query) use ($bookingDate) {
            $query->where('booking_date', $bookingDate); // Exclude seats that are already booked on this date
        })->get();
    
        // Pass the available seats to the view
        return view('user.seats.create', compact('seats', 'bookingDate'));
    }
    

    // Method to list user's seat bookings
    // Method to list user's seat bookings
public function userbookSeatindex(Request $request)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        // Redirect to login page or return an error response if unauthenticated
        return redirect()->route('login')->with('error', 'Please log in to view your bookings.');
    }

    $user = Auth::user();
    $bookings = Booking::where('training_id', $user->training_id)->get();

    // Pass the bookings data to the view
    return view('user.seats.index', compact('bookings'));
}



public function editBooking($id)
{
    $booking = Booking::findOrFail($id); // Fetch the booking record by ID

    // Fetch available seats, including the seat already booked in this booking
    $availableSeats = Seat::where('is_booked', false)
        ->orWhere('seat_no', $booking->seat_no)
        ->get();

    return view('user.seats.edit', compact('booking', 'availableSeats'));
}



public function updateBooking(Request $request, $id)
{
    $request->validate([
        'booking_date' => 'required|date',
        'seat_no' => 'required|string',
    ]);

    $booking = Booking::findOrFail($id);
    $date = $request->input('booking_date');
    $seatNumber = $request->input('seat_no');

    // Check if the selected date is in the past
    if (strtotime($date) < time()) {
        return back()->with('error', 'You cannot update your booking to a past date.');
    }

    // Check if the user already has a booking on the selected date, other than the current one
    if (Booking::where('training_id', $booking->training_id)
                ->where('booking_date', $date)
                ->where('id', '!=', $id)
                ->exists()) {
        return back()->with('error', 'You already have a booking on this date!');
    }

    // Check if the seat is already booked for the selected date by any user
    if (Booking::where('seat_no', $seatNumber)
                ->where('booking_date', $date)
                ->exists() && $booking->seat_no !== $seatNumber) {
        return back()->with('error', 'Seat is already booked for the selected date!');
    }

    // Free up the old seat and book the new one
    Seat::where('seat_no', $booking->seat_no)->update(['is_booked' => false]); // Free the old seat
    Seat::where('seat_no', $seatNumber)->update(['is_booked' => true]); // Book the new seat

    // Update the booking record
    $booking->update([
        'booking_date' => $date,
        'seat_no' => $seatNumber,
    ]);

    // Send notification email
    Mail::to($booking->user->email)->send(new BookingUpdateMail($booking));

    return redirect()->route('user.seats.index')->with('success', 'Booking updated successfully!');
}



public function deleteBooking($id)
{
    $booking = Booking::findOrFail($id);

    // Check if the booking date is in the past
    if (Carbon::parse($booking->booking_date)->isBefore(now())) {
        return redirect()->route('user.seats.index')->with('error', 'Cannot delete a past booking.');
    }

    $user = $booking->user;

    // Free the booked seat
    Seat::where('seat_no', $booking->seat_no)->update(['is_booked' => false]);

    // Send email notification
    Mail::to($user->email)->send(new BookingDeleted($booking));

    // Delete the booking
    $booking->delete();

    // Redirect back with a success message
    return redirect()->route('user.seats.index')->with('success', 'Booking deleted successfully, and notification email sent!');
}




public function index()
{
    $user = Auth::user(); // Get the currently authenticated user
    $bookingCount = Booking::where('training_id', $user->training_id)->count(); // Count bookings for the user's training_id
    return view('user.home', compact('bookingCount'));
}

}
