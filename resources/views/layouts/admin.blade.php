<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - IHURIRO Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0f2557 0%, #051638 100%);
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar.open {
            transform: translateX(0);
        }

        /* Desktop: sidebar always visible */
        @media (min-width: 1024px) {
            .admin-sidebar {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 260px;
            }
        }

        .sidebar-link {
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(191, 219, 254, 0.8);
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        /* Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 40;
        }

        .sidebar-overlay.open {
            display: block;
        }

        /* Topbar */
        .topbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
        }

        /* Card */
        .content-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebar-overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="admin-sidebar">
        <!-- Logo -->
        <div class="p-6 pb-4">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
                <h1 style="font-family:'Outfit',sans-serif; font-size:1.5rem; font-weight:700; color:white; margin:0;">IHURIRO</h1>
                <span style="font-size:0.7rem; font-weight:500; color:#93c5fd; letter-spacing:0.1em; text-transform:uppercase;">Admin Panel</span>
            </a>
        </div>

        <!-- Nav -->
        <nav style="flex:1; padding:0 1rem; margin-top:0.5rem;">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.services.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" style="margin-top:0.25rem;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Services
            </a>
        </nav>

        <!-- Bottom section -->
        <div style="padding:1rem; margin-top:auto; border-top:1px solid rgba(255,255,255,0.1);">
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link" style="font-size:0.75rem;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View Website
            </a>

            <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem;">
                <div style="width:32px; height:32px; border-radius:50%; background:rgba(59,130,246,0.2); display:flex; align-items:center; justify-content:center; color:#bfdbfe; font-size:0.875rem; font-weight:700;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div style="min-width:0; flex:1;">
                    <p style="font-size:0.875rem; font-weight:500; color:white; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ Auth::user()->name }}</p>
                    <p style="font-size:0.75rem; color:#93c5fd; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-main" style="min-height:100vh; display:flex; flex-direction:column;">
        <!-- Top Bar -->
        <header class="topbar" style="position:sticky; top:0; z-index:30; padding:1rem 1.5rem;">
            <div style="display:flex; align-items:center; justify-content:space-between;">
                <!-- Mobile menu toggle -->
                <button onclick="toggleSidebar()" style="padding:0.5rem; border-radius:0.5rem; border:none; background:none; cursor:pointer; display:block;" class="lg-hide-btn">
                    <svg style="width:24px;height:24px;color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Page Title -->
                <h2 style="font-size:1.125rem; font-weight:700; color:#0f2557; font-family:'Outfit',sans-serif; margin:0;">
                    @yield('page-title', 'Dashboard')
                </h2>

                <!-- Logout -->
                <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" style="display:flex; align-items:center; gap:0.5rem; padding:0.5rem 1rem; font-size:0.875rem; font-weight:500; color:#64748b; background:none; border:none; border-radius:0.5rem; cursor:pointer; transition:all 0.2s;">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main style="flex:1; padding:1.5rem;" class="animate-in">
            <!-- Flash Messages -->
            @if(session('success'))
                <div style="margin-bottom:1.5rem; padding:1rem; background:#ecfdf5; border:1px solid #a7f3d0; border-radius:0.75rem; display:flex; align-items:center; gap:0.75rem;">
                    <svg style="width:20px;height:20px;color:#059669;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span style="color:#047857; font-size:0.875rem; font-weight:500;">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div style="margin-bottom:1.5rem; padding:1rem; background:#fef2f2; border:1px solid #fecaca; border-radius:0.75rem; display:flex; align-items:center; gap:0.75rem;">
                    <svg style="width:20px;height:20px;color:#dc2626;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span style="color:#b91c1c; font-size:0.875rem; font-weight:500;">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <style>
        @media (min-width: 1024px) {
            .lg-hide-btn { display: none !important; }
        }
    </style>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }
    </script>

    @stack('scripts')
</body>
</html>
