<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invitation Letter</title>
    <!-- Load Google Fonts with display=swap for better rendering -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&family=Noto+Serif+Bengali&display=swap"
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
                font-family: 'Noto Serif Bengali', 'Georgia', serif;
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
            top: 14%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 70%;
            text-align: center;
        }

        .student-name-web {
            position: absolute;
            top: 14%;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            text-align: center;
                font-family: 'Noto Serif Bengali', 'Georgia', serif;
            font-size: clamp(25px, 4vw, 15px);
            font-weight: 200;
            color: #1a1a1a;
            line-height: 1.3;
            padding: 5px 20px;
        }
    </style>

</head>

<body>
    <div class="page">
        <div class="background-image">
            <img src="{{ $imageSrc }}" alt="Invitation Letter Background">
        </div>

        <!-- Student Name Overlay -->
        <div class="student-name-container">
            <div class="student-name-pdf">
                {{ $name }}
            </div>
        </div>

    </div>
</body>
