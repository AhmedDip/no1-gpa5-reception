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

        // Convert image to base64
        // $imagePath = public_path('images/certificate_background.png');

        if ($gender == 1)
            {
                $imagePath = public_path('images/certificate_male.jpg');
            }
            else {
                $imagePath =  public_path('images/certificate_female.jpg');
            }

        if (!file_exists($imagePath)) {
            throw new \Exception('Certificate background image not found at: ' . $imagePath);
        }

        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpg;base64,' . $imageData;

        // Pass data to view
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
