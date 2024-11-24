<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FaceBookController extends Controller
{

  
public function loginUsingFacebook()
{
    return Socialite::driver('facebook')->stateless()->redirect();
}

public function handleFacebookCallback()
{
    try {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        // Find the user by email
        $user = User::where('email', $facebookUser->getEmail())->first();

        if ($user) {
            // Update the Facebook ID for the existing user
            $user->update(['facebook_id' => $facebookUser->getId()]);
        } else {
            // If no user, create a new one
            $user = User::create([
                'first_name' => explode(' ', $facebookUser->getName())[0],
                'last_name' => explode(' ', $facebookUser->getName())[1] ?? '',
                'email' => $facebookUser->getEmail(),
                'password' => Hash::make($facebookUser->getName() . '@' . $facebookUser->getId()),
                'facebook_id' => $facebookUser->getId(),
                'training_id' => 'N/A',
                'dep_no' => 'N/A',
                'dep_name' => 'N/A',
                'phone_number' => '0000000000',
                'is_admin' => 0,
            ]);
        }

        // Log the user in
        Auth::loginUsingId($user->id);

        return redirect()->route('user.home');
    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['error' => 'Unable to login with Facebook.']);
    }
}

}
