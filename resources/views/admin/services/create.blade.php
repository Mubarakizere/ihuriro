@extends('admin.layout')

@section('title', 'Add Service')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 animate-fade-in" style="animation-delay: 0.05s;">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Add New Service</h1>
        <p class="text-sm text-slate-500 mt-1">Create a new service offering and configure its pricing.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
            Cancel
        </a>
    </div>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" class="flex flex-col lg:flex-row gap-8 items-start animate-fade-in" style="animation-delay: 0.1s;">
    @csrf
    
    <div class="flex-1 w-full bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
            <h2 class="font-semibold text-slate-800">Basic Information</h2>
        </div>
        <div class="p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Service Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Premium Haircut" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Category *</label>
                <select name="category_id" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                    <option value="" disabled selected>Select a category...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Duration (minutes) *</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 60) }}" min="1" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                    @error('duration_minutes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Base Price (Optional)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-400 sm:text-xs font-semibold">RWF</span>
                        </div>
                        <input type="number" name="price_rwf" value="{{ old('price_rwf') }}" min="0" placeholder="5000" class="block w-full pl-12 pr-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                    </div>
                    @error('price_rwf') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Description *</label>
                <textarea name="description" rows="4" placeholder="Describe the service..." class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-medium text-slate-900">Active Status</h4>
                    <p class="text-xs text-slate-500">Determine whether this service is available for booking.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#0f2557]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0f2557]"></div>
                </label>
            </div>
        </div>
    </div>
    
    <!-- Right Sidebar (Locations) -->
    <div class="w-full lg:w-96 flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                <h2 class="font-semibold text-slate-800">Location Overrides</h2>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-500 mb-5 leading-relaxed bg-slate-50 p-3 rounded-lg border border-slate-100">
                    Set specific prices for active cities. If you leave a city blank, it will automatically use the Base Price defined on the left.
                </p>
                
                <div class="max-h-[500px] overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                    @forelse($cities as $city)
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5 flex justify-between">
                            <span>{{ $city->name }}</span>
                            <span class="text-[10px] uppercase text-slate-400">{{ $city->country->name }}</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-slate-400 sm:text-xs font-semibold">{{ $city->country->currency }}</span>
                            </div>
                            <input type="number" name="city_prices[{{ $city->id }}]" value="{{ old('city_prices.'.$city->id) }}" min="0" placeholder="Base Price" class="block w-full pl-12 pr-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6">
                        <p class="text-sm text-slate-500">No active cities available.</p>
                        <a href="{{ route('admin.cities.index') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Manage Cities</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sticky top-6">
            <button type="submit" class="w-full bg-[#0f2557] text-white px-4 py-3 rounded-lg hover:bg-[#0a183d] transition-colors shadow-lg shadow-[#0f2557]/20 flex items-center justify-center gap-2 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Create Service
            </button>
        </div>
    </div>
</form>

<style>
    /* Custom thin scrollbar for location list if it gets too long */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection
