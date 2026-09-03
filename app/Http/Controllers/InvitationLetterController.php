<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationLetterController extends Controller
{
    public function index()
    {
        $name = Auth::user()?->studentDetail?->name ?? Auth::user()?->name ?? 'Student';

        return view('frontend.pages.invitation-letter.index', compact('name'));
    }
}
