<?php
// app/Services/OtpService.php

namespace App\Services;

use App\Models\User;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class OtpService
{
    /**
     * Generate and send OTP for user
     */
    public function __construct(private NotificationService $notificationService) {}

    public function generateAndSendOtp(User $user): array
    {
        try {
            $otp = $this->generateOtp();
            $expiresAt = now()->addMinutes(5);

            Log::info("Generating OTP for user: {$user->id}, Mobile: {$user->mobile}");

            OtpVerification::where('user_id', $user->id)
                ->where('is_verified', false)
                ->update(['is_verified' => false, 'expires_at' => now()]);

            $otpRecord = OtpVerification::create([
                'user_id'         => $user->id,
                'mobile'          => $user->mobile,
                'otp_code'        => $otp,
                'expires_at'      => $expiresAt,
                'is_verified'     => false,
                'attempts'        => 0,
                'ip_address'      => Request::ip(),
                'user_agent'      => Request::userAgent(),
            ]);

            $sent = $this->sendOtp($user->mobile, $otp);

            if ($sent) {
                return [
                    'success'       => true,
                    'message'       => 'OTP পাঠানো হয়েছে',
                    'otp_record_id' => $otpRecord->id,
                ];
            }

            return ['success' => false, 'message' => 'OTP পাঠাতে ব্যর্থ হয়েছে'];
        } catch (\Exception $e) {
            Log::error('OTP Generation Error: ' . $e->getMessage());
            return ['success' => false, 'message' => 'OTP তৈরি করতে ব্যর্থ হয়েছে: ' . $e->getMessage()];
        }
    }
    /**
     * Generate random 6-digit OTP
     */
    private function generateOtp(): string
    {
        return str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }
    /**
     * Send OTP via SMS
     */
    private function sendOtp(string $mobile, string $otp): bool
    {
        try {
            Log::info("OTP generated for mobile: {$this->maskMobile($mobile)}");

            // Local/dev convenience only — controlled by SHOW_TEST_OTP env flag,
            // NOT by APP_ENV. Whether a *real* SMS goes out is decided solely by
            // SMS_DRIVER (log vs banglalink) inside NotificationService — the
            // exact same rule Approve/Reject/Notify already follow.
            if (config('services.sms.show_test_otp')) {
                session(['test_otp' => $otp]);
                session(['test_otp_mobile' => $mobile]);
            }

            return $this->notificationService->sendOtpSms($mobile, $otp);
        } catch (\Exception $e) {
            Log::error('Send OTP Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(User $user, string $otp, bool $markMobileVerified = true): array
    {
        try {
            Log::info("Verifying OTP for user: {$user->id}, Input OTP: {$otp}");

            if ($markMobileVerified && $user->is_mobile_verified) {
                return [
                    'success' => false,
                    'message' => 'মোবাইল নম্বর ইতিমধ্যে যাচাই করা হয়েছে'
                ];
            }

            $otpRecord = OtpVerification::where('user_id', $user->id)
                ->where('is_verified', false)
                ->where('expires_at', '>', now())
                ->latest()
                ->first();

            // Log::info("Found OTP Record: " . ($otpRecord ? json_encode($otpRecord->toArray()) : 'None'));

            if (!$otpRecord) {
                return [
                    'success' => false,
                    'message' => 'OTP পাওয়া যায়নি বা মেয়াদ শেষ হয়েছে। দয়া করে নতুন OTP অনুরোধ করুন।'
                ];
            }

            if ($otpRecord->isExpired()) {
                return [
                    'success' => false,
                    'message' => 'OTP এর মেয়াদ শেষ হয়েছে। দয়া করে নতুন OTP অনুরোধ করুন।'
                ];
            }

            if ($otpRecord->isMaxAttemptsReached()) {
                return [
                    'success' => false,
                    'message' => 'অনেকবার চেষ্টা করেছেন। দয়া করে নতুন OTP অনুরোধ করুন।'
                ];
            }

            // Log::info("Comparing OTP: Record: {$otpRecord->otp_code}, Input: {$otp}");

            if ($otpRecord->otp_code !== $otp) {
                $otpRecord->increment('attempts');
                $otpRecord->update(['last_attempt_at' => now()]);

                $remaining = 5 - $otpRecord->attempts;
                return [
                    'success' => false,
                    'message' => "ভুল OTP। {$remaining} বার চেষ্টা করতে পারবেন।"
                ];
            }

            $otpRecord->update([
                'is_verified' => true,
                'verified_at' => now(),
            ]);

            if ($markMobileVerified) {
                $user->update([
                    'is_mobile_verified' => true,
                    'mobile_verified_at' => now(),
                ]);
            }

            session()->forget(['test_otp', 'test_otp_mobile']);

            // Log::info("OTP Verified Successfully for user: {$user->id}");

            return [
                'success' => true,
                'message' => $markMobileVerified
                    ? 'মোবাইল নম্বর সফলভাবে যাচাই করা হয়েছে'
                    : 'OTP সফলভাবে যাচাই করা হয়েছে',
            ];
        } catch (\Exception $e) {
            Log::error('OTP Verification Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'OTP যাচাই করতে ব্যর্থ হয়েছে: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(User $user): array
    {
        try {
            // Check if already verified
            if ($user->is_mobile_verified) {
                return [
                    'success' => false,
                    'message' => 'মোবাইল নম্বর ইতিমধ্যে যাচাই করা হয়েছে'
                ];
            }

            // Get latest OTP record
            $latestOtp = OtpVerification::where('user_id', $user->id)
                ->where('is_verified', false)
                ->latest()
                ->first();

            // Rate limiting check
            if ($latestOtp && !$latestOtp->canResend()) {
                return [
                    'success' => false,
                    'message' => 'আবার চেষ্টা করার জন্য ৬০ সেকেন্ড অপেক্ষা করুন'
                ];
            }

            // Generate new OTP
            return $this->generateAndSendOtp($user);
        } catch (\Exception $e) {
            Log::error('Resend OTP Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'OTP পুনরায় পাঠাতে ব্যর্থ হয়েছে'
            ];
        }
    }



    private function formatMobileNumber(string $mobile): string
    {
        // Remove any non-numeric characters
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        // Check if number starts with 0
        if (str_starts_with($mobile, '0')) {
            $mobile = substr($mobile, 1); // Remove leading 0
        }

        // Add Bangladesh country code (+88) if not present
        if (!str_starts_with($mobile, '880')) {
            $mobile = '880' . $mobile;
        }

        // Add '+' prefix for E.164 format
        return $mobile;
    }

    /**
     * Get OTP message with branding
     */
    private function getOtpMessage(string $otp): string
    {
        return "আপনার OTP কোড: {$otp}\n" .
            "এটি ৫ মিনিটের জন্য বৈধ।\n" .
            "— নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা - ২০২৬";
    }
    /**
     * Mask mobile number for logging
     */
    private function maskMobile(string $mobile): string
    {
        if (strlen($mobile) <= 6) {
            return '***';
        }

        $visibleStart = substr($mobile, 0, 4);
        $visibleEnd = substr($mobile, -2);
        $masked = str_repeat('*', strlen($mobile) - 6);

        return $visibleStart . $masked . $visibleEnd;
    }

    /**
     * Check Twilio balance before sending
     */
    private function checkTwilioBalance(): bool
    {
        try {
            $client = new \Twilio\Rest\Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );

            $balance = $client->api->v2010->accounts(
                config('services.twilio.sid')
            )->fetch()->balance;

            if ($balance <= 0) {
                Log::warning('Twilio balance is low or empty', ['balance' => $balance]);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to check Twilio balance: ' . $e->getMessage());
            return false;
        }
    }


    public function deleteIfExpired(User $user): bool
    {
        if ($user->is_mobile_verified) {
            return false;
        }

        if ($user->created_at->gt(now()->subMinutes(1))) {
            return false;
        }

        $user->studentDetail()?->delete();
        $user->otpVerifications()->delete();
        $user->delete();

        return true;
    }
}
