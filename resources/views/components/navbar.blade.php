<header class="fixed top-0 left-0 right-0 z-40 bg-white/80 backdrop-blur-lg border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <span class="font-display text-2xl font-bold text-[#0f2557] tracking-tight group-hover:opacity-80 transition-opacity">IHURIRO</span>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
                <a href="https://divahousebeauty.com" target="_blank" class="nav-link font-medium hover:text-[#0f2557]">Shopping</a>
                <a href="{{ route('booking.create') }}" class="nav-link {{ request()->routeIs('booking.*') ? 'active' : '' }}">Book Now</a>
            </nav>
            
            <!-- Right Side -->
            <div class="flex items-center gap-4">
                
                <!-- CTA Button -->
                @guest
                    <a href="{{ route('login') }}" class="hidden md:inline-flex text-sm font-medium text-gray-700 hover:text-[#0f2557]">
                        Login
                    </a>
                    <a href="{{ route('booking.create') }}" class="hidden md:inline-flex btn-primary text-sm">
                        Book Appointment
                    </a>
                @endguest

                @auth
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('customer.dashboard') }}" class="text-sm font-medium text-[#0f2557] hover:underline">
                            My Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Spacer for fixed header -->
<div class="h-20"></div>
