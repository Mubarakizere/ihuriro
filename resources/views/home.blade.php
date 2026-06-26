@extends('layouts.app')

@section('title', 'IHURIRO - Premium Beauty & Wellness Salon in Rwanda')

@section('content')

{{-- Hero Section --}}
<section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden" id="hero-section">
    <!-- Carousel Backgrounds -->
    <div class="absolute inset-0 z-0 bg-slate-900" id="hero-carousel">
        @php
            // Use category images for the carousel, or fallbacks if none exist yet
            $carouselImages = !empty($categoryImages) ? array_filter(array_values($categoryImages)) : [];
            if(count($carouselImages) < 3) {
                $carouselImages = array_merge($carouselImages, [
                    'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=2000', // Salon interior
                    'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&q=80&w=2000', // Beauty
                    'https://images.unsplash.com/photo-1516975080661-46bce0d460d7?auto=format&fit=crop&q=80&w=2000'  // Makeup
                ]);
            }
        @endphp

        @foreach(array_slice($carouselImages, 0, 4) as $index => $image)
            <div class="hero-slide absolute inset-0 transition-all duration-[1500ms] ease-in-out {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-110' }}">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 via-slate-900/50 to-slate-900/80 z-10"></div>
                <img src="{{ $image }}" alt="IHURIRO Beauty" class="w-full h-full object-cover">
            </div>
        @endforeach
    </div>

    <!-- Content Overlay -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mt-16">
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-6 tracking-tight drop-shadow-xl">
            Elevate Your <br class="sm:hidden">
            <span class="text-blue-300">Style & Soul</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl mx-auto leading-relaxed drop-shadow-md font-medium">
            Step into Rwanda's premier destination for beauty and wellness. Where modern artistry meets timeless elegance.
        </p>
        <div class="flex flex-col sm:flex-row gap-5 justify-center">
            <a href="{{ route('booking.create') }}" class="px-8 py-4 bg-white text-slate-900 rounded-xl font-bold text-lg hover:bg-blue-50 hover:-translate-y-1 transition-all shadow-[0_0_30px_rgba(255,255,255,0.2)] hover:shadow-[0_0_40px_rgba(255,255,255,0.4)] duration-300">
                Book Appointment
            </a>
            <a href="{{ route('services.index') }}" class="px-8 py-4 bg-transparent border-2 border-white/70 text-white rounded-xl font-bold text-lg hover:bg-white/10 hover:border-white transition-all backdrop-blur-sm">
                Explore Services
            </a>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-3 gap-8 mt-20 pt-10 border-t border-white/20 max-w-3xl mx-auto">
            <div>
                <div class="font-display text-3xl md:text-5xl font-bold text-white drop-shadow-md">5K+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-300 mt-2 uppercase tracking-widest">Happy Clients</div>
            </div>
            <div>
                <div class="font-display text-3xl md:text-5xl font-bold text-white drop-shadow-md">7+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-300 mt-2 uppercase tracking-widest">Services</div>
            </div>
            <div>
                <div class="font-display text-3xl md:text-5xl font-bold text-white drop-shadow-md">4.9</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-300 mt-2 uppercase tracking-widest">Average Rating</div>
            </div>
        </div>
    </div>
</section>

{{-- Services Section --}}
<section class="py-24 bg-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-slate-900 mb-4 tracking-tight">Explore Our Collections</h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Curated beauty experiences tailored just for you.</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
                <a href="{{ route('services.index', ['category' => $category->slug]) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl hover:border-slate-300 transition-all duration-300">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ $category->image_path ?? 'https://loremflickr.com/800/600/salon?lock='.$category->id }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-slate-900 mb-2">{{ $category->name }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-2">
                            {{ $category->description ?? 'Explore our premium ' . strtolower($category->name) . ' services tailored for your ultimate look.' }}
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 text-sm font-semibold group-hover:translate-x-1 transition-transform">
                            View Services 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200">
                    No categories found. Check back later!
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-16">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition-colors shadow-sm">
                View All Services
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>

{{-- Why Choose Us Section --}}
<section class="py-24 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left Content -->
            <div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-slate-900 mb-6 tracking-tight">Why Choose IHURIRO?</h2>
                <div class="w-20 h-1 bg-blue-600 mb-8 rounded-full"></div>
                <p class="text-slate-600 mb-10 text-lg leading-relaxed">
                    At IHURIRO, we combine skilled artistry with premium products to deliver exceptional results. Our team of experienced professionals is dedicated to making you look and feel your absolute best.
                </p>
                
                <div class="space-y-8">
                    <div class="flex gap-5">
                        <div class="w-14 h-14 rounded-xl bg-slate-50 flex items-center justify-center flex-shrink-0 border border-slate-200">
                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-lg mb-1">Expert Professionals</h3>
                            <p class="text-slate-500">Our skilled team brings years of experience and continuous training to ensure perfect results.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-5">
                        <div class="w-14 h-14 rounded-xl bg-slate-50 flex items-center justify-center flex-shrink-0 border border-slate-200">
                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-lg mb-1">Premium Products</h3>
                            <p class="text-slate-500">We use only high-quality, dermatologically tested products for all our treatments.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Stats Card -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 lg:p-10 shadow-xl border border-slate-100">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-slate-900 mb-2">5+</div>
                            <div class="text-sm font-medium text-slate-500">Years Experience</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-slate-900 mb-2">15+</div>
                            <div class="text-sm font-medium text-slate-500">Expert Stylists</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-slate-900 mb-2">100%</div>
                            <div class="text-sm font-medium text-slate-500">Satisfaction</div>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="font-display text-4xl font-bold text-slate-900 mb-2">24/7</div>
                            <div class="text-sm font-medium text-slate-500">Online Booking</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section class="py-24 bg-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-slate-900 mb-4 tracking-tight">Client Stories</h2>
            <div class="w-16 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Read what our valued customers have to say about their experience.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <!-- Stars -->
                <div class="flex gap-1 mb-6">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                
                <p class="text-slate-600 mb-8 leading-relaxed">"{{ $testimonial->comment }}"</p>
                
                <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg border border-slate-200">
                        {{ $testimonial->initials }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">{{ $testimonial->name }}</div>
                        <div class="text-sm text-slate-500">{{ $testimonial->location }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200">
                Client reviews will appear here soon.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">
            Ready to Transform Your Look?
        </h2>
        <p class="text-slate-500 text-lg mb-12 max-w-2xl mx-auto leading-relaxed">
            Book your appointment today and experience the IHURIRO difference service. Secure your spot online in less than 2 minutes.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('booking.create') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white rounded-xl font-semibold text-lg hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10">
                Book Appointment Now
            </a>
            <a href="tel:+250780159059" class="w-full sm:w-auto px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold text-lg hover:bg-slate-50 transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Call +250 780 159 059
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Carousel with smooth fade and zoom animation
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length > 1) {
            let currentSlide = 0;
            
            setInterval(() => {
                // Fade out current slide, scale it up slightly
                slides[currentSlide].classList.remove('opacity-100', 'scale-100');
                slides[currentSlide].classList.add('opacity-0', 'scale-110');
                
                // Move to next slide
                currentSlide = (currentSlide + 1) % slides.length;
                
                // Before fading in, reset scale so it zooms out as it fades in
                // (It's currently at scale-110 from its previous hidden state)
                
                // Fade in next slide and scale it down to normal
                slides[currentSlide].classList.remove('opacity-0', 'scale-110');
                slides[currentSlide].classList.add('opacity-100', 'scale-100');
            }, 6000); // Change image every 6 seconds
        }
    });
</script>
@endpush
