<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Noto Serif Bengali', serif;
            margin: 0;
            padding: 0;
            background: #fff;
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

        /* Exact positioning for student name */
        .student-name-container {
            position: absolute;
            top: 42%; /* Adjust this percentage to match your image */
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 70%;
            text-align: center;
        }

        .student-name-pdf {
            font-size: 48px;
            font-weight: 700;
            color: #1a1a1a;
            font-family: 'DejaVu Sans', 'Noto Serif Bengali', serif;
            line-height: 1.3;
            padding: 5px 20px;
            display: inline-block;
        }

        /* Certificate ID */
        .certificate-id {
            position: absolute;
            bottom: 8%;
            right: 10%;
            z-index: 2;
            font-size: 12px;
            color: #666;
            font-family: 'DejaVu Sans', sans-serif;
        }

        @media (max-width: 768px) {
            .student-name-container {
                top: 40%;
                width: 80%;
            }
            .student-name-pdf {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Background Image -->
        <div class="background-image">
            <img src="{{ $imageSrc }}" alt="Certificate Background">
        </div>

        <!-- Student Name Overlay -->
        <div class="student-name-container">
            <div class="student-name-pdf">
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
