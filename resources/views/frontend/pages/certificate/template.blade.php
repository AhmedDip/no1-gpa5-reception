<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate</title>

    <!-- Load Google Fonts with display=swap for better rendering -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: 'DejaVu Sans', 'Noto Serif Bengali', sans-serif;
        }

        .page {
            width: 100%;
            height: 100vh;
            position: relative;
            page-break-after: avoid;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .background-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Student Name Container */
        .student-name-container {
            position: absolute;
            top: 38%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 70%;
            text-align: center;
        }

        .student-name-pdf {
            font-family: 'Great Vibes', 'Dancing Script', cursive !important;
            font-size: 90px;
            font-weight: 400;
            color: #1a1a1a;
            line-height: 1.3;
            padding: 5px 20px;
            display: inline-block;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .certificate-id {
            position: absolute;
            bottom: 8%;
            right: 10%;
            z-index: 2;
            font-size: 12px;
            color: #666;
            font-family: 'DejaVu Sans', sans-serif;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .student-name-container {
                top: 40%;
                width: 80%;
            }

            .student-name-pdf {
                font-size: 32px;
            }
        }

        /* Print/PDF specific styles */
        @media print {
            body {
                background: #fff;
            }

            .page {
                height: 100vh;
                page-break-after: avoid;
            }
        }

        @page {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="page">

        <div class="background-image">
            <img src="{{ $imageSrc }}" alt="Certificate Background">
        </div>

        <!-- Student Name Overlay  -->
        <div class="student-name-container">
            <div class="student-name-pdf" style="font-family: 'Great Vibes', cursive !important;">
                {{ $name }}
            </div>
        </div>

        <!-- Certificate ID -->
        <div class="certificate-id">
            Certificate No: CERT-{{ str_pad(Auth::id() ?? 1, 6, '0', STR_PAD_LEFT) }}
        </div>
    </div>
</body>

</html>
