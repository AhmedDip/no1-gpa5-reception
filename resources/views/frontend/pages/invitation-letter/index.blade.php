@extends('frontend.layouts.app')

@section('title', 'নিমন্ত্রণপত্র')

@section('content')

  <style>
    @font-face {
      font-family: 'Kalpurush';
      src: url('{{ asset('fonts/kalpurush.woff2') }}') format('woff2'),
           url('{{ asset('fonts/kalpurush.ttf') }}') format('truetype');
      font-style: normal;
      font-weight: 400;
      font-display: swap;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .card-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1.5rem;
      padding: 1.5rem;
      max-width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
      background: #f2f4f8;
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
    }

    .invitation {
      position: relative;
      width: 1000px;
      height: 633px;
      flex-shrink: 0;
      overflow: hidden;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12), 0 4px 10px rgba(0, 0, 0, 0.05);
      contain: layout paint;
      border: 1px solid rgba(0, 0, 0, 0.04);
      margin-top: 100px;
    }

    .invitation-image {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: fill;
    }

    .student-name {
      position: absolute;
      top: 15%;
      left: 15%;
      width: 70%;
      margin: 0;
      text-align: center;
      font-family: 'Kalpurush', sans-serif;
      font-size: 20px;
      font-weight: 600;
      color: #1a1a1a;
      line-height: 1.3;
      overflow-wrap: anywhere;
      pointer-events: none;
      white-space: normal;
      word-break: break-word;
    }

    .student-qr {
      position: absolute;
      top: 55%;
      left: 76%;
      width: 18%;
      height: auto;
      z-index: 2;
      background: #fff;
      padding: 6px;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      object-fit: contain;
    }

    .download-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 14px 36px;
      background: #e93b75;
      color: #fff;
      border: none;
      border-radius: 60px;
      font-size: 17px;
      font-weight: 600;
      letter-spacing: 0.3px;
      cursor: pointer;
      box-shadow: 0 6px 16px rgba(233, 59, 117, 0.3);
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      border: 1px solid rgba(255, 255, 255, 0.2);
      flex-shrink: 0;
      user-select: none;
    }

    .download-btn:hover {
      background: #c42d61;
      box-shadow: 0 8px 22px rgba(233, 59, 117, 0.4);
      transform: translateY(-1px);
    }

    .download-btn:active {
      transform: translateY(1px) scale(0.97);
      box-shadow: 0 4px 10px rgba(233, 59, 117, 0.3);
    }

    .download-btn:disabled {
      opacity: 0.7;
      cursor: wait;
    }

    .download-btn span {
      font-size: 20px;
      line-height: 1;
    }


    @media (max-width: 1050px) {
      .invitation {
        width: 95vw;
        height: auto;
        aspect-ratio: 297 / 188.067;
        max-width: 1000px;
        margin-top: 60px;
      }
      .card-wrapper {
        gap: 1rem;
        padding: 1rem;
      }
      .download-btn {
        padding: 12px 28px;
        font-size: 15px;
      }
    }

    @media (max-width: 800px) {
      .invitation {
        width: 100vw;
        border-radius: 4px;
        margin-top: 30px;
      }
      .student-name {
        font-size: 14px;
      }
      .download-btn {
        padding: 10px 24px;
        font-size: 14px;
        gap: 6px;
      }
    }

    @media print {
      @page {
        size: A4 landscape;
        margin: 0;
      }

      html, body {
        width: 297mm;
        height: 210mm;
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        overflow: hidden !important;
      }

      /* Hide everything by default */
      body * {
        visibility: hidden !important;
      }

      #invitationCard,
      #invitationCard * {
        visibility: visible !important;
      }

      .card-wrapper {
        position: static !important;
        display: block !important;
        padding: 0 !important;
        margin: 0 !important;
        min-height: 0 !important;
        background: #fff !important;
        overflow: visible !important;
      }

      #invitationCard {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 297mm !important;
        height: 210mm !important;
        max-width: 297mm !important;
        max-height: 210mm !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        overflow: hidden !important;
        page-break-after: avoid !important;
        page-break-inside: avoid !important;
        background: #fff !important;
      }

      #invitationCard .invitation-image {
        width: 100% !important;
        height: 100% !important;
        display: block !important;
        object-fit: fill !important;
      }

      #invitationCard .student-name {
        top: 15% !important;
        left: 15% !important;
        width: 70% !important;
        font-size: 22px !important;
        color: #1a1a1a !important;
      }

      #invitationCard .student-qr {
        top: 55% !important;
        left: 76% !important;
        width: 18% !important;
        padding: 6px !important;
        box-shadow: none !important;
      }

      /* Button must never appear in the PDF */
      .download-btn {
        display: none !important;
        visibility: hidden !important;
      }

      /* Force all colors & images to render */
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color-adjust: exact !important;
      }
    }
  </style>

  <div class="card-wrapper">
    <main class="invitation" id="invitationCard" aria-label="নিমন্ত্রণপত্র">
      <img class="invitation-image" src="{{ asset('images/invitation-bg.jpg') }}" alt="নিমন্ত্রণপত্র">
      <p class="student-name">{{ $name }}</p>
      <img class="student-qr" src="{{ $qrDataUri }}" alt="Student QR code">
    </main>

    <button class="download-btn" id="printBtn" type="button">
      <span>📄</span> Download PDF
    </button>
  </div>

@endsection

@push('scripts')
  <script>
    (function () {
      const printBtn = document.getElementById('printBtn');
      const card     = document.getElementById('invitationCard');
      if (!printBtn || !card) return;


      function whenImagesReady(root) {
        const images = root.querySelectorAll('img');
        const promises = Array.from(images).map(function (img) {
          if (img.complete && img.naturalWidth > 0) {
            return img.decode ? img.decode().catch(function () {}) : Promise.resolve();
          }
          return new Promise(function (resolve) {
            img.addEventListener('load',  resolve, { once: true });
            img.addEventListener('error', resolve, { once: true });
          });
        });
        return Promise.all(promises);
      }

      printBtn.addEventListener('click', function () {
        printBtn.disabled = true;
        const originalHTML = printBtn.innerHTML;
        printBtn.innerHTML = '<span>⏳</span> Preparing...';

        whenImagesReady(card).then(function () {
          requestAnimationFrame(function () {
            setTimeout(function () {
              window.print();

              setTimeout(function () {
                printBtn.disabled = false;
                printBtn.innerHTML = originalHTML;
              }, 400);
            }, 150);
          });
        });
      });
    })();
  </script>
@endpush
