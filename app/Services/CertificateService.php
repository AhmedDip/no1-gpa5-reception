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

        // Use asset() to get the URL
        $imageUrl = asset('images/certificate_background.png');

        // Get the content using HTTP
        $imageData = base64_encode(file_get_contents($imageUrl));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        $html = view('frontend.pages.certificate.template', compact('name', 'year', 'imageSrc'))->render();

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions([
            'defaultFont' => 'dejavu-sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 150,
        ]);

        return $pdf->download("Certificate_{$user->id}_{$year}.pdf");
    }
}
