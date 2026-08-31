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
        // $this->middleware('auth')->only(['verify', 'history']); // Use default auth
    }

    /**
     * Show QR code at entrance
     */
    public function index()
    {
        // Generate QR code URL that points to verify endpoint
        $verifyUrl = route('student.ceremony.verify');

        $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?' . http_build_query([
            'size'   => '400x400',
            'data'   => $verifyUrl,
            'margin' => 10,
        ]);

        return view('frontend.pages.qrcode.index', compact('qrImageUrl'));
    }

    /**
     * Verify entry when QR code is scanned
     */
    public function verify(Request $request)
    {
        // User must be authenticated
        if (!auth()->check()) {
            return redirect()->route('student.login')
                ->with('error', 'Please login first to verify your entry.');
        }

        $studentId = auth()->id();

        // Process the verification
        $result = $this->ceremonyService->verifyEntry($studentId);

        if ($result['success']) {
            return view('frontend.pages.qrcode.approved', $result);
        } else {
            return view('frontend.pages.qrcode.denied', $result);
        }
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
