{{-- resources/views/frontend/pages/qrcode/student.blade.php --}}

@extends('frontend.layouts.app')

@section('title', $user ? 'QR কোড - ' . ($user->studentDetail->name_bn ?? $user->name) : 'Invalid QR Code')

@push('styles')
    <style>
        .qr-page-bg {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background-color: #f8f9fc;
            background-image:
                radial-gradient(at 0% 0%, rgba(170, 27, 29, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(255, 193, 7, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(170, 27, 29, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(28, 20, 20, 0.05) 0px, transparent 50%);
            overflow: hidden;
            font-family: 'Hind Siliguri', 'Poppins', sans-serif; /* Assuming you have a nice font */
        }

        /* Floating decorative orbs */
        .qr-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.5;
            animation: floatOrb 8s ease-in-out infinite;
        }
        .qr-orb-1 { width: 300px; height: 300px; background: #aa1b1d; top: -100px; left: -100px; }
        .qr-orb-2 { width: 250px; height: 250px; background: #ffb703; bottom: -80px; right: -80px; animation-delay: -4s; }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        /* ===== GLASS CARD WRAPPER ===== */
        .qr-content-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 560px;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; */
        }

        @keyframes slideUpFade {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .qr-card-container {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 10px;
            box-shadow:
                0 20px 40px -10px rgba(170, 27, 29, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.5) inset;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .qr-card-container:hover {
            transform: translateY(-4px);
            box-shadow:
                0 30px 50px -15px rgba(170, 27, 29, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.6) inset;
        }

        /* Inner image wrapper */
        .qr-card {
            position: relative;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            line-height: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        .qr-card img.qr-bg {
            width: 100%;
            height: auto;
            display: block;
        }


        .qr-overlay {
            position: absolute;
            top: 57%; /* Adjust to match placeholder */
            left: 50%;
            width: 45%; /* Adjust to match placeholder */
            transform: translate(-50%, -50%);
            /* animation: popIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.4s both; */
        }

        @keyframes popIn {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
            100% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        }

        .qr-overlay img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ===== MODERN BUTTONS ===== */
        .qr-actions {
            margin-top: 2rem;
            display: flex;
            gap: 0.8rem;
            justify-content: center;
            flex-wrap: wrap;
            /* animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both; */
        }

        .qr-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 0.8rem 1.6rem;
            border-radius: 14px;
            font-weight: 500;
            font-size: 0.85rem;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            /* transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); */
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            letter-spacing: 0.3px;
        }

        .qr-btn-primary {
            background: linear-gradient(135deg, #aa1b1d 0%, #8a1416 100%);
            color: #fff;
            box-shadow: 0 10px 20px -5px rgba(170, 27, 29, 0.4);
        }
        .qr-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(170, 27, 29, 0.5);
            color: #fff;
        }

        .qr-btn-download {
            background: linear-gradient(135deg, #1c1414 0%, #000 100%);
            color: #fff;
            box-shadow: 0 10px 20px -5px rgba(28, 20, 20, 0.4);
        }
        .qr-btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(28, 20, 20, 0.5);
            color: #fff;
        }

        .qr-btn-ghost {
            background: rgba(255, 255, 255, 0.8);
            color: #1c1414;
            border-color: rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
        }
        .qr-btn-ghost:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);
            color: #1c1414;
        }


        .qr-invalid-box {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(245, 198, 198, 0.8);
            border-radius: 24px;
            padding: 3rem 2rem;
            max-width: 440px;
            box-shadow: 0 20px 40px -10px rgba(220, 53, 69, 0.15);
            /* animation: slideUpFade 0.6s ease both; */
        }

        .qr-invalid-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #fff0f0;
            color: #dc3545;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

    </style>
@endpush

@section('content')
    <div class="qr-page-bg" style="margin-top:50px;">
        {{-- Decorative Background Orbs --}}
        <div class="qr-orb qr-orb-1"></div>
        <div class="qr-orb qr-orb-2"></div>

        <div class="qr-content-wrapper">
            @if ($user)
                <div class="qr-card-container">
                    <div class="qr-card" id="printableCard">
                        <img class="qr-bg" src="{{ asset('images/qr-code/qr-code.jpeg') }}" alt="QR Card" style="height: 550px;">

                        <div class="qr-overlay">
                            @if (!empty($qrDataUri))
                                <img src="{{ $qrDataUri }}" alt="QR Code">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="qr-actions">
                    {{-- <button type="button" onclick="window.print()" class="qr-btn qr-btn-primary">
                        <i class="fas fa-print"></i> প্রিন্ট করুন
                    </button> --}}

                    <button type="button" id="downloadBtn" class="qr-btn qr-btn-download">
                        <i class="fas fa-download"></i> ডাউনলোড করুন
                    </button>

                    <a href="{{ url()->previous() }}" class="qr-btn qr-btn-ghost">
                        <i class="fas fa-arrow-left"></i> ফিরে যান
                    </a>
                </div>
            @else
                <div class="qr-invalid-box">
                    <div class="qr-invalid-icon">
                        <i class="fas fa-times"></i>
                    </div>
                    <h4 class="mb-3 fw-bold text-dark">Invalid or Unregistered QR Code</h4>
                    <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                        এই মোবাইল নম্বরে কোনো নিবন্ধিত অনুমোদিত শিক্ষার্থী/অতিথি পাওয়া যায়নি।
                    </p>
                    <a href="{{ url('/') }}" class="qr-btn qr-btn-primary">
                        <i class="fas fa-home"></i> হোমে ফিরে যান
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const downloadBtn = document.getElementById('downloadBtn');

            if (downloadBtn) {
                downloadBtn.addEventListener('click', function () {
                    const cardElement = document.getElementById('printableCard');
                    const originalText = downloadBtn.innerHTML;

                    downloadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ডাউনলোড হচ্ছে...';
                    downloadBtn.disabled = true;
                    downloadBtn.style.opacity = '0.7';

                    html2canvas(cardElement, {
                        scale: 3,
                        useCORS: true,
                        backgroundColor: null,
                        logging: false
                    }).then(canvas => {
                        const imgData = canvas.toDataURL('image/jpeg', 0.95);

                        const link = document.createElement('a');
                        // link.download =
                        // name and mobile link download file name
                        link.download = 'QR_Code_{{ $user->name ?? '' }}_{{ $user->mobile }}.jpg';
                        link.href = imgData;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                        downloadBtn.innerHTML = originalText;
                        downloadBtn.disabled = false;
                        downloadBtn.style.opacity = '1';
                    }).catch(error => {
                        console.error('Error generating image:', error);
                        alert('দুঃখিত, ছবিটি ডাউনলোড করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।');

                        downloadBtn.innerHTML = originalText;
                        downloadBtn.disabled = false;
                        downloadBtn.style.opacity = '1';
                    });
                });
            }
        });
    </script>
@endpush
