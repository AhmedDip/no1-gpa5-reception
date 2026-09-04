<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvitationLetterService
{
    public function downloadInvitation()
    {
        $user = Auth::user();

        // Get Bengali name
        $name = $user?->studentDetail?->name_bn ?? $user?->name ?? 'Student';

        $imagePath = public_path('images/invitation-bg.jpg');

        if (!file_exists($imagePath)) {
            throw new \Exception('Invitation background image not found');
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;

        $html = view('frontend.pages.invitation-letter.template', compact('name', 'imageSrc'))->render();

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('a4', 'landscape');

        // THIS IS KEY - Use kalpurush font
        $pdf->setOptions([
            'defaultFont'           => 'kalpurush',
            'isHtml5ParserEnabled'  => true,
            'isRemoteEnabled'       => true,
            'isFontSubsettingEnabled' => false,
            'dpi'                   => 150,
        ]);

        return $pdf->download("Invitation_{$user->id}.pdf");
    }
}
