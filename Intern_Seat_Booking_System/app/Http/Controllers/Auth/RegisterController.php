<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use App\Notifications\NewUserRegistered;
use Illuminate\Support\Facades\Notification;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Models\University;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/user/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'training_id' => ['required', 'digits:4', 'unique:users'],
            'department' => ['required', 'string', 'exists:departments,dep_no'], // Ensure the selected dep_no exists
            'phone_number' => ['required', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'university_name' => ['required', 'string', 'exists:universities,name'],

        ]);
    }

    protected function create(array $data)
    {
        $department = Department::where('dep_no', $data['department'])->first();
    
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'training_id' => $data['training_id'],
            'dep_no' => $department->dep_no,
            'dep_name' => $department->dep_name,
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'university_name' => $data['university_name'], 
        ]);
        // dd($data['university_name']);
    
        // Notify admin or other relevant users
        Notification::send(User::where('is_admin', true)->get(), new NewUserRegistered($user));
        
        $registrationDate = now()->format('F d, Y');
        Mail::to($user->email)->send(new UserRegistered($user, $registrationDate));
    
        return $user;
    }

    public function showRegistrationForm()
    {
        $departments = Department::all();
        $universities = University::all(); 
        return view('auth.register', [
            'departments' => $departments,
            'universities' => $universities,
        ]);
    }
    
}
