@extends('layouts.app')

@section('title', $service->name . ' - IHURIRO Beauty & Wellness Salon')
@section('description', $service->description)

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-[#0f2557]">Home</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('services.index') }}" class="text-slate-500 hover:text-[#0f2557]">Services</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-[#0f2557] font-medium">{{ $service->name }}</span>
        </nav>
    </div>
</div>

<!-- Service Detail -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-start">
            <!-- Left - Image/Icon -->
            <div class="relative">
                <div class="aspect-square rounded-3xl bg-blue-50 flex items-center justify-center overflow-hidden border border-blue-100">
                    <div class="w-40 h-40 rounded-3xl bg-[#0f2557] flex items-center justify-center text-white shadow-xl">
                        <div class="w-20 h-20">
                            @include('components.service-icon', ['icon' => $service->icon])
                        </div>
                    </div>
                </div>
                
                <!-- Simple Decoration -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-100/50 rounded-2xl -z-10"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-slate-100/50 rounded-full -z-10"></div>
            </div>
            
            <!-- Right - Details -->
            <div>
                <!-- Category Badge -->
                <span class="inline-block px-4 py-1 bg-blue-50 rounded-full text-[#0f2557] text-sm font-medium mb-4 capitalize border border-blue-100">
                    {{ str_replace('_', ' ', $service->category) }}
                </span>
                
                <h1 class="font-display text-4xl sm:text-5xl font-bold text-[#0f2557] mb-6">
                    {{ $service->name }}
                </h1>
                
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    {{ $service->description }}
                </p>
                
                <!-- Details Cards -->
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-6 h-6 text-[#0f2557]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-slate-500">Duration</span>
                        </div>
                        <div class="font-display text-2xl font-bold text-[#0f2557]">
                            {{ $service->formatted_duration }}
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-6 h-6 text-[#0f2557]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-slate-500">Price</span>
                        </div>
                        <div class="font-display text-2xl font-bold text-[#0f2557] price-display" 
                             data-rwf="{{ $service->price_rwf }}" 
                             data-usd="{{ $service->price_usd }}">
                            {{ $service->formatted_price_rwf }}
                        </div>
                        <div class="text-sm text-slate-500 mt-1">
                            ≈ {{ $service->formatted_price_usd }}
                        </div>
                    </div>
                </div>
                
                <!-- Currency Toggle -->
                <div class="mb-8">
                    <div class="currency-toggle">
                        <button class="currency-btn active" data-currency="RWF" onclick="setCurrency('RWF')">RWF</button>
                        <button class="currency-btn" data-currency="USD" onclick="setCurrency('USD')">USD</button>
                    </div>
                </div>
                
                <!-- Book Button -->
                <a href="{{ route('booking.create', ['service' => $service->slug]) }}" 
                   class="btn-primary inline-flex items-center gap-2 text-lg py-4 px-8 shadow-lg hover:shadow-xl">
                    Book This Service
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                
                <!-- Features -->
                <div class="mt-10 pt-8 border-t border-gray-200">
                    <h3 class="font-semibold text-[#0f2557] mb-4">What's Included:</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-slate-600">Professional consultation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-slate-600">Premium products used</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-slate-600">Expert stylist/technician</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-slate-600">Aftercare advice</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Services -->
@if($relatedServices->count() > 0)
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-2xl font-bold text-[#0f2557] mb-8 text-center">
            Related Services
        </h2>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedServices as $related)
            <a href="{{ route('services.show', $related->slug) }}" class="service-card group">
                <div class="p-6">
                    <div class="service-card-icon mb-4 group-hover:bg-[#0f2557] group-hover:text-white transition-colors">
                        @include('components.service-icon', ['icon' => $related->icon])
                    </div>
                    <h3 class="font-display text-lg font-semibold text-[#0f2557] mb-2 group-hover:text-blue-600 transition-colors">
                        {{ $related->name }}
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="price-display font-bold text-[#0f2557]" 
                              data-rwf="{{ $related->price_rwf }}" 
                              data-usd="{{ $related->price_usd }}">
                            {{ $related->formatted_price_rwf }}
                        </span>
                        <span class="text-sm text-slate-400">{{ $related->formatted_duration }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
