<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    

class NotificationController extends Controller
{
    public function destroy($id)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }

    if (!method_exists($user, 'notifications')) {
        return response()->json(['success' => false, 'message' => 'Method notifications() not available'], 500);
    }
    
    $notification = $user->notifications()->find($id);

    if ($notification) {
        $notification->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
}

}
