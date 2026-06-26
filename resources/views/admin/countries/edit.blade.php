@extends('admin.layout')

@section('title', 'Edit Country')

@section('content')
<div class="mb-6 animate-fade-in" style="animation-delay: 0.05s;">
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('admin.countries.index') }}" class="text-slate-400 hover:text-[#0f2557] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Country</h1>
    </div>
    <p class="text-sm text-slate-500 ml-8">Update details and operating currency for {{ $country->name }}.</p>
</div>

<div class="max-w-2xl animate-fade-in" style="animation-delay: 0.1s;">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
            <h2 class="font-semibold text-slate-800">Country Details</h2>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.countries.update', $country) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Country Name *</label>
                        <input type="text" name="name" value="{{ old('name', $country->name) }}" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Country Code (Optional)</label>
                            <input type="text" name="code" value="{{ old('code', $country->code) }}" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white font-mono uppercase">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Currency *</label>
                            <input type="text" name="currency" value="{{ old('currency', $country->currency) }}" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white font-mono uppercase" required>
                            @error('currency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-2" x-data="{ isActive: '{{ old('is_active', $country->is_active) ? '1' : '0' }}' }">
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

                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                    <button type="button" @click.prevent="window.dispatchEvent(new CustomEvent('open-modal'))" class="text-sm font-medium text-red-600 hover:text-red-700 transition-colors px-3 py-2 rounded-lg hover:bg-red-50">
                        Delete Country
                    </button>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.countries.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#0f2557] rounded-lg hover:bg-[#0a183d] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0f2557]/50 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Standalone Delete Modal Trigger Setup -->
<div x-data="{
    showModal: false,
    init() {
        window.addEventListener('open-modal', () => {
            this.showModal = true;
        });
    }
}">
    <!-- Reusable Alpine Modal -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                <form action="{{ route('admin.countries.destroy', $country) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title">Delete Country</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Are you sure you want to permanently delete this country? This will also remove or detach all associated cities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 focus:ring-red-500 w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Delete Country
                        </button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f2557] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
