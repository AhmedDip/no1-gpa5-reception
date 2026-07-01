<?php
// app/Http/Controllers/StudentNotificationController.php

namespace App\Http\Controllers;

use App\Models\StudentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentNotificationController extends Controller
{

    public function index()
    {
        $notifications = StudentNotification::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        $page_content = [
            'page_title' => 'নোটিফিকেশন',
        ];

        return view('frontend.pages.student.notifications', compact('notifications', 'page_content'));
    }

   
    public function markRead(Request $request, int $id)
    {
        $notification = StudentNotification::where('user_id', Auth::id())->findOrFail($id);
        $notification->markAsRead();

        return response()->json([
            'success' => true,
        ]);
    }

   
    public function markAllRead(Request $request)
    {
        StudentNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json([
            'success' => true,
        ]);
    }
}