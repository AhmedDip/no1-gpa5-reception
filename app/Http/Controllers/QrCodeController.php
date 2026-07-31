<?php
// app/Http/Controllers/QrCodeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index(Request $request)
    {
        $targetUrl = $request->query('url', 'https://no1family.com/');

        $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?' . http_build_query([
            'size'   => '400x400',
            'data'   => $targetUrl,
            'margin' => 10,
        ]);

        return view('frontend.pages.qrcode.index', compact('targetUrl', 'qrImageUrl'));
    }
}
