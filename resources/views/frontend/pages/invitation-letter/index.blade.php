<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নিমন্ত্রণপত্র</title>

    <style>
        @font-face {
            font-family: 'Kalpurush';
            src: url('{{ asset('fonts/kalpurush.woff2') }}') format('woff2'),
                 url('{{ asset('fonts/kalpurush.ttf') }}') format('truetype');
            font-style: normal;
            font-weight: 400;
            font-display: swap;
        }

        /* ----- RESET & BASE ----- */
        * {
            box-sizing: border-box;
        }
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        body {
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        /* ----- INVITATION CONTAINER ----- */
        .invitation {
            position: relative;
            width: min(100vw, 157.9vh);
            aspect-ratio: 297 / 188.067;
            overflow: hidden;
            background: #fff;
        }

        .invitation-image {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: fill;
            /* stretches to fill the container */;
        }

        .student-name {
            position: absolute;
            top: 15%;
            left: 15%;
            width: 70%;
            margin: 0;
            text-align: center;
            font-family: 'Kalpurush', sans-serif;
            font-size: clamp(10px, 1.8vw, 20px);
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.3;
            overflow-wrap: anywhere;
            pointer-events: none;
            /* so it doesn't block clicks */;
        }

        /* ----- PRINT STYLES (landscape PDF) ----- */
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                background: #fff;
                overflow: hidden;
                display: block;
                width: 100%;
                height: 100%;
            }

            body {
                display: block;
            }

            .invitation {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                aspect-ratio: auto;
                /* remove the fixed ratio so it fills the page */
                background: #fff;
                overflow: hidden;
            }

            .invitation-image {
                width: 100%;
                height: 100%;
                object-fit: fill;
                /* keep the same as screen – stretches */;
            }

            .student-name {
                font-size: clamp(20px, 2.2vw, 20px);
                /* slightly larger for print */
                top: 15%;
                left: 15%;
                width: 70%;
                color: #1a1a1a;
            }

            /* hide the print button */
            .print-button {
                display: none !important;
            }

            /* ensure background images & colors print */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }

        /* ----- PRINT BUTTON (screen only) ----- */
        .print-button {
            position: fixed;
            top: 550px;
            /* right: 10px; */
            padding: 10px 20px;
            background-color: #e93b75;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-family: system-ui, -apple-system, sans-serif;
            z-index: 9999;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: background-color 0.2s;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        .print-button:active {
            transform: scale(0.96);
        }
    </style>
</head>
<body>

    <main class="invitation" aria-label="নিমন্ত্রণপত্র">
        <img class="invitation-image" src="{{ asset('images/invitation-bg.jpg') }}" alt="নিমন্ত্রণপত্র">
        <p class="student-name">{{ $name }}</p>
    </main>

    <button class="print-button" id="printBtn">📄 Download PDF</button>

    <script>
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });
    </script>

</body>
</html>
