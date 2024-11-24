<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking; // Import the Auth facade
use App\Models\Department;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $user = Auth::user()->load('department');// Eager-load the department relationship
    
        // Fetch all bookings for the logged-in user
        $bookings = Booking::where('training_id', $user->training_id)->get();
    
        // Pass the user data and bookings details to the view
        return view('user.home', ['user' => $user, 'bookings' => $bookings]);
    }
    
    
    
}
