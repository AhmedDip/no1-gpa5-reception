<?php
// app/Http/Controllers/Admin/ProfileController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Handles password changes for Admin, Wing Manager, and Regional Manager alike —
     * all three authenticate through the same guard, so no role branching is needed.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password'      => ['required', 'string', 'min:6', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required'         => 'Current password is required.',
            'current_password.current_password' => 'Current password is incorrect.',
            'new_password.required'             => 'New password is required.',
            'new_password.min'                  => 'New password must be at least 6 characters.',
            'new_password.confirmed'            => 'New password confirmation does not match.',
            'new_password.different'            => 'New password must be different from the current password.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Your password has been changed successfully.');
    }
}
