<?php

namespace App\Services;

use App\Helpers\BanglaPdfHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvitationLetterService
{
    public function downloadInvitation()
    {
        $user = Auth::user();
        $raw_name = $user?->studentDetail?->name_bn ?? $user?->name ?? 'Student';

            // Process Bangla text for PDF
            $processed_name = BanglaPdfHelper::prepareForPdf($raw_name);

        $imagePath = public_path('images/invitation-bg.jpg');

        if (!file_exists($imagePath)) {
            throw new \Exception('Invitation background image not found at: ' . $imagePath);
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;

       $html = view('frontend.pages.invitation-letter.template', compact('processed_name', 'imageSrc'))->render();

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'dpi' => 150,
                'defaultFont' => 'SolaimanLipi',
                'fontDir' => storage_path('fonts'),
                'fontCache' => storage_path('fonts/cache'),
                'isFontSubsettingEnabled' => true, // Important for Bangla
            ]);
        return $pdf->download("Invitation_{$user->id}.pdf");
    }
}
