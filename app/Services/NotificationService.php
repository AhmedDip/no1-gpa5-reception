<?php
// app/Services/NotificationService.php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\StudentDetail;
use App\Models\StudentNotification;
use App\Models\User;
use App\Services\Sms\BanglalinkSmsService;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function __construct(private BanglalinkSmsService $banglalinkSms)
    {}

    // public function approvedTemplate(StudentDetail $app): string
    // {
    //     $name      = $app->name_bn ?: $app->name_en;
    //     $roll      = $app->roll_number;
    //     $stallName = $app->tea_stall_name ?? 'আপনার চায়ের দোকান';

    //     return "অভিনন্দন! প্রিয় {$name},"
    //         . "আপনার আবেদন (রোল: {$roll}) সফলভাবে অনুমোদিত হয়েছে।"
    //         . "নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬-এ আপনাকে স্বাগতম।"
    //         . "সংবর্ধনার তারিখ ও স্থান শীঘ্রই জানানো হবে।";
    // }

    public function approvedTemplate(StudentDetail $app): string
    {
        $roll = $app->roll_number;
        return "অভিনন্দন! আবেদন (রোল: {$roll}) অনুমোদিত হয়েছে। বিস্তারিত পরে জানানো হবে।";
    }

    // public function rejectedTemplate(StudentDetail $app, string $remarks = ''): string
    // {
    //     $name = $app->name_bn ?: $app->name_en;
    //     $roll = $app->roll_number;

    //     $msg = "প্রিয় {$name},\n\n"
    //         . "দুঃখিত, আপনার আবেদনটি (রোল: {$roll}) গ্রহণ করা সম্ভব হয়নি।";

    //     if ($remarks) {
    //         $msg .= "\nকারণ: {$remarks}";
    //     }

    //     $msg .= "\n\nআরও তথ্যের জন্য যোগাযোগ করুন।\n— নাম্বার ওয়ান ব্র্যান্ড";

    //     return $msg;
    // }

    public function rejectedTemplate(StudentDetail $app): string
    {
        $roll = $app->roll_number;
        return "দুঃখিত, আপনার আবেদন (রোল: {$roll}) নির্বাচিত হয়নি।";
    }

    public function customTemplate(StudentDetail $app, string $message): string
    {
        $name = $app->name_bn ?: $app->name_en;

        return "প্রিয় {$name},\n{$message}\n— নাম্বার ওয়ান";
    }

    private function storeNotification(StudentDetail $app, string $title, string $message, string $type): void
    {
        try {
            StudentNotification::create([
                'user_id'           => $app->user_id,
                'student_detail_id' => $app->id,
                'title'             => $title,
                'message'           => $message,
                'type'              => $type,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to store student notification: ' . $e->getMessage());
        }
    }

    public function sendSms(string $mobile, string $message, ?int $studentDetailId = null, string $type = 'custom'): bool
    {
        $driver = config('services.sms.driver', 'banglalink');
        $result = $this->dispatch($driver, $mobile, $message);

        try {
            SmsLog::create([
                'student_detail_id' => $studentDetailId,
                'sent_by'           => auth()->id(),
                'mobile'            => $mobile,
                'type'              => $type,
                'message'           => $message,
                'status'            => $result['success'] ? 'sent' : 'failed',
                'driver'            => $driver,
                'response'          => $result['response'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to store SMS log: ' . $e->getMessage());
        }

        return $result['success'];
    }

    private function dispatch(string $driver, string $mobile, string $message): array
    {
        switch ($driver) {
            case 'banglalink':
                return $this->sendViaBanglalink($mobile, $message);
            case 'log':
            default:
                return $this->sendViaLog($mobile, $message);
        }
    }

    private function sendViaBanglalink(string $mobile, string $message): array
    {
        $result = $this->banglalinkSms->send($mobile, $message, $this->containsBangla($message));

        Log::info('SMS dispatched via Banglalink', [
            'mobile'  => $this->maskMobile($mobile),
            'status'  => $result['status_code'],
            'success' => $result['success'],
        ]);

        return [
            'success'  => $result['success'],
            'response' => trim(($result['status_code'] ?? '') . ' - ' . $result['message']),
        ];
    }

    /** Bangla messages need messagetype "3" (Unicode) instead of "1" (English) */
    private function containsBangla(string $text): bool
    {
        return (bool) preg_match('/\p{Bengali}/u', $text);
    }

    private function sendViaLog(string $mobile, string $message): array
    {
        Log::info('SMS logged (driver: log)', [
            'mobile'  => $this->maskMobile($mobile),
            'message' => $message,
        ]);

        return [
            'success'  => true,
            'response' => 'Logged successfully',
        ];
    }

    public function notifyApproved(StudentDetail $app): bool
    {
        $message = $this->approvedTemplate($app);
        $this->storeNotification($app, 'আবেদন অনুমোদিত হয়েছে', $message, 'approved');

        $mobile = $app->user->mobile ?? $app->parent_mobile;
        if (! $mobile) {
            return false;
        }

        $sent = $this->sendSms($mobile, $message, $app->id, 'approved');

        if ($sent) {
            $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
        }

        return $sent;
    }

    public function notifyRejected(StudentDetail $app, string $remarks = ''): bool
    {
        $message = $this->rejectedTemplate($app, $remarks);
        $this->storeNotification($app, 'আবেদন প্রত্যাখ্যাত হয়েছে', $message, 'rejected');

        $mobile = $app->user->mobile ?? $app->parent_mobile;
        if (! $mobile) {
            return false;
        }

        return $this->sendSms($mobile, $message, $app->id, 'rejected');
    }

   
    public function notifyRegistrationComplete(User $user): bool
    {
        $studentDetail = $user->studentDetail;
        $name          = $studentDetail?->name_bn ?: $user->name;

        $message = "অভিনন্দন {$name}, আপনার নিবন্ধন সফলভাবে সম্পন্ন হয়েছে। — নাম্বার ওয়ান";
        if ($studentDetail) {
            $this->storeNotification($studentDetail, 'নিবন্ধন সম্পন্ন হয়েছে', $message, 'registration');
        }

        if (! $user->mobile) {
            return false;
        }

        return $this->sendSms($user->mobile, $message, $studentDetail?->id, 'registration');
    }

    public function sendBulk(array $applications, string $customMessage = ''): array
    {
        $sent   = 0;
        $failed = 0;

        foreach ($applications as $app) {
            /** @var StudentDetail $app */
            $body = $customMessage
                ? $this->customTemplate($app, $customMessage)
                : $this->approvedTemplate($app);

            $type  = $customMessage ? 'custom' : 'approved';
            $title = $customMessage ? 'নতুন বার্তা' : 'আবেদন অনুমোদিত হয়েছে';
            $this->storeNotification($app, $title, $body, $type);

            $mobile = $app->user->mobile ?? $app->parent_mobile;
            if (! $mobile) {
                $failed++;
                continue;
            }

            $ok = $this->sendSms($mobile, $body, $app->id, $type);

            if ($ok) {
                $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
                $sent++;
            } else {
                $failed++;
            }

                            // Brief pause to respect Twilio rate limits
            usleep(200000); // 200ms
        }

        return compact('sent', 'failed');
    }

    private function formatMobile(string $mobile): string
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);
        if (str_starts_with($mobile, '0')) {
            $mobile = substr($mobile, 1);
        }
        if (! str_starts_with($mobile, '880')) {
            $mobile = '880' . $mobile;
        }
        return '+' . $mobile;
    }

    private function maskMobile(string $mobile): string
    {
        if (strlen($mobile) <= 6) {
            return '***';
        }
        return substr($mobile, 0, 4) . str_repeat('*', strlen($mobile) - 6) . substr($mobile, -2);
    }

    public function otpTemplate(string $otp): string
    {
        // return "আপনার OTP কোড: {$otp}\n"
        //     . "এটি ৫ মিনিটের জন্য বৈধ।\n"
        //     . "— নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা - ২০২৬";
        return "আপনার OTP: {$otp}। ৫ মিনিটের জন্য বৈধ। - নাম্বার ওয়ান";
    }

    public function sendOtpSms(string $mobile, string $otp): bool
    {
        return $this->sendSms($mobile, $this->otpTemplate($otp), null, 'otp');
    }
}
