@extends('layouts.app')

@section('title', 'Service Menu | IHURIRO')
@section('description', 'Explore our premium beauty services menu. Select your location for precise pricing.')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-16 overflow-hidden bg-slate-900">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80" 
             alt="Luxury Salon Background" 
             class="w-full h-full object-cover opacity-40 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-t from-[#fafafc] via-slate-900/60 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8">
        <h1 class="font-display text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6 leading-tight animate-fade-in-up">
            Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Treatment Menu</span>
        </h1>
        <p class="text-slate-300 text-lg sm:text-xl max-w-2xl mx-auto font-light animate-fade-in-up" style="animation-delay: 0.1s;">
            Comprehensive, professional services tailored for you.
        </p>
    </div>
</section>

<!-- Main Container -->
<div class="bg-[#fafafc] min-h-screen pb-24 -mt-8 relative z-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Location Selector Widget -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8 mb-12 animate-fade-in-up" style="animation-delay: 0.2s;"
             x-data="locationSelector()">
            <form action="{{ route('services.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Select Country</label>
                    <select name="country_id" x-model="selectedCountry" class="block w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm bg-slate-50 hover:bg-white transition-colors cursor-pointer outline-none">
                        <option value="">All Locations</option>
                        <template x-for="country in countries" :key="country.id">
                            <option :value="country.id" x-text="country.name" :selected="country.id == selectedCountry"></option>
                        </template>
                    </select>
                </div>

                <div class="flex-1 w-full" x-show="selectedCountry" x-transition x-cloak>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Select City for Pricing</label>
                    <select name="city_id" x-model="selectedCity" class="block w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm bg-slate-50 hover:bg-white transition-colors cursor-pointer outline-none">
                        <option value="">Select a city...</option>
                        <template x-for="city in availableCities" :key="city.id">
                            <option :value="city.id" x-text="city.name" :selected="city.id == selectedCity"></option>
                        </template>
                    </select>
                </div>

                <div class="w-full md:w-auto mt-4 md:mt-0">
                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-[#0f2557] text-white text-sm font-bold rounded-xl hover:bg-[#0a183d] transition-all shadow-md hover:shadow-lg focus:ring-4 focus:ring-blue-100 flex items-center justify-center gap-2">
                        View Menu
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
            
            @if($selectedCity)
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center text-sm text-emerald-600 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Currently showing pricing for {{ $selectedCity->name }}, {{ $selectedCity->country->name }}.
                </div>
            @endif
        </div>

        <!-- Service Menu Accordions -->
        <div class="space-y-4" x-data="{ activeAccordion: null }">
            @forelse($categories as $category)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300"
                     :class="activeAccordion === {{ $category->id }} ? 'ring-2 ring-[#0f2557]/20 shadow-md' : 'hover:border-slate-300'">
                    
                    <!-- Accordion Header -->
                    <button @click="activeAccordion = activeAccordion === {{ $category->id }} ? null : {{ $category->id }}" 
                            class="w-full px-6 py-5 flex items-center justify-between bg-white hover:bg-slate-50 transition-colors focus:outline-none">
                        <div class="flex items-center gap-4 text-left">
                            @if($category->image_path)
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-12 h-12 rounded-full object-cover border border-slate-100 shadow-sm hidden sm:block">
                            @endif
                            <div>
                                <h2 class="font-display text-xl font-bold text-slate-900">{{ $category->name }}</h2>
                                <p class="text-sm text-slate-500 font-medium mt-0.5">{{ $category->services->count() }} Treatments</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-transform duration-300 border border-slate-100"
                             :class="activeAccordion === {{ $category->id }} ? 'rotate-180 bg-blue-50 text-[#0f2557] border-blue-100' : ''">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>

                    <!-- Accordion Content (Table) -->
                    <div x-show="activeAccordion === {{ $category->id }}" x-transition x-cloak>
                        <div class="border-t border-slate-100">
                            @if($category->description)
                                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 text-sm text-slate-600">
                                    {{ $category->description }}
                                </div>
                            @endif
                            
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-white">
                                        <tr>
                                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider border-b border-slate-100">Treatment</th>
                                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider border-b border-slate-100 hidden sm:table-cell">Duration</th>
                                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider border-b border-slate-100 text-right">Price</th>
                                            <th class="px-6 py-4 border-b border-slate-100 w-24"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($category->services as $service)
                                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                                <td class="px-6 py-5">
                                                    <div class="font-bold text-slate-900 text-base group-hover:text-[#0f2557] transition-colors">{{ $service->name }}</div>
                                                    <div class="text-sm text-slate-500 mt-1.5 line-clamp-2 max-w-sm">{{ $service->description }}</div>
                                                    <div class="text-xs font-medium text-slate-500 mt-3 sm:hidden flex items-center bg-slate-100 w-fit px-2 py-1 rounded">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        {{ $service->formatted_duration }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-5 hidden sm:table-cell whitespace-nowrap align-top pt-6">
                                                    <span class="inline-flex items-center text-sm font-medium text-slate-600 bg-slate-100 px-2.5 py-1.5 rounded-md border border-slate-200">
                                                        <svg class="w-3.5 h-3.5 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        {{ $service->formatted_duration }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-5 text-right align-top pt-6">
                                                    @if($selectedCity)
                                                        @php
                                                            $cityService = $service->cities->where('id', $selectedCity->id)->first();
                                                            $cityPrice = $cityService ? $cityService->pivot->price_rwf : null;
                                                        @endphp
                                                        @if($cityPrice)
                                                            <div class="font-bold text-[#0f2557] text-lg whitespace-nowrap">
                                                                {{ number_format($cityPrice) }} {{ $selectedCity->country->currency ?? 'RWF' }}
                                                            </div>
                                                        @else
                                                            <span class="text-sm text-slate-400 font-normal italic whitespace-nowrap">Not available</span>
                                                        @endif
                                                    @else
                                                        @php
                                                            // If a country is selected but no city, filter to show only cities in that country
                                                            $pricedCities = $service->cities->filter(function($c) use ($selectedCountry) { 
                                                                if (!$c->pivot->price_rwf) return false;
                                                                if ($selectedCountry && $c->country_id != $selectedCountry->id) return false;
                                                                return true;
                                                            });
                                                        @endphp
                                                        @if($pricedCities->count() > 0)
                                                            <div class="flex flex-col gap-1.5 text-sm items-end">
                                                                @foreach($pricedCities as $city)
                                                                    <div class="flex justify-end gap-3 whitespace-nowrap">
                                                                        <span class="text-slate-500">{{ $city->name }}:</span>
                                                                        <span class="font-bold text-[#0f2557]">{{ number_format($city->pivot->price_rwf) }} {{ $city->country->currency ?? 'RWF' }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-sm text-slate-400 font-normal italic whitespace-nowrap">Not available in selected location</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="px-6 py-5 text-right whitespace-nowrap align-top pt-5">
                                                    <a href="{{ route('booking.create', ['service' => $service->slug]) }}" 
                                                       class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-900 text-white text-sm font-semibold rounded-lg hover:bg-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/20 transition-all shadow-sm group-hover:shadow">
                                                        Book
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No Services Available</h3>
                    <p class="text-slate-500 text-lg max-w-md mx-auto">We are currently updating our premium service menu.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('locationSelector', () => ({
            countries: @json($countries),
            selectedCountry: '{{ $selectedCity ? $selectedCity->country_id : request('country_id', '') }}',
            selectedCity: '{{ request('city_id', '') }}',
            
            get availableCities() {
                if (!this.selectedCountry) return [];
                const country = this.countries.find(c => c.id == this.selectedCountry);
                return country ? country.cities : [];
            },
            
            init() {
                this.$watch('selectedCountry', (value) => {
                    const currentCountryHasSelectedCity = this.availableCities.some(c => c.id == this.selectedCity);
                    if (!currentCountryHasSelectedCity) {
                        this.selectedCity = '';
                    }
                });
            }
        }));
    });
</script>
@endpush

@push('styles')
<style>
    [x-cloak] { display: none !important; }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in-up {
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }
</style>
@endpush
@endsection
