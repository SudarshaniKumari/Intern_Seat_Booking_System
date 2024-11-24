<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Show the form to fill the training ID
    public function showTrainingIdForm()
    {
        return view('user.fill-training-id');
    }

    public function updateTrainingId(Request $request)
    {
        // Validate the training_id field
        $request->validate([
            'training_id' => 'required|unique:users,training_id', // Ensure training_id is unique
        ]);
    
        // Step 1: Get the current user's old training_id
        $oldTrainingId = auth()->user()->training_id;
        $newTrainingId = $request->input('training_id');
    
        // Step 2: Ensure the new training_id exists in the users table (if necessary)
        if (!DB::table('users')->where('training_id', $newTrainingId)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The selected training ID does not exist.']);
        }
    
        // Step 3: Update the dependent records in bookings (or other related tables)
        try {
            DB::table('bookings')
                ->where('training_id', $oldTrainingId)
                ->update(['training_id' => $newTrainingId]);
        } catch (\Exception $e) {
            Log::error('Error updating bookings table: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update bookings table.']);
        }
    
        // Step 4: Update the authenticated user's training_id
        try {
            auth()->user()->update([
                'training_id' => $newTrainingId,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user training_id: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update user training ID.']);
        }
    
        // Step 5: Redirect back with success message
        return redirect()->route('user.home')->with('success', 'Training ID updated successfully!');
    }
}