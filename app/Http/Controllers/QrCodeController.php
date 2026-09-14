<?php

namespace App\Http\Controllers;

use App\Models\CeremonyEntry;
use App\Services\CeremonyEntryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QrCodeController extends Controller
{
    protected $ceremonyService;

    /** How many recent scans to show in the live feed. */
    private const RECENT_LIMIT = 10;

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

        $entries = $this->recentApprovedEntriesQuery()->get();
        $latestEntry = $entries->first();

        return view('frontend.pages.qrcode.index', compact('qrImageUrl', 'entries', 'latestEntry'));
    }

    /**
     * JSON feed polled by the display page every few seconds.
     * Public (same as index) — this page is meant to run on an
     * unattended screen at the venue entrance.
     */
    public function latestScans(): JsonResponse
    {
        $entries = $this->recentApprovedEntriesQuery()->get();

        return response()->json([
            'success' => true,
            'latest'  => $entries->isNotEmpty() ? $this->formatEntry($entries->first()) : null,
            'recent'  => $entries->map(fn (CeremonyEntry $entry) => $this->formatEntry($entry))->values(),
        ]);
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

    /**
     * Shared base query for the live display: only successful check-ins,
     * newest first, with everything the card/list needs eager loaded.
     */
    private function recentApprovedEntriesQuery()
    {
        return CeremonyEntry::query()
            ->with(['studentDetail.board', 'student'])
            ->where('status', 'approved')
            ->latest('scanned_at')
            ->limit(self::RECENT_LIMIT);
    }

    private function formatEntry(CeremonyEntry $entry): array
    {
        $detail = $entry->studentDetail;

        return [
            'id'           => $entry->id,
            'name_en'      => $detail->name_en ?? $entry->student->name ?? '',
            'name_bn'      => $detail->name_bn ?? '',
            'roll_number'  => $detail->roll_number ?? '',
            'board'        => $detail->board->name_bn ?? $detail->board->name ?? '',
            'photo_url'    => $detail->student_photo_url ?? asset('images/default-user.png'),
            'scanned_at'   => $entry->scanned_at->format('h:i A'),
        ];
    }
}
