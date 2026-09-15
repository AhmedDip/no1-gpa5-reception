<?php

namespace App\Http\Controllers;

use App\Models\CeremonyEntry;
use App\Models\User;
use App\Services\CeremonyEntryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\StudentDetail;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

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
     * GET /qr-code/{mobile}
     * Renders the individual QR code for a single student, identified by
     * their mobile number — for printing on ID cards / invitations.
     * No auth required.
     */
     /**
     * GET /qr-code/{mobile}
     * Renders the individual QR code for a single student, identified by
     * their mobile number — with the student's photo embedded in the
     * center of the code. No auth required.
     */
    public function showStudentQrCode(string $mobile)
    {
        $user = $this->findStudentByMobile($mobile);

        $qrDataUri = null;

        if ($user) {
            $scanUrl = route('qrcode.student.scan', ['mobile' => $user->mobile]);
            $qrDataUri = $this->buildStudentQrCode($scanUrl, $user->studentDetail);
        }


        return view('frontend.pages.qrcode.student', compact('user', 'qrDataUri'));
    }

        /**
     * Build a QR code PNG (as a data URI) with the student's photo
     * punched out in the center. High error-correction keeps it
     * reliably scannable despite the logo overlay.
     */
    private function buildStudentQrCode(string $data, ?StudentDetail $detail): string
    {
        $builder = Builder::create()
            ->writer(new PngWriter())
            ->data($data)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(420)
            ->margin(12)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->validateResult(false);

        $logoPath = $this->resolveStudentPhotoPath($detail);

        if ($logoPath) {
            $builder = $builder
                ->logoPath($logoPath)
                ->logoResizeToWidth(110)
                ->logoPunchoutBackground(true);
        }

        return $builder->build()->getDataUri();
    }

    /**
     * Resolve the student's photo to a local filesystem path that
     * endroid/qr-code can read directly (it needs a real file path,
     * not a URL). Falls back to null (plain QR, no logo) if missing.
     */
    private function resolveStudentPhotoPath(?StudentDetail $detail): ?string
    {
        if (!$detail || !$detail->student_photo) {
            return null;
        }


        return "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0svvaxiI_AYMFmR0j0CFgFeb3eTLSrPKn6W815LNA8gXwHHaXwcHQJe9d&s=10";



    }

    /**
     * GET /qr-code/scan/{mobile}
     * The URL encoded inside the individual student's QR image.
     * Records a scan (visible on the /qr-code live feed) and shows the
     * student's info back to whoever scanned it. No auth required.
     */
    public function scanStudentQrCode(string $mobile)
    {
        $user = $this->findStudentByMobile($mobile);

        if (!$user || !$user->studentDetail) {
            return view('frontend.pages.qrcode.student-invalid');
        }

        try {
            CeremonyEntry::create([
                'student_id'        => $user->id,
                'student_detail_id' => $user->studentDetail->id,
                'status'            => 'approved',
                'remarks'           => 'ব্যক্তিগত QR কোড স্ক্যান (মোবাইল ভিত্তিক প্রবেশ)',
                'scanned_at'        => now(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }

        return view('frontend.pages.qrcode.student-scanned', [
            'user'   => $user,
            'detail' => $user->studentDetail,
        ]);
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
            'id'          => $entry->id,
            'name_en'     => $detail->name_en ?? $entry->student->name ?? '',
            'name_bn'     => $detail->name_bn ?? '',
            'roll_number' => $detail->roll_number ?? '',
            'board'       => $detail->board->name_bn ?? $detail->board->name ?? '',
            'photo_url'   => $detail->student_photo_url ?? asset('images/default-user.png'),
            'scanned_at'  => $entry->scanned_at->format('h:i A'),
        ];
    }

    /**
     * Look up a registered student (user_type_id = 1) by mobile number.
     * Digits-only match; returns null when not found.
     */
    private function findStudentByMobile(string $mobile): ?User
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        if ($mobile === '') {
            return null;
        }

        return User::query()
            ->where('mobile', $mobile)
            ->where('user_type_id', 1)
            ->with('studentDetail.board')
            ->first();
    }


}
