<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\UserEmailCode; // Import the UserEmailCode model
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class TwoFAController extends Controller
{
    public function index()
    {
        return view('2fa');
    }
  
    public function store(Request $request)
    {
        $request->validate(['code' => 'required']);

        // Verify the code stored in the database
        $codeRecord = UserEmailCode::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(10)) // Ensure the code is not older than 10 minutes
            ->first();

        if ($codeRecord) {
            // Store user ID in session after successful verification
            Session::put('user_2fa', auth()->user()->id);
            return redirect()->route('user.home');
        }

        return back()->with('error', 'You entered the wrong code or the code has expired.');
    }

    public function resend()
    {
        // Regenerate the code
        auth()->user()->generateCode();

        return back()->with('success', 'We re-sent the code to your email.');
    }


//     public function adminIndex()
//     {
//         return view('auth.admin.two-factor-authentication');
//     }

//     // Verify the 2FA code for admins
//     // In adminStore method after verifying 2FA
// public function adminStore(Request $request)
// {
//     $request->validate(['code' => 'required|numeric']);

//     if ($request->code == Session::get('admin_2fa_code')) {
//         Session::forget('admin_2fa_code');
//         return redirect()->route('admin.dashboard'); // Ensure this route exists
//     }

//     return redirect()->back()->withErrors('Invalid 2FA code.');
// }

//     // Resend 2FA code for admins
//     public function adminResend()
//     {
//         $code = random_int(100000, 999999);
//         Session::put('admin_2fa_code', $code);

//         // Send the code via email
//         $admin = auth()->user(); // Assuming the admin is logged in
//         Mail::raw('Your new two-factor authentication code is: ' . $code, function ($message) use ($admin) {
//             $message->to($admin->email)->subject('Resent 2FA Code');
//         });

//         return back()->with('status', 'A new 2FA code has been sent to your email.');
//     }
}
