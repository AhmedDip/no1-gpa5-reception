<?php

namespace App\Http\Controllers;

use App\Services\CeremonyEntryService;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    protected $ceremonyService;

    public function __construct(CeremonyEntryService $ceremonyService)
    {
        $this->ceremonyService = $ceremonyService;
    }

    public function index()
    {
        $verifyUrl = route('student.ceremony.verify');

        $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?' . http_build_query([
            'size'   => '400x400',
            'data'   => $verifyUrl,
            'margin' => 10,
        ]);

        return view('frontend.pages.qrcode.index', compact('qrImageUrl'));
    }


    public function verify(Request $request)
    {
        if (!auth()->check()) {
            session(['url.intended' => $request->url()]);

            return redirect()->route('student.login')
                ->with('error', 'প্রবেশ যাচাই করতে দয়া করে প্রথমে লগইন করুন।');
        }

        $studentId = auth()->id();
        $result = $this->ceremonyService->verifyEntry($studentId);

        $studnetBname = auth()->user()->studentDetail?->name_bn ?? '';


        return match ($result['type'] ?? null) {
            'approved'        => view('frontend.pages.qrcode.approved', $result)->with('studnetBname', $studnetBname),
            'already_scanned' => view('frontend.pages.qrcode.already-scanned', $result),
            default           => view('frontend.pages.qrcode.denied', $result),
        };
    }

    /**
     * Show entry history
     */
    public function history()
    {
        $entries = auth()->user()
            ->ceremonyEntries()
            ->with('studentDetail')
            ->latest('scanned_at')
            ->paginate(10);

        return view('frontend.pages.qrcode.history', compact('entries'));
    }
}
