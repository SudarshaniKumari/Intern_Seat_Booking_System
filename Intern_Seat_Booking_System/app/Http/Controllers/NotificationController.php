<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $notificationId)->first();
        
        if ($notification) {
            $notification->markAsRead();
            // Store the user ID in the session for highlighting the row
            session(['highlight_user_id' => $notification->data['user_id']]);
            
            // Redirect to the user show page
            return redirect()->route('admin.users.show', $notification->data['user_id'])
                             ->with('success', 'Notification marked as read');
        }
    
        return redirect()->route('admin.users.index')->with('error', 'Notification not found');
    }
    
    
}
