<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>405 Method Not Allowed</title>
    <style>
        /* Simple, modern, and clean styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f8f9fc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            color: #1e293b;
        }

        .error-container {
            background: white;
            max-width: 640px;
            width: 100%;
            padding: 3rem 2.5rem;
            border-radius: 32px;
            box-shadow: 0 20px 40px -12px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.2s ease;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .error-code {
            font-size: 6rem;
            font-weight: 700;
            line-height: 1;
            color: #3b82f6;
            letter-spacing: -0.02em;
            margin-bottom: 0.25rem;
        }

        .error-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #0f172a;
        }

        .error-message {
            font-size: 1.125rem;
            color: #475569;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .allowed-methods {
            background: #f1f5f9;
            padding: 0.9rem 1.5rem;
            border-radius: 60px;
            display: inline-flex;
            flex-wrap: wrap;
            gap: 0.5rem 1.2rem;
            justify-content: center;
            margin-bottom: 2.25rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }

        .allowed-methods span {
            background: white;
            padding: 0.2rem 1.2rem;
            border-radius: 40px;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            border: 1px solid #d1d9e6;
        }

        .action-link {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 0.75rem 2.2rem;
            border-radius: 60px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
            font-size: 1rem;
            border: none;
            box-shadow: 0 4px 8px -4px rgba(59, 130, 246, 0.3);
        }

        .action-link:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -6px rgba(59, 130, 246, 0.4);
        }

        .action-link:active {
            transform: scale(0.97);
        }

        .extra-info {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #94a3b8;
            border-top: 1px solid #e9edf2;
            padding-top: 1.75rem;
        }

        .extra-info p {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .method-badge {
            background: #e9edf2;
            padding: 0.1rem 0.7rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #334155;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .error-container {
                padding: 2rem 1.5rem;
            }
            .error-code {
                font-size: 4.5rem;
            }
            .error-title {
                font-size: 1.5rem;
            }
            .allowed-methods {
                flex-direction: column;
                align-items: center;
                gap: 0.4rem;
                padding: 0.9rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- 405 status code -->
        <div class="error-code">405</div>

        <!-- Short, clear title -->
        <h1 class="error-title">Method Not Allowed</h1>

        <!-- User-friendly explanation -->
        <p class="error-message">
            The HTTP method you used is not supported for this endpoint.<br>
            Please use one of the allowed methods listed below.
        </p>

        <!-- Allowed methods – clearly visible -->
        <div class="allowed-methods">
            <span>GET</span>
            <span>POST</span>
        </div>

        <!-- Helpful action: back to home / retry -->
        <a href="/" class="action-link">← Return to Home</a>

        <!-- Additional context for developers or curious users -->
        <div class="extra-info">
            <p>
                <span>🔹</span>
                <span>Your request used <strong class="method-badge">PUT</strong> (or another method)</span>
                <span>🔹</span>
                <span>Allowed: <strong>GET</strong> · <strong>POST</strong></span>
            </p>
            <p style="margin-top: 0.5rem; font-size: 0.85rem; color: #a0aec0;">
                If you think this is a mistake, contact the API administrator.
            </p>
        </div>
    </div>
</body>
</html>
