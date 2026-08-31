@extends('frontend.layouts.app')

@section('title', 'সার্টিফিকেট | No.1 Babar Kriti Santan Songbordhona’26')

@section('content')

<style>
    .certificate-wrapper {
        width: 100%;
        max-width: 1400px;
        margin: 40px auto;
        position: relative;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .certificate-container {
        width: 100%;
        position: relative;
    }

    .certificate-image {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Student Name Overlay - Web Version */
    .student-name-web {
        position: absolute;
        top: 42%; /* Match this with PDF position */
        left: 50%;
        transform: translateX(-50%);
        width: 70%;
        text-align: center;
        font-family: 'Noto Serif Bengali', 'Georgia', serif;
        font-size: clamp(28px, 4vw, 48px);
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.3;
        padding: 5px 20px;
    }

    .download-section {
        padding: 30px;
        text-align: center;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .btn-download {
        display: inline-block;
        padding: 15px 40px;
        background: #3498db;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-download:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }

    .btn-download i {
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .certificate-wrapper {
            margin: 20px auto;
            border-radius: 5px;
        }
        .student-name-web {
            font-size: clamp(18px, 5vw, 32px);
            top: 40%;
            width: 80%;
        }
        .btn-download {
            padding: 12px 25px;
            font-size: 16px;
        }
    }

    @media print {
        .download-section {
            display: none;
        }
        .certificate-wrapper {
            box-shadow: none;
            margin: 0;
            border-radius: 0;
        }
    }
</style>

<div class="container-fluid px-3" style="margin-top: 120px; margin-bottom: 20px;">
    <div class="certificate-wrapper">
        <div class="certificate-container">
            <!-- Certificate Background Image (with all text) -->
            <img
                src="{{ asset('images/certificate_background.png') }}"
                alt="Certificate"
                class="certificate-image"
            >

            <!-- Dynamic Student Name Only -->
            <div class="student-name-web">
                {{ $name }}
            </div>
        </div>

        <!-- Download Button -->
        <div class="download-section">
            <a href="{{ route('student.certificate.download') }}" class="btn-download">
                <i class="fas fa-download"></i> Download PDF Certificate
            </a>
        </div>
    </div>
</div>

@endsection
