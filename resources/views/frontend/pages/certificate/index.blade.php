@extends('frontend.layouts.app')

@section('title', 'সার্টিফিকেট | No.1 Babar Kriti Santan Songbordhona’26')

@section('content')

    <style>
        .certificate-container {
            width: 100%;
            max-width: 1400px;
            margin: 40px auto;
            position: relative;
        }

        .certificate-image {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Dynamic Student Name */
        .student-name {
            position: absolute;

            /* Name position */
            top: 42.5%;
            left: 20%;
            width: 60%;

            text-align: center;

            font-family: 'Noto Serif Bengali', serif;
            font-size: clamp(28px, 4vw, 60px);
            font-weight: 700;
            color: #111;

            line-height: 1.2;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .certificate-container {
                margin: 20px auto;
            }

            .student-name {
                font-size: clamp(18px, 5vw, 35px);
            }
        }
    </style>

    <div class="container-fluid px-3">

        <div class="certificate-container">

            {{-- Certificate Background --}}
            <img
                src="{{ asset('images/certificate_background.png') }}"
                alt="Certificate"
                class="certificate-image"
            >

            {{-- Dynamic Student Name --}}
            <div class="student-name">
                {{ $name }}
            </div>

        </div>

    </div>

@endsection
