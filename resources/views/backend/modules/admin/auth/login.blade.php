<!DOCTYPE html>
<html lang="bn" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Executive Portal | No.1 Scholarship</title>
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome.css') }}" />

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-deep: rgb(34, 33, 34);
            --bg-surface: #0b0f19;
            --border-subtle: rgba(255, 255, 255, 0.05);
            --accent: #8b5cf6;
            --accent-gold: #d4af37;
            --accent-gradient: linear-gradient(135deg, #a78bfa 0%, #35038b 100%);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-dark: #64748b;
            --color-danger: #ef4444;
            --color-success: #10b981;
            --radius-premium: 16px;
        }

        html,
        body {
            height: 100%;
            font-family: 'Inter', 'Hind Siliguri', system-ui, sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-primary);
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

=
        .premium-container {
            width: 100%;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            background-color: var(--bg-deep);
            position: relative;
        }
=
        .premium-container::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50%;
            height: 60%;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

=
        .brand-wall {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4rem;
            background: linear-gradient(180deg, rgba(11, 15, 25, 0.6) 0%, rgba(5, 7, 12, 0.9) 100%);
            border-right: 1px solid var(--border-subtle);
            position: relative;
            overflow: hidden;
        }

        /* Interactive Canvas Element background */
        #constellationCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: auto;
        }

        .showcase-header {
            position: relative;
            z-index: 5;
        }

        .showcase-header .status-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #a78bfa;
            background: rgba(139, 92, 246, 0.1);
            padding: 6px 16px;
            border-radius: 30px;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        /* Balanced Logo Showcase Row */
        .logo-gallery-row {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin: 4rem 0;
            z-index: 5;
        }

        .brand-logo-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-subtle);
            padding: 1.5rem 2rem;
            border-radius: var(--radius-premium);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .brand-logo-card:hover {
            transform: translateY(-4px);
            border-color: rgba(139, 92, 246, 0.25);
        }

        .brand-logo-card img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .logo-separator-dot {
            width: 6px;
            height: 6px;
            background: var(--text-dark);
            border-radius: 50%;
            opacity: 0.5;
        }

        .showcase-footer {
            position: relative;
            z-index: 5;
        }

        .showcase-footer h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.25;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .showcase-footer p {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
            max-width: 460px;
        }

        /* ── Right Side: Elegant Form Area ── */
        .form-wall {
            background-color: var(--bg-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem;
            position: relative;
        }

        .form-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .form-intro {
            margin-bottom: 2.5rem;
        }

        .form-intro h2 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #ffffff;
        }

        .form-intro p {
            color: var(--text-dark);
            font-size: 0.95rem;
            margin-top: 0.4rem;
        }

        /* Minimal Luxury Form Inputs */
        .field-box {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .field-box label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-container i.input-icon {
            position: absolute;
            left: 1.2rem;
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: color 0.2s ease;
            z-index: 2;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            background-color: rgba(5, 7, 12, 0.5);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 0.95rem;
            padding: 1rem 3.5rem 1rem 3rem;
            /* Safe padding-right prevents shifts */
            outline: none;
            transition: all 0.25s ease;
            position: relative;
            z-index: 1;
        }

        input:focus {
            border-color: var(--accent);
            background-color: rgba(5, 7, 12, 0.8);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }

        input:focus~i.input-icon {
            color: var(--accent);
        }

        input.is-invalid {
            border-color: var(--color-danger);
        }

        /* Fixed absolute positioned buttons to stop layouts breaking */
        .password-reveal-btn {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 52px;
            background: transparent;
            border: none;
            color: var(--text-dark);
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-reveal-btn:hover {
            color: var(--text-primary);
        }

        .form-options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1.8rem 0 2.2rem;
        }

        .remember-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        .remember-toggle input {
            width: 16px;
            height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        /* Solid High-End Button Design */
        .submit-action-btn {
            width: 100%;
            background: var(--accent-gradient);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.25);
        }

        .submit-action-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
        }

        .submit-action-btn:active {
            transform: translateY(1px);
        }

        .submit-action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* Modern Notification Elements */
        .toast-alert {
            border-radius: 10px;
            padding: 1rem 1.2rem;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(5, 7, 12, 0.4);
            border: 1px solid var(--border-subtle);
        }

        .toast-alert-danger {
            border-left: 4px solid var(--color-danger);
            color: #fca5a5;
        }

        .toast-alert-success {
            border-left: 4px solid var(--color-success);
            color: #6ee7b7;
        }

        /* Footer Metadata */
        .gate-footer {
            margin-top: 4rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--text-dark);
        }

        .gate-footer a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .gate-footer a:hover {
            color: var(--accent);
        }

        /* ── Responsive Adaptability Matrix ── */
        @media (max-width: 1050px) {
            .premium-container {
                grid-template-columns: 1fr;
            }

            .brand-wall {
                padding: 3rem 2rem;
                border-right: none;
                border-bottom: 1px solid var(--border-subtle);
                min-height: 380px;
            }

            .logo-gallery-row {
                margin: 2.5rem 0;
            }

            .form-wall {
                padding: 4rem 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="premium-container">

=
        <div class="brand-wall" id="canvasContainer">
            <canvas id="constellationCanvas"></canvas>

            <div class="showcase-header">
                <div class="status-tag">
                    <i class="fas fa-circle" style="font-size: 7px; vertical-align: middle;"></i> Secure Access Point
                </div>
            </div>
=
            <div class="logo-gallery-row">
                <div class="brand-logo-card">
                    <img src="{{ asset('images/mgi-logo.png') }}" alt="MGI Corporate Brand" />
                </div>
                <div class="logo-separator-dot"></div>
                <div class="brand-logo-card">
                    <img src="{{ asset('images/no1-logo.png') }}" alt="No.1 Brand Portfolio"/>
                </div>
            </div>

            <div class="showcase-footer">
                <h2>
                   নাম্বার ওয়ান স্কলারশিপ ম্যানেজমেন্ট পোর্টাল
                </h2>
                <br/>
                <p>
                  নাম্বার ওয়ান স্কলারশিপ ম্যানেজমেন্ট-এর সুরক্ষিত অ্যাডমিন পোর্টালে স্বাগতম। ড্যাশবোর্ডে প্রবেশ করতে আপনার লগইন তথ্য দিয়ে পরিচয় যাচাই করুন।
                </p>
            </div>
        </div>

=
        <div class="form-wall">
            <div class="form-wrapper">

                <div class="form-intro">
                    <h2>Sign In</h2>
                    <p>Enter your assigned system keys to enter</p>
                </div>

                @if (session('error'))
                    <div class="toast-alert toast-alert-danger">
                        <i class="fas fa-exclamation-circle" style="color:var(--color-danger);"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('success'))
                    <div class="toast-alert toast-alert-success">
                        <i class="fas fa-check-circle" style="color:var(--color-success);"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" id="executiveLoginForm" novalidate>
                    @csrf

                    <div class="field-box">
                        <label for="email">Identity Space</label>
                        <div class="input-container">
                            <i class="far fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="name@domain.com" autocomplete="email"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required autofocus>
                        </div>
                        @error('email')
                            <p style="color:var(--color-danger);font-size:0.75rem;margin-top:0.5rem;">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field-box">
                        <label for="password">Password Token</label>
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••"
                                autocomplete="current-password"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required>
                            <button type="button" class="password-reveal-btn" id="triggerReveal"
                                title="Toggle Plaintext">
                                <i class="far fa-eye" id="eyeGlyph"></i>
                            </button>
                        </div>
                        @error('password')
                            <p style="color:var(--color-danger);font-size:0.75rem;margin-top:0.5rem;">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-options-row">
                        <label class="remember-toggle">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>Keep session mapped</span>
                        </label>
                    </div>

                    <button type="submit" class="submit-action-btn" id="formSubmitAction">
                        Authenticate Access <i class="fas fa-shield-alt"></i>
                    </button>
                </form>

                <div class="gate-footer">
                    <p>© {{ date('Y') }} MGI &amp; No.1 Brand Group.</p>
                    <a href="{{ route('home') }}">
                        Main Gateway <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>

        document.getElementById('triggerReveal').addEventListener('click', function() {
            const field = document.getElementById('password');
            const glyph = document.getElementById('eyeGlyph');
            if (field.type === 'password') {
                field.type = 'text';
                glyph.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                glyph.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });


        document.getElementById('executiveLoginForm').addEventListener('submit', function() {
            const primaryBtn = document.getElementById('formSubmitAction');
            primaryBtn.disabled = true;
            primaryBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authorizing Connection...';
        });


        const canvas = document.getElementById('constellationCanvas');
        const ctx = canvas.getContext('2d');
        const container = document.getElementById('canvasContainer');

        let particlesArray = [];
        const maxParticlesCount = 100;

        let userMouse = {
            x: null,
            y: null,
            radius: 180
        };



        function adjustCanvasLayoutSize() {
            canvas.width = container.offsetWidth;
            canvas.height = container.offsetHeight;
        }
        adjustCanvasLayoutSize();

        class NetworkNode {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 1.5 + 1;
                this.speedX = (Math.random() * 0.3) - 0.15;
                this.speedY = (Math.random() * 0.3) - 0.15;
                this.forceMultiplier = (Math.random() * 15) + 15;
            }

            draw() {
                ctx.fillStyle = 'rgba(167, 139, 246, 0.4)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.closePath();
                ctx.fill();
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                if (this.x < 0 || this.x > canvas.width) this.speedX = -this.speedX;
                if (this.y < 0 || this.y > canvas.height) this.speedY = -this.speedY;

                if (userMouse.x != null && userMouse.y != null) {
                    let dx = userMouse.x - this.x;
                    let dy = userMouse.y - this.y;
                    let distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < userMouse.radius) {
                        let forceX = dx / distance;
                        let forceY = dy / distance;
                        let normalizedForce = (userMouse.radius - distance) / userMouse.radius;

                        this.x += forceX * normalizedForce * this.forceMultiplier * 0.2;
                        this.y += forceY * normalizedForce * this.forceMultiplier * 0.2;
                    }
                }
            }
        }

        function initConstellation() {
            particlesArray = [];
            for (let i = 0; i < maxParticlesCount; i++) {
                particlesArray.push(new NetworkNode());
            }
        }
        initConstellation();

        function assignConnections() {
            for (let a = 0; a < particlesArray.length; a++) {
                for (let b = a; b < particlesArray.length; b++) {
                    let dx = particlesArray[a].x - particlesArray[b].x;
                    let dy = particlesArray[a].y - particlesArray[b].y;
                    let distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 110) {
                        let lineAlpha = 1 - (distance / 110);
                        ctx.strokeStyle = `rgba(139, 92, 246, ${lineAlpha * 0.12})`;
                        ctx.lineWidth = 0.8;
                        ctx.beginPath();
                        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function runEngineLoop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
            }
            assignConnections();
            requestAnimationFrame(runEngineLoop);
        }
        runEngineLoop();

        window.addEventListener('resize', function() {
            adjustCanvasLayoutSize();
            initConstellation();
        });
    </script>
</body>

</html>
