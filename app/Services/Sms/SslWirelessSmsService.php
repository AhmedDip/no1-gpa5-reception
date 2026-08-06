<?php
// app/Services/Sms/SslWirelessSmsService.php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SslWirelessSmsService
{
    private const SUCCESS_CODE = 200;

    private const ERROR_MESSAGES = [
        200  => 'Success',
        4001 => 'Unauthorized',
        4002 => 'SID Not Permitted',
        4003 => 'IP Blacklisted',
        4004 => 'Invalid Request Format',
        4005 => 'End Point Not Found',
        4010 => 'Invalid CSMS ID',
        4011 => 'Required Parameter Missing',
        4012 => 'Duplicate CSMS ID',
        4013 => 'Duplicate MSISDN',
        4014 => 'Invalid MSISDN',
        4015 => 'Blocked MSISDN',
        4016 => 'Message Length Exceeded',
        4025 => 'Invalid Message Data',
        4030 => 'Too Many Requests',
        4035 => 'Client Signature Mismatch',
        4038 => 'Limit Exceeded',
        4039 => 'TPS Exceeded',
        4040 => 'Invalid SMS',
        4050 => 'Too Many OTP Requests',
        4060 => 'Unable to Decrypt SMS',
        5000 => 'Internal Error',
    ];

    /**
     * Send a single SMS. Mirrors BanglalinkSmsService::send() signature/shape
     * so NotificationService can dispatch to either provider identically.
     */
    public function send(string $mobile, string $message, bool $isUnicode = false): array
    {
        $payload = [
            'api_token' => config('services.sslwireless.api_token'),
            'sid'       => config('services.sslwireless.sid'),
            'msisdn'    => $this->normalizeMsisdn($mobile),
            'sms'       => $message,
            'csms_id'   => $this->generateCsmsId(),
        ];

        return $this->call($this->endpoint('/api/v3/send-sms'), $payload);
    }

    private function call(string $url, array $payload): array
    {
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->asJson()
                ->post($url, $payload);

            $body    = $response->json() ?? [];
            $code    = (int) ($body['status_code'] ?? $response->status());
            $success = $code === self::SUCCESS_CODE;

            if (!$success) {
                Log::warning('SSL Wireless SMS API returned non-success status', [
                    'status_code' => $code,
                    'csms_id'     => $payload['csms_id'] ?? null,
                    'response'    => $body,
                ]);
            }

            return [
                'success'     => $success,
                'status_code' => $code,
                'message'     => self::ERROR_MESSAGES[$code] ?? ($body['message'] ?? 'Unknown response'),
                'raw'         => $body,
            ];
        } catch (\Throwable $e) {
            Log::error('SSL Wireless SMS API request failed: ' . $e->getMessage());

            return [
                'success'     => false,
                'status_code' => null,
                'message'     => 'API request failed: ' . $e->getMessage(),
                'raw'         => null,
            ];
        }
    }

    private function normalizeMsisdn(string $mobile): string
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        if (str_starts_with($mobile, '0')) {
            $mobile = substr($mobile, 1);
        }
        if (!str_starts_with($mobile, '880')) {
            $mobile = '880' . $mobile;
        }

        return $mobile;
    }

    private function generateCsmsId(): string
    {
        // Must be unique per request — 4012 (Duplicate CSMS ID) is thrown otherwise
        return Str::upper(Str::random(8)) . time();
    }

    private function endpoint(string $path): string
    {
        return rtrim((string) config('services.sslwireless.domain'), '/') . $path;
    }
}
