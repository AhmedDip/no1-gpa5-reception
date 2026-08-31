<?php

namespace App\Services;

use App\Models\CeremonyEntry;
use App\Models\StudentDetail;
use Exception;

class CeremonyEntryService
{
    /**
     * Verify and process ceremony entry
     */
    public function verifyEntry(int $studentId): array
    {
        try {
            // Check if already scanned today
            $existingEntry = CeremonyEntry::scannedToday($studentId)->first();
            if ($existingEntry) {
                return [
                    'success' => false,
                    'type' => 'already_scanned',
                    'message' => 'You have already scanned your entry today.',
                    'scanned_at' => $existingEntry->scanned_at->format('M d, Y h:i A'),
                ];
            }

            // Get student details
            $studentDetail = StudentDetail::where('user_id', $studentId)
                ->with('applicationStatus')
                ->firstOrFail();

            $applicationStatus = $studentDetail->applicationStatus;

            // Check if application is approved
            if (!$applicationStatus || strtolower($applicationStatus->name) !== 'approved') {
                // Record denied entry
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
                    'message' => 'Your application has not been approved.',
                    'current_status' => $applicationStatus?->name ?? 'Pending',
                ];
            }

            // Record approved entry
            $entry = CeremonyEntry::create([
                'student_id' => $studentId,
                'student_detail_id' => $studentDetail->id,
                'status' => 'approved',
                'scanned_at' => now(),
            ]);

            return [
                'success' => true,
                'type' => 'approved',
                'message' => 'Entry Granted! Welcome to the ceremony.',
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
