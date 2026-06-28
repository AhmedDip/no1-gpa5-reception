<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon/favicon.ico') }}" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome.css') }}" />

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #0d1117;
            --surface:    #161b22;
            --border:     #30363d;
            --accent:     #7e54de;
            --accent-dim: rgba(126,84,222,.15);
            --text:       #e6edf3;
            --muted:      #8b949e;
            --danger:     #f85149;
            --success:    #3fb950;
            --input-bg:   #21262d;
            --radius:     10px;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* ── Layout ── */
        .login-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 480px;
        }

        /* Left panel — decorative */
        .login-left {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0d1117 0%, #161b22 40%, #1a1040 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
        }

        .login-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 20% 60%, rgba(126,84,222,.18) 0%, transparent 70%),
                radial-gradient(ellipse 400px 600px at 80% 20%, rgba(37,182,235,.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 3.5rem;
            position: relative;
            z-index: 1;
        }

        .left-brand img { height: 48px; }

        .left-brand-text { font-size: 1.2rem; font-weight: 700; color: #fff; }
        .left-brand-text small { display: block; font-size: .75rem; font-weight: 400; color: var(--muted); }

        .left-headline {
            position: relative;
            z-index: 1;
        }

        .left-headline h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.15;
            color: #fff;
            margin-bottom: 1rem;
        }

        .left-headline h1 span {
            background: linear-gradient(90deg, #7e54de, #25b6eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-headline p {
            color: var(--muted);
            line-height: 1.7;
            max-width: 420px;
        }

        .left-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
            position: relative;
            z-index: 1;
        }

        .stat-item { }
        .stat-item .num { font-size: 2rem; font-weight: 700; color: #fff; }
        .stat-item .lbl { font-size: .78rem; color: var(--muted); margin-top: 2px; }

        .divider { width: 1px; background: var(--border); }

        /* Floating grid decoration */
        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(126,84,222,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(126,84,222,.06) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }

        /* Right panel — form */
        .login-right {
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
        }

        .form-header { margin-bottom: 2.5rem; }
        .form-header h2 { font-size: 1.6rem; font-weight: 700; color: var(--text); }
        .form-header p  { color: var(--muted); margin-top: 6px; font-size: .9rem; }

        /* Alert */
        .alert {
            border-radius: var(--radius);
            padding: .85rem 1rem;
            font-size: .875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-danger  { background: rgba(248,81,73,.12); border: 1px solid rgba(248,81,73,.3); color: #ffa198; }
        .alert-success { background: rgba(63,185,80,.12); border: 1px solid rgba(63,185,80,.3); color: #7ee787; }

        /* Form */
        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .95rem;
            pointer-events: none;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            font-size: .95rem;
            padding: .75rem 2.8rem .75rem 2.6rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            font-family: inherit;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(126,84,222,.2);
        }

        input.is-invalid { border-color: var(--danger); }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 4px;
            line-height: 1;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--text); }

        /* Remember / footer row */
        .form-row-check {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .check-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .875rem;
            color: var(--muted);
            cursor: pointer;
        }

        .check-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 600;
            padding: .85rem;
            cursor: pointer;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            font-family: inherit;
            box-shadow: 0 4px 18px rgba(126,84,222,.35);
        }

        .btn-login:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(126,84,222,.45); }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: .6; cursor: not-allowed; transform: none; }

        /* Footer note */
        .form-footer {
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .form-footer p { color: var(--muted); font-size: .8rem; text-align: center; }

        .badge-secure {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-dim);
            border: 1px solid rgba(126,84,222,.3);
            color: #b196f5;
            font-size: .75rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .right-top {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-shell { grid-template-columns: 1fr; }
            .login-left  { display: none; }
            .login-right { min-height: 100vh; padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="login-shell">

    {{-- ── Left decorative panel ── --}}
    <div class="login-left">
        <div class="grid-bg"></div>

        <div class="left-brand">
            <img src="{{ asset('images/no1-logo.png') }}" alt="No1">
            <div class="left-brand-text">
                No.1 Brand
                <small>Scholarship Management System</small>
            </div>
        </div>

        <div class="left-headline">
            <h1>Admin <span>Control Panel</span></h1>
            <p>
                নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬ — প্রশাসনিক প্যানেলে আপনাকে স্বাগতম।
                এখানে আবেদন পর্যালোচনা, শিক্ষার্থী ব্যবস্থাপনা ও রিপোর্ট পরিচালনা করুন।
            </p>

            <div class="left-stats">
                <div class="stat-item">
                    <div class="num">১,০০০+</div>
                    <div class="lbl">নিবন্ধিত শিক্ষার্থী</div>
                </div>
                <div class="divider"></div>
                <div class="stat-item">
                    <div class="num">৫০০+</div>
                    <div class="lbl">যাচাই সম্পন্ন</div>
                </div>
                <div class="divider"></div>
                <div class="stat-item">
                    <div class="num">৬৪</div>
                    <div class="lbl">জেলা</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right form panel ── --}}
    <div class="login-right">

        <div class="right-top">
            <span class="badge-secure">
                <i class="fas fa-lock"></i> Secure Login
            </span>
        </div>

        <div class="form-header">
            <h2>Sign in to Admin Panel</h2>
            <p>আপনার ইমেইল ও পাসওয়ার্ড দিয়ে লগইন করুন</p>
        </div>

        {{-- Alerts --}}
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm" novalidate>
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope icon"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        autocomplete="email"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <p style="color:var(--danger);font-size:.8rem;margin-top:5px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        required
                    >
                    <button type="button" class="toggle-pw" id="togglePw" title="Show/Hide password">
                        <i class="fas fa-eye" id="pwIcon"></i>
                    </button>
                </div>
                @error('password')
                    <p style="color:var(--danger);font-size:.8rem;margin-top:5px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="form-row-check">
                <label class="check-label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn-login" id="submitBtn">
                <i class="fas fa-sign-in-alt me-1"></i> Sign In
            </button>
        </form>

        <div class="form-footer">
            <p>© {{ date('Y') }} No.1 Brand. All rights reserved.</p>
            <p style="margin-top:8px;">
                <a href="{{ route('home') }}" style="color:var(--accent);text-decoration:none;font-size:.8rem;">
                    ← Public Website
                </a>
            </p>
        </div>

    </div>
</div>

<script>
    // Toggle password
    document.getElementById('togglePw').addEventListener('click', function () {
        const pw   = document.getElementById('password');
        const icon = document.getElementById('pwIcon');
        if (pw.type === 'password') {
            pw.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pw.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Loading state
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
    });
</script>
</body>
</html>
