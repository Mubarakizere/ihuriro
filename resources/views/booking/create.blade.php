@extends('layouts.app')

@section('title', 'Book Appointment - IHURIRO')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30">

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  HERO HEADER                                                       --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <div class="bg-[#0f2557] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <h1 class="font-display text-3xl sm:text-4xl font-bold mb-3">Book Your Appointment</h1>
            <p class="text-blue-200 text-lg">Choose your location, pick a service, and we'll take care of the rest.</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  PROGRESS STEPPER                                                  --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <div class="sticky top-[80px] z-30 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                @php $steps = ['Location & Service', 'Date & Time', 'Your Details', 'Confirm']; @endphp
                @foreach($steps as $i => $label)
                    <div class="flex items-center gap-2 step-indicator" data-step="{{ $i + 1 }}">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300
                            {{ $i === 0 ? 'bg-[#0f2557] text-white shadow-lg shadow-blue-900/30' : 'bg-slate-100 text-slate-400' }}" id="step-circle-{{ $i + 1 }}">
                            <span class="step-number">{{ $i + 1 }}</span>
                            <svg class="w-4 h-4 hidden step-check" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="text-sm font-medium hidden sm:inline transition-colors duration-300 {{ $i === 0 ? 'text-[#0f2557]' : 'text-slate-400' }}" id="step-label-{{ $i + 1 }}">{{ $label }}</span>
                    </div>
                    @if($i < 3)
                        <div class="flex-1 mx-2 sm:mx-4">
                            <div class="h-0.5 bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-[#0f2557] rounded-full transition-all duration-500 w-0" id="step-line-{{ $i + 1 }}"></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  FORM                                                              --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <form id="booking-form">
        @csrf
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

            {{-- ───────────────────────────────────────────────────────── --}}
            {{--  STEP 1 — LOCATION & SERVICE                             --}}
            {{-- ───────────────────────────────────────────────────────── --}}
            <div id="step-1" class="step-panel">

                {{-- Location Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0f2557] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[#0f2557]">Where would you like to be served?</h2>
                            <p class="text-sm text-slate-500">Services and prices vary by location</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="country-selector">Country</label>
                            <select id="country-selector" class="w-full p-4 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/10 transition-all outline-none font-medium text-slate-700 cursor-pointer appearance-none" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%2364748b%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.25rem;">
                                <option value="">— Select country —</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="city-selector">City</label>
                            <select name="city_id" id="city-selector" class="w-full p-4 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/10 transition-all outline-none font-medium text-slate-700 cursor-pointer appearance-none disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%2364748b%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.25rem;" required disabled>
                                <option value="">— Select country first —</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Services Section (hidden until city picked) --}}
                <div id="services-section" class="hidden" style="animation: fadeSlideUp .4s ease-out">

                    {{-- Selected Location Badge --}}
                    <div class="flex items-center gap-2 mb-5" id="location-badge">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-[#0f2557] rounded-full text-sm font-medium border border-blue-100">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            <span id="location-badge-text">Kigali</span>
                        </span>
                        <span class="text-sm text-slate-400">— showing available services & local prices</span>
                    </div>

                    {{-- Search + Category Filter Bar --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-4 sm:p-5 mb-6">
                        <div class="relative mb-4">
                            <input type="text" id="service-search" placeholder="Search services…"
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-2 focus:ring-[#0f2557]/10 transition-all outline-none text-sm">
                            <svg class="w-4.5 h-4.5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="flex flex-wrap gap-2" id="category-tabs">
                            <button type="button" onclick="filterCategory('all', this)"
                                    class="category-tab active px-4 py-2 rounded-lg text-sm font-semibold transition-all bg-[#0f2557] text-white shadow-md" data-category="all">
                                All
                            </button>
                            @foreach($categories as $category)
                            <button type="button" onclick="filterCategory('{{ $category->id }}', this)"
                                    class="category-tab px-4 py-2 rounded-lg text-sm font-semibold transition-all bg-slate-100 text-slate-600 hover:bg-slate-200" data-category="{{ $category->id }}">
                                {{ $category->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- No Available Services in City Message --}}
                    <div id="no-services-city" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200/80 mb-6">
                        <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-1">No Services Available</h3>
                        <p class="text-slate-400 text-sm">We currently do not offer any services in this city.</p>
                    </div>

                    {{-- Service Cards by Category --}}
                    @foreach($categories as $category)
                    <div class="category-group mb-6" data-category="{{ $category->id }}">
                        <h3 class="font-display text-base font-bold text-[#0f2557] mb-3 flex items-center gap-2 category-title">
                            <span class="w-1.5 h-5 bg-[#0f2557] rounded-full"></span>
                            {{ $category->name }}
                        </h3>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden divide-y divide-slate-100">
                            @foreach($category->services as $service)
                            @php
                                $cityPrices = [];
                                foreach($service->cities as $c) {
                                    $cityPrices[$c->id] = $c->pivot->price_rwf !== null ? (float)$c->pivot->price_rwf : null;
                                }
                            @endphp
                            <label class="service-item flex items-center gap-4 px-5 py-4 cursor-pointer hover:bg-blue-50/40 transition-colors relative" data-name="{{ strtolower($service->name) }}">
                                <input type="radio" name="service_id" value="{{ $service->id }}"
                                       data-name="{{ $service->name }}"
                                       data-duration="{{ $service->formatted_duration }}"
                                       data-city-prices='{{ json_encode($cityPrices) }}'
                                       class="peer sr-only"
                                       {{ $selectedService && $selectedService->id == $service->id ? 'checked' : '' }}>

                                {{-- Radio Circle --}}
                                <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center shrink-0 transition-all peer-checked:border-[#0f2557] peer-checked:bg-[#0f2557] peer-disabled:opacity-40">
                                    <div class="w-2 h-2 rounded-full bg-white scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0 peer-disabled:opacity-40">
                                    <div class="font-semibold text-[#0f2557] text-[15px] leading-tight">{{ $service->name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ $service->formatted_duration }}</div>
                                </div>

                                {{-- Price --}}
                                <div class="text-right shrink-0 peer-disabled:opacity-40">
                                    <div class="price-display font-bold text-[#0f2557]">—</div>
                                </div>

                                {{-- Selected Indicator --}}
                                <div class="absolute inset-y-0 left-0 w-1 bg-[#0f2557] rounded-r-full scale-y-0 peer-checked:scale-y-100 transition-transform origin-center"></div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    {{-- No Results --}}
                    <div id="no-results" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200/80">
                        <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-1">No services found</h3>
                        <p class="text-slate-400 text-sm">Try a different search or category</p>
                    </div>
                </div>
            </div>

            {{-- ───────────────────────────────────────────────────────── --}}
            {{--  STEP 2 — DATE & TIME                                    --}}
            {{-- ───────────────────────────────────────────────────────── --}}
            <div id="step-2" class="step-panel hidden">

                {{-- Selected Service Recap --}}
                <div class="bg-blue-50/60 rounded-2xl border border-blue-100 px-6 py-4 mb-6 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#0f2557] text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Selected Service</div>
                        <div class="font-bold text-[#0f2557] text-lg truncate" id="recap-service">—</div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-[#0f2557] text-xl" id="recap-price">—</div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Date Picker --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-[#0f2557] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-[#0f2557]">Pick a Date</h3>
                        </div>
                        <input type="date" name="booking_date" id="booking-date"
                               style="color-scheme: light;"
                               class="w-full p-4 bg-slate-50 border-2 border-slate-200 rounded-xl font-medium text-slate-900 focus:outline-none focus:ring-4 focus:ring-[#0f2557]/10 focus:border-[#0f2557] transition-all cursor-pointer"
                               min="{{ date('Y-m-d') }}" required>
                    </div>

                    {{-- Time Slots --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-[#0f2557] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-[#0f2557]">Pick a Time</h3>
                        </div>
                        <input type="hidden" name="booking_time" id="booking-time">
                        <div id="time-slots-container" class="grid grid-cols-3 gap-2 max-h-72 overflow-y-auto pr-1">
                            <div class="col-span-full py-10 text-center">
                                <div class="text-slate-400 text-sm">Select a date first</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ───────────────────────────────────────────────────────── --}}
            {{--  STEP 3 — YOUR DETAILS                                   --}}
            {{-- ───────────────────────────────────────────────────────── --}}
            <div id="step-3" class="step-panel hidden">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8 max-w-lg mx-auto">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0f2557] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[#0f2557]">Your Contact Details</h2>
                            <p class="text-sm text-slate-500">We'll send confirmation here</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                            <input type="text" name="customer_name" id="customer-name" value="{{ old('customer_name', $user->name ?? '') }}"
                                   class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="e.g. Jane Uwimana" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                            <input type="email" name="customer_email" id="customer-email" value="{{ old('customer_email', $user->email ?? '') }}"
                                   class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="jane@example.com" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone Number</label>
                            <div class="flex">
                                @php
                                    $worldCountryCodes = [
                                        "RW" => ["name" => "Rwanda", "code" => "+250", "flag" => "🇷🇼"],
                                        "AF" => ["name" => "Afghanistan", "code" => "+93", "flag" => "🇦🇫"],
                                        "AL" => ["name" => "Albania", "code" => "+355", "flag" => "🇦🇱"],
                                        "DZ" => ["name" => "Algeria", "code" => "+213", "flag" => "🇩🇿"],
                                        "AS" => ["name" => "American Samoa", "code" => "+1", "flag" => "🇦🇸"],
                                        "AD" => ["name" => "Andorra", "code" => "+376", "flag" => "🇦🇩"],
                                        "AO" => ["name" => "Angola", "code" => "+244", "flag" => "🇦🇴"],
                                        "AI" => ["name" => "Anguilla", "code" => "+1", "flag" => "🇦🇮"],
                                        "AG" => ["name" => "Antigua and Barbuda", "code" => "+1", "flag" => "🇦🇬"],
                                        "AR" => ["name" => "Argentina", "code" => "+54", "flag" => "🇦🇷"],
                                        "AM" => ["name" => "Armenia", "code" => "+374", "flag" => "🇦🇲"],
                                        "AW" => ["name" => "Aruba", "code" => "+297", "flag" => "🇦🇼"],
                                        "AU" => ["name" => "Australia", "code" => "+61", "flag" => "🇦🇺"],
                                        "AT" => ["name" => "Austria", "code" => "+43", "flag" => "🇦🇹"],
                                        "AZ" => ["name" => "Azerbaijan", "code" => "+994", "flag" => "🇦🇿"],
                                        "BS" => ["name" => "Bahamas", "code" => "+1", "flag" => "🇧🇸"],
                                        "BH" => ["name" => "Bahrain", "code" => "+973", "flag" => "🇧🇭"],
                                        "BD" => ["name" => "Bangladesh", "code" => "+880", "flag" => "🇧🇩"],
                                        "BB" => ["name" => "Barbados", "code" => "+1", "flag" => "🇧🇧"],
                                        "BY" => ["name" => "Belarus", "code" => "+375", "flag" => "🇧🇾"],
                                        "BE" => ["name" => "Belgium", "code" => "+32", "flag" => "🇧🇪"],
                                        "BZ" => ["name" => "Belize", "code" => "+501", "flag" => "🇧🇿"],
                                        "BJ" => ["name" => "Benin", "code" => "+229", "flag" => "🇧🇯"],
                                        "BM" => ["name" => "Bermuda", "code" => "+1", "flag" => "🇧🇲"],
                                        "BT" => ["name" => "Bhutan", "code" => "+975", "flag" => "🇧🇹"],
                                        "BO" => ["name" => "Bolivia", "code" => "+591", "flag" => "🇧🇴"],
                                        "BA" => ["name" => "Bosnia and Herzegovina", "code" => "+387", "flag" => "🇧🇦"],
                                        "BW" => ["name" => "Botswana", "code" => "+267", "flag" => "🇧🇼"],
                                        "BR" => ["name" => "Brazil", "code" => "+55", "flag" => "🇧🇷"],
                                        "IO" => ["name" => "British Indian Ocean Territory", "code" => "+246", "flag" => "🇮🇴"],
                                        "VG" => ["name" => "British Virgin Islands", "code" => "+1", "flag" => "🇻🇬"],
                                        "BN" => ["name" => "Brunei", "code" => "+673", "flag" => "🇧🇳"],
                                        "BG" => ["name" => "Bulgaria", "code" => "+359", "flag" => "🇧🇬"],
                                        "BF" => ["name" => "Burkina Faso", "code" => "+226", "flag" => "🇧🇫"],
                                        "BI" => ["name" => "Burundi", "code" => "+257", "flag" => "🇧🇮"],
                                        "KH" => ["name" => "Cambodia", "code" => "+855", "flag" => "🇰🇭"],
                                        "CM" => ["name" => "Cameroon", "code" => "+237", "flag" => "🇨🇲"],
                                        "CA" => ["name" => "Canada", "code" => "+1", "flag" => "🇨🇦"],
                                        "CV" => ["name" => "Cape Verde", "code" => "+238", "flag" => "🇨🇻"],
                                        "KY" => ["name" => "Cayman Islands", "code" => "+1", "flag" => "🇰🇾"],
                                        "CF" => ["name" => "Central African Republic", "code" => "+236", "flag" => "🇨🇫"],
                                        "TD" => ["name" => "Chad", "code" => "+235", "flag" => "🇹🇩"],
                                        "CL" => ["name" => "Chile", "code" => "+56", "flag" => "🇨🇱"],
                                        "CN" => ["name" => "China", "code" => "+86", "flag" => "🇨🇳"],
                                        "CX" => ["name" => "Christmas Island", "code" => "+61", "flag" => "🇨🇽"],
                                        "CC" => ["name" => "Cocos Islands", "code" => "+61", "flag" => "🇨🇨"],
                                        "CO" => ["name" => "Colombia", "code" => "+57", "flag" => "🇨🇴"],
                                        "KM" => ["name" => "Comoros", "code" => "+269", "flag" => "🇰🇲"],
                                        "CK" => ["name" => "Cook Islands", "code" => "+682", "flag" => "🇨🇰"],
                                        "CR" => ["name" => "Costa Rica", "code" => "+506", "flag" => "🇨🇷"],
                                        "HR" => ["name" => "Croatia", "code" => "+385", "flag" => "🇭🇷"],
                                        "CU" => ["name" => "Cuba", "code" => "+53", "flag" => "🇨🇺"],
                                        "CW" => ["name" => "Curacao", "code" => "+599", "flag" => "🇨🇼"],
                                        "CY" => ["name" => "Cyprus", "code" => "+357", "flag" => "🇨🇾"],
                                        "CZ" => ["name" => "Czech Republic", "code" => "+420", "flag" => "🇨🇿"],
                                        "CD" => ["name" => "Democratic Republic of the Congo", "code" => "+243", "flag" => "🇨🇩"],
                                        "DK" => ["name" => "Denmark", "code" => "+45", "flag" => "🇩🇰"],
                                        "DJ" => ["name" => "Djibouti", "code" => "+253", "flag" => "🇩🇯"],
                                        "DM" => ["name" => "Dominica", "code" => "+1", "flag" => "🇩🇲"],
                                        "DO" => ["name" => "Dominican Republic", "code" => "+1", "flag" => "🇩🇴"],
                                        "TL" => ["name" => "East Timor", "code" => "+670", "flag" => "🇹🇱"],
                                        "EC" => ["name" => "Ecuador", "code" => "+593", "flag" => "🇪🇨"],
                                        "EG" => ["name" => "Egypt", "code" => "+20", "flag" => "🇪🇬"],
                                        "SV" => ["name" => "El Salvador", "code" => "+503", "flag" => "🇸🇻"],
                                        "GQ" => ["name" => "Equatorial Guinea", "code" => "+240", "flag" => "🇬🇶"],
                                        "ER" => ["name" => "Eritrea", "code" => "+291", "flag" => "🇪🇷"],
                                        "EE" => ["name" => "Estonia", "code" => "+372", "flag" => "🇪🇪"],
                                        "ET" => ["name" => "Ethiopia", "code" => "+251", "flag" => "🇪🇹"],
                                        "FK" => ["name" => "Falkland Islands", "code" => "+500", "flag" => "🇫🇰"],
                                        "FO" => ["name" => "Faroe Islands", "code" => "+298", "flag" => "🇫🇴"],
                                        "FJ" => ["name" => "Fiji", "code" => "+679", "flag" => "🇫🇯"],
                                        "FI" => ["name" => "Finland", "code" => "+358", "flag" => "🇫🇮"],
                                        "FR" => ["name" => "France", "code" => "+33", "flag" => "🇫🇷"],
                                        "PF" => ["name" => "French Polynesia", "code" => "+689", "flag" => "🇵🇫"],
                                        "GA" => ["name" => "Gabon", "code" => "+241", "flag" => "🇬🇦"],
                                        "GM" => ["name" => "Gambia", "code" => "+220", "flag" => "🇬🇲"],
                                        "GE" => ["name" => "Georgia", "code" => "+995", "flag" => "🇬🇪"],
                                        "DE" => ["name" => "Germany", "code" => "+49", "flag" => "🇩🇪"],
                                        "GH" => ["name" => "Ghana", "code" => "+233", "flag" => "🇬🇭"],
                                        "GI" => ["name" => "Gibraltar", "code" => "+350", "flag" => "🇬🇮"],
                                        "GR" => ["name" => "Greece", "code" => "+30", "flag" => "🇬🇷"],
                                        "GL" => ["name" => "Greenland", "code" => "+299", "flag" => "🇬🇱"],
                                        "GD" => ["name" => "Grenada", "code" => "+1", "flag" => "🇬🇩"],
                                        "GU" => ["name" => "Guam", "code" => "+1", "flag" => "🇬🇺"],
                                        "GT" => ["name" => "Guatemala", "code" => "+502", "flag" => "🇬🇹"],
                                        "GG" => ["name" => "Guernsey", "code" => "+44", "flag" => "🇬🇬"],
                                        "GN" => ["name" => "Guinea", "code" => "+224", "flag" => "🇬🇳"],
                                        "GW" => ["name" => "Guinea-Bissau", "code" => "+245", "flag" => "🇬🇼"],
                                        "GY" => ["name" => "Guyana", "code" => "+592", "flag" => "🇬🇾"],
                                        "HT" => ["name" => "Haiti", "code" => "+509", "flag" => "🇭🇹"],
                                        "HN" => ["name" => "Honduras", "code" => "+504", "flag" => "🇭🇳"],
                                        "HK" => ["name" => "Hong Kong", "code" => "+852", "flag" => "🇭🇰"],
                                        "HU" => ["name" => "Hungary", "code" => "+36", "flag" => "🇭🇺"],
                                        "IS" => ["name" => "Iceland", "code" => "+354", "flag" => "🇮🇸"],
                                        "IN" => ["name" => "India", "code" => "+91", "flag" => "🇮🇳"],
                                        "ID" => ["name" => "Indonesia", "code" => "+62", "flag" => "🇮🇩"],
                                        "IR" => ["name" => "Iran", "code" => "+98", "flag" => "🇮🇷"],
                                        "IQ" => ["name" => "Iraq", "code" => "+964", "flag" => "🇮🇶"],
                                        "IE" => ["name" => "Ireland", "code" => "+353", "flag" => "🇮🇪"],
                                        "IM" => ["name" => "Isle of Man", "code" => "+44", "flag" => "🇮🇲"],
                                        "IL" => ["name" => "Israel", "code" => "+972", "flag" => "🇮🇱"],
                                        "IT" => ["name" => "Italy", "code" => "+39", "flag" => "🇮🇹"],
                                        "CI" => ["name" => "Ivory Coast", "code" => "+225", "flag" => "🇨🇮"],
                                        "JM" => ["name" => "Jamaica", "code" => "+1", "flag" => "🇯🇲"],
                                        "JP" => ["name" => "Japan", "code" => "+81", "flag" => "🇯🇵"],
                                        "JE" => ["name" => "Jersey", "code" => "+44", "flag" => "🇯🇪"],
                                        "JO" => ["name" => "Jordan", "code" => "+962", "flag" => "🇯🇴"],
                                        "KZ" => ["name" => "Kazakhstan", "code" => "+7", "flag" => "🇰🇿"],
                                        "KE" => ["name" => "Kenya", "code" => "+254", "flag" => "🇰🇪"],
                                        "KI" => ["name" => "Kiribati", "code" => "+686", "flag" => "🇰🇮"],
                                        "XK" => ["name" => "Kosovo", "code" => "+383", "flag" => "🇽🇰"],
                                        "KW" => ["name" => "Kuwait", "code" => "+965", "flag" => "🇰🇼"],
                                        "KG" => ["name" => "Kyrgyzstan", "code" => "+996", "flag" => "🇰🇬"],
                                        "LA" => ["name" => "Laos", "code" => "+856", "flag" => "🇱🇦"],
                                        "LV" => ["name" => "Latvia", "code" => "+371", "flag" => "🇱🇻"],
                                        "LB" => ["name" => "Lebanon", "code" => "+961", "flag" => "🇱🇧"],
                                        "LS" => ["name" => "Lesotho", "code" => "+266", "flag" => "🇱🇸"],
                                        "LR" => ["name" => "Liberia", "code" => "+231", "flag" => "🇱🇷"],
                                        "LY" => ["name" => "Libya", "code" => "+218", "flag" => "🇱🇾"],
                                        "LI" => ["name" => "Liechtenstein", "code" => "+423", "flag" => "🇱🇮"],
                                        "LT" => ["name" => "Lithuania", "code" => "+370", "flag" => "🇱🇹"],
                                        "LU" => ["name" => "Luxembourg", "code" => "+352", "flag" => "🇱🇺"],
                                        "MO" => ["name" => "Macau", "code" => "+853", "flag" => "🇲🇴"],
                                        "MK" => ["name" => "Macedonia", "code" => "+389", "flag" => "🇲🇰"],
                                        "MG" => ["name" => "Madagascar", "code" => "+261", "flag" => "🇲🇬"],
                                        "MW" => ["name" => "Malawi", "code" => "+265", "flag" => "🇲🇼"],
                                        "MY" => ["name" => "Malaysia", "code" => "+60", "flag" => "🇲🇾"],
                                        "MV" => ["name" => "Maldives", "code" => "+960", "flag" => "🇲🇻"],
                                        "ML" => ["name" => "Mali", "code" => "+223", "flag" => "🇲🇱"],
                                        "MT" => ["name" => "Malta", "code" => "+356", "flag" => "🇲🇹"],
                                        "MH" => ["name" => "Marshall Islands", "code" => "+692", "flag" => "🇲🇭"],
                                        "MR" => ["name" => "Mauritania", "code" => "+222", "flag" => "🇲🇷"],
                                        "MU" => ["name" => "Mauritius", "code" => "+230", "flag" => "🇲🇺"],
                                        "YT" => ["name" => "Mayotte", "code" => "+262", "flag" => "🇾🇹"],
                                        "MX" => ["name" => "Mexico", "code" => "+52", "flag" => "🇲🇽"],
                                        "FM" => ["name" => "Micronesia", "code" => "+691", "flag" => "🇫🇲"],
                                        "MD" => ["name" => "Moldova", "code" => "+373", "flag" => "🇲🇩"],
                                        "MC" => ["name" => "Monaco", "code" => "+377", "flag" => "🇲🇨"],
                                        "MN" => ["name" => "Mongolia", "code" => "+976", "flag" => "🇲🇳"],
                                        "ME" => ["name" => "Montenegro", "code" => "+382", "flag" => "🇲🇪"],
                                        "MS" => ["name" => "Montserrat", "code" => "+1", "flag" => "🇲🇸"],
                                        "MA" => ["name" => "Morocco", "code" => "+212", "flag" => "🇲🇦"],
                                        "MZ" => ["name" => "Mozambique", "code" => "+258", "flag" => "🇲🇿"],
                                        "MM" => ["name" => "Myanmar", "code" => "+95", "flag" => "🇲🇲"],
                                        "NA" => ["name" => "Namibia", "code" => "+264", "flag" => "🇳🇦"],
                                        "NR" => ["name" => "Nauru", "code" => "+674", "flag" => "🇳🇷"],
                                        "NP" => ["name" => "Nepal", "code" => "+977", "flag" => "🇳🇵"],
                                        "NL" => ["name" => "Netherlands", "code" => "+31", "flag" => "🇳🇱"],
                                        "NC" => ["name" => "New Caledonia", "code" => "+687", "flag" => "🇳🇨"],
                                        "NZ" => ["name" => "New Zealand", "code" => "+64", "flag" => "🇳🇿"],
                                        "NI" => ["name" => "Nicaragua", "code" => "+505", "flag" => "🇳🇮"],
                                        "NE" => ["name" => "Niger", "code" => "+227", "flag" => "🇳🇪"],
                                        "NG" => ["name" => "Nigeria", "code" => "+234", "flag" => "🇳🇬"],
                                        "NU" => ["name" => "Niue", "code" => "+683", "flag" => "🇳🇺"],
                                        "KP" => ["name" => "North Korea", "code" => "+850", "flag" => "🇰🇵"],
                                        "MP" => ["name" => "Northern Mariana Islands", "code" => "+1", "flag" => "🇲🇵"],
                                        "NO" => ["name" => "Norway", "code" => "+47", "flag" => "🇳🇴"],
                                        "OM" => ["name" => "Oman", "code" => "+968", "flag" => "🇴🇲"],
                                        "PK" => ["name" => "Pakistan", "code" => "+92", "flag" => "🇵🇰"],
                                        "PW" => ["name" => "Palau", "code" => "+680", "flag" => "🇵🇼"],
                                        "PS" => ["name" => "Palestine", "code" => "+970", "flag" => "🇵🇸"],
                                        "PA" => ["name" => "Panama", "code" => "+507", "flag" => "🇵🇦"],
                                        "PG" => ["name" => "Papua New Guinea", "code" => "+675", "flag" => "🇵🇬"],
                                        "PY" => ["name" => "Paraguay", "code" => "+595", "flag" => "🇵🇾"],
                                        "PE" => ["name" => "Peru", "code" => "+51", "flag" => "🇵🇪"],
                                        "PH" => ["name" => "Philippines", "code" => "+63", "flag" => "🇵🇭"],
                                        "PN" => ["name" => "Pitcairn", "code" => "+64", "flag" => "🇵🇳"],
                                        "PL" => ["name" => "Poland", "code" => "+48", "flag" => "🇵🇱"],
                                        "PT" => ["name" => "Portugal", "code" => "+351", "flag" => "🇵🇹"],
                                        "PR" => ["name" => "Puerto Rico", "code" => "+1", "flag" => "🇵🇷"],
                                        "QA" => ["name" => "Qatar", "code" => "+974", "flag" => "🇶🇦"],
                                        "CG" => ["name" => "Republic of the Congo", "code" => "+242", "flag" => "🇨🇬"],
                                        "RE" => ["name" => "Reunion", "code" => "+262", "flag" => "🇷🇪"],
                                        "RO" => ["name" => "Romania", "code" => "+40", "flag" => "🇷🇴"],
                                        "RU" => ["name" => "Russia", "code" => "+7", "flag" => "🇷🇺"],
                                        "BL" => ["name" => "Saint Barthelemy", "code" => "+590", "flag" => "🇧🇱"],
                                        "SH" => ["name" => "Saint Helena", "code" => "+290", "flag" => "🇸🇭"],
                                        "KN" => ["name" => "Saint Kitts and Nevis", "code" => "+1", "flag" => "🇰🇳"],
                                        "LC" => ["name" => "Saint Lucia", "code" => "+1", "flag" => "🇱🇨"],
                                        "MF" => ["name" => "Saint Martin", "code" => "+590", "flag" => "🇲🇫"],
                                        "PM" => ["name" => "Saint Pierre and Miquelon", "code" => "+508", "flag" => "🇵🇲"],
                                        "VC" => ["name" => "Saint Vincent and the Grenadines", "code" => "+1", "flag" => "🇻🇨"],
                                        "WS" => ["name" => "Samoa", "code" => "+685", "flag" => "🇼🇸"],
                                        "SM" => ["name" => "San Marino", "code" => "+378", "flag" => "🇸🇲"],
                                        "ST" => ["name" => "Sao Tome and Principe", "code" => "+239", "flag" => "🇸🇹"],
                                        "SA" => ["name" => "Saudi Arabia", "code" => "+966", "flag" => "🇸🇦"],
                                        "SN" => ["name" => "Senegal", "code" => "+221", "flag" => "🇸🇳"],
                                        "RS" => ["name" => "Serbia", "code" => "+381", "flag" => "🇷🇸"],
                                        "SC" => ["name" => "Seychelles", "code" => "+248", "flag" => "🇸🇨"],
                                        "SL" => ["name" => "Sierra Leone", "code" => "+232", "flag" => "🇸🇱"],
                                        "SG" => ["name" => "Singapore", "code" => "+65", "flag" => "🇸🇬"],
                                        "SX" => ["name" => "Sint Maarten", "code" => "+1", "flag" => "🇸🇽"],
                                        "SK" => ["name" => "Slovakia", "code" => "+421", "flag" => "🇸🇰"],
                                        "SI" => ["name" => "Slovenia", "code" => "+386", "flag" => "🇸🇮"],
                                        "SB" => ["name" => "Solomon Islands", "code" => "+677", "flag" => "🇸🇧"],
                                        "SO" => ["name" => "Somalia", "code" => "+252", "flag" => "🇸🇴"],
                                        "ZA" => ["name" => "South Africa", "code" => "+27", "flag" => "🇿🇦"],
                                        "KR" => ["name" => "South Korea", "code" => "+82", "flag" => "🇰🇷"],
                                        "SS" => ["name" => "South Sudan", "code" => "+211", "flag" => "🇸🇸"],
                                        "ES" => ["name" => "Spain", "code" => "+34", "flag" => "🇪🇸"],
                                        "LK" => ["name" => "Sri Lanka", "code" => "+94", "flag" => "🇱🇰"],
                                        "SD" => ["name" => "Sudan", "code" => "+249", "flag" => "🇸🇩"],
                                        "SR" => ["name" => "Suriname", "code" => "+597", "flag" => "🇸🇷"],
                                        "SJ" => ["name" => "Svalbard and Jan Mayen", "code" => "+47", "flag" => "🇸🇯"],
                                        "SZ" => ["name" => "Swaziland", "code" => "+268", "flag" => "🇸🇿"],
                                        "SE" => ["name" => "Sweden", "code" => "+46", "flag" => "🇸🇪"],
                                        "CH" => ["name" => "Switzerland", "code" => "+41", "flag" => "🇨🇭"],
                                        "SY" => ["name" => "Syria", "code" => "+963", "flag" => "🇸🇾"],
                                        "TW" => ["name" => "Taiwan", "code" => "+886", "flag" => "🇹🇼"],
                                        "TJ" => ["name" => "Tajikistan", "code" => "+992", "flag" => "🇹🇯"],
                                        "TZ" => ["name" => "Tanzania", "code" => "+255", "flag" => "🇹🇿"],
                                        "TH" => ["name" => "Thailand", "code" => "+66", "flag" => "🇹🇭"],
                                        "TG" => ["name" => "Togo", "code" => "+228", "flag" => "🇹🇬"],
                                        "TK" => ["name" => "Tokelau", "code" => "+690", "flag" => "🇹🇰"],
                                        "TO" => ["name" => "Tonga", "code" => "+676", "flag" => "🇹🇴"],
                                        "TT" => ["name" => "Trinidad and Tobago", "code" => "+1", "flag" => "🇹🇹"],
                                        "TN" => ["name" => "Tunisia", "code" => "+216", "flag" => "🇹🇳"],
                                        "TR" => ["name" => "Turkey", "code" => "+90", "flag" => "🇹🇷"],
                                        "TM" => ["name" => "Turkmenistan", "code" => "+993", "flag" => "🇹🇲"],
                                        "TC" => ["name" => "Turks and Caicos Islands", "code" => "+1", "flag" => "🇹🇨"],
                                        "TV" => ["name" => "Tuvalu", "code" => "+688", "flag" => "🇹🇻"],
                                        "VI" => ["name" => "U.S. Virgin Islands", "code" => "+1", "flag" => "🇻🇮"],
                                        "UG" => ["name" => "Uganda", "code" => "+256", "flag" => "🇺🇬"],
                                        "UA" => ["name" => "Ukraine", "code" => "+380", "flag" => "🇺🇦"],
                                        "AE" => ["name" => "United Arab Emirates", "code" => "+971", "flag" => "🇦🇪"],
                                        "GB" => ["name" => "United Kingdom", "code" => "+44", "flag" => "🇬🇧"],
                                        "US" => ["name" => "United States", "code" => "+1", "flag" => "🇺🇸"],
                                        "UY" => ["name" => "Uruguay", "code" => "+598", "flag" => "🇺🇾"],
                                        "UZ" => ["name" => "Uzbekistan", "code" => "+998", "flag" => "🇺🇿"],
                                        "VU" => ["name" => "Vanuatu", "code" => "+678", "flag" => "🇻🇺"],
                                        "VA" => ["name" => "Vatican", "code" => "+379", "flag" => "🇻🇦"],
                                        "VE" => ["name" => "Venezuela", "code" => "+58", "flag" => "🇻🇪"],
                                        "VN" => ["name" => "Vietnam", "code" => "+84", "flag" => "🇻🇳"],
                                        "WF" => ["name" => "Wallis and Futuna", "code" => "+681", "flag" => "🇼🇫"],
                                        "EH" => ["name" => "Western Sahara", "code" => "+212", "flag" => "🇪🇭"],
                                        "YE" => ["name" => "Yemen", "code" => "+967", "flag" => "🇾🇪"],
                                        "ZM" => ["name" => "Zambia", "code" => "+260", "flag" => "🇿🇲"],
                                        "ZW" => ["name" => "Zimbabwe", "code" => "+263", "flag" => "🇿🇼"]
                                    ];
                                @endphp
                                <div class="relative group" id="country-code-wrapper">
                                    <input type="hidden" name="country_code" id="country-code" value="+250">
                                    <button type="button" class="px-3 rounded-l-xl border border-r-0 border-slate-200 bg-slate-50 text-slate-600 font-medium focus:outline-none focus:bg-white transition-colors cursor-pointer hover:bg-slate-100 text-sm h-full flex items-center gap-1.5 w-[110px]" onclick="document.getElementById('cc-dropdown').classList.toggle('hidden')">
                                        <span id="cc-selected" class="truncate">🇷🇼 +250</span>
                                        <svg class="w-4 h-4 text-slate-400 shrink-0 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div id="cc-dropdown" class="hidden absolute top-full left-0 mt-2 w-64 bg-white border border-slate-200 shadow-xl rounded-xl z-50 p-2 overflow-hidden flex flex-col">
                                        <input type="text" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-lg mb-2 text-sm focus:outline-none focus:border-[#0f2557] focus:ring-2 focus:ring-[#0f2557]/10 transition-all" placeholder="Search country..." id="cc-search" onkeyup="filterCountryCodes(this.value)" onclick="event.stopPropagation()">
                                        <div class="max-h-60 overflow-y-auto" id="cc-list">
                                            @foreach($worldCountryCodes as $codeData)
                                                <button type="button" class="cc-item w-full text-left px-3 py-2.5 text-sm hover:bg-slate-50 focus:bg-slate-50 rounded-lg transition-colors flex items-center gap-2" data-name="{{ strtolower($codeData['name']) }}" data-code="{{ $codeData['code'] }}" onclick="selectCountryCode('{{ $codeData['code'] }}', '{{ $codeData['flag'] }}')">
                                                    <span class="text-lg">{{ $codeData['flag'] }}</span>
                                                    <span class="font-medium text-slate-700 truncate">{{ $codeData['name'] }}</span>
                                                    <span class="text-slate-400 shrink-0 ml-auto">{{ $codeData['code'] }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <input type="tel" name="customer_phone" id="customer-phone" value="{{ old('customer_phone') }}"
                                       class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-r-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="788 123 456" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Notes <span class="text-slate-400 font-normal">(optional)</span></label>
                            <textarea name="notes" id="notes" rows="2"
                                      class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium resize-none" placeholder="Any special requests?"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ───────────────────────────────────────────────────────── --}}
            {{--  STEP 4 — CONFIRM                                        --}}
            {{-- ───────────────────────────────────────────────────────── --}}
            <div id="step-4" class="step-panel hidden">
                <div class="max-w-lg mx-auto">
                    {{-- Booking Summary Ticket --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/80 overflow-hidden">
                        {{-- Ticket Header --}}
                        <div class="bg-[#0f2557] text-white px-6 sm:px-8 py-6">
                            <div class="text-sm text-blue-200 uppercase tracking-wider font-semibold mb-1">Booking Summary</div>
                            <div class="font-display text-2xl font-bold" id="summary-service">—</div>
                        </div>

                        {{-- Ticket Body --}}
                        <div class="px-6 sm:px-8 py-6 space-y-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 text-[#0f2557] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Location</div>
                                    <div class="font-medium text-slate-800" id="summary-location">—</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 text-[#0f2557] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Date & Time</div>
                                    <div class="font-medium text-slate-800"><span id="summary-date">—</span> at <span id="summary-time">—</span></div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 text-[#0f2557] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Customer</div>
                                    <div class="font-medium text-slate-800" id="summary-name">—</div>
                                    <div class="text-sm text-slate-500" id="summary-email">—</div>
                                </div>
                            </div>
                        </div>

                        {{-- Ticket Footer - Total --}}
                        <div class="border-t-2 border-dashed border-slate-200 mx-6 sm:mx-8"></div>
                        <div class="px-6 sm:px-8 py-5 flex items-center justify-between">
                            <div class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Price</div>
                            <div class="font-display font-bold text-2xl text-[#0f2557]" id="summary-price">—</div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="mt-6">
                        <label class="flex items-start gap-3 cursor-pointer group p-4 bg-white rounded-xl border border-slate-200/80 hover:border-slate-300 transition-colors">
                            <input type="checkbox" id="terms-checkbox" class="mt-0.5 w-5 h-5 rounded border-slate-300 text-[#0f2557] focus:ring-[#0f2557] cursor-pointer">
                            <span class="text-sm text-slate-600 leading-relaxed">
                                I agree to the booking terms and conditions. Cancellation is allowed up to <strong>24 hours</strong> before the appointment.
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ───────────────────────────────────────────────────────── --}}
            {{--  SUCCESS STATE                                           --}}
            {{-- ───────────────────────────────────────────────────────── --}}
            <div id="booking-success" class="hidden">
                <div class="text-center py-16 max-w-md mx-auto">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8 relative">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        <div class="absolute inset-0 rounded-full border-4 border-green-200 animate-ping opacity-30"></div>
                    </div>
                    <h2 class="text-3xl font-display font-bold text-[#0f2557] mb-3">You're All Set!</h2>
                    <p class="text-slate-500 mb-3 text-lg">Your appointment has been confirmed.</p>
                    <p class="text-slate-400 mb-10">Reference: <span class="font-mono font-bold text-[#0f2557] text-lg" id="booking-reference">—</span></p>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#0f2557] text-white rounded-xl font-bold hover:bg-[#051638] transition-colors shadow-lg shadow-blue-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Back to Home
                        </a>
                        <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white text-[#0f2557] rounded-xl font-bold border-2 border-slate-200 hover:border-[#0f2557] transition-colors">
                            Book Another
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </form>

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  STICKY BOTTOM ACTION BAR                                          --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] z-40" id="action-bar">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-4">
            <button type="button" id="prev-btn" onclick="prevStep()"
                    class="px-5 py-3 rounded-xl font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors hidden items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back
            </button>

            <div class="flex-1 hidden sm:block" id="running-total-box">
                <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Total</div>
                <div class="font-bold text-[#0f2557] text-xl" id="running-total">—</div>
            </div>

            <button type="button" id="next-btn" onclick="nextStep()" disabled
                    class="flex-1 sm:flex-none px-8 py-3.5 bg-[#0f2557] text-white rounded-xl font-bold shadow-lg shadow-blue-900/20 hover:bg-[#051638] transition-all disabled:opacity-40 disabled:cursor-not-allowed flex items-center justify-center gap-2 text-[15px]">
                <span id="next-btn-text">Continue</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>

            <button type="button" id="confirm-btn" onclick="submitBooking(event)" disabled
                    class="flex-1 sm:flex-none px-8 py-3.5 bg-green-600 text-white rounded-xl font-bold shadow-lg shadow-green-600/20 hover:bg-green-700 transition-all hidden disabled:opacity-40 disabled:cursor-not-allowed items-center justify-center gap-2 text-[15px]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>Confirm Booking</span>
            </button>
        </div>
    </div>

    {{-- Bottom spacer for the fixed bar --}}
    <div class="h-24"></div>
</div>

@push('styles')
<style>
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .step-panel { animation: fadeSlideUp .35s ease-out; }
    .time-slot.selected { background: #0f2557 !important; color: white !important; border-color: #0f2557 !important; }
    input[type="date"] { position: relative; color-scheme: light; }
    input[type="date"]::-webkit-calendar-picker-indicator { position: absolute; right: 10px; color: #64748b; cursor: pointer; opacity: 0.7; }
    input[type="date"]::-webkit-calendar-picker-indicator:hover { opacity: 1; }
    input[type="date"]::-webkit-datetime-edit-text,
    input[type="date"]::-webkit-datetime-edit-month-field,
    input[type="date"]::-webkit-datetime-edit-day-field,
    input[type="date"]::-webkit-datetime-edit-year-field { color: #0f172a; font-weight: 500; }
    input[type="date"]:valid { color: #0f172a !important; }

    /* Custom scrollbar for time slots */
    #time-slots-container::-webkit-scrollbar { width: 4px; }
    #time-slots-container::-webkit-scrollbar-track { background: transparent; }
    #time-slots-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

    /* Inner radio dot fix */
    input[type="radio"]:checked ~ .w-5 .w-2 { transform: scale(1); }
</style>
@endpush

@push('scripts')
<script>
    const countriesData = {};
    @foreach($countries as $country)
        countriesData['{{ $country->id }}'] = {
            name: '{!! addslashes($country->name) !!}',
            currency: '{{ $country->currency ?? "RWF" }}',
            cities: [
                @foreach($country->cities as $city)
                    { id: '{{ $city->id }}', name: '{!! addslashes($city->name) !!}' },
                @endforeach
            ]
        };
    @endforeach

    let currentStep = 1;
    let selectedService = null;
    let selectedDate = null;
    let selectedTime = null;
    let activeCurrency = 'RWF';
    let selectedCityName = '';
    let selectedCountryName = '';

    // ═══════════════════════════════════════════════════════════════════
    //  INIT
    // ═══════════════════════════════════════════════════════════════════
    document.addEventListener('DOMContentLoaded', () => {
        const countrySelector = document.getElementById('country-selector');
        const citySelector = document.getElementById('city-selector');

        // Country selector
        countrySelector.addEventListener('change', function() {
            const countryId = this.value;
            citySelector.innerHTML = '<option value="">— Select city —</option>';
            
            if (countryId && countriesData[countryId]) {
                const data = countriesData[countryId];
                activeCurrency = data.currency;
                selectedCountryName = data.name;
                
                data.cities.forEach(city => {
                    const opt = document.createElement('option');
                    opt.value = city.id;
                    opt.textContent = city.name;
                    citySelector.appendChild(opt);
                });
                
                citySelector.disabled = false;
            } else {
                citySelector.innerHTML = '<option value="">— Select country first —</option>';
                citySelector.disabled = true;
                document.getElementById('services-section').classList.add('hidden');
                selectedCountryName = '';
            }
            
            citySelector.value = '';
            selectedCityName = '';
            validateStep();
        });

        // City selector
        citySelector.addEventListener('change', function() {
            const cityId = this.value;
            const opt = this.options[this.selectedIndex];
            if (cityId) {
                selectedCityName = opt.text;

                document.getElementById('services-section').classList.remove('hidden');
                document.getElementById('location-badge-text').textContent = selectedCityName + ', ' + selectedCountryName;

                updatePricesForCity(cityId);
            } else {
                document.getElementById('services-section').classList.add('hidden');
            }
            validateStep();
        });

        // Service radios
        document.querySelectorAll('input[name="service_id"]').forEach(input => {
            input.addEventListener('change', () => handleServiceSelection(input));
        });

        // Pre-selection
        const checked = document.querySelector('input[name="service_id"]:checked');
        if (checked) handleServiceSelection(checked);

        // Search
        document.getElementById('service-search')?.addEventListener('input', handleSearch);

        // Date
        document.getElementById('booking-date')?.addEventListener('change', function() {
            selectedDate = this.value;
            loadTimeSlots();
            validateStep();
        });

        // Terms
        document.getElementById('terms-checkbox')?.addEventListener('change', function() {
            document.getElementById('confirm-btn').disabled = !this.checked;
        });

        // Step 3 inputs
        ['customer-name', 'customer-email', 'customer-phone'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', validateStep);
        });

        validateStep();
    });

    // ═══════════════════════════════════════════════════════════════════
    //  SERVICE SELECTION
    // ═══════════════════════════════════════════════════════════════════
    function handleServiceSelection(input) {
        const cityId = document.getElementById('city-selector').value;
        const cityPrices = JSON.parse(input.dataset.cityPrices || '{}');
        const price = cityPrices[cityId] !== undefined ? cityPrices[cityId] : null;

        if (price !== null) {
            selectedService = {
                id: input.value,
                name: input.dataset.name,
                duration: input.dataset.duration,
                price: price,
                currency: activeCurrency
            };
        }
        updateRunningTotal();
        validateStep();
    }

    function updatePricesForCity(cityId) {
        // activeCurrency is already updated when Country is selected.
        let totalVisibleServices = 0;

        document.querySelectorAll('.category-group').forEach(group => {
            let visibleCount = 0;
            const categoryId = group.dataset.category;

            group.querySelectorAll('input[name="service_id"]').forEach(input => {
                const cityPrices = JSON.parse(input.dataset.cityPrices || '{}');
                const price = cityPrices[cityId] !== undefined ? cityPrices[cityId] : null;
                const label = input.closest('label');
                const priceDisplay = label.querySelector('.price-display');

                if (price === null) {
                    label.style.display = 'none';
                    input.disabled = true;
                } else {
                    label.style.display = 'flex';
                    priceDisplay.textContent = new Intl.NumberFormat().format(price) + ' ' + activeCurrency;
                    priceDisplay.className = 'price-display font-bold text-[#0f2557]';
                    input.disabled = false;
                    visibleCount++;
                    totalVisibleServices++;
                }
            });

            const tabBtn = document.querySelector(`.category-tab[data-category="${categoryId}"]`);
            if (visibleCount === 0) {
                group.dataset.hiddenByCity = 'true';
                if(tabBtn) tabBtn.style.display = 'none';
            } else {
                group.dataset.hiddenByCity = 'false';
                if(tabBtn) tabBtn.style.display = 'inline-block';
            }
        });

        if (totalVisibleServices === 0) {
            document.getElementById('no-services-city').classList.remove('hidden');
            document.getElementById('category-tabs').style.display = 'none';
            document.querySelectorAll('.category-group').forEach(g => g.style.display = 'none');
        } else {
            document.getElementById('no-services-city').classList.add('hidden');
            document.getElementById('category-tabs').style.display = 'flex';
            
            // Re-apply active filter logic
            const activeTabBtn = document.querySelector('.category-tab.active');
            let activeCategoryId = activeTabBtn && activeTabBtn.style.display !== 'none' ? activeTabBtn.dataset.category : 'all';
            
            let checkActiveTabBtn = document.querySelector(`.category-tab[data-category="${activeCategoryId}"]`);
            if (!checkActiveTabBtn || checkActiveTabBtn.style.display === 'none') {
                activeCategoryId = 'all';
                let allBtn = document.querySelector('.category-tab[data-category="all"]');
                if (allBtn) allBtn.click();
            } else {
                filterCategory(activeCategoryId, checkActiveTabBtn);
            }
        }

        // Reset selection if disabled
        const checked = document.querySelector('input[name="service_id"]:checked');
        if (checked && !checked.disabled) {
            handleServiceSelection(checked);
        } else if (checked && checked.disabled) {
            checked.checked = false;
            selectedService = null;
            updateRunningTotal();
            validateStep();
        }
    }

    function updateRunningTotal() {
        const el = document.getElementById('running-total');
        if (!selectedService) { el.textContent = '—'; return; }
        el.textContent = new Intl.NumberFormat().format(selectedService.price) + ' ' + selectedService.currency;
    }

    // ═══════════════════════════════════════════════════════════════════
    //  SEARCH & FILTER
    // ═══════════════════════════════════════════════════════════════════
    function handleSearch(e) {
        const query = e.target.value.toLowerCase().trim();
        const items = document.querySelectorAll('.service-item');
        const groups = document.querySelectorAll('.category-group');
        const noResults = document.getElementById('no-results');
        let hasResults = false;

        if (query) {
            document.querySelectorAll('.category-tab').forEach(t => { t.classList.remove('bg-[#0f2557]', 'text-white', 'shadow-md', 'active'); t.classList.add('bg-slate-100', 'text-slate-600'); });

            items.forEach(item => {
                const input = item.querySelector('input[name="service_id"]');
                if (!input.disabled) {
                    const match = item.dataset.name.includes(query);
                    item.style.display = match ? 'flex' : 'none';
                    if (match) hasResults = true;
                }
            });

            groups.forEach(group => {
                if (group.dataset.hiddenByCity === 'true') {
                    group.style.display = 'none';
                } else {
                    const visible = Array.from(group.querySelectorAll('.service-item')).some(item => item.style.display === 'flex');
                    group.style.display = visible ? 'block' : 'none';
                }
            });

        } else {
            filterCategory('all', document.querySelector('.category-tab[data-category="all"]'));
            return;
        }

        noResults.classList.toggle('hidden', hasResults);
    }

    function filterCategory(category, btn) {
        document.getElementById('service-search').value = '';
        document.getElementById('no-results').classList.add('hidden');

        document.querySelectorAll('.category-tab').forEach(t => { t.classList.remove('bg-[#0f2557]', 'text-white', 'shadow-md', 'active'); t.classList.add('bg-slate-100', 'text-slate-600'); });
        if(btn) {
            btn.classList.add('bg-[#0f2557]', 'text-white', 'shadow-md', 'active');
            btn.classList.remove('bg-slate-100', 'text-slate-600');
        }

        document.querySelectorAll('.category-group').forEach(group => {
            if (group.dataset.hiddenByCity === 'true') {
                group.style.display = 'none';
            } else {
                if (category === 'all') {
                    group.style.display = 'block';
                    group.querySelector('.category-title').style.display = 'flex';
                } else {
                    const isMatch = group.dataset.category === category;
                    group.style.display = isMatch ? 'block' : 'none';
                    group.querySelector('.category-title').style.display = isMatch ? 'flex' : 'none';
                }
                
                // Show items that are not disabled by city selection
                group.querySelectorAll('.service-item').forEach(item => {
                    const input = item.querySelector('input[name="service_id"]');
                    if (!input.disabled) {
                        item.style.display = 'flex';
                    }
                });
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════════
    //  STEP NAVIGATION
    // ═══════════════════════════════════════════════════════════════════
    function validateStep() {
        let valid = false;
        if (currentStep === 1) {
            valid = !!document.getElementById('city-selector').value && !!selectedService;
        }
        if (currentStep === 2) valid = !!selectedDate && !!selectedTime;
        if (currentStep === 3) {
            valid = document.getElementById('customer-name').value && document.getElementById('customer-email').value && document.getElementById('customer-phone').value;
        }
        document.getElementById('next-btn').disabled = !valid;
    }

    function nextStep() {
        if (currentStep < 4) {
            if (currentStep === 1) {
                document.getElementById('recap-service').textContent = selectedService.name;
                document.getElementById('recap-price').textContent = new Intl.NumberFormat().format(selectedService.price) + ' ' + selectedService.currency;
            }
            if (currentStep === 3) updateSummary();
            showStep(currentStep + 1);
        }
    }

    function prevStep() {
        if (currentStep > 1) showStep(currentStep - 1);
    }

    function showStep(step) {
        document.querySelectorAll('.step-panel').forEach(el => el.classList.add('hidden'));
        const panel = document.getElementById(`step-${step}`);
        panel.classList.remove('hidden');
        // Re-trigger animation
        panel.style.animation = 'none';
        panel.offsetHeight; // trigger reflow
        panel.style.animation = null;

        currentStep = step;

        // Update stepper circles
        for (let i = 1; i <= 4; i++) {
            const circle = document.getElementById(`step-circle-${i}`);
            const label = document.getElementById(`step-label-${i}`);
            const num = circle.querySelector('.step-number');
            const check = circle.querySelector('.step-check');

            if (i < step) {
                // Completed
                circle.className = 'w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-green-500 text-white';
                label.className = 'text-sm font-medium hidden sm:inline transition-colors duration-300 text-green-600';
                num.classList.add('hidden'); check.classList.remove('hidden');
            } else if (i === step) {
                // Active
                circle.className = 'w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-[#0f2557] text-white shadow-lg shadow-blue-900/30';
                label.className = 'text-sm font-medium hidden sm:inline transition-colors duration-300 text-[#0f2557]';
                num.classList.remove('hidden'); check.classList.add('hidden');
            } else {
                // Future
                circle.className = 'w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-slate-100 text-slate-400';
                label.className = 'text-sm font-medium hidden sm:inline transition-colors duration-300 text-slate-400';
                num.classList.remove('hidden'); check.classList.add('hidden');
            }
        }
        // Update step lines
        for (let i = 1; i <= 3; i++) {
            const line = document.getElementById(`step-line-${i}`);
            line.style.width = i < step ? '100%' : '0%';
        }

        // Button states
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const confirmBtn = document.getElementById('confirm-btn');

        prevBtn.classList.toggle('hidden', step === 1);
        prevBtn.style.display = step === 1 ? 'none' : 'flex';

        if (step === 4) {
            nextBtn.classList.add('hidden');
            confirmBtn.classList.remove('hidden');
            confirmBtn.style.display = 'flex';
            confirmBtn.disabled = !document.getElementById('terms-checkbox').checked;
        } else {
            nextBtn.classList.remove('hidden');
            confirmBtn.classList.add('hidden');
            confirmBtn.style.display = 'none';
            validateStep();
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ═══════════════════════════════════════════════════════════════════
    //  TIME SLOTS
    // ═══════════════════════════════════════════════════════════════════
    function loadTimeSlots() {
        const container = document.getElementById('time-slots-container');
        container.innerHTML = '<div class="col-span-full text-center py-8"><div class="w-7 h-7 border-2 border-[#0f2557] border-t-transparent rounded-full animate-spin mx-auto"></div><p class="text-sm text-slate-400 mt-3">Loading available slots…</p></div>';

        fetch(`{{ route('booking.slots') }}?date=${selectedDate}&service_id=${selectedService.id}`)
            .then(res => res.json())
            .then(data => {
                if (!data.slots.length) {
                    container.innerHTML = '<div class="col-span-full text-center text-slate-500 py-8">No slots available for this date</div>';
                    return;
                }
                container.innerHTML = data.slots.map(slot => `
                    <button type="button"
                            class="time-slot px-3 py-2.5 text-sm font-semibold rounded-lg border-2 border-slate-200 text-slate-700 hover:border-[#0f2557] hover:text-[#0f2557] transition-all ${!slot.available ? 'opacity-30 !cursor-not-allowed line-through' : 'cursor-pointer'}"
                            onclick="selectTimeSlot('${slot.time}', '${slot.display}', this)"
                            ${!slot.available ? 'disabled' : ''}>
                        ${slot.display}
                    </button>
                `).join('');
            });
    }

    function selectTimeSlot(time, display, el) {
        selectedTime = { time, display };
        document.getElementById('booking-time').value = time;
        document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
        el.classList.add('selected');
        validateStep();
    }

    // ═══════════════════════════════════════════════════════════════════
    //  SUMMARY & SUBMIT
    // ═══════════════════════════════════════════════════════════════════
    function updateSummary() {
        document.getElementById('summary-service').textContent = selectedService.name;
        document.getElementById('summary-location').textContent = selectedCityName + ', ' + selectedCountryName;

        const dateParts = selectedDate.split('-');
        const dateObj = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        document.getElementById('summary-date').textContent = dateObj.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric' });
        document.getElementById('summary-time').textContent = selectedTime.display;

        document.getElementById('summary-name').textContent = document.getElementById('customer-name').value;
        document.getElementById('summary-email').textContent = document.getElementById('customer-email').value;
        document.getElementById('summary-price').textContent = new Intl.NumberFormat().format(selectedService.price) + ' ' + selectedService.currency;
    }

    function submitBooking(e) {
        e.preventDefault();
        const btn = document.getElementById('confirm-btn');
        btn.disabled = true;
        btn.innerHTML = '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div> Processing…';

        const formData = new FormData(document.getElementById('booking-form'));
        const countryCode = document.getElementById('country-code').value;
        const phone = document.getElementById('customer-phone').value;
        formData.set('customer_phone', countryCode + ' ' + phone);

        fetch('{{ route('booking.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('action-bar').classList.add('hidden');
                document.querySelectorAll('.step-panel').forEach(el => el.classList.add('hidden'));
                document.getElementById('booking-success').classList.remove('hidden');
                document.getElementById('booking-reference').textContent = data.booking.reference;
                // hide stepper
                document.querySelector('.sticky.top-\\[80px\\]').style.display = 'none';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                let msg = 'Booking failed. ';
                if (data.errors) {
                    msg += Object.values(data.errors).flat().join(', ');
                }
                alert(msg);
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Confirm Booking</span>';
            }
        })
        .catch(err => {
            alert('Connection error. Please try again.');
            console.error(err);
            btn.disabled = false;
            btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Confirm Booking</span>';
        });
    }

    // ═══════════════════════════════════════════════════════════════════
    //  COUNTRY CODE DROPDOWN
    // ═══════════════════════════════════════════════════════════════════
    function filterCountryCodes(query) {
        query = query.toLowerCase();
        document.querySelectorAll('.cc-item').forEach(item => {
            if (item.dataset.name.includes(query) || item.dataset.code.includes(query)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function selectCountryCode(code, flag) {
        document.getElementById('country-code').value = code;
        document.getElementById('cc-selected').textContent = flag + ' ' + code;
        document.getElementById('cc-dropdown').classList.add('hidden');
        document.getElementById('cc-search').value = '';
        filterCountryCodes('');
    }

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('country-code-wrapper');
        const dropdown = document.getElementById('cc-dropdown');
        if (wrapper && !wrapper.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection
