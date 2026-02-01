@extends('layouts.app')

@section('title', 'IHURIRO')
@section('description', 'Explore our premium beauty services including haircuts, hairstyling, lashes, makeup, nails, tattoo, and spa treatments.')

@section('content')
<!-- Hero Section (Title & Image) -->
<section class="relative pt-32 pb-16 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1600948836101-f9ffda59d250?q=80&w=2036&auto=format&fit=crop" 
             alt="Luxury Salon Background" 
             class="w-full h-full object-cover">
        <!-- Black Overlay -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-[1px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Animated Main Title -->
        <h1 class="font-display text-4xl sm:text-6xl font-bold text-white mb-6 leading-tight drop-shadow-sm opacity-0 animate-fade-in-up">
            Find Your Perfect Treatment
        </h1>
        <!-- Animated Subtitle -->
        <p class="text-gray-200 text-lg sm:text-xl leading-relaxed max-w-2xl mx-auto font-light opacity-0 animate-fade-in-up delay-200">
            Browse our curated collection of beauty and wellness services designed for you.
        </p>
    </div>
</section>

<!-- Sticky Search & Filter Bar -->
<div id="sticky-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-white/20 shadow-lg transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search Bar -->
            <div class="relative w-full md:w-96 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#0f2557] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       id="service-search" 
                       class="block w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-full text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all" 
                       placeholder="Search services...">
            </div>

            <!-- Category Filters -->
            <div class="w-full md:w-auto overflow-x-auto pb-1 md:pb-0 no-scrollbar">
                <div class="flex gap-2" id="category-filters">
                    <button type="button" 
                            class="filter-pill active whitespace-nowrap px-4 py-2 rounded-full text-sm font-bold bg-[#0f2557] text-white shadow-md transition-all hover:scale-105" 
                            data-filter="all">
                        All
                    </button>
                    @foreach($services as $category => $categoryServices)
                        @php $label = $categoryLabels[$category] ?? ucfirst($category); @endphp
                        <button type="button" 
                                class="filter-pill whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium bg-white text-slate-600 border border-slate-200 hover:border-[#0f2557] hover:text-[#0f2557] transition-all hover:scale-105" 
                                data-filter="{{ $category }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Grid -->
<section class="py-12 bg-[#fafafc] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Results Counter -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-[#0f2557]">All Treatments</h2>
            <span class="text-sm text-slate-500 bg-white px-3 py-1 rounded-full border border-slate-100 shadow-sm" id="results-count">
                Showing all services
            </span>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="services-grid">
            @foreach($services as $category => $categoryServices)
                @foreach($categoryServices as $service)
                    <div class="service-card group bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full" 
                         data-name="{{ strtolower($service->name) }}" 
                         data-category="{{ $category }}">
                        
                        <!-- Icon/Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#0f2557] flex items-center justify-center group-hover:bg-[#0f2557] group-hover:text-white transition-colors duration-300">
                                @include('components.service-icon', ['icon' => $service->icon])
                            </div>
                            <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                                {{ ucfirst($category) }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <h3 class="font-display font-bold text-lg text-[#0f2557] mb-1 group-hover:text-blue-700 transition-colors line-clamp-2">
                                {{ $service->name }}
                            </h3>
                            <div class="flex items-center text-xs text-slate-500 mb-4 font-medium">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $service->formatted_duration }}
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="pt-4 border-t border-slate-50 flex items-center justify-between mt-auto">
                            <div class="font-bold text-[#0f2557]">
                                @if($service->price_rwf > 0)
                                    {{ number_format($service->price_rwf) }} <span class="text-xs font-normal text-slate-400">RWF</span>
                                @else
                                    <span class="text-xs text-slate-500">Variable</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('booking.create', ['service' => $service->slug]) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-[#0f2557] group-hover:bg-[#0f2557] group-hover:text-white transition-all transform group-hover:rotate-45 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

        <!-- Empty State -->
        <div id="no-results" class="hidden text-center py-24">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-[#0f2557]">No services found</h3>
            <p class="text-slate-500">Try adjusting your search or filter</p>
            <button onclick="resetFilters()" class="mt-4 text-blue-600 font-medium hover:underline">Clear all filters</button>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<button id="scroll-to-top" 
        class="fixed bottom-6 right-6 z-40 p-3 rounded-full bg-[#0f2557] text-white shadow-xl translate-y-20 opacity-0 transition-all duration-300 hover:bg-blue-800 hover:-translate-y-1 focus:outline-none">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Hero Text Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('service-search');
        const filterPills = document.querySelectorAll('.filter-pill');
        const cards = document.querySelectorAll('.service-card');
        const noResults = document.getElementById('no-results');
        const resultsCountStr = document.getElementById('results-count');
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        
        let activeCategory = 'all';
        let searchQuery = '';

        // Category Filter
        filterPills.forEach(pill => {
            pill.addEventListener('click', () => {
                // Toggle UI
                filterPills.forEach(p => {
                    p.classList.remove('bg-[#0f2557]', 'text-white', 'shadow-md');
                    p.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
                });
                
                pill.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
                pill.classList.add('bg-[#0f2557]', 'text-white', 'shadow-md');
                
                activeCategory = pill.dataset.filter;
                applyFilters();
            });
        });

        // Search Filter
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            applyFilters();
        });

        function applyFilters() {
            let visibleCount = 0;
            
            cards.forEach(card => {
                const name = card.dataset.name;
                const category = card.dataset.category;
                
                const matchesCategory = activeCategory === 'all' || category === activeCategory;
                const matchesSearch = name.includes(searchQuery);
                
                if (matchesCategory && matchesSearch) {
                    card.classList.remove('hidden');
                    card.classList.add('flex'); // Ensure flex display is restored
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('flex');
                }
            });

            // Update UI
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
            
            resultsCountStr.textContent = `Showing ${visibleCount} service${visibleCount !== 1 ? 's' : ''}`;
        }
        
        window.resetFilters = function() {
            searchInput.value = '';
            searchQuery = '';
            
            // Click "All" pill programmatically
            document.querySelector('[data-filter="all"]').click();
        }

        // Scroll Logic
        window.addEventListener('scroll', () => {
            // Sticky Header shadow effect
            const header = document.getElementById('sticky-header');
            if (window.scrollY > 100) {
                header.classList.add('shadow-lg', 'bg-white/95');
                header.classList.remove('shadow-none', 'bg-white/50');
            } else {
                // Optional: make it more transparent when at top if needed
            }

            // Scroll to Top visibility
            if (window.scrollY > 500) {
                scrollToTopBtn.classList.remove('translate-y-20', 'opacity-0');
            } else {
                scrollToTopBtn.classList.add('translate-y-20', 'opacity-0');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
@endpush
@endsection
