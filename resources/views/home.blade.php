@extends('layouts.app')

@section('title', 'IHURIRO - Premium Beauty & Wellness Salon in Rwanda')

@section('content')
<!-- Hero Section with Parallax & Carousel -->
<section class="relative min-h-screen flex items-center bg-[#0f2557] overflow-hidden" id="hero-section">
    <!-- Carousel Backgrounds -->
    <div class="absolute inset-0 z-0" id="hero-carousel">
        <!-- Slide 1: Makeup -->
        <div class="hero-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <img src="/images/categories/makeup.png" alt="Professional Makeup Service" class="w-full h-full object-cover">
        </div>
        <!-- Slide 2: Hair -->
        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <img src="/images/categories/hair.png" alt="Hair Styling & Cut" class="w-full h-full object-cover">
        </div>
        <!-- Slide 3: Lashes -->
        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <img src="/images/categories/lashes.png" alt="Eyelash Extensions" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Parallax Floating Elements -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="parallax-element absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl" data-speed="0.05"></div>
        <div class="parallax-element absolute bottom-1/3 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl" data-speed="0.08"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left Content -->
            <div class="text-center lg:text-left text-white">
                <!-- Badge Removed -->
                
                <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6 animate-fade-in-up">
                    Elevate Your
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Style & Soul</span>
                </h1>
                
                <p class="text-lg text-blue-100 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed animate-delay-100 animate-fade-in-up">
                    Step into Rwanda's premier destination for beauty and wellness. Where modern artistry meets timeless elegance.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-delay-200 animate-fade-in-up">
                    <a href="{{ route('booking.create') }}" class="px-8 py-4 bg-white text-[#0f2557] rounded-lg font-bold text-lg hover:bg-blue-50 transition-all shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transform hover:-translate-y-1">
                        Book Appointment
                    </a>
                    <a href="{{ route('services.index') }}" class="px-8 py-4 bg-transparent border-2 border-white/30 text-white rounded-lg font-bold text-lg hover:bg-white/10 transition-colors backdrop-blur-sm">
                        Explore Services
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 mt-16 pt-8 border-t border-white/10 animate-delay-300 animate-fade-in-up">
                    <div class="text-center lg:text-left">
                        <div class="font-display text-4xl font-bold text-white">5K+</div>
                        <div class="text-sm font-medium text-blue-200 mt-1">Happy Clients</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="font-display text-4xl font-bold text-white">7+</div>
                        <div class="text-sm font-medium text-blue-200 mt-1">Premium Services</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="font-display text-4xl font-bold text-white">4.9</div>
                        <div class="text-sm font-medium text-blue-200 mt-1">Average Rating</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Floating Cards (Parallax) -->
            <div class="relative hidden lg:block h-[600px] pointer-events-none">
                <!-- Floating Card 1: Nails -->
                <div class="parallax-card absolute top-10 right-10 w-64 bg-white/95 backdrop-blur-xl p-4 rounded-2xl shadow-2xl transform rotate-3 z-20" data-speed="0.04">
                    <img src="/images/categories/nails.png" alt="Nail Artistry" class="w-full h-40 object-cover rounded-xl mb-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-[#0f2557]">Nail Artistry</h4>
                            <p class="text-xs text-gray-500">Manicure & Pedicure</p>
                        </div>
                        <div class="flex text-yellow-500 text-xs">★★★★★</div>
                    </div>
                </div>

                <!-- Floating Card 2: Spa/Massage (using Waxing/Massage image if available, or just generic Spa) -->
                <!-- We don't have a specific 'spa' image in the list, so let's use Waxing or maybe duplicate Makeup for now if it makes sense, but Waxing is better contextually for 'body' -->
                <div class="parallax-card absolute bottom-20 left-10 w-64 bg-white/95 backdrop-blur-xl p-4 rounded-2xl shadow-2xl transform -rotate-3 z-30" data-speed="0.06">
                    <img src="/images/categories/tattoo.png" alt="Body Art & Spa" class="w-full h-40 object-cover rounded-xl mb-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-[#0f2557]">Body Art</h4>
                            <p class="text-xs text-gray-500">Premium Tattoo</p>
                        </div>
                        <div class="flex text-yellow-500 text-xs">★★★★★</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-24 bg-white relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate="animate-fade-in-up">
            <h2 class="section-title mb-4">Explore Our Collections</h2>
            <div class="w-24 h-1 bg-[#0f2557] mx-auto mb-6 rounded-full"></div>
            <p class="section-subtitle mx-auto text-slate-600">Curated beauty experiences tailored just for you.</p>
        </div>
        
        <!-- Curated Categories Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. Makeup -->
            <a href="{{ route('services.index', ['category' => 'makeup']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/makeup.png" alt="Makeup Artistry" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Makeup Artistry</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Bridal, Editorial & Special Occasion
                    </p>
                </div>
            </a>

            <!-- 2. Hair -->
            <a href="{{ route('services.index', ['category' => 'hair']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/hair.png" alt="Hair Styling" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Hair Styling</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Cuts, Colors, Braids & Treatments
                    </p>
                </div>
            </a>

            <!-- 3. Lashes -->
            <a href="{{ route('services.index', ['category' => 'lashes']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/lashes.png" alt="Lashes & Brows" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Lashes & Brows</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Extensions, Tinting & Lamination
                    </p>
                </div>
            </a>

            <!-- 4. Nails -->
            <a href="{{ route('services.index', ['category' => 'nails']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/nails.png" alt="Nail Care" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Nail Care</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Manicure, Pedicure & Gel Art
                    </p>
                </div>
            </a>

            <!-- 5. Body Art (Tattoo) -->
            <a href="{{ route('services.index', ['category' => 'tattoo']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/tattoo.png" alt="Body Art" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Body Art</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Professional Tattoo Services
                    </p>
                </div>
            </a>

            <!-- 6. Piercing -->
            <a href="{{ route('services.index', ['category' => 'piercing']) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/5] shadow-lg">
                <img src="/images/categories/piercing.png" alt="Piercing" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2557] via-[#0f2557]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                    <h3 class="font-display text-2xl font-bold text-white mb-2">Piercing & More</h3>
                    <p class="text-blue-100 text-sm opacity-0 group-hover:opacity-100 transition-opacity delay-100 transform translate-y-2 group-hover:translate-y-0">
                        Safe & Stylish Piercings
                    </p>
                </div>
            </a>
        
        <!-- View All Button -->
        <div class="text-center mt-16">
            <a href="{{ route('services.index') }}" class="btn-secondary inline-flex items-center gap-2">
                View All Services
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-24 bg-[#f1f5f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left Content -->
            <div data-animate="animate-fade-in-up">
                <h2 class="section-title mb-6">Why Choose IHURIRO?</h2>
                <div class="w-20 h-1 bg-[#0f2557] mb-8 rounded-full"></div>
                <p class="text-slate-600 mb-10 text-lg leading-relaxed">
                    At IHURIRO, we combine skilled artistry with premium products to deliver exceptional results. Our team of experienced professionals is dedicated to making you look and feel your absolute best.
                </p>
                
                <div class="space-y-8">
                    <div class="flex gap-5">
                        <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-200">
                            <svg class="w-6 h-6 text-[#0f2557]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#0f2557] text-lg mb-2">Expert Professionals</h3>
                            <p class="text-slate-500">Our skilled team brings years of experience and continuous training to ensure perfect results.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-5">
                        <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-200">
                            <svg class="w-6 h-6 text-[#0f2557]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#0f2557] text-lg mb-2">Premium Products</h3>
                            <p class="text-slate-500">We use only high-quality, dermatologically tested products for all our treatments.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Stats Card -->
            <div class="relative" data-animate="animate-slide-in-right">
                <div class="bg-white rounded-2xl p-10 shadow-xl border border-slate-100">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-[#0f2557] mb-2">5+</div>
                            <div class="text-sm font-medium text-slate-500">Years Experience</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-[#0f2557] mb-2">15+</div>
                            <div class="text-sm font-medium text-slate-500">Expert Stylists</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-[#0f2557] mb-2">100%</div>
                            <div class="text-sm font-medium text-slate-500">Satisfaction</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-[#0f2557] mb-2">24/7</div>
                            <div class="text-sm font-medium text-slate-500">Online Booking</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate="animate-fade-in-up">
            <h2 class="section-title mb-4">Client Stories</h2>
            <div class="w-16 h-1 bg-[#0f2557] mx-auto mb-6 rounded-full"></div>
            <p class="section-subtitle mx-auto text-slate-600">Read what our valued customers have to say about their experience.</p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $index => $testimonial)
            <div class="testimonial-card border border-slate-200 shadow-sm hover:shadow-md transition-shadow" data-animate="animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
                <!-- Stars -->
                <div class="flex gap-1 mb-6">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                
                <!-- Comment -->
                <p class="text-slate-600 mb-8 leading-relaxed italic">"{{ $testimonial->comment }}"</p>
                
                <!-- Author -->
                <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-[#0f2557] font-bold text-lg">
                        {{ $testimonial->initials }}
                    </div>
                    <div>
                        <div class="font-bold text-[#0f2557]">{{ $testimonial->name }}</div>
                        <div class="text-sm text-slate-500">{{ $testimonial->location }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section - Premium Dark Gradient -->
<section class="py-24 relative overflow-hidden">
    <!-- Background Gradient & Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#050b1a] to-[#0f2557] z-0"></div>
    <div class="absolute inset-0 bg-[url('/images/pattern.png')] opacity-5 z-0 mix-blend-overlay"></div>
    
    <!-- Decorative Blobs -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mb-6 leading-tight" data-animate="animate-fade-in-up">
            Ready to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Transform Your Look?</span>
        </h2>
        <p class="text-blue-100 text-lg mb-12 max-w-2xl mx-auto leading-relaxed" data-animate="animate-fade-in-up" style="animation-delay: 0.1s;">
            Book your appointment today and experience the IHURIRO difference service. Secure your spot online in less than 2 minutes.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-5 justify-center items-center" data-animate="animate-fade-in-up" style="animation-delay: 0.2s;">
            <a href="{{ route('booking.create') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-[#0f2557] rounded-xl font-bold text-lg hover:bg-blue-50 transition-all shadow-[0_0_20px_rgba(255,255,255,0.2)] hover:shadow-[0_0_30px_rgba(255,255,255,0.4)] transform hover:-translate-y-1">
                Book Appointment Now
            </a>
            <a href="tel:+250780159059" class="w-full sm:w-auto px-8 py-4 bg-white/5 border border-white/20 text-white rounded-xl font-bold text-lg hover:bg-white/10 transition-all backdrop-blur-sm flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Call +250 780 159 059
            </a>
        </div>
        
        <!-- Badge Removed -->
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Carousel
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;
        
        setInterval(() => {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');
            
            currentSlide = (currentSlide + 1) % slides.length;
            
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }, 5000); // Change every 5 seconds

        // Mouse Parallax
        const heroSection = document.getElementById('hero-section');
        const parallaxElements = document.querySelectorAll('.parallax-element, .parallax-card');
        
        heroSection.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth - e.pageX * 2) / 100;
            const y = (window.innerHeight - e.pageY * 2) / 100;
            
            parallaxElements.forEach(el => {
                const speed = el.getAttribute('data-speed') || 0.05;
                const xOffset = x * speed * 100;
                const yOffset = y * speed * 100;
                
                el.style.transform = `translateX(${xOffset}px) translateY(${yOffset}px)`;
            });
        });
    });
</script>
@endpush
