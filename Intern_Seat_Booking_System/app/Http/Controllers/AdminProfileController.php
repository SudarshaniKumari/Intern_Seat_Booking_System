<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminProfileController extends Controller
{
    public function show()
    {
        // Get the authenticated admin user
        // Fetch the admin user by email
        $admin = User::where('email', 'sudarik992@gmail.com')->first();

        // Check if the admin user exists
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin not found.');
        }

        // Pass the admin data to the view
        return view('admin.profile.show', compact('admin'));
    }


    public function edit()
    {
        $admin = User::where('email', 'sudarik992@gmail.com')->first();

        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin not found.');
        }

        return view('admin.profile.edit', compact('admin'));
    }
}
