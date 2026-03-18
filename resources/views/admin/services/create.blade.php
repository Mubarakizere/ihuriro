@extends('layouts.admin')

@section('title', 'Add Service')
@section('page-title', 'Add New Service')

@section('content')
<div class="max-w-3xl">
    <!-- Back Link -->
    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-[#0f2557] mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Services
    </a>

    <div class="content-card p-6 lg:p-8">
        <h2 class="text-xl font-bold text-[#0f2557] mb-6" style="font-family: 'Outfit', sans-serif;">Service Details</h2>

        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <!-- Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Service Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all"
                       placeholder="e.g. Classic Lash Extensions">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div class="mb-5">
                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Category *</label>
                <select id="category" name="category" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] transition-all">
                    <option value="">Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                    <option value="" disabled>────────────</option>
                    <option value="waxing">Waxing</option>
                    <option value="makeup">Makeup</option>
                    <option value="lashes">Lashes</option>
                    <option value="nails">Nails</option>
                    <option value="hair">Hair</option>
                    <option value="tattoo">Tattoo</option>
                    <option value="piercing">Piercing</option>
                </select>
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all resize-none"
                          placeholder="Describe the service...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Duration & Price -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="duration_minutes" class="block text-sm font-semibold text-slate-700 mb-2">Duration (minutes) *</label>
                    <input type="number" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes') }}" required min="1"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all"
                           placeholder="60">
                    @error('duration_minutes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="price_rwf" class="block text-sm font-semibold text-slate-700 mb-2">Price (RWF) *</label>
                    <input type="number" id="price_rwf" name="price_rwf" value="{{ old('price_rwf') }}" required min="0" step="0.01"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all"
                           placeholder="35000">
                    @error('price_rwf') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Icon & Sort Order -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="icon" class="block text-sm font-semibold text-slate-700 mb-2">Icon</label>
                    <select id="icon" name="icon"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] transition-all">
                        <option value="">Select icon</option>
                        @foreach(['scissors', 'sparkles', 'star', 'heart', 'eye', 'hand', 'pencil', 'leaf', 'plus', 'bolt'] as $iconOption)
                            <option value="{{ $iconOption }}" {{ old('icon') == $iconOption ? 'selected' : '' }}>{{ ucfirst($iconOption) }}</option>
                        @endforeach
                    </select>
                    @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all"
                           placeholder="0">
                    @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Active Toggle -->
            <div class="mb-8">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-5 h-5 rounded border-slate-300 text-[#0f2557] focus:ring-[#0f2557]">
                    <div>
                        <span class="text-sm font-semibold text-slate-700">Active</span>
                        <p class="text-xs text-slate-500">Service will be visible on the website</p>
                    </div>
                </label>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-3 pt-6 border-t border-slate-100">
                <button type="submit" class="px-6 py-3 bg-[#0f2557] text-white text-sm font-semibold rounded-xl hover:bg-[#051638] transition-all shadow-sm hover:shadow-md">
                    Create Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="px-6 py-3 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-100 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
