@extends('layouts.app')

@section('title', 'Book Appointment - IHURIRO')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Booking Wizard Container -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden h-[85vh] sm:h-[calc(100vh-6rem)] min-h-[550px] flex flex-col relative">
            
            <!-- Header & Progress -->
            <div class="pt-8 pb-6 px-6 sm:px-10 bg-white z-20">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="font-display text-2xl font-bold text-[#0f2557]">Book Appointment</h1>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-slate-500">Step <span id="current-step-display">1</span> of 4</span>
                    </div>
                </div>
                
                <!-- Sleek Progress Bar -->
                <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#0f2557] transition-all duration-500 ease-out w-1/4" id="progress-bar"></div>
                </div>
            </div>

            <!-- Scrollable Content Area -->
            <div class="flex-1 overflow-y-auto no-scrollbar relative">
                <form id="booking-form" class="h-full flex flex-col">
                    @csrf
                    
                    <!-- STEP 1: SERVICE SELECTION -->
                    <div id="step-1" class="step-content p-6 sm:p-10 pb-32">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-[#0f2557] mb-2">Select Service</h2>
                            <p class="text-slate-500">Choose a treatment to continue</p>
                        </div>

                        <!-- Sticky Search & Filter -->
                        <div class="sticky top-0 bg-white/95 backdrop-blur-sm z-10 pb-4 shadow-sm -mx-6 px-6 sm:-mx-10 sm:px-10 pt-2 mb-4">
                            <!-- Search Bar -->
                            <div class="relative mb-4">
                                <input type="text" id="service-search" placeholder="Search services (e.g. Fade, Manicure)..." 
                                       class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-2 focus:ring-[#0f2557]/10 transition-all outline-none">
                                <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Category Tabs -->
                            <div class="flex overflow-x-auto pb-2 gap-2 no-scrollbar snap-x" id="category-tabs">
                                @foreach($services as $category => $categoryServices)
                                <button type="button" onclick="filterCategory('{{ $category }}', this)" 
                                        class="category-tab px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap transition-all border border-slate-200 text-slate-600 hover:border-slate-300 hover:bg-slate-50 {{ $loop->first ? 'active bg-[#0f2557] text-white shadow-lg border-transparent' : '' }}"
                                        data-category="{{ $category }}">
                                    {{ ucfirst($category) }}
                                </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Services Grid -->
                        <div class="space-y-8 mt-2" id="services-grid">
                            @foreach($services as $category => $categoryServices)
                            <div class="category-group {{ !$loop->first ? 'hidden' : '' }}" data-category="{{ $category }}">
                                <h3 class="font-display font-bold text-[#0f2557] mb-4 pl-1 hidden category-title">{{ ucfirst($category) }}</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                                    @foreach($categoryServices as $service)
                                    <label class="group relative cursor-pointer service-item" data-name="{{ strtolower($service->name) }}">
                                        <input type="radio" name="service_id" value="{{ $service->id }}" 
                                               data-name="{{ $service->name }}"
                                               data-duration="{{ $service->formatted_duration }}"
                                               data-price-rwf="{{ $service->price_rwf }}"
                                               data-price-usd="{{ $service->price_usd }}"
                                               data-price-formatted="{{ $service->formatted_price_rwf }}"
                                               class="peer sr-only"
                                               {{ $selectedService && $selectedService->id == $service->id ? 'checked' : '' }}>
                                        
                                        <div class="p-4 rounded-2xl border border-slate-200 bg-white transition-all duration-300 hover:shadow-md hover:border-blue-200 peer-checked:border-[#0f2557] peer-checked:ring-1 peer-checked:ring-[#0f2557] peer-checked:bg-blue-50/20">
                                            <div class="flex items-start gap-4">
                                                <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#0f2557] flex items-center justify-center shrink-0 group-hover:bg-[#0f2557] group-hover:text-white transition-colors peer-checked:bg-[#0f2557] peer-checked:text-white">
                                                    @include('components.service-icon', ['icon' => $service->icon])
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex justify-between items-start">
                                                        <h4 class="font-bold text-[#0f2557] line-clamp-1 pr-2">{{ $service->name }}</h4>
                                                        <div class="hidden peer-checked:block text-[#0f2557]">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-slate-500 mt-1 mb-2">{{ $service->formatted_duration }}</p>
                                                    <div class="font-bold text-[#0f2557]">{{ $service->formatted_price_rwf }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- No Results State -->
                            <div id="no-results" class="hidden text-center py-12">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-medium text-slate-900">No services found</h3>
                                <p class="text-slate-500">Try adjusting your search terms</p>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: DATE & TIME Selection -->
                    <div id="step-2" class="step-content hidden p-6 sm:p-10 pb-32">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-[#0f2557] mb-2">When?</h2>
                            <p class="text-slate-500">Choose a date and time slot</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-semibold text-[#0f2557] mb-3">Select Date</label>
                                <div class="relative">
                                    <input type="date" name="booking_date" id="booking-date" 
                                           style="color-scheme: light;"
                                           class="w-full p-4 bg-white border-2 border-slate-300 rounded-xl font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] transition-all cursor-pointer" 
                                           min="{{ date('Y-m-d') }}"
                                           required>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-[#0f2557] mb-3">Available Slots</label>
                                <input type="hidden" name="booking_time" id="booking-time">
                                <div id="time-slots-container" class="grid grid-cols-3 gap-2 max-h-64 overflow-y-auto no-scrollbar">
                                    <div class="col-span-full py-8 text-center text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                        Select a date to view slots
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: DETAILS -->
                    <div id="step-3" class="step-content hidden p-6 sm:p-10 pb-32">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-[#0f2557] mb-2">Your Details</h2>
                            <p class="text-slate-500">Contact information for booking updates</p>
                        </div>

                        <div class="space-y-4 max-w-md mx-auto">
                            <div class="group">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1 ml-1">Full Name</label>
                                <input type="text" name="customer_name" id="customer-name" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="John Doe" required>
                            </div>
                            
                            <div class="group">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1 ml-1">Email</label>
                                <input type="email" name="customer_email" id="customer-email" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="john@example.com" required>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1 ml-1">Phone Number</label>
                                <div class="flex">
                                    <select name="country_code" id="country-code" class="px-3 rounded-l-xl border border-r-0 border-slate-200 bg-slate-50 text-slate-600 font-medium focus:outline-none focus:bg-white transition-colors cursor-pointer hover:bg-slate-100">
                                        <option value="+250">🇷🇼 +250</option>
                                        <option value="+254">🇰🇪 +254</option>
                                    </select>
                                    <input type="tel" name="customer_phone" id="customer-phone" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-r-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium" placeholder="788 123 456" required>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1 ml-1">Notes (Optional)</label>
                                <textarea name="notes" id="notes" rows="2" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0f2557] focus:ring-4 focus:ring-[#0f2557]/5 transition-all outline-none font-medium resize-none" placeholder="Any special requests?"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: CONFIRMATION -->
                    <div id="step-4" class="step-content hidden p-6 sm:p-10 pb-32">
                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-bold text-[#0f2557] mb-2">Review Booking</h2>
                            <p class="text-slate-500">Please confirm your appointment details</p>
                        </div>

                        <div class="bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-2xl p-6 max-w-md mx-auto relative overflow-hidden">
                            <!-- Ticket Decoration -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-[#0f2557]"></div>
                            
                            <div class="space-y-4 relative z-10">
                                <div class="flex justify-between items-start pb-4 border-b border-slate-100">
                                    <div class="text-sm text-slate-500">Service</div>
                                    <div class="text-right font-bold text-[#0f2557] text-lg leading-tight w-2/3" id="summary-service">...</div>
                                </div>
                                <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                                    <div class="text-sm text-slate-500">Date & Time</div>
                                    <div class="text-right font-medium text-[#0f2557]"><span id="summary-date">...</span> at <span id="summary-time">...</span></div>
                                </div>
                                <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                                    <div class="text-sm text-slate-500">Customer</div>
                                    <div class="text-right font-medium text-[#0f2557]" id="summary-name">...</div>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <div class="text-sm font-bold text-slate-500">Total</div>
                                    <div class="text-right font-display font-bold text-2xl text-[#0f2557]" id="summary-price">...</div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-md mx-auto mt-6">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" id="terms-checkbox" class="mt-1 w-5 h-5 rounded border-slate-300 text-[#0f2557] focus:ring-[#0f2557] cursor-pointer">
                                <span class="text-sm text-slate-500 group-hover:text-slate-700 transition-colors">
                                    I agree to the booking terms. Cancellation is allowed up to 24 hours in advance.
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- SUCCESS STATE -->
                    <div id="booking-success" class="hidden h-full flex items-center justify-center p-10">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h2 class="text-3xl font-display font-bold text-[#0f2557] mb-2">Booking Confirmed!</h2>
                            <p class="text-slate-500 mb-8">Ref: <span class="font-mono font-bold text-[#0f2557]" id="booking-reference">...</span></p>
                            
                            <a href="{{ route('home') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-3 rounded-full">
                                Back to Home
                            </a>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Sticky Bottom Action Bar -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-white/90 backdrop-blur-md border-t border-slate-100 z-30" id="action-bar">
                <div class="max-w-3xl mx-auto flex items-center justify-between gap-4">
                    <button type="button" id="prev-btn" onclick="prevStep()" class="px-6 py-3 rounded-xl font-medium text-slate-500 hover:bg-slate-50 transition-colors hidden">
                        Back
                    </button>
                    
                    <div class="flex-1 text-right sm:text-left hidden sm:block">
                        <div class="text-xs text-slate-400 uppercase tracking-wide">Total</div>
                        <div class="font-bold text-[#0f2557] text-lg" id="running-total">--</div>
                    </div>

                    <button type="button" id="next-btn" onclick="nextStep()" class="flex-1 sm:flex-none sm:w-auto px-8 py-3 bg-[#0f2557] text-white rounded-xl font-bold shadow-lg shadow-blue-900/20 hover:bg-[#051638] hover:shadow-blue-900/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span id="next-btn-text">Continue</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <button type="button" id="confirm-btn" onclick="submitBooking(event)" class="flex-1 sm:flex-none sm:w-auto px-8 py-3 bg-[#0f2557] text-white rounded-xl font-bold shadow-lg shadow-blue-900/20 hover:bg-[#051638] hover:shadow-blue-900/30 transition-all hidden disabled:opacity-50 flex items-center justify-center gap-2">
                        <span>Confirm Booking</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .time-slot.selected { @apply bg-[#0f2557] text-white border-[#0f2557]; }
    .category-tab.active { @apply bg-[#0f2557] text-white shadow-lg border-transparent; }
    
    /* Date input styling for better visibility */
    input[type="date"] {
        position: relative;
        color-scheme: light;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 10px;
        color: #64748b;
        cursor: pointer;
        opacity: 0.7;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator:hover {
        opacity: 1;
    }
    
    /* Ensure date text is visible */
    input[type="date"]::-webkit-datetime-edit-text,
    input[type="date"]::-webkit-datetime-edit-month-field,
    input[type="date"]::-webkit-datetime-edit-day-field,
    input[type="date"]::-webkit-datetime-edit-year-field {
        color: #0f172a;
        font-weight: 500;
    }
    
    /* Ensure the date value is visible when set */
    input[type="date"]:valid {
        color: #0f172a !important;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentStep = 1;
    let selectedService = null;
    let selectedDate = null;
    let selectedTime = null;

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Pre-selection check
        const checked = document.querySelector('input[name="service_id"]:checked');
        if(checked) handleServiceSelection(checked);
        
        // Listeners for Service Grid
        document.querySelectorAll('input[name="service_id"]').forEach(input => {
            input.addEventListener('change', () => handleServiceSelection(input));
        });

        // Search Listener
        document.getElementById('service-search')?.addEventListener('input', handleSearch);

        // Date Listener
        document.getElementById('booking-date')?.addEventListener('change', function() {
            selectedDate = this.value;
            loadTimeSlots();
            validateStep();
        });

        // Terms Listener
        document.getElementById('terms-checkbox')?.addEventListener('change', function() {
            document.getElementById('confirm-btn').disabled = !this.checked;
        });
        
        validateStep();
    });

    function handleSearch(e) {
        const query = e.target.value.toLowerCase().trim();
        const serviceItems = document.querySelectorAll('.service-item');
        const categoryGroups = document.querySelectorAll('.category-group');
        const categoryTabs = document.getElementById('category-tabs');
        const noResults = document.getElementById('no-results');
        
        let hasResults = false;

        if (query) {
            // Search Mode: Show all matches regardless of category
            categoryTabs.classList.add('opacity-50', 'pointer-events-none');
            
            serviceItems.forEach(item => {
                const name = item.dataset.name;
                const match = name.includes(query);
                item.style.display = match ? 'block' : 'none';
                if(match) hasResults = true;
            });

            // Show groups that have visible children
            categoryGroups.forEach(group => {
                const visibleChildren = group.querySelectorAll('.service-item[style="display: block;"]');
                if (visibleChildren.length > 0) {
                    group.classList.remove('hidden');
                    group.querySelector('.category-title').classList.remove('hidden');
                } else {
                    group.classList.add('hidden');
                }
            });

        } else {
            // Clear Search: Reset to Category Mode
            categoryTabs.classList.remove('opacity-50', 'pointer-events-none');
            const activeTab = document.querySelector('.category-tab.active');
            filterCategory(activeTab.dataset.category, activeTab);
            return;
        }

        noResults.classList.toggle('hidden', hasResults);
    }

    function handleServiceSelection(input) {
        selectedService = {
            id: input.value,
            name: input.dataset.name,
            priceFormatted: input.dataset.priceFormatted
        };
        document.getElementById('running-total').textContent = selectedService.priceFormatted;
        validateStep();
    }

    function filterCategory(category, btn) {
        // Reset Search if active
        document.getElementById('service-search').value = '';
        document.getElementById('no-results').classList.add('hidden');
        document.getElementById('category-tabs').classList.remove('opacity-50', 'pointer-events-none');

        // Update Tabs
        document.querySelectorAll('.category-tab').forEach(el => el.classList.remove('active', 'bg-[#0f2557]', 'text-white', 'shadow-lg', 'border-transparent'));
        document.querySelectorAll('.category-tab').forEach(el => el.classList.add('border-slate-200', 'text-slate-600'));
        
        btn.classList.add('active', 'bg-[#0f2557]', 'text-white', 'shadow-lg', 'border-transparent');
        btn.classList.remove('border-slate-200', 'text-slate-600');

        // Filter Grid
        document.querySelectorAll('.category-group').forEach(group => {
            const isMatch = group.dataset.category === category;
            group.classList.toggle('hidden', !isMatch);
            // Hide titles in category mode since tab is active
            group.querySelector('.category-title').classList.add('hidden'); 
            
            // Show all items in the group
            group.querySelectorAll('.service-item').forEach(item => item.style.display = 'block');
        });
    }

    function validateStep() {
        let valid = false;
        if (currentStep === 1) valid = !!selectedService;
        if (currentStep === 2) valid = !!selectedDate && !!selectedTime;
        if (currentStep === 3) {
            const name = document.getElementById('customer-name').value;
            const email = document.getElementById('customer-email').value;
            const phone = document.getElementById('customer-phone').value;
            valid = name && email && phone;
        }

        document.getElementById('next-btn').disabled = !valid;
    }

    // Input listeners for Step 3 validation
    ['customer-name', 'customer-email', 'customer-phone'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', validateStep);
    });

    function nextStep() {
        if (currentStep < 4) {
            // Logic for pre-Step 4 update
            if (currentStep === 3) updateSummary();
            
            showStep(currentStep + 1);
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    }

    function showStep(step) {
        // Hide all
        document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(`step-${step}`).classList.remove('hidden');

        // Update Progress
        document.getElementById('current-step-display').textContent = step;
        document.getElementById('progress-bar').style.width = (step / 4 * 100) + '%';
        
        currentStep = step;

        // Button logic
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const confirmBtn = document.getElementById('confirm-btn');

        prevBtn.classList.toggle('hidden', step === 1);
        
        if (step === 4) {
            nextBtn.classList.add('hidden');
            confirmBtn.classList.remove('hidden');
            confirmBtn.disabled = !document.getElementById('terms-checkbox').checked;
        } else {
            nextBtn.classList.remove('hidden');
            confirmBtn.classList.add('hidden');
            validateStep();
        }

        // Auto scroll to top of wizard content
        document.querySelector('.overflow-y-auto').scrollTop = 0;
    }

    function loadTimeSlots() {
        const container = document.getElementById('time-slots-container');
        container.innerHTML = '<div class="col-span-full text-center py-4"><div class="spinner border-2 border-[#0f2557] border-t-transparent w-6 h-6 rounded-full animate-spin mx-auto"></div></div>';
        
        // Mocking fetching logic via route to reuse existing controller
        fetch(`{{ route('booking.slots') }}?date=${selectedDate}&service_id=${selectedService.id}`)
            .then(res => res.json())
            .then(data => {
                if (!data.slots.length) {
                    container.innerHTML = '<div class="col-span-full text-center text-slate-500 py-4">No slots available</div>';
                    return;
                }
                container.innerHTML = data.slots.map(slot => `
                    <button type="button" 
                            class="time-slot p-3 text-sm font-medium rounded-lg border border-slate-200 hover:border-[#0f2557] hover:text-[#0f2557] transition-all disabled:opacity-50 disabled:cursor-not-allowed ${!slot.available ? 'opacity-50 cursor-not-allowed' : ''}"
                            onclick="selectTimeSlot('${slot.time}', '${slot.display}')"
                            ${!slot.available ? 'disabled' : ''}>
                        ${slot.display}
                    </button>
                `).join('');
            });
    }

    function selectTimeSlot(time, display) {
        selectedTime = { time, display };
        document.getElementById('booking-time').value = time;
        
        // Visual selection
        document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected', 'bg-[#0f2557]', 'text-white'));
        event.target.classList.add('selected', 'bg-[#0f2557]', 'text-white');
        
        validateStep();
    }

    function updateSummary() {
        document.getElementById('summary-service').textContent = selectedService.name;
        // Fix date parsing to avoid timezone issues
        const dateParts = selectedDate.split('-');
        const dateObj = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        document.getElementById('summary-date').textContent = dateObj.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric' });
        document.getElementById('summary-time').textContent = selectedTime.display;
        
        const countryCode = document.getElementById('country-code').value;
        const phone = document.getElementById('customer-phone').value;
        
        document.getElementById('summary-name').textContent = document.getElementById('customer-name').value;
        document.getElementById('summary-price').textContent = selectedService.priceFormatted;
    }

    function submitBooking(e) {
        e.preventDefault();
        const btn = document.getElementById('confirm-btn');
        btn.disabled = true;
        btn.innerHTML = '<div class="spinner border-2 border-white border-t-transparent w-5 h-5 rounded-full animate-spin"></div> Processing...';

        const formData = new FormData(document.getElementById('booking-form'));
        
        // Combine country code and phone
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
                document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
                document.getElementById('booking-success').classList.remove('hidden');
                document.getElementById('booking-reference').textContent = data.booking.reference;
            } else {
                alert('Booking failed: ' + (data.message || 'Unknown error'));
                btn.disabled = false;
                btn.textContent = 'Confirm Booking';
            }
        })
        .catch(err => {
            alert('Error processing booking');
            console.error(err);
            btn.disabled = false;
            btn.textContent = 'Confirm Booking';
        });
    }
</script>
@endpush
@endsection
