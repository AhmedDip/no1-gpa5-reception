<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invitation Letter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: kalpurush, sans-serif;
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

        .student-name-container {
            position: absolute;
            top: 14%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 70%;
            text-align: center;
        }

        .student-name-pdf {
            font-family: kalpurush, sans-serif;
            font-size: 28px;
            font-weight: normal;
            color: #000;
            line-height: 1.4;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="background-image">
            <img src="{{ $imageSrc }}" alt="Invitation Letter Background">
        </div>

        <div class="student-name-container">
            <div class="student-name-pdf">{{ $name }}</div>
        </div>
    </div>
</body>
</html>
