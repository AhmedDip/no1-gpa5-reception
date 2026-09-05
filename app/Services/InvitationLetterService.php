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

        $fontPath = public_path('fonts/kalpurush.ttf');

        if (!file_exists($fontPath)) {
            throw new \Exception('Bengali font not found');
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
        $fontData = base64_encode(file_get_contents($fontPath));
        $fontSrc = 'data:font/truetype;base64,' . $fontData;

        $html = view('frontend.pages.invitation-letter.template', compact('name', 'imageSrc', 'fontSrc'))->render();

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper([0, 0, 841.89, 533.86], 'landscape');

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
