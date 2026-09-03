<?php

namespace App\Services;

use App\Models\CeremonyEntry;
use App\Models\StudentDetail;
use Exception;

class CeremonyEntryService
{

    public function verifyEntry(int $studentId): array
    {
        try {
            $existingEntry = CeremonyEntry::scannedToday($studentId)->first();
            if ($existingEntry) {
                return [
                    'success' => false,
                    'type' => 'already_scanned',
                    'message' => 'আপনি আজ ইতিমধ্যেই স্ক্যান করেছেন।',
                    'scanned_at' => $existingEntry->scanned_at->format('M d, Y h:i A'),
                ];
            }


            $studentDetail = StudentDetail::where('user_id', $studentId)
                ->with('applicationStatus')
                ->firstOrFail();

            $applicationStatus = $studentDetail->applicationStatus;

            if (!$applicationStatus || strtolower($applicationStatus->name) !== 'approved') {
                CeremonyEntry::create([
                    'student_id' => $studentId,
                    'student_detail_id' => $studentDetail->id,
                    'status' => 'denied',
                    'remarks' => 'Application status: ' . ($applicationStatus?->name ?? 'pending'),
                    'scanned_at' => now(),
                ]);

                return [
                    'success' => false,
                    'type' => 'not_approved',
                    'message' => 'আপনার আবেদনটি অনুমোদিত হয়নি।',
                    'current_status' => $applicationStatus?->name ?? '',
                ];
            }


            $entry = CeremonyEntry::create([
                'student_id' => $studentId,
                'student_detail_id' => $studentDetail->id,
                'status' => 'approved',
                'remarks' => 'Entry approved.',
                'scanned_at' => now(),
            ]);

            return [
                'success' => true,
                'type' => 'approved',
                'message' => 'প্রবেশ অনুমোদিত! নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬ আপনাকে স্বাগতম।',
                'entry_id' => $entry->id,
                'scanned_at' => $entry->scanned_at->format('M d, Y h:i A'),
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'type' => 'error',
                'message' => 'An error occurred. Please try again.',
            ];
        }
    }
}
