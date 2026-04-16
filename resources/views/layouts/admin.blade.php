<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — ZhraanF Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=DM+Sans:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="admin-body antialiased">
    {{-- Sidebar --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar-logo">
            <a href="/" class="admin-logo-link">&lt;<span class="logo-accent">Zhraan</span>F&gt;</a>
            <span class="admin-badge">ADMIN</span>
        </div>

        <nav class="admin-nav">
            <a href="{{ route('admin.profile') }}" class="admin-nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                Profile
            </a>
            <a href="{{ route('admin.career') }}" class="admin-nav-link {{ request()->routeIs('admin.career') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                Career
            </a>
            <a href="{{ route('admin.activities') }}" class="admin-nav-link {{ request()->routeIs('admin.activities') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                Activities
            </a>
        </nav>

        <div class="admin-sidebar-footer">
            {{-- Theme toggle --}}
            <button type="button" class="admin-theme-toggle" id="admin-theme-toggle" title="Toggle theme">
                <svg class="admin-icon-sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="admin-icon-moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>

            @if(session('admin_avatar'))
                <img src="{{ session('admin_avatar') }}" alt="{{ session('admin_name') }}" class="admin-avatar">
            @endif
            <div class="admin-user-info">
                <span class="admin-user-name">{{ session('admin_name', 'Admin') }}</span>
                <span class="admin-user-email">{{ session('admin_email', '') }}</span>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin-top:auto;">
                @csrf
                <button type="submit" class="admin-logout-btn" title="Logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content (SCROLLABLE) --}}
    <main class="admin-main">
        <div class="admin-content">
            @if(session('success'))
                <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="admin-alert admin-alert--error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <script>
    // Admin theme toggle (independent from main site)
    (function() {
        const toggle = document.getElementById('admin-theme-toggle');
        const html = document.documentElement;
        const saved = localStorage.getItem('admin-theme') || 'dark';
        html.setAttribute('data-theme', saved);

        if (toggle) {
            toggle.addEventListener('click', () => {
                const current = html.getAttribute('data-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', next);
                localStorage.setItem('admin-theme', next);
            });
        }
    })();
    </script>
</body>
</html>
