<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something Went Wrong — ClientHub</title>
    <style>
        :root {
            --bg: #f6f7fb;
            --surface: #ffffff;
            --text: #1e1b4b;
            --muted: #6b7280;
            --border: #e4e4f0;
            --primary: #4f46e5;
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            margin: 0;
            background: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .error-wrapper { text-align: center; max-width: 420px; }
        .error-brand {
            display: flex; align-items: center; justify-content: center;
            gap: 10px; margin-bottom: 32px;
        }
        .error-brand-mark {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--primary); color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 15px;
        }
        .error-brand h2 { margin: 0; font-size: 20px; }
        .error-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px 32px;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.06);
        }
        .error-code {
            font-size: 56px;
            font-weight: 800;
            color: #dc2626;
            margin: 0 0 8px;
        }
        .error-title { font-size: 20px; margin: 0 0 8px; }
        .error-message { color: var(--muted); font-size: 14px; margin: 0 0 28px; }
        .error-link {
            display: inline-block;
            padding: 11px 22px;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }
        .error-link:hover { background: #4338ca; }
    </style>
</head>
<body>
    <div class="error-wrapper">
        <div class="error-brand">
            <span class="error-brand-mark">CH</span>
            <h2>ClientHub</h2>
        </div>
        <div class="error-card">
            <p class="error-code">500</p>
            <h1 class="error-title">Something went wrong</h1>
            <p class="error-message">We hit an unexpected error on our end. Please try again in a moment.</p>
            <a href="{{ url('/dashboard') }}" class="error-link">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>