<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ClientHub' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f6f7fb;
            --surface: #ffffff;
            --text: #1e1b4b;
            --muted: #6b7280;
            --border: #e4e4f0;
            --primary: #4f46e5;
            --accent-gold: #a16207;
            --sidebar-bg: #1e1b4b;
            --sidebar-text: rgba(255, 255, 255, 0.75);
            --sidebar-text-active: #ffffff;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --warning-bg: #fef3c7;
            --warning-text: #92400e;
            --danger-bg: #fee2e2;
            --danger-text: #991b1b;
            --neutral-bg: #e5e7eb;
            --neutral-text: #374151;
            --font-display: 'Fraunces', serif;
            --font-body: 'Inter', -apple-system, sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            margin: 0;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3 {
            font-family: var(--font-display);
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        /* ===== App Shell: Sidebar + Main Content ===== */

        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            transition: transform 0.25s ease;
        }

        .sidebar-brand {
            display: block;
            text-decoration: none;
            color: #ffffff;
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 600;
            padding: 8px 12px 28px;
            letter-spacing: -0.01em;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: 10px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.15s ease, color 0.15s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--sidebar-text-active);
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--sidebar-text-active);
            border-left-color: var(--accent-gold);
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 14px 4px;
        }
                .sidebar-section-label {
            padding: 20px 12px 6px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
        }

        .sidebar-footer {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-footer form {
            margin: 0;
        }

        .sidebar-footer button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            min-width: 0;
        }

        /* ===== Mobile menu toggle ===== */

        .mobile-topbar {
            display: none;
        }

        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 900px) {
            .mobile-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: var(--sidebar-bg);
                padding: 14px 18px;
                position: sticky;
                top: 0;
                z-index: 90;
            }

            .mobile-topbar .sidebar-brand {
                padding: 0;
                font-size: 19px;
            }

            .mobile-menu-button {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: white;
                width: 38px;
                height: 38px;
                border-radius: 8px;
                font-size: 18px;
                cursor: pointer;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.is-open {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 99;
            }

            .sidebar-backdrop.is-visible {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* ===== Shared components (cards, badges, forms, etc.) ===== */

        .container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            padding: 40px 28px 60px;
        }

        .card {
            background: var(--surface);
            padding: 26px;
            margin-bottom: 20px;
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: none;
        }

        .card h2, .card h3 { margin-top: 0; }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .activity-timeline {
    position: relative;
    padding-left: 6px;
}
.sidebar-quick-action {
    display: block;
    text-align: center;
    margin: 0 0 18px;
    padding: 10px 12px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

.sidebar-quick-action:hover {
    background: rgba(255, 255, 255, 0.18);
}
.activity-item {
    display: flex;
    gap: 14px;
    padding-bottom: 20px;
    position: relative;
}

.activity-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 5px;
    top: 16px;
    bottom: -4px;
    width: 1px;
    background: var(--border, #e4e4f0);
}

.activity-dot {
    width: 11px;
    height: 11px;
    border-radius: 50%;
    background: #1e1b4b;
    margin-top: 4px;
    flex-shrink: 0;
}

.activity-content { min-width: 0; }

.activity-description {
    margin: 0 0 4px;
    font-size: 14px;
    color: #1e1b4b;
    font-weight: 500;
}

.activity-time {
    font-size: 12px;
    color: var(--muted, #6b7280);
}

        input[type="text"], input[type="email"], input[type="password"],
        input[type="number"], input[type="date"], select, textarea {
            border-radius: 10px !important;
            border: 1px solid var(--border) !important;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            font-family: inherit;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus,
        input[type="number"]:focus, input[type="date"]:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid var(--border); }

        .plain-list { list-style: none; margin: 0; padding: 0; }
        .plain-list li { display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid var(--border); }
        .plain-list li:last-child { border-bottom: none; }
        .toast {
    position: fixed;
    top: 24px;
    right: 24px;
    z-index: 999;
    padding: 14px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    color: white;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    animation: toast-in 0.3s ease;
    max-width: 320px;
}

.toast-success { background: #15803d; }
.toast-error { background: #b91c1c; }

.toast.toast-hide {
    animation: toast-out 0.3s ease forwards;
}

@keyframes toast-in {
    from { transform: translateX(40px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes toast-out {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(40px); opacity: 0; }
}

.activity-bell-wrapper {
    position: relative;
    margin-bottom: 14px;
}

.activity-bell-button {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.08);
    border: none;
    color: white;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    position: relative;
}

.activity-bell-button:hover {
    background: rgba(255, 255, 255, 0.14);
}

.activity-badge {
    margin-left: auto;
    background: #dc2626;
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 1px 7px;
    border-radius: 9999px;
}

.activity-dropdown {
    display: none;
    position: fixed;
    width: 300px;
    max-height: 360px;
    overflow-y: auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
    z-index: 500;
}

.activity-dropdown.is-open { display: block; }

.activity-dropdown-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f5;
}

.activity-dropdown-item p {
    margin: 0 0 4px;
    font-size: 13px;
    color: #1e1b4b;
    font-weight: 500;
}

.activity-dropdown-item span {
    font-size: 11px;
    color: #6b7280;
}

.activity-dropdown-footer {
    display: block;
    text-align: center;
    padding: 12px;
    font-size: 13px;
    font-weight: 600;
    color: #1e1b4b;
    text-decoration: none;
}

.activity-dropdown-footer:hover { background: #f6f7fb; }

@media (max-width: 850px) {
    .container { padding: 20px 14px 40px; }
    .grid { grid-template-columns: 1fr !important; }
    .dashboard-welcome { flex-direction: column; align-items: flex-start; }
    .current-project-header { flex-direction: column; padding: 20px; }
    .current-project-title { font-size: 24px; }
    .project-info-grid { grid-template-columns: 1fr; }
    .project-info-item { padding: 16px 20px; }
    .project-info-item:not(:last-child) { border-right: none; border-bottom: 1px solid #e5e7eb; }
    .project-progress-section { padding: 20px; }
    .dashboard-grid { grid-template-columns: 1fr; }
    .client-invoice-list { grid-template-columns: 1fr; }
    .invoice-card-details { gap: 20px; flex-wrap: wrap; }
    .invoice-create { flex-direction: column; align-items: stretch; }
    .invoice-form { flex-direction: column; align-items: stretch; }
    .amount-input input { width: 100%; }
    .file-item { flex-direction: column; align-items: flex-start; }
    .file-item .btn { align-self: flex-end; }
    .milestone-card-header { flex-direction: column; align-items: stretch; }
    .milestone-main { width: 100%; }
    .milestone-title { flex-wrap: wrap; width: 100%; }
    .invoice-edit-row { flex-direction: column; }
    .invoice-status-select { width: 100%; }
    .milestone-actions { width: 100%; justify-content: space-between; margin-top: 10px; }
    .milestone-card-details { flex-direction: column; align-items: flex-start; gap: 16px; }
    .milestone-review { margin-left: 0; }
}
</style>
</head>
<body>

    @php
        $isGuest = auth()->guest();
        $isAdmin = !$isGuest && auth()->user()->role === 'admin';
        $homeRoute = $isGuest ? url('/login') : ($isAdmin ? route('admin.dashboard') : route('dashboard'));
        $current = request()->path();
    @endphp

    <div class="app-shell">
        @if(session('success'))
    <div class="toast toast-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="toast toast-error">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="toast toast-error">{{ $errors->first() }}</div>
@endif

        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <aside class="sidebar" id="sidebar">
            <a href="{{ $homeRoute }}" class="sidebar-brand">ClientHub</a>

                                   @unless($isGuest)
                <div style="display: flex; align-items: center; gap: 10px; padding: 0 12px 20px;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div style="min-width: 0;">
                        <div style="color: white; font-size: 14px; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ auth()->user()->name }}
                        </div>
                        <div style="color: var(--sidebar-text); font-size: 12px;">
                            {{ $isAdmin ? 'Administrator' : 'Client' }}
                        </div>
                    </div>
                </div>
            @endunless

            <nav class="sidebar-nav">
                @unless($isGuest)

               @if($isAdmin)
    <div class="activity-bell-wrapper">
        <button type="button" class="activity-bell-button" id="activityBellButton">
            <span>&#128276;</span> Notifications
            @if($unreadActivityCount > 0)
                <span class="activity-badge">{{ $unreadActivityCount > 9 ? '9+' : $unreadActivityCount }}</span>
            @endif
        </button>

        <div class="activity-dropdown" id="activityDropdown">
            @forelse($recentActivity as $item)
                <div class="activity-dropdown-item">
                    <p>{{ $item->description }}</p>
                    <span>{{ $item->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="activity-dropdown-item">
                    <p style="color: var(--muted);">No activity yet.</p>
                </div>
            @endforelse

            <a href="{{ route('admin.activity.index') }}" class="activity-dropdown-footer">
                View all activity
            </a>
        </div>
    </div>

    <a href="{{ route('admin.projects.create') }}" class="sidebar-quick-action">
    + New Project
</a>
@endif

                <div class="sidebar-section-label">Workspace</div>

                @if(!$isAdmin)
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') || request()->routeIs('dashboard.project') ? 'active' : '' }}">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Overview
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        Projects
                    </a>
                    <a href="{{ route('admin.clients.create') }}" class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        Clients
                    </a>
                    <a href="{{ route('admin.payments.index') }}" class="sidebar-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        Payments
                    </a>
                 <a href="{{ route('admin.activity.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}">
    Activity Log
</a>   
                @endif

                <div class="sidebar-section-label">Account</div>

                <a href="{{ route('account.edit') }}" class="sidebar-link {{ request()->routeIs('account.edit') ? 'active' : '' }}">
                    Settings
                </a>

                @if(!$isAdmin)
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=hello.clienthub@gmail.com" target="_blank" class="sidebar-link">
                        Contact Support
                    </a>
                @endif
                @endunless

                        @unless($isGuest)
                <div class="sidebar-divider"></div>

                <div class="sidebar-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link">Logout</button>
                    </form>
                </div>
            @endunless
        </aside>

        <div class="main-content">

            <div class="mobile-topbar">
                <a href="{{ $homeRoute }}" class="sidebar-brand" style="color: white;">ClientHub</a>
                <button class="mobile-menu-button" id="mobileMenuButton" aria-label="Open menu">&#9776;</button>
            </div>

            <main class="container">
                {{ $slot }}
            </main>

        </div>

    </div>
<script>
    (function () {
        var sidebar = document.getElementById('sidebar');
        var backdrop = document.getElementById('sidebarBackdrop');
        var button = document.getElementById('mobileMenuButton');

        function openMenu() {
            sidebar.classList.add('is-open');
            backdrop.classList.add('is-visible');
        }

        function closeMenu() {
            sidebar.classList.remove('is-open');
            backdrop.classList.remove('is-visible');
        }

        if (button) {
            button.addEventListener('click', openMenu);
        }
        if (backdrop) {
            backdrop.addEventListener('click', closeMenu);
        }

        document.querySelectorAll('.toast').forEach(function (toast, i) {
            setTimeout(function () {
                toast.classList.add('toast-hide');
            }, 3500 + i * 300);

            setTimeout(function () {
                toast.remove();
            }, 3900 + i * 300);
        });

        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function () {
                var btn = form.querySelector('button[type="submit"]');
                if (btn && !btn.disabled) {
                    btn.disabled = true;
                    btn.dataset.originalText = btn.innerHTML;
                    btn.innerHTML = 'Please wait...';
                    btn.style.opacity = '0.7';
                    btn.style.cursor = 'default';
                }
            });
        });

        var bellButton = document.getElementById('activityBellButton');
        var dropdown = document.getElementById('activityDropdown');

        if (bellButton && dropdown) {
    bellButton.addEventListener('click', function (e) {
        e.stopPropagation();
        if (dropdown.classList.contains('is-open')) {
            dropdown.classList.remove('is-open');
        } else {
            var rect = bellButton.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.classList.add('is-open');
        }
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && e.target !== bellButton) {
            dropdown.classList.remove('is-open');
        }
    });
}
    })();
</script>
    

</body>
</html>