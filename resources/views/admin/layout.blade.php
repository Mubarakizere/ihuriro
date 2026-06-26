<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - IHURIRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .nav-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-item:hover {
            transform: translateX(4px);
        }
        /* Fade in animation for main content */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#0f2557] selection:text-white">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black/50 md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#0a1536] text-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:flex-shrink-0 shadow-2xl flex flex-col">
            <!-- Logo -->
            <div class="h-20 flex items-center border-b border-slate-800 px-6 bg-[#0a1536]">
                <div class="flex items-center w-full">
                    <span class="text-2xl font-black text-white tracking-widest uppercase">IHURIRO</span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 no-scrollbar">
                
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Overview</p>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Management Group -->
                <div class="mt-6" x-data="{ open: {{ request()->routeIs('admin.bookings.*') || request()->routeIs('admin.services.*') || request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 mb-1 text-xs font-semibold text-slate-500 hover:text-slate-300 uppercase tracking-wider transition-colors">
                        <span>Management</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="open" x-collapse class="space-y-1.5">
                        <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.bookings.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Bookings
                        </a>
                        
                        <a href="{{ route('admin.services.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.services.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Services
                        </a>

                        <a href="{{ route('admin.categories.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Categories
                        </a>
                    </div>
                </div>

                <!-- Locations Group -->
                <div class="mt-2" x-data="{ open: {{ request()->routeIs('admin.countries.*') || request()->routeIs('admin.cities.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 mb-1 text-xs font-semibold text-slate-500 hover:text-slate-300 uppercase tracking-wider transition-colors">
                        <span>Locations</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="open" x-collapse class="space-y-1.5">
                        <a href="{{ route('admin.countries.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.countries.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.countries.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Countries
                        </a>

                        <a href="{{ route('admin.cities.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.cities.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.cities.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Cities
                        </a>
                    </div>
                </div>

                <!-- Settings -->
                <div class="mt-6">
                    <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Settings</p>
                    <a href="{{ route('admin.settings.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600/10 text-blue-400 font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.settings.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Site Settings
                    </a>
                </div>
            </nav>

            <!-- Bottom action -->
            <div class="p-4 border-t border-white/10 bg-[#060e27]">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/5 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center group-hover:bg-white/20 transition-colors">
                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </div>
                    <span class="text-sm font-medium">View Website</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
            <!-- Header -->
            <header class="h-20 glass-panel sticky top-0 z-10 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xl font-bold text-slate-800 hidden sm:block">@yield('title', 'Admin Portal')</h2>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3 border-r border-slate-200 pr-4">
                        <div class="w-8 h-8 rounded-full bg-[#0f2557] text-white flex items-center justify-center font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block text-sm">
                            <p class="font-semibold text-slate-700 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 mt-1">Administrator</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg text-slate-500 hover:bg-red-50 hover:text-red-600 transition-colors group relative" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main view -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 lg:p-8 animate-fade-in">
                
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-200 p-4 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <p class="font-medium text-sm">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-emerald-600 hover:text-emerald-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms class="mb-6 bg-red-50 text-red-800 border border-red-200 p-4 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            <p class="font-medium text-sm">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-600 hover:text-red-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
