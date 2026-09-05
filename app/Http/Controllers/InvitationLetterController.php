<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationLetterController extends Controller
{
    public function index()
    {
        $name = Auth::user()?->studentDetail?->name_bn ?? Auth::user()?->name ?? 'Student';

          if (Auth::user()?->studentDetail?->application_status_id != 7) {
            return back()->with('error', 'আপনি এখনও ইনভিটেশন কার্ড ডাউনলোডের জন্য যোগ্য নন।');
        }

        return view('frontend.pages.invitation-letter.index', compact('name'));
    }
}
