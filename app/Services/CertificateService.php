<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateService
{
    public function downloadCertificate()
    {
        $user = Auth::user();
        $name = $user->studentDetail->name ?? $user->name;
        $year = now()->year;
        $gender = $user->studentDetail->gender ?? 1;

        if ($gender == 1) {
            $imagePath = public_path('images/certificate_male.jpg');
        } else {
            $imagePath = public_path('images/certificate_female.jpg');
        }

        if (!file_exists($imagePath)) {
            throw new \Exception('Certificate background image not found at: ' . $imagePath);
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpg;base64,' . $imageData;


        $fontPath = public_path('fonts/Solistaria-Script-Italic.ttf');

        if (!file_exists($fontPath)) {
            throw new \Exception('Certificate font not found at: ' . $fontPath);
        }

        $certificateId = 'CERT-' . str_pad($user->id, 6, '0', STR_PAD_LEFT);

        $html = view('frontend.pages.certificate.template', compact(
            'name',
            'year',
            'imageSrc',
            'fontPath',
            'certificateId',
            'user'
        ))->render();


        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions([
            'defaultFont' => 'dejavu-sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 150,
            'isFontSubsettingEnabled' => true,
        ]);

        return $pdf->download("Certificate_{$user->id}_{$year}.pdf");
    }
}
