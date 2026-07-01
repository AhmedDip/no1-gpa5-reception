@extends('frontend.layouts.app')

@section('title', 'সার্টিফিকেট | No.1 Babar Kriti Santan Songbordhona’26')

@section('content')

    <style>
        .cert-wrapper {
            position: relative;
            width: 100%;
            max-width: 1000px;
            aspect-ratio: 4 / 3;
            background-image: url('{{ asset('images/certificate_background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            overflow: hidden;
            ma
        }

        /* Content Overlay Container */
        .cert-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 8% 12% 5% 12%;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        /* Typography Styles */
        .cert-header-title {
            font-family: 'Cinzel', serif;
            color: #000000;
            font-weight: 800;
            letter-spacing: 4px;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
        }

        .cert-subtitle {
            font-family: 'Montserrat', sans-serif;
            color: #475569;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .cert-present-text {
            font-family: 'Great Vibes', cursive;
            color: #64748b;
            font-size: 1.8rem;
        }

        .cert-recipient-name {
            font-family: 'Noto Serif Bengali', serif;
            color: #0f2e47;
            /* Deep luxury navy matching the top arch */
            font-weight: 700;
            font-size: 3rem;
            display: inline-block;
            padding-bottom: 5px;
        }

        .cert-description {
            font-family: 'Noto Serif Bengali', serif;
            color: #050505;
            font-size: 1.15rem;
            line-height: 1.8;
            max-width: 750px;
            margin: 0 auto;
            background-color: rgba(225, 231, 254, 0.192);
        }

        /* Signature styling positioned strictly over the template's bottom-left accent lines */
        .cert-footer-section {
            margin-bottom: 2%;
        }

        .signature-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }

        .signature-font {
            font-family: 'Great Vibes', cursive;
            font-size: 1.6rem;
            color: #1e293b;
            line-height: 1;
        }

        /* Responsive adjustments for mid-size displays */
        @media (max-width: 768px) {
            .cert-recipient-name {
                font-size: 2rem;
            }

            .cert-description {
                font-size: 0.9rem;
                line-height: 1.5;
                background-color: rgba(234, 232, 255, 0.214);
            }

            .cert-header-title {
                font-size: 1.75rem;
            }
        }
    </style>

    <div class="py-5 mt-5 px-3 d-flex justify-content-center align-items-center bg-light" style="min-height: 100vh;">

        <div class="cert-wrapper">

            <div class="cert-content text-center">

                <div class="mt-4">
                    <h1 class="cert-header-title display-5 mb-1">CERTIFICATE OF HONOUR</h1>
                    <p class="cert-subtitle mb-0">No.1 Babar Kriti Santan Songbordhona’26</p>
                    <div class="cert-present-text mt-2">This certificate is proudly presented to</div>
                </div>

                <div class="my-2">
                    <span class="cert-recipient-name">{{ $name ?? 'আহমেদ রাশিদুন বারী দ্বীপ' }}</span>
                    <div class="mx-auto"
                        style="width: 40%; height: 2px; background: linear-gradient(to right, transparent, #2c4a5e, transparent);">
                    </div>
                </div>

                <div>
                    <p class="cert-description">
                        পিতার প্রতি অকৃত্রিম ভালোবাসা, দায়িত্বশীলতা এবং সমাজ গঠনে একজন কৃতি সন্তান হিসেবে অনন্য অবদানের
                        স্বীকৃতিস্বরূপ এই বিশেষ সম্মাননা প্রদান করা হলো। আপনার ভবিষ্যৎ জীবন উত্তরোত্তর সাফল্যমণ্ডিত হোক।
                    </p>
                </div>

                <div class="cert-footer-section row align-items-end text-start">
                    <div class="col-12 row text-center">

                        <div class="col-4">
                            <span class="font-monospace fw-bold text-dark" style="font-size: 0.95rem;">২১ জুন, ২০২৬</span>
                            <div style="width: 80%; height: 1px; background-color: #cbd5e1; margin: 4px auto;"></div>
                            <div class="signature-title">তারিখ (Date)</div>
                        </div>

                        <div class="col-4">
                            <span class="signature-font">Committee Head</span>
                            <div style="width: 80%; height: 1px; background-color: #cbd5e1; margin: 4px auto;"></div>
                            <div class="signature-title">প্রধান পৃষ্ঠপোষক</div>
                        </div>

                        <div class="col-4">
                            <span class="signature-font">Chairperson</span>
                            <div style="width: 80%; height: 1px; background-color: #cbd5e1; margin: 4px auto;"></div>
                            <div class="signature-title">সভাপতি</div>
                        </div>

                    </div>

                    <div class="col-5"></div>
                </div>

            </div>
        </div>

    </div>
@endsection
