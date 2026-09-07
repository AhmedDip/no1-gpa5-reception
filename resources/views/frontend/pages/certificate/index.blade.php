@extends('frontend.layouts.app')

@section('title', 'সার্টিফিকেট | No.1 Babar Kriti Santan Songbordhona’26')

@section('content')
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        /* ===== @FONT-FACE FOR SOLISTARIA SCRIPT-ITALIC ===== */
        @font-face {
            font-family: 'Solistaria Script';
            src: url('/fonts/Solistaria-Script-Italic.woff2') format('woff2'),
                url('/fonts/Solistaria-Script-Italic.woff') format('woff'),
                url('/fonts/Solistaria-Script-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== CERTIFICATE WRAPPER ===== */
        .certificate-wrapper {
            width: 100%;
            max-width: 1400px;
            margin: 40px auto;
            position: relative;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .certificate-wrapper:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* ===== CERTIFICATE CONTAINER ===== */
        .certificate-container {
            width: 100%;
            position: relative;
            background: #ffffff;
        }

        /* ===== CERTIFICATE IMAGE ===== */
        .certificate-image {
            width: 100%;
            height: auto;
            display: block;
            user-select: none;
            -webkit-user-drag: none;
        }

        /* ===== STUDENT NAME - WEB VERSION ===== */
        .student-name-web {
            position: absolute;
            top: 44%;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            text-align: center;

            /* ===== SOLISTARIA SCRIPT-ITALIC FONT ===== */
            font-family: 'Solistaria Script', cursive;
            font-style: italic;
            font-weight: normal;

            /* ===== SIZING - SLIGHTLY INCREASED ===== */
            font-size: clamp(50px, 9vw, 120px);
            line-height: 1.3;

            /* ===== COLOR & SPACING ===== */
            color: #1a1a1a;
            padding: 5px 20px;

            /* ===== TEXT EFFECTS ===== */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
            letter-spacing: 1px;

            /* ===== RESPONSIVE BEHAVIOR ===== */
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;

            /* ===== Z-INDEX ===== */
            z-index: 10;
        }

        /* ===== FALLBACK FOR OLDER BROWSERS ===== */
        @supports not (font-family: 'Solistaria Script') {
            .student-name-web {
                font-family: 'Great Vibes', 'Pacifico', cursive;
            }
        }

        /* ===== DOWNLOAD SECTION ===== */
        .download-section {
            padding: 30px;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 2px solid #dee2e6;
        }

        .download-section p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 15px;
            font-family: Arial, sans-serif;
        }

        /* ===== DOWNLOAD BUTTON ===== */
        .btn-download {
            display: inline-block;
            padding: 16px 45px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            font-family: 'Segoe UI', Arial, sans-serif;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            letter-spacing: 0.5px;
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1a6a9e 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-download:active {
            transform: translateY(0px);
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-download i {
            margin-right: 12px;
            font-size: 20px;
        }

        /* ===== SECONDARY BUTTON (OPTIONAL) ===== */
        .btn-secondary {
            display: inline-block;
            padding: 12px 30px;
            background: #6c757d;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Segoe UI', Arial, sans-serif;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1400px) {
            .student-name-web {
                font-size: clamp(45px, 8.5vw, 105px);
                top: 44%;
            }
        }

        @media (max-width: 1200px) {
            .student-name-web {
                font-size: clamp(40px, 7.5vw, 85px);
                top: 44%;
            }
        }

        @media (max-width: 992px) {
            .certificate-wrapper {
                margin: 30px auto;
                border-radius: 8px;
            }

            .student-name-web {
                font-size: clamp(35px, 6.5vw, 70px);
                top: 43%;
                width: 85%;
            }

            .btn-download {
                padding: 14px 35px;
                font-size: 17px;
            }
        }

        @media (max-width: 768px) {
            .certificate-wrapper {
                margin: 20px 10px;
                border-radius: 5px;
            }

            .student-name-web {
                font-size: clamp(25px, 5.5vw, 40px);
                top: 41%;
                width: 80%;
                padding: 3px 15px;
                letter-spacing: 0.5px;
            }

            .download-section {
                padding: 20px 15px;
            }

            .btn-download {
                padding: 12px 25px;
                font-size: 15px;
                width: 100%;
                max-width: 300px;
            }

            .btn-secondary {
                padding: 10px 20px;
                font-size: 14px;
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
                max-width: 300px;
            }

            .download-section .button-group {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .student-name-web {
                font-size: clamp(20px, 4.5vw, 32px);
                top: 40%;
                width: 75%;
                padding: 2px 10px;
            }

            .certificate-wrapper {
                margin: 10px 5px;
            }

            .btn-download {
                padding: 10px 20px;
                font-size: 14px;
            }

            .btn-download i {
                font-size: 16px;
                margin-right: 8px;
            }
        }

        @media (max-width: 400px) {
            .student-name-web {
                font-size: clamp(15px, 3.8vw, 22px);
                top: 38%;
                width: 70%;
                padding: 2px 8px;
            }
        }

        /* ===== PRINT STYLES ===== */
        @media print {
            body {
                background: #ffffff;
                margin: 0;
                padding: 0;
            }

            .certificate-wrapper {
                box-shadow: none;
                margin: 0;
                border-radius: 0;
                max-width: 100%;
            }

            .download-section {
                display: none !important;
            }

            .student-name-web {
                font-family: 'Solistaria Script', cursive !important;
                font-style: italic !important;
                color: #000000 !important;
                text-shadow: none !important;
                font-size: 110px !important;
            }

            .certificate-image {
                max-width: 100%;
                height: auto;
            }
        }

        /* ===== DARK MODE SUPPORT ===== */
        @media (prefers-color-scheme: dark) {
            .certificate-wrapper {
                background: #1a1a1a;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            }

            .student-name-web {
                color: #ffffff;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .download-section {
                background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
                border-top-color: #404040;
            }

            .download-section p {
                color: #adb5bd;
            }

            .btn-download {
                background: linear-gradient(135deg, #2980b9 0%, #1a6a9e 100%);
            }

            .btn-download:hover {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            }
        }

        /* ===== ACCESSIBILITY ===== */
        @media (prefers-reduced-motion: reduce) {

            .certificate-wrapper,
            .btn-download,
            .btn-secondary {
                transition: none !important;
            }

            .btn-download:hover {
                transform: none !important;
            }
        }

        /* ===== HIGH DPI SCREENS ===== */
        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {
            .certificate-image {
                image-rendering: auto;
            }
        }

        /* ===== FOCUS STATE FOR ACCESSIBILITY ===== */
        .btn-download:focus-visible,
        .btn-secondary:focus-visible {
            outline: 3px solid #3498db;
            outline-offset: 3px;
        }

        /* ===== LOADING STATE ===== */
        .btn-download.loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .btn-download.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translateY(-50%) rotate(360deg);
            }
        }
    </style>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="container-fluid px-3" style="margin-top: 120px; margin-bottom: 20px;">
        <div class="certificate-wrapper">
            <div class="certificate-container">
                <!-- ===== CERTIFICATE IMAGE ===== -->
                @if ($user->studentDetail && $user->studentDetail->gender == 2)
                    <img src="{{ asset('images/certificate_female.png') }}" alt="Certificate for Female Student"
                        class="certificate-image" loading="lazy" width="1400" height="auto">
                @else
                    <img src="{{ asset('images/certificate_male.png') }}" alt="Certificate for Male Student"
                        class="certificate-image" loading="lazy" width="1400" height="auto">
                @endif

                <!-- ===== STUDENT NAME OVERLAY ===== -->
                <div class="student-name-web" aria-label="Student Name: {{ $name }}">
                    {{ $name }}
                </div>
            </div>

            <!-- ===== DOWNLOAD SECTION ===== -->
            <div class="download-section">
                <p>
                    <i class="fas fa-info-circle" style="color: #6c757d; margin-right: 5px;"></i>
                    Click the button below to download your certificate as a PDF
                </p>

                <div class="button-group">
                    <button type="button" class="btn-download" aria-label="Download PDF Certificate">
                        <i class="fas fa-download"></i> Download Certificate PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== JAVASCRIPT FOR ENHANCED FUNCTIONALITY ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== DOWNLOAD CERTIFICATE AS A PDF =====
            const downloadBtn = document.querySelector('.btn-download');

            if (downloadBtn) {
                downloadBtn.addEventListener('click', async function() {
                    const certificateImage = document.querySelector('.certificate-image');
                    const nameElement = document.querySelector('.student-name-web');
                    const container = document.querySelector('.certificate-container');
                    const originalContent = this.innerHTML;

                    if (!certificateImage || !nameElement || !container) return;

                    this.classList.add('loading');
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing PDF...';

                    try {
                        if (!window.jspdf || !window.jspdf.jsPDF) {
                            throw new Error('jsPDF library is unavailable');
                        }

                        await document.fonts.load('italic 90px "Solistaria Script"');

                        const image = new Image();
                        image.src = certificateImage.currentSrc || certificateImage.src;
                        await image.decode();

                        const canvas = document.createElement('canvas');
                        canvas.width = image.naturalWidth;
                        canvas.height = image.naturalHeight;

                        const context = canvas.getContext('2d');
                        context.drawImage(image, 0, 0, canvas.width, canvas.height);

                        const scale = canvas.width / container.clientWidth;
                        const nameStyle = window.getComputedStyle(nameElement);
                        const nameRect = nameElement.getBoundingClientRect();
                        const containerRect = container.getBoundingClientRect();
                        const centerX = (nameRect.left - containerRect.left + nameRect.width / 2) *
                            scale;
                        const centerY = (nameRect.top - containerRect.top + nameRect.height / 2) *
                            scale;
                        const fontSize = parseFloat(nameStyle.fontSize) * scale;

                        context.font =
                            `${nameStyle.fontStyle} ${nameStyle.fontWeight} ${fontSize}px "Solistaria Script"`;
                        context.fillStyle = nameStyle.color;
                        context.textAlign = 'center';
                        context.textBaseline = 'middle';
                        context.fillText(nameElement.textContent.trim(), centerX, centerY);

                        const {
                            jsPDF
                        } = window.jspdf;
                        const pdf = new jsPDF({
                            orientation: 'landscape',
                            unit: 'mm',
                            format: 'a4'
                        });
                        const pageWidth = pdf.internal.pageSize.getWidth();
                        const pageHeight = pdf.internal.pageSize.getHeight();
                        const imageRatio = canvas.width / canvas.height;
                        let pdfWidth = pageWidth;
                        let pdfHeight = pageWidth / imageRatio;

                        if (pdfHeight > pageHeight) {
                            pdfHeight = pageHeight;
                            pdfWidth = pageHeight * imageRatio;
                        }

                        pdf.addImage(
                            canvas.toDataURL('image/png'),
                            'PNG',
                            (pageWidth - pdfWidth) / 2,
                            (pageHeight - pdfHeight) / 2,
                            pdfWidth,
                            pdfHeight
                        );
                        pdf.save('certificate-{{ $user->id }}.pdf');
                    } catch (error) {
                        console.error('Certificate PDF generation failed:', error);
                        alert('Unable to download the certificate PDF. Please try again.');
                    } finally {
                        this.classList.remove('loading');
                        this.innerHTML = originalContent;
                    }
                });
            }

            // ===== RESPONSIVE FONT SIZE ADJUSTMENT =====
            function adjustFontSize() {
                const nameElement = document.querySelector('.student-name-web');
                if (!nameElement) return;

                const nameLength = nameElement.textContent.length;
                const viewportWidth = window.innerWidth;

                // Adjust font size based on name length
                if (viewportWidth <= 768) {
                    if (nameLength > 35) {
                        nameElement.style.fontSize = 'clamp(18px, 5vw, 45px)';
                    } else if (nameLength > 25) {
                        nameElement.style.fontSize = 'clamp(20px, 5vw, 45px)';
                    } else {
                        nameElement.style.fontSize = 'clamp(25px, 5.5vw, 40px)';
                    }
                } else if (viewportWidth <= 992) {
                    if (nameLength > 35) {
                        nameElement.style.fontSize = 'clamp(28px, 5vw, 45px)';
                    } else if (nameLength > 25) {
                        nameElement.style.fontSize = 'clamp(32px, 6vw, 55px)';
                    } else {
                        nameElement.style.fontSize = 'clamp(35px, 6.5vw, 55px)';
                    }
                } else {
                    if (nameLength > 40) {
                        nameElement.style.fontSize = 'clamp(45px, 7vw, 55px)';
                    } else if (nameLength > 30) {
                        nameElement.style.fontSize = 'clamp(50px, 8vw, 60px)';
                    } else {
                        nameElement.style.fontSize = 'clamp(55px, 9vw, 55px)';
                    }
                }
            }

            // Run on load and resize
            adjustFontSize();
            window.addEventListener('resize', adjustFontSize);

            // ===== KEYBOARD SHORTCUTS =====
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                    return;
                }
            });


            console.log('Certificate viewed for: {{ $name }}');

        });

        document.addEventListener('DOMContentLoaded', function() {
            // Check if Solistaria Script loaded successfully
            const testElement = document.createElement('span');
            testElement.style.fontFamily = '"Solistaria Script", cursive';
            testElement.style.position = 'absolute';
            testElement.style.visibility = 'hidden';
            testElement.textContent = 'Test';
            document.body.appendChild(testElement);

            // Get computed font family
            const computedFont = window.getComputedStyle(testElement).fontFamily;

            // If Solistaria Script didn't load, log warning
            if (!computedFont.includes('Solistaria')) {
                console.warn('Solistaria Script font failed to load. Using fallback font.');
            }

            document.body.removeChild(testElement);
        });
    </script>
@endsection
