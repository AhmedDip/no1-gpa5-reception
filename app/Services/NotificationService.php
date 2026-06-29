<?php
// app/Services/NotificationService.php

namespace App\Services;

use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    // ─── SMS Templates ────────────────────────────────────────────────────────

    /**
     * Approved SMS template (Bangla)
     */
    public function approvedTemplate(StudentDetail $app): string
    {
        $name     = $app->name_bn ?: $app->name_en;
        $roll     = $app->roll_number;
        $stallName = $app->tea_stall_name ?? 'আপনার চায়ের দোকান';

        return "প্রিয় {$name},\n\n"
            . "আপনার আবেদন (রোল: {$roll}) সফলভাবে অনুমোদিত হয়েছে।\n"
            . "নাম্বার ওয়ান বাবার কৃতি সন্তান সংবর্ধনা ২০২৬-এ আপনাকে আমন্ত্রণ।\n"
            . "সংবর্ধনার তারিখ ও স্থান শীঘ্রই SMS-এ জানানো হবে।\n\n"
            . "অভিনন্দন!\n"
            . "— নাম্বার ওয়ান ব্র্যান্ড";
    }

    /**
     * Rejected SMS template (Bangla)
     */
    public function rejectedTemplate(StudentDetail $app, string $remarks = ''): string
    {
        $name = $app->name_bn ?: $app->name_en;
        $roll = $app->roll_number;

        $msg = "প্রিয় {$name},\n\n"
            . "দুঃখিত, আপনার আবেদন (রোল: {$roll}) গ্রহণ করা সম্ভব হয়নি।";

        if ($remarks) {
            $msg .= "\nকারণ: {$remarks}";
        }

        $msg .= "\n\nআরও তথ্যের জন্য যোগাযোগ করুন।\n— নাম্বার ওয়ান ব্র্যান্ড";

        return $msg;
    }

    /**
     * Custom notification template
     */
    public function customTemplate(StudentDetail $app, string $message): string
    {
        $name = $app->name_bn ?: $app->name_en;

        return "প্রিয় {$name},\n\n{$message}\n\n— নাম্বার ওয়ান ব্র্যান্ড";
    }

    // ─── Send Methods ─────────────────────────────────────────────────────────

    /**
     * Send SMS via Twilio
     */
    public function sendSms(string $mobile, string $message): bool
    {
        try {
            $sid   = config('services.twilio.sid');
            $token = config('services.twilio.token');
            $from  = config('services.twilio.from');

            if (empty($sid) || empty($token) || empty($from)) {
                Log::warning('Twilio credentials not configured; SMS skipped.', ['mobile' => $this->maskMobile($mobile)]);
                return false;
            }

            $formattedMobile = $this->formatMobile($mobile);

            $client = new \Twilio\Rest\Client($sid, $token);
            $sms    = $client->messages->create($formattedMobile, [
                'from' => $from,
                'body' => $message,
            ]);

            Log::info('SMS sent', ['sid' => $sms->sid, 'mobile' => $this->maskMobile($formattedMobile)]);
            return true;
        } catch (\Twilio\Exceptions\RestException $e) {
            Log::error('Twilio SMS error: ' . $e->getMessage(), ['code' => $e->getCode()]);
            return false;
        } catch (\Exception $e) {
            Log::error('SMS error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send approved notification for a single application
     */
    public function notifyApproved(StudentDetail $app): bool
    {
        $mobile  = $app->user->mobile ?? $app->parent_mobile;
        if (!$mobile) {
            return false;
        }

        $message = $this->approvedTemplate($app);
        $sent    = $this->sendSms($mobile, $message);

        if ($sent) {
            $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
        }

        return $sent;
    }

    /**
     * Send rejected notification for a single application
     */
    public function notifyRejected(StudentDetail $app, string $remarks = ''): bool
    {
        $mobile = $app->user->mobile ?? $app->parent_mobile;
        if (!$mobile) {
            return false;
        }

        $message = $this->rejectedTemplate($app, $remarks);
        return $this->sendSms($mobile, $message);
    }

    /**
     * Send a custom bulk SMS to an array of StudentDetail records
     * Returns ['sent' => int, 'failed' => int]
     */
    public function sendBulk(array $applications, string $customMessage = ''): array
    {
        $sent   = 0;
        $failed = 0;

        foreach ($applications as $app) {
            /** @var StudentDetail $app */
            $mobile = $app->user->mobile ?? $app->parent_mobile;
            if (!$mobile) {
                $failed++;
                continue;
            }

            $body = $customMessage
                ? $this->customTemplate($app, $customMessage)
                : $this->approvedTemplate($app);

            $ok = $this->sendSms($mobile, $body);

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

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function formatMobile(string $mobile): string
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);
        if (str_starts_with($mobile, '0')) {
            $mobile = substr($mobile, 1);
        }
        if (!str_starts_with($mobile, '880')) {
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
}
