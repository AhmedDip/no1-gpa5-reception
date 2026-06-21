@extends('frontend.layouts.app')

@section('title', 'আমন্ত্রণ পত্র | No.1 Babar Kriti Santan Songbordhona’26')

@section('content')
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Montserrat:wght@400;500;600;700&family=Hind+Siliguri:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Base page reset */
        .invitation-body-wrapper {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }

        /* Invitation container using the ivory blank graphic with the graduation hat asset */
        .invitation-card {
            max-width: 950px;
            width: 100%;
            aspect-ratio: 4 / 3;
            /* Fixed professional aspect ratio layout mimicking physical print */
            background-image: url('{{ asset('images/invitation-bg.png') }}');
            /* Save the generated background graphic here */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 12px;
            box-shadow: 0 20px 45px rgba(15, 46, 71, 0.12);
            position: relative;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Pure structural overlay matching layout constraints safely */
        .invitation-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 9% 12% 5% 12%;
            /* Leaves safe breathing margins from the dark top arches */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        /* Typography & Element Styling resets */
        .bangla {
            font-family: 'Hind Siliguri', sans-serif;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-placeholder {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            border: 2px solid #2c4a5e;
            /* Matching deep signature navy color accent */
        }

        .brand-text {
            font-weight: 700;
            color: #0f2e47;
            font-size: 1.15rem;
            line-height: 1.2;
        }

        .brand-text small {
            font-weight: 500;
            font-size: 0.8rem;
            display: block;
            color: #475569;
        }

        /* Main Invitation Letter Heading */
        .invitation-heading {
            font-family: 'Cinzel', serif;
            color: #0d233a;
            font-weight: 800;
            letter-spacing: 3px;
            margin: 0.5rem 0 0.2rem 0;
            text-align: center;
            font-size: 2rem;
        }

        .invitation-content-area {
            margin-top: 0.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .salutation {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f2e47;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        .invitation-text {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #1e293b;
            font-weight: 400;
            text-align: left;
            max-width: 720px;
            /* Constrained execution path ensuring words stay clear of the graduation hat graphic */
        }

        .invitation-text strong {
            color: #0f2e47;
            font-weight: 700;
        }

        .invitation-text .highlight {
            color: #b45309;
            /* Warm luxury gold-bronze highlight shift */
            font-weight: 700;
        }

        /* Functional Informational Grid Layout Box */
        .event-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin: 1rem 0;
            border: 1px solid rgba(203, 213, 225, 0.6);
            max-width: 660px;
            /* Kept safely narrow to sit strictly left of the graduation cap graphic */
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #334155;
            font-size: 0.95rem;
        }

        .detail-item i {
            font-size: 1.2rem;
            color: #2c4a5e;
            width: 1.5rem;
            text-align: center;
        }

        .detail-item span {
            font-weight: 700;
            color: #0f2e47;
        }

        .detail-item small {
            font-weight: 500;
            color: #475569;
        }

        /* Signature area safely configured along the lower-left block grid spaces */
        .bottom-action-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 0.5rem;
            max-width: 660px;
            /* Left-balanced alignment boundary layout */
        }

        .footer-note {
            font-size: 0.85rem;
            color: #475569;
            text-align: left;
        }

        .footer-note .social {
            margin-top: 0.4rem;
        }

        .footer-note .social i {
            margin-right: 0.6rem;
            color: #2c4a5e;
            font-size: 1.1rem;
        }

        .signature-box {
            text-align: center;
            border-top: 1px solid #cbd5e1;
            padding-top: 0.4rem;
            min-width: 180px;
        }

        .signature-box p {
            font-weight: 600;
            color: #0f2e47;
            font-size: 0.95rem;
            margin-bottom: 0px;
        }

        .signature-box .org {
            font-weight: 500;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Responsive Breakpoints fallback scaling for smaller dynamic viewport resolutions */
        @media (max-width: 992px) {
            .invitation-card {
                aspect-ratio: auto;
                height: auto;
            }

            .invitation-overlay {
                position: relative;
                padding: 2.5rem 1.5rem;
            }

            .invitation-text,
            .event-details,
            .bottom-action-row {
                max-width: 100%;
            }

            .event-details {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="invitation-body-wrapper bangla py-5 mt-5">
        <div class="invitation-card">
            <div class="invitation-overlay">

                <div class="header-row">
                    <div class="logo-group">
                        <img src="{{ asset('images/no1-logo.png') }}" alt="No.1 Logo" class="logo-placeholder">
                        <div class="brand-text">
                            No.1 Brand
                            <small>নং ১ ব্র্যান্ড</small>
                        </div>
                    </div>
                    <div>
                        <h1 class="invitation-heading">INVITATION</h1>
                    </div>
                </div>

                <div class="invitation-content-area">
                    <div class="salutation">
                        <i class="fas fa-envelope-open-text" style="color: #2c4a5e; margin-right: 8px;"></i> প্রিয় অভিভাবক
                        ও কৃতি সন্তান,
                    </div>

                    <div class="invitation-text">
                        <p class="mb-2">
                            <strong>No.1 Brand</strong> -এর পক্ষ থেকে আন্তরিক অভিনন্দন ও আমন্ত্রণ।
                            <span class="highlight">“নং ১ বাবার কৃতি সন্তান সম্বর্ধনা’২৬”</span>
                            অনুষ্ঠানে আপনার সন্তানের অসাধারণ অর্জন উদযাপন করতে আমরা গর্বিত। চায়ের দোকানের মালিকদের মেধাবী
                            সন্তানদের এই বিশেষ সম্মাননা তাদের পড়াশোনার পাশাপাশি অভিভাবকদের ত্যাগকেও শ্রদ্ধা জানায়।
                        </p>
                        <p class="mb-2">
                            Your child has made us all proud by achieving <strong>GPA-5</strong>। আমরা তাকে <strong>“নং ১
                                বাবারের কৃতি সন্তান”</strong> হিসেবে সম্মানিত করতে চাই। অনুগ্রহ করে নির্ধারিত সময়ে উপস্থিত
                            থেকে অনুষ্ঠানটিকে প্রাণবন্ত করুন।
                        </p>
                        <div style="font-weight: 600; color: #0f2e47; font-size: 0.95rem;">
                            <i class="fas fa-hand-holding-heart" style="color: #2c4a5e; margin-right: 4px;"></i> আয়োজনে
                            থাকছে: সার্টিফিকেট, ক্রেস্ট, শিক্ষা উপকরণ ও বিশেষ উপহার।
                        </div>
                    </div>
                </div>

                <div class="event-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <div><span>তারিখ:</span> <small>২৬ জুন ২০২৬, শুক্রবার</small></div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <div><span>সময়:</span> <small>সকাল ১০:৩০ – বিকাল ০১:০০</small></div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-pin"></i>
                        <div><span>স্থান:</span> <small>মিরপুর শহীদ বুদ্ধিজীবী মিলনায়তন, ঢাকা</small></div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-user-check"></i>
                        <div><span>নিবন্ধন:</span> <small>অনলাইন নিবন্ধন বাধ্যতামূলক।</small></div>
                    </div>
                </div>

                <div class="bottom-action-row">
                    <div class="footer-note">
                        <div>
                            <i class="fas fa-globe-asia" style="color: #2c4a5e; margin-right: 4px;"></i>
                            বিস্তারিত ও নিবন্ধন: <strong>www.no1babarkriti.com</strong>
                        </div>
                        <div class="social">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-instagram"></i>
                            <i class="fab fa-youtube"></i>
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <div class="signature-box">
                        <p>শুভেচ্ছা সহ,</p>
                        <p style="font-weight: 700; font-size: 1.05rem; color: #0f2e47;">No.1 Brand</p>
                        <p class="org mb-1">আয়োজক কমিটি</p>
                        <p style="font-size: 0.8rem; color: #475569;">
                            <i class="fas fa-phone-alt" style="color: #2c4a5e;"></i> +৮৮০ ১৭১২-৩৪৫৬৭৮
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
