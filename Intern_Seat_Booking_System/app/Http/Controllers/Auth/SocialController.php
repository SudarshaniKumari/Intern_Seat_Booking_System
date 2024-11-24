<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if the user already exists in the database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // If the user doesn't exist, create them with partial information
                $user = User::create([
                    'first_name' => 'N/V',
                    'last_name' => 'N/V',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('default_password'), // Set a random or default password
                ]);

                // Redirect to additional information form
                Auth::login($user);
                return redirect()->route('additional.info');
            } 

            // Log the user in if they already exist
            Auth::login($user);
            return redirect()->intended('/user/home');

        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['error' => 'Unable to login with Google.']);
        }
    }

    // Show additional information form
    public function showAdditionalInfoForm()
    {
        // Fetch departments to display in the dropdown
        $departments = Department::all();
        return view('auth.additional_info', compact('departments'));
    }

    // Store additional information
    public function storeAdditionalInfo(Request $request)
    {
        // Validate additional information
        $request->validate([
            'training_id' => 'required|unique:users,training_id',
            'department' => 'required|exists:departments,id',
        ]);

        // Update the user’s additional information
        $user = Auth::user();
        $user->update([
            'training_id' => $request->input('training_id'),
            'department' => $request->input('department'),
        ]);

        return redirect('/user/home')->with('success', 'Profile completed successfully.');
    }



    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Check if the user already exists
            $user = User::where('email', $facebookUser->email)->first();

            if (!$user) {
                // Create a new user if it doesn't exist
                $user = User::create([
                    'first_name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => bcrypt('facebook_default_password'), // or set it null
                ]);
            }

            // Log the user in
            Auth::login($user);
            return redirect()->intended('/user/home'); // Redirect to home or any intended page
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Unable to login with Facebook.']);
        }
    }

}
