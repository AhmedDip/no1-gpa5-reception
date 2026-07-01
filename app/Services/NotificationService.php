<?php
// app/Services/NotificationService.php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{

    public function approvedTemplate(StudentDetail $app): string
    {
        $name      = $app->name_bn ?: $app->name_en;
        $roll      = $app->roll_number;
        $stallName = $app->tea_stall_name ?? 'আপনার চায়ের দোকান';

        return "প্রিয় {$name},\n\n"
            . "আপনার আবেদন (রোল: {$roll}) সফলভাবে অনুমোদিত হয়েছে।\n"
            . "নাম্বার ওয়ান বাবার কৃতি সন্তান সংবর্ধনা ২০২৬-এ আপনাকে আমন্ত্রণ।\n"
            . "সংবর্ধনার তারিখ ও স্থান শীঘ্রই SMS-এ জানানো হবে।\n\n"
            . "অভিনন্দন!\n"
            . "— নাম্বার ওয়ান ব্র্যান্ড";
    }

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

    public function customTemplate(StudentDetail $app, string $message): string
    {
        $name = $app->name_bn ?: $app->name_en;

        return "প্রিয় {$name},\n\n{$message}\n\n— নাম্বার ওয়ান ব্র্যান্ড";
    }

 
    public function sendSms(string $mobile, string $message, ?int $studentDetailId = null, string $type = 'custom'): bool
    {
        $driver = config('services.sms.driver', 'log');
        $result = $this->dispatch($driver, $mobile, $message);

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

        return $result['success'];
    }

    public function notifyApproved(StudentDetail $app): bool
    {
        $mobile = $app->user->mobile ?? $app->parent_mobile;
        if (!$mobile) {
            return false;
        }

        $message = $this->approvedTemplate($app);
        $sent    = $this->sendSms($mobile, $message, $app->id, 'approved');

        if ($sent) {
            $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
        }

        return $sent;
    }

    public function notifyRejected(StudentDetail $app, string $remarks = ''): bool
    {
        $mobile = $app->user->mobile ?? $app->parent_mobile;
        if (!$mobile) {
            return false;
        }

        $message = $this->rejectedTemplate($app, $remarks);
        $sent    = $this->sendSms($mobile, $message, $app->id, 'rejected');

        if ($sent) {
            $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
        }

        return $sent;
    }


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

            $ok = $this->sendSms($mobile, $body, $app->id, $customMessage ? 'custom' : 'approved');

            if ($ok) {
                $app->update(['sms_sent_at' => now(), 'notification_sent' => true]);
                $sent++;
            } else {
                $failed++;
            }

            usleep(200000); 
        }

        return compact('sent', 'failed');
    }


    private function dispatch(string $driver, string $mobile, string $message): array
    {
        return match ($driver) {
            'twilio' => $this->sendViaTwilio($mobile, $message),
            default  => $this->sendViaLog($mobile, $message),
        };
    }

 
    private function sendViaLog(string $mobile, string $message): array
    {
        Log::info(' [SMS TEST MODE — not actually delivered]', [
            'to'      => $this->maskMobile($mobile),
            'message' => $message,
        ]);

        return [
            'success'  => true,
            'response' => 'Logged only (driver=log) — no real SMS sent.',
        ];
    }

    private function sendViaTwilio(string $mobile, string $message): array
    {
        try {
            $sid   = config('services.twilio.sid');
            $token = config('services.twilio.token');
            $from  = config('services.twilio.from');

            if (empty($sid) || empty($token) || empty($from)) {
                Log::warning('Twilio credentials missing; SMS skipped.', ['mobile' => $this->maskMobile($mobile)]);
                return ['success' => false, 'response' => 'Twilio credentials missing'];
            }

            $formattedMobile = $this->formatMobile($mobile);

            $client = new \Twilio\Rest\Client($sid, $token);
            $sms    = $client->messages->create($formattedMobile, [
                'from' => $from,
                'body' => $message,
            ]);

            Log::info('SMS sent via Twilio', ['sid' => $sms->sid, 'mobile' => $this->maskMobile($formattedMobile)]);
            return ['success' => true, 'response' => $sms->sid];
        } catch (\Twilio\Exceptions\RestException $e) {
            Log::error('Twilio SMS error: ' . $e->getMessage(), ['code' => $e->getCode()]);
            return ['success' => false, 'response' => $e->getMessage()];
        } catch (\Exception $e) {
            Log::error('SMS error: ' . $e->getMessage());
            return ['success' => false, 'response' => $e->getMessage()];
        }
    }


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
