<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Models\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvitationLetterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $name = $user?->studentDetail?->name_bn ?? $user?->name ?? 'Student';

        if ($user?->studentDetail?->application_status_id != 6) {
            return back()->with('error', 'আপনি এখনও ইনভিটেশন কার্ড ডাউনলোডের জন্য যোগ্য নন।');
        }

        $scanUrl = route('admin.qrcode.student.scan', ['mobile' => $user->mobile]);
        $qrDataUri = $this->buildStudentQrCode($scanUrl, $user->studentDetail);

        return view('frontend.pages.invitation-letter.index', compact('name', 'qrDataUri'));
    }

    public function showForStudent(string $mobile)
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        $user = User::where('mobile', $mobile)
            ->where('user_type_id', 1)
            ->whereHas('studentDetail', function ($query) {
                $query->whereIn('application_status_id', [4, 6]);
            })
            ->first();

        if (!$user || !$user->studentDetail) {
            abort(404, 'কোনো অনুমোদিত শিক্ষার্থী পাওয়া যায়নি।');
        }

        $name = $user->studentDetail->name_bn ?? $user->name;

        $scanUrl = route('admin.qrcode.student.scan', ['mobile' => $user->mobile]);
        $qrDataUri = $this->buildStudentQrCode($scanUrl, $user->studentDetail);

        return view('frontend.pages.invitation-letter.index', compact('name', 'qrDataUri'));
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

        $photoPath = $this->resolveStudentPhotoPath($detail);

        if ($photoPath) {
            $builder = $builder
                ->logoPath($photoPath)
                ->logoResizeToHeight(180)
                ->logoResizeToWidth(180)
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
}
