@extends('admin.layout')

@section('title', 'Add Country')

@section('content')
<div class="mb-6 animate-fade-in" style="animation-delay: 0.05s;">
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('admin.countries.index') }}" class="text-slate-400 hover:text-[#0f2557] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Add New Country</h1>
    </div>
    <p class="text-sm text-slate-500 ml-8">Add a new country and specify its operating currency.</p>
</div>

<div class="max-w-2xl animate-fade-in" style="animation-delay: 0.1s;">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
            <h2 class="font-semibold text-slate-800">Country Details</h2>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.countries.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Country Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Rwanda" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Country Code (Optional)</label>
                            <input type="text" name="code" value="{{ old('code') }}" placeholder="e.g. RW" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white font-mono uppercase">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Currency *</label>
                            <input type="text" name="currency" value="{{ old('currency', 'RWF') }}" placeholder="e.g. RWF" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white font-mono uppercase" required>
                            @error('currency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-2" x-data="{ isActive: '{{ old('is_active', '1') ? '1' : '0' }}' }">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Country Status</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Active Option -->
                            <label class="relative flex cursor-pointer rounded-xl border bg-white p-4 shadow-sm transition-all duration-200"
                                :class="isActive === '1' ? 'border-emerald-500 ring-1 ring-emerald-500 bg-emerald-50/10' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50'">
                                <input type="radio" name="is_active" value="1" class="sr-only" x-model="isActive">
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span class="block text-sm font-semibold flex items-center gap-2"
                                            :class="isActive === '1' ? 'text-emerald-700' : 'text-slate-700'">
                                            <span class="w-2 h-2 rounded-full transition-colors" :class="isActive === '1' ? 'bg-emerald-500' : 'bg-slate-300'"></span>
                                            Active
                                        </span>
                                        <span class="mt-1 flex items-center text-xs text-slate-500">Available for new cities and bookings.</span>
                                    </span>
                                </span>
                                <svg class="h-5 w-5 transition-colors" :class="isActive === '1' ? 'text-emerald-600' : 'text-transparent'" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </label>

                            <!-- Inactive Option -->
                            <label class="relative flex cursor-pointer rounded-xl border bg-white p-4 shadow-sm transition-all duration-200"
                                :class="isActive === '0' ? 'border-slate-400 ring-1 ring-slate-400 bg-slate-50' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50'">
                                <input type="radio" name="is_active" value="0" class="sr-only" x-model="isActive">
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span class="block text-sm font-semibold flex items-center gap-2"
                                            :class="isActive === '0' ? 'text-slate-800' : 'text-slate-700'">
                                            <span class="w-2 h-2 rounded-full transition-colors" :class="isActive === '0' ? 'bg-slate-500' : 'bg-slate-300'"></span>
                                            Inactive
                                        </span>
                                        <span class="mt-1 flex items-center text-xs text-slate-500">Hidden from customers and bookings.</span>
                                    </span>
                                </span>
                                <svg class="h-5 w-5 transition-colors" :class="isActive === '0' ? 'text-slate-600' : 'text-transparent'" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.countries.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#0f2557] rounded-lg hover:bg-[#0a183d] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0f2557]/50 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Save Country
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
