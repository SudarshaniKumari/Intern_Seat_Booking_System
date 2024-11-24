<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;





class AdminController extends Controller
{
    // Show admin login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle admin login and 2FA
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                // Generate and store 2FA code
                $code = random_int(100000, 999999);
                Session::put('2fa_code', $code);

                // Send 2FA code via email
                Mail::raw('Your two-factor authentication code is: ' . $code, function ($message) use ($user) {
                    $message->to($user->email)->subject('Admin 2FA Code');
                });

                return redirect()->route('admin.2fa');
            }

            Auth::logout();
            return redirect()->route('admin.login')->withErrors('You are not authorized as an admin.');
        }

        return redirect()->back()->withErrors('Invalid credentials.');
    }

    // Show 2FA form
    public function show2FAForm()
    {
        return view('admin.2fa');
    }

    // Verify 2FA code
    public function verify2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        $code = $request->input('code');
        $storedCode = Session::get('2fa_code');

        if ($code == $storedCode) {
            Session::forget('2fa_code');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors('Invalid 2FA code.');
    }

    public function index()
    {
        // Fetch counts
        $userCount = User::where('is_admin', false)->count();
        $bookingCount = Booking::count();
        $availableSeatCount = Seat::where('is_booked', false)->count();
        $bookedSeatCount = Seat::where('is_booked', true)->count();

        return view('admin.dashboard', compact('userCount', 'bookingCount', 'availableSeatCount', 'bookedSeatCount'));
    }


    public function user_index(Request $request)
    {
        session()->forget('highlight_user_id');
    
        // Start with a query for non-admin users
        $query = User::where('is_admin', 0);
    
        // Check if there's a search query for training_id
        if ($request->has('search') && $request->search != '') {
            $query->where('training_id', $request->search);
        }
    
        // Handle sorting based on column and order
        $sort_by = $request->input('sort_by', 'id'); // Default sort by 'id'
        $order = $request->input('order', 'asc'); // Default order 'asc'
    
        $query->orderBy($sort_by, $order);
    
        // Paginate the results
        $users = $query->paginate(5)->appends($request->input()); // Append request parameters for pagination links
    
        return view('admin.users.index', compact('users'));
    }
    

    public function showUser($id)
    {
        // Fetch the user by ID
        session()->forget('highlight_user_id');
        $user = User::findOrFail($id);


        // Return the view with user details
        return view('admin.users.show', compact('user'));
    }


    public function generateUserPDF($id)
    {
        // Fetch the specific user details
        $user = DB::table('users')
            ->where('id', $id)
            ->first(); // Fetch the user by ID

        // Check if the user exists
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        // Fetch all bookings for this user's training_id
        $bookings = DB::table('bookings')
            ->where('training_id', $user->training_id)
            ->get(); // Get all bookings related to this user, including attendance

        // Load the view and pass the user and their booking data, including attendance
        $pdf = PDF::loadView('admin.users.pdf', compact('user', 'bookings'));

        // Return the generated PDF
        return $pdf->download('user-bookings.pdf');
    }


    public function booking_index(Request $request)
{
    $query = DB::table('bookings')
        ->join('users', 'bookings.training_id', '=', 'users.training_id')
        ->select('bookings.*', 'users.first_name', 'users.last_name', 'users.email')
        ->where('bookings.booking_date', '>=', Carbon::now()->format('Y-m-d'));

    // Check if there's a search query for seat number
    if ($request->has('search') && $request->search != '') {
        $query->where('bookings.seat_no', $request->search);
    }

    // Check for sorting
    $sort_by = $request->get('sort_by', 'booking_date'); // Default sort column
    $order = $request->get('order', 'asc'); // Default sort order

    $query->orderBy($sort_by, $order);

    // Paginate the results
    $bookings = $query->paginate(5); // Display 5 bookings per page

    $notifications = Auth::user()->unreadNotifications;


    // Set error message if no bookings found
    $message = null;
    if ($request->has('search') && $request->search != '' && $bookings->isEmpty()) {
        $message = 'No bookings found for the seat number: ' . htmlspecialchars($request->search);
    }

    return view('admin.bookings.index', compact('bookings', 'message'));
}


    public function markAttendance(Request $request, $id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            if ($request->input('status') == 'present') {
                $booking->is_present = true; // Mark as present
            } else if ($request->input('status') == 'absent') {
                $booking->is_present = false; // Mark as absent
            }

            $booking->save();

            $message = $request->input('status') == 'present' ? 'Attendance marked as present!' : 'Attendance marked as absent!';
            return redirect()->route('admin.bookings.index')->with('success', $message);
        }

        return redirect()->route('admin.bookings.index')->with('error', 'Booking not found!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Optionally handle soft deletes
        $user->delete(); // If using soft deletes

        // Or delete the user permanently
        // $user->forceDelete(); 

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }



    

}
