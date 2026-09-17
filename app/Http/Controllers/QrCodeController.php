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
        $entries = $this->recentApprovedEntriesQuery()->get();
        $latestEntry = $entries->first();

        $latestQrDataUri = $latestEntry ? $this->qrCodeForEntry($latestEntry) : null;

        return view('frontend.pages.qrcode.index', compact('entries', 'latestEntry', 'latestQrDataUri'));
    }

    /**
     * JSON feed polled by the display page every few seconds.
     */
    public function latestScans(): JsonResponse
    {
        $entries = $this->recentApprovedEntriesQuery()->get();
        $latestEntry = $entries->first();

        $latestData = null;
        if ($latestEntry) {
            $latestData = array_merge(
                $this->formatEntry($latestEntry),
                ['qr_data_uri' => $this->qrCodeForEntry($latestEntry)]
            );
        }

        return response()->json([
            'success' => true,
            'latest' => $latestData,
            'recent' => $entries->map(fn(CeremonyEntry $entry) => $this->formatEntry($entry))->values(),
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
            'approved' => view('frontend.pages.qrcode.approved', $result)->with('studnetBname', $studnetBname),
            'already_scanned' => view('frontend.pages.qrcode.already-scanned', $result),
            default => view('frontend.pages.qrcode.denied', $result),
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


    public function showStudentQrCode(string $mobile)
    {

        $user = $this->findApprovedStudent($mobile);


        $qrDataUri = null;

        if ($user) {
            $scanUrl = route('admin.qrcode.student.scan', ['mobile' => $user->mobile]);
            $qrDataUri = $this->buildStudentQrCode($scanUrl, $user->studentDetail);
        }

        // dd($user, $qrDataUri, $scanUrl );


        return view('frontend.pages.qrcode.student', compact('user', 'qrDataUri'));
    }

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
                ->logoResizeToHeight(150)
                ->logoResizeToWidth(150)
                ->logoPunchoutBackground(true);
        }

        return $builder->build()->getDataUri();
    }




    private function resolveStudentPhotoPath(?StudentDetail $detail): ?string
    {
        if (!$detail || empty($detail->student_photo)) {
            return null;
        }

        $photoPath = ltrim(str_replace('\\', '/', $detail->student_photo), '/');
        $uploadsDisk = Storage::disk('uploads');

        if (!$uploadsDisk->exists($photoPath)) {
            return null;
        }

        return $uploadsDisk->path($photoPath);
    }




    public function scanStudentQrCode(string $mobile)
    {
        $user = $this->findApprovedStudent($mobile);

        if (!$user || !$user->studentDetail) {
            return view('frontend.pages.qrcode.student-invalid');
        }

        try {
            CeremonyEntry::create([
                'student_id' => $user->id,
                'student_detail_id' => $user->studentDetail->id,
                'status' => 'approved',
                'remarks' => 'ব্যক্তিগত QR কোড স্ক্যান (মোবাইল ভিত্তিক প্রবেশ)',
                'scanned_at' => now(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }

        return view('frontend.pages.qrcode.student-scanned', [
            'user' => $user,
            'detail' => $user->studentDetail,
        ]);
    }

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
            'id' => $entry->id,
            'name_en' => $detail->name_en ?? $entry->student->name ?? '',
            'name_bn' => $detail->name_bn ?? '',
            'roll_number' => $detail->roll_number ?? '',
            'board' => $detail->board->name_bn ?? $detail->board->name ?? '',
            'photo_url' => $detail->student_photo_url ?? asset('images/default-user.png'),
            'scanned_at' => $entry->scanned_at->format('h:i A'),
        ];
    }


    private function findApprovedStudent(string $mobile): ?User
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        if ($mobile === '') {
            return null;
        }


        return User::query()
            ->where('mobile', $mobile)
            ->where('user_type_id', 1)
            ->whereHas('studentDetail', function ($query) {
                $query->whereIn('application_status_id', [4, 6]);
            })
            ->first();
    }


    private function qrCodeForEntry(CeremonyEntry $entry): ?string
    {
        $mobile = $entry->student->mobile ?? null;

        if (!$mobile) {
            return null;
        }

        $scanUrl = route('admin.qrcode.student.scan', ['mobile' => $mobile]);

        return $this->buildStudentQrCode($scanUrl, $entry->studentDetail);
    }


}
