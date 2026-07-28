<?php
// app/Services/Sms/BanglalinkSmsService.php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BanglalinkSmsService
{
    private const SUCCESS_CODE = '1000';

    /** Error code => human-readable message, straight from the API docs */
    private const ERROR_MESSAGES = [
        '1000' => 'Success',
        '1001' => 'IP Blacklist',
        '1002' => 'Invalid Username',
        '1003' => 'Invalid Password',
        '1004' => 'Parameter missing - CLI not found',
        '1005' => 'Invalid Parameter - client transaction id is not unique',
        '1006' => 'CLI/Masking Invalid',
        '1007' => 'Account Barred',
        '1008' => 'Insufficient Balance',
        '1009' => 'DND User',
        '1010' => 'Invalid MSISDN',
        '1011' => 'Duplicate Transaction ID',
        '1012' => 'Message length exceed',
        '1013' => 'No Request found',
        '1014' => 'Delivery pending',
        '1015' => 'TPS Limit Exceeded',
        '1016' => 'Number Barred',
        '1017' => 'API is not allowed for user',
        '1018' => 'No Live Campaign',
        '1019' => 'Message body Invalid',
        '1020' => 'Internal Server Error',
        '1050' => 'Allowed campaigns limit exceeded',
        '1051' => 'Allowed SMS quota is completed',
    ];

    /**
     * Send a single SMS. Returns a normalized array regardless of success/failure,
     * so the caller never has to deal with raw HTTP/JSON shapes.
     */
    public function send(string $mobile, string $message, bool $isUnicode = false): array
    {
        $payload = [
            'username'      => config('services.banglalink.username'),
            'password'      => config('services.banglalink.password'),
            'apicode'       => config('services.banglalink.apicode', '5'),
            'msisdn'        => [$this->normalizeMsisdn($mobile)],
            'countrycode'   => config('services.banglalink.country_code', '880'),
            'cli'           => config('services.banglalink.cli', 'No.1'),
            'messagetype'   => $isUnicode ? '3' : '1', // 3 = Unicode(Bangla), 1 = English text
            'message'       => $message,
            'clienttransid' => $this->generateTransId(),
            'bill_msisdn'   => config('services.banglalink.bill_msisdn'),
            'tran_type'     => 'T', // Transactional
            'request_type'  => 'S', // Single
            'rn_code'       => config('services.banglalink.rn_code', '91'),
        ];

        return $this->call(config('services.banglalink.sms_url'), $payload);
    }

    public function checkBalance(): array
    {
        return $this->call(config('services.banglalink.ecm_url'), [
            'username'      => config('services.banglalink.username'),
            'password'      => config('services.banglalink.password'),
            'apicode'       => '3',
            'clienttransid' => $this->generateTransId(),
        ]);
    }

    public function checkCli(): array
    {
        return $this->call(config('services.banglalink.ecm_url'), [
            'username'      => config('services.banglalink.username'),
            'password'      => config('services.banglalink.password'),
            'apicode'       => '2',
            'cli'           => config('services.banglalink.cli'),
            'clienttransid' => $this->generateTransId(),
        ]);
    }

    public function deliveryStatus(string $mobile, string $operatorTransId): array
    {
        return $this->call(config('services.banglalink.ecm_url'), [
            'username'        => config('services.banglalink.username'),
            'password'        => config('services.banglalink.password'),
            'apicode'         => '4',
            'msisdn'          => [$this->normalizeMsisdn($mobile)],
            'countrycode'     => config('services.banglalink.country_code', '880'),
            'cli'             => config('services.banglalink.cli'),
            'messagetype'     => '1',
            'clienttransid'   => $this->generateTransId(),
            'operatortransid' => $operatorTransId,
        ]);
    }

    private function call(string $url, array $payload): array
    {
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->asJson()
                ->post($url, $payload);

            $status = $response->json('statusInfo', []);
            $code   = (string) ($status['statusCode'] ?? '');
            $success = $code === self::SUCCESS_CODE;

            if (!$success) {
                Log::warning('Banglalink SMS API returned non-success status', [
                    'status_code'   => $code,
                    'clienttransid' => $payload['clienttransid'] ?? null,
                ]);
            }

            return [
                'success'     => $success,
                'status_code' => $code ?: null,
                'message'     => self::ERROR_MESSAGES[$code] ?? ($status['errordescription'] ?? 'Unknown response'),
                'raw'         => $status,
            ];
        } catch (\Throwable $e) {
            Log::error('Banglalink SMS API request failed: ' . $e->getMessage());

            return [
                'success'     => false,
                'status_code' => null,
                'message'     => 'API request failed: ' . $e->getMessage(),
                'raw'         => null,
            ];
        }
    }

    /**
     * API samples use 880-prefixed MSISDN without '+' (e.g. 8801XXXXXXXXX).
     * Reusing the same normalization pattern already used in NotificationService::formatMobile().
     */
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

    private function generateTransId(): string
    {
        // Must be unique per request; Banglalink disallows reuse within 5 minutes
        return Str::upper(Str::random(8)) . time();
    }
}
