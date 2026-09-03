<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invitation Letter</title>

    <style>
        @font-face {
            font-family: 'SolaimanLipi';
            src: url("{{ storage_path('fonts/SolaimanLipi-Normal.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif;
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

        .student-name-container {
            position: absolute;
            top: 14%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 80%;
            text-align: center;
        }

        .student-name-pdf {
            font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif;
            font-size: clamp(28px, 4.5vw, 52px);
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.6;
            padding: 10px 20px;
            letter-spacing: 1px;
            word-break: break-word;
            text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.6);
        }

        /* For debugging - shows if font loaded */
        .font-test {
            font-family: 'SolaimanLipi', sans-serif;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="background-image">
            <img src="{{ $imageSrc }}" alt="Invitation Letter Background">
        </div>

        <div class="student-name-container">
            <div class="student-name-pdf">
                {!! $processed_name !!}
            </div>
        </div>
    </div>
</body>
</html>
