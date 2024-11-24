<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if an admin user already exists
        if (!User::where('email', 'sudarik992@gmail.com')->exists()) {
            // Create the admin user
            User::create([
                'first_name' => 'Admin',             // First name
                'last_name' => 'User',                // Last name
                'training_id' => '1234', 
                'dep_no' =>'01',            // Example training ID
                'dep_name' => 'Administration',      // Department name
                'phone_number' => '0123456789',       // Example phone number
                'email' => 'sudarik992@gmail.com',        // Admin email
                'password' => Hash::make('123'), // Secure password
                'is_admin' => true,                    // Set is_admin to true
            ]);
        }
    }
}
