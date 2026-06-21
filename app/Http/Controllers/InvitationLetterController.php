<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationLetterController extends Controller
{
    public function index()
    {
        return view('frontend.pages.invitation-letter.index');
    }
}
