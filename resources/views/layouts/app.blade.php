<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'IHURIRO - Premium Beauty & Wellness Salon in Rwanda')</title>
    <meta name="description" content="@yield('description', 'IHURIRO offers premium beauty services including haircuts, hairstyling, lashes, makeup, nails, tattoo, and spa treatments in Rwanda. Book your appointment today!')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230f2557'/><text x='50' y='72' font-size='65' font-family='sans-serif' font-weight='bold' fill='white' text-anchor='middle'>I</text></svg>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Heroicons -->
    <script src="https://unpkg.com/@heroicons/vue@2.0.13/dist/heroicons.min.js" defer></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Site Loader -->
    <div id="site-loader">
        <div class="loader-logo">IHURIRO</div>
        <div class="loader-spinner"></div>
    </div>

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        <!-- Navigation -->
        @include('components.navbar')
    @endif
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        <!-- Footer -->
        @include('components.footer')
    @endif
    
    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="mobile-menu">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('home') }}" class="font-display text-2xl font-bold text-[#0f2557]">IHURIRO</a>
                <button onclick="toggleMobileMenu()" class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-4">
                <a href="{{ route('home') }}" class="text-lg font-medium py-3 border-b border-gray-100 text-[#0f2557]">Home</a>
                <a href="{{ route('services.index') }}" class="text-lg font-medium py-3 border-b border-gray-100 text-[#0f2557]">Services</a>
                <a href="https://divahousebeauty.com" target="_blank" class="text-lg font-medium py-3 border-b border-gray-100 text-[#0f2557]">Shopping</a>
                <a href="{{ route('booking.create') }}" class="text-lg font-medium py-3 border-b border-gray-100 text-[#0f2557]">Book Now</a>
            </nav>
            <div class="mt-8">
                <a href="{{ route('booking.create') }}" class="btn-primary block text-center">
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
            document.body.classList.toggle('overflow-hidden');
        }
        
        
        // Scroll animations
        const animatedElements = document.querySelectorAll('[data-animate]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated', entry.target.dataset.animate);
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(el => observer.observe(el));

        // Hide Site Loader on Page Load
        window.addEventListener('load', function() {
            const loader = document.getElementById('site-loader');
            if (loader) {
                // Optional slight delay for effect
                setTimeout(() => {
                    loader.classList.add('hidden-loader');
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 500); // Matches CSS transition duration
                }, 200);
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
