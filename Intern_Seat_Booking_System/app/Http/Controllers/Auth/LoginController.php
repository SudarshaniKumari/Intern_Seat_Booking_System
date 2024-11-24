<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEmailCode;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /** 
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Include soft-deleted users in the query
        $user = User::withTrashed()->where('email', $credentials['email'])->first();

        if ($user && $user->trashed()) {
            return redirect()->back()->withErrors('Your account has been deleted and cannot be logged into.');
        }

        // Attempt login with credentials
        if (Auth::attempt($credentials)) {
            // If user is an admin, handle 2FA
            if ($user->isAdmin()) {
                // Generate and store 2FA code for admin
                $code = random_int(100000, 999999);
                Session::put('admin_2fa_code', $code);

                // Send the 2FA code via email
                Mail::raw('Your two-factor authentication code is: ' . $code, function ($message) use ($user) {
                    $message->to($user->email)->subject('Admin 2FA Code');
                });

                return redirect()->route('2fa.admin.index'); // Redirect to admin 2FA verification
            } else {
                // Generate and store the 2FA code for regular users
                $user->generateCode();
                return redirect()->route('2fa.index'); // Redirect to user 2FA verification
            }
        }

        return redirect("login")->withErrors('Oops! You have entered invalid credentials');
    }


    protected function authenticated(Request $request, $user)
    {
        // Redirect to the booking card after login for regular users
        return redirect()->route('booking.card')->with([
            'booking_date' => session('booking_date'),
            'booking_seat' => session('booking_seat')
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        // 1. Retrieve Google user details
        $googleUser = Socialite::driver('google')->user();

        // 2. Check if the user exists by `google_id` or `email`
        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        if ($user) {
            // 3. If the user exists but does not have a `google_id`, update it
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
            // 4. Log the user in
            Auth::login($user);
        } else {
            // 5. If no user exists, create a new one
            // Extract first and last names from Google user data
            $nameParts = explode(' ', $googleUser->getName());
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : ''; // Handle cases where there is no last name

            // Create a new user with the details from Google account
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(24)), // Random password as it's OAuth login
                'google_id' => $googleUser->getId(),
                'training_id' => 'N/A', // Adjust these default values as per your application's requirements
                'dep_no' => 'N/A',
                'dep_name' => 'N/A',
                'phone_number' => '0000000000',
                'is_admin' => 0, // Default to non-admin
            ]);

            // 6. Log the newly created user in
            Auth::login($user);
        }

        // 7. Redirect to the user's home page (or another page)
        return redirect()->route('user.home');
    } catch (Exception $e) {
        // Handle any error that occurs during the login process
        return redirect('/login')->withErrors(['error' => 'Unable to login with Google.']);
    }
}
   
}
