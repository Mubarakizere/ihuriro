@extends('layouts.app')

@section('title', 'Book an Appointment')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden p-6 sm:p-10">
        {{-- Header --------------------------------------------------- --}}
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h1 class="text-2xl sm:text-3xl font-semibold text-slate-900 tracking-tight">Book Your Appointment</h1>
            <p class="text-slate-500 mt-2 text-sm sm:text-base">Select a location, service, date & time – and we’ll handle the rest.</p>
        </div>

        <form id="booking-form" method="POST" action="{{ route('booking.store') }}">
            @csrf
            {{-- Location ------------------------------------------------ --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-slate-900 mb-4">1. Where are you located?</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="country-selector">Country</label>
                        <select id="country-selector"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors">
                            <option value="">Select a country…</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="city-selector">City</label>
                        <select name="city_id" id="city-selector"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors disabled:bg-slate-50 disabled:text-slate-400"
                                required disabled>
                            <option value="">Select a country first…</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Service -------------------------------------------------- --}}
            <div class="mb-8 pt-6 border-t border-slate-100" id="service-section" style="display:none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">2. Select Service</h3>
                <div class="flex flex-wrap gap-2 mb-4" id="category-tabs">
                    <button type="button" data-category="all" class="category-tab active px-4 py-2 rounded-md bg-slate-900 text-white text-sm font-medium transition-colors shadow-sm" onclick="filterCategory('all', this)">All</button>
                    @foreach($categories as $category)
                        <button type="button" data-category="{{ $category->id }}" class="category-tab px-4 py-2 rounded-md bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 text-sm font-medium transition-colors" onclick="filterCategory('{{ $category->id }}', this)">{{ $category->name }}</button>
                    @endforeach
                </div>
                
                <div id="no-services-msg" class="hidden text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                    No services are available in this city yet. Please choose another location.
                </div>

                <div class="space-y-3" id="services-list">
                    @foreach($categories as $category)
                        <div class="category-group" data-category="{{ $category->id }}" data-hidden-by-city="false">
                            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-4">{{ $category->name }}</h3>
                            @foreach($category->services as $service)
                                @php
                                    $cityPrices = [];
                                    foreach($service->cities as $c) {
                                        $cityPrices[$c->id] = $c->pivot->price_rwf !== null ? (float)$c->pivot->price_rwf : null;
                                    }
                                @endphp
                                <label class="flex items-center p-4 border border-slate-200 rounded-lg hover:border-slate-400 hover:bg-slate-50 transition-colors cursor-pointer mb-2" data-name="{{ strtolower($service->name) }}">
                                    <input type="radio" name="service_id" value="{{ $service->id }}"
                                           class="mr-4 w-4 h-4 text-slate-900 focus:ring-slate-900 border-slate-300" data-city-prices='{{ json_encode($cityPrices) }}'>
                                    <div class="flex-1">
                                        <div class="font-medium text-slate-900">{{ $service->name }}</div>
                                        <div class="text-sm text-slate-500">{{ $service->formatted_duration }}</div>
                                    </div>
                                    <div class="price-display font-medium text-slate-900">—</div>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Date & Time --------------------------------------------- --}}
            <div class="mb-8 pt-6 border-t border-slate-100" id="datetime-section" style="display:none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">3. Pick a Date & Time</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="booking-date">Date</label>
                        <input type="date" name="booking_date" id="booking-date"
                               class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors"
                               min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2" for="booking-time">Time</label>
                        <input type="hidden" name="booking_time" id="booking-time">
                        <div id="time-slots" class="grid grid-cols-3 gap-2">
                            <div class="col-span-full text-center text-slate-500 text-sm py-3 border border-dashed border-slate-300 rounded-lg bg-slate-50">Select a date first</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Details ----------------------------------------- --}}
            <div class="mb-8 pt-6 border-t border-slate-100" id="contact-section" style="display:none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">4. Your Details</h3>
                <div class="grid gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="customer-name">Full Name</label>
                        <input type="text" name="customer_name" id="customer-name"
                               class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="customer-email">Email Address</label>
                        <input type="email" name="customer_email" id="customer-email"
                               class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="customer-phone">Phone Number</label>
                        <div class="flex shadow-sm rounded-lg">
                            <select name="country_code" id="country-code" class="w-1/3 sm:w-1/4 px-3 py-2.5 bg-slate-50 border border-slate-300 rounded-l-lg text-sm border-r-0 focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors">
                                @foreach($countries as $country)
                                    @php
                                        $flags = ['Rwanda' => '🇷🇼', 'Burundi' => '🇧🇮', 'Kenya' => '🇰🇪', 'Uganda' => '🇺🇬', 'Tanzania' => '🇹🇿', 'DRC' => '🇨🇩'];
                                        $codes = ['Rwanda' => '+250', 'Burundi' => '+257', 'Kenya' => '+254', 'Uganda' => '+256', 'Tanzania' => '+255', 'DRC' => '+243'];
                                    @endphp
                                    <option value="{{ $codes[$country->name] ?? '+250' }}">{{ $flags[$country->name] ?? '🌍' }} {{ $codes[$country->name] ?? '+250' }}</option>
                                @endforeach
                            </select>
                            <input type="tel" name="customer_phone" id="customer-phone"
                                   class="flex-1 px-4 py-2.5 bg-white border border-slate-300 rounded-r-lg text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors" placeholder="Phone number" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="notes">Additional Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="3"
                                  class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors"></textarea>
                    </div>
                </div>
            </div>

            {{-- Submit --------------------------------------------------- --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end" id="submit-section" style="display:none;">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-slate-900 text-white rounded-lg font-medium text-sm hover:bg-slate-800 transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const countriesData = {};
    @foreach($countries as $country)
        countriesData['{{ $country->id }}'] = {
            currency: '{{ $country->currency ?? "RWF" }}',
            cities: [
                @foreach($country->cities as $city)
                    { id: '{{ $city->id }}', name: '{!! addslashes($city->name) !!}' },
                @endforeach
            ]
        };
    @endforeach

    let activeCurrency = 'RWF';
    let selectedService = null;
    let selectedDate = null;
    let selectedTime = null;

    document.addEventListener('DOMContentLoaded', () => {
        const countrySelector = document.getElementById('country-selector');
        const citySelector = document.getElementById('city-selector');

        // Country selection logic
        countrySelector.addEventListener('change', function() {
            const countryId = this.value;
            citySelector.innerHTML = '<option value="">Select a city…</option>';
            
            if (countryId && countriesData[countryId]) {
                const data = countriesData[countryId];
                activeCurrency = data.currency;
                
                data.cities.forEach(city => {
                    const opt = document.createElement('option');
                    opt.value = city.id;
                    opt.textContent = city.name;
                    citySelector.appendChild(opt);
                });
                
                citySelector.disabled = false;
            } else {
                citySelector.innerHTML = '<option value="">Select a country first…</option>';
                citySelector.disabled = true;
                document.getElementById('service-section').style.display = 'none';
            }
            
            // Reset sections below
            citySelector.value = '';
            resetSelections();
        });

        // City selection logic
        citySelector.addEventListener('change', function() {
            const cityId = this.value;
            if (cityId) {
                document.getElementById('service-section').style.display = 'block';
                updateServicePrices(cityId);
            } else {
                document.getElementById('service-section').style.display = 'none';
                resetSelections();
            }
        });

        // Service selection
        document.querySelectorAll('input[name="service_id"]').forEach(input => {
            input.addEventListener('change', () => {
                const cityId = document.getElementById('city-selector').value;
                const cityPrices = JSON.parse(input.dataset.cityPrices || '{}');
                const price = cityPrices[cityId] !== undefined ? cityPrices[cityId] : null;
                if (price !== null) {
                    selectedService = { id: input.value, name: input.closest('label').querySelector('div.font-medium').textContent.trim(), price, currency: activeCurrency };
                } else {
                    selectedService = null;
                }
                
                // Highlight selected label
                document.querySelectorAll('input[name="service_id"]').forEach(inp => {
                    if (inp.checked) {
                        inp.closest('label').classList.add('border-slate-900', 'bg-slate-50', 'ring-1', 'ring-slate-900');
                        inp.closest('label').classList.remove('border-slate-200');
                    } else {
                        inp.closest('label').classList.remove('border-slate-900', 'bg-slate-50', 'ring-1', 'ring-slate-900');
                        inp.closest('label').classList.add('border-slate-200');
                    }
                });

                // Show next sections if everything ready
                if (selectedService) {
                    document.getElementById('datetime-section').style.display = 'block';
                }
            });
        });

        // Date picker -> load slots
        document.getElementById('booking-date').addEventListener('change', function(){
            selectedDate = this.value;
            if (selectedService && selectedDate) {
                loadTimeSlots();
                document.getElementById('contact-section').style.display = 'block';
            }
        });

        // Time slot selection
        window.selectTimeSlot = function(time, display, btn) {
            selectedTime = { time, display };
            document.getElementById('booking-time').value = time;
            
            // Highlight selected time slot
            document.querySelectorAll('.time-slot').forEach(t => {
                t.classList.remove('bg-slate-900', 'text-white', 'border-slate-900');
                t.classList.add('text-slate-700', 'bg-white', 'border-slate-300');
            });
            btn.classList.add('bg-slate-900', 'text-white', 'border-slate-900');
            btn.classList.remove('text-slate-700', 'bg-white', 'border-slate-300');

            document.getElementById('submit-section').style.display = 'flex';
        };
    });

    function resetSelections() {
        document.querySelectorAll('input[name="service_id"]').forEach(inp => inp.checked = false);
        selectedService = null;
        document.getElementById('datetime-section').style.display = 'none';
        document.getElementById('contact-section').style.display = 'none';
        document.getElementById('submit-section').style.display = 'none';
        
        document.querySelectorAll('input[name="service_id"]').forEach(inp => {
            inp.closest('label').classList.remove('border-slate-900', 'bg-slate-50', 'ring-1', 'ring-slate-900');
            inp.closest('label').classList.add('border-slate-200');
        });
    }

    function updateServicePrices(cityId) {
        let totalVisibleServices = 0;
        let activeTabBtn = document.querySelector('.category-tab.active');
        let activeCategoryId = activeTabBtn ? activeTabBtn.dataset.category : 'all';

        document.querySelectorAll('.category-group').forEach(group => {
            let visibleCount = 0;
            const categoryId = group.dataset.category;
            
            group.querySelectorAll('input[name="service_id"]').forEach(input => {
                const cityPrices = JSON.parse(input.dataset.cityPrices || '{}');
                const price = cityPrices[cityId] !== undefined ? cityPrices[cityId] : null;
                const priceEl = input.closest('label').querySelector('.price-display');
                
                if (price === null) {
                    input.closest('label').style.display = 'none';
                    input.disabled = true;
                    if (input.checked) {
                        input.checked = false;
                        resetSelections();
                    }
                } else {
                    input.closest('label').style.display = 'flex';
                    priceEl.textContent = new Intl.NumberFormat().format(price) + ' ' + activeCurrency;
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

        // Show/hide "No services" message
        if (totalVisibleServices === 0) {
            document.getElementById('no-services-msg').classList.remove('hidden');
            document.getElementById('category-tabs').style.display = 'none';
            document.getElementById('services-list').style.display = 'none';
        } else {
            document.getElementById('no-services-msg').classList.add('hidden');
            document.getElementById('category-tabs').style.display = 'flex';
            document.getElementById('services-list').style.display = 'block';
            
            // Re-apply active category filter (fallback to 'all' if current tab is hidden)
            let checkActiveTabBtn = document.querySelector(`.category-tab[data-category="${activeCategoryId}"]`);
            if (!checkActiveTabBtn || checkActiveTabBtn.style.display === 'none') {
                activeCategoryId = 'all';
                let allBtn = document.querySelector('.category-tab[data-category="all"]');
                if (allBtn) {
                    allBtn.click();
                } else {
                    filterCategory('all', null);
                }
            } else {
                filterCategory(activeCategoryId, checkActiveTabBtn);
            }
        }
    }

    function filterCategory(categoryId, btn) {
        if (btn) {
            document.querySelectorAll('.category-tab').forEach(t => {
                t.classList.remove('bg-slate-900', 'text-white', 'shadow-sm', 'active');
                t.classList.add('bg-white', 'border', 'border-slate-200', 'text-slate-600');
            });
            btn.classList.remove('bg-white', 'border', 'border-slate-200', 'text-slate-600');
            btn.classList.add('bg-slate-900', 'text-white', 'shadow-sm', 'active');
        }
        
        document.querySelectorAll('.category-group').forEach(g => {
            if (g.dataset.hiddenByCity !== 'true' && (categoryId === 'all' || g.dataset.category === categoryId)) {
                g.style.display = 'block';
            } else {
                g.style.display = 'none';
            }
        });
    }

    function loadTimeSlots() {
        const container = document.getElementById('time-slots');
        container.innerHTML = '<div class="col-span-full text-center py-4"><div class="spinner border-2 border-slate-900 border-t-transparent w-5 h-5 rounded-full animate-spin mx-auto"></div></div>';
        fetch(`{{ route('booking.slots') }}?date=${selectedDate}&service_id=${selectedService.id}`)
            .then(r => r.json())
            .then(data => {
                if (!data.slots.length) {
                    container.innerHTML = '<div class="col-span-full text-center text-slate-500 text-sm py-3 border border-dashed border-slate-300 rounded-lg bg-slate-50">No slots available for this date</div>';
                    return;
                }
                container.innerHTML = data.slots.map(s => `
                    <button type="button" class="time-slot px-3 py-2 text-sm font-medium border border-slate-300 rounded-md bg-white text-slate-700 hover:border-slate-400 transition-colors ${s.available ? '' : 'opacity-40 bg-slate-50 cursor-not-allowed'}"
                            onclick="selectTimeSlot('${s.time}', '${s.display}', this)" ${s.available ? '' : 'disabled'}>
                        ${s.display}
                    </button>
                `).join('');
                
                // Reset submit and time if new date is chosen
                document.getElementById('booking-time').value = '';
                selectedTime = null;
                document.getElementById('submit-section').style.display = 'none';
            });
    }
</script>
@endpush
@endsection
