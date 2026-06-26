@extends('admin.layout')

@section('title', 'Bulk Add Services')

@section('content')
<div x-data="{
    categories: [
        @foreach($categories as $category)
            { id: {{ $category->id }}, name: '{{ addslashes($category->name) }}' },
        @endforeach
    ],
    rows: [{ id: 1, name: '', category_id: '', duration: 60, price: '', showLocations: false }],
    addRow() {
        this.rows.push({
            id: Date.now(),
            name: '',
            category_id: '',
            duration: 60,
            price: '',
            showLocations: false
        });
    },
    removeRow(id) {
        if (this.rows.length > 1) {
            this.rows = this.rows.filter(row => row.id !== id);
        }
    }
}">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 animate-fade-in" style="animation-delay: 0.05s;">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Bulk Add Services</h1>
            <p class="text-sm text-slate-500 mt-1">Quickly create multiple services at once.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                Cancel
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600 animate-fade-in" style="animation-delay: 0.1s;">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.services.bulk-store') }}" method="POST" class="animate-fade-in" style="animation-delay: 0.1s;">
        @csrf
        <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium w-1/3">Service Name *</th>
                            <th scope="col" class="px-6 py-4 font-medium w-1/4">Category *</th>
                            <th scope="col" class="px-6 py-4 font-medium w-1/6">Duration (min) *</th>
                            <th scope="col" class="px-6 py-4 font-medium w-1/5">Base Price (Opt)</th>
                            <th scope="col" class="px-6 py-4 font-medium w-24 text-center">Actions</th>
                        </tr>
                    </thead>
                    <template x-for="(row, index) in rows" :key="row.id">
                        <tbody class="group border-b border-slate-100 last:border-none">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <input type="text" :name="`services[${index}][name]`" x-model="row.name" required placeholder="e.g. Premium Haircut" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                </td>
                                <td class="px-6 py-4">
                                    <select :name="`services[${index}][category_id]`" x-model="row.category_id" required class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                        <option value="" disabled>Select...</option>
                                        <template x-for="cat in categories" :key="cat.id">
                                            <option :value="cat.id" x-text="cat.name"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" :name="`services[${index}][duration_minutes]`" x-model="row.duration" min="1" required class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-slate-400 sm:text-sm font-semibold">RWF</span>
                                        </div>
                                        <input type="number" :name="`services[${index}][price_rwf]`" x-model="row.price" min="0" placeholder="Optional" class="block w-full pl-12 pr-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button type="button" @click="row.showLocations = !row.showLocations" :class="row.showLocations ? 'bg-blue-50 text-blue-600' : 'text-slate-400 hover:bg-slate-100 hover:text-slate-700'" class="transition-colors p-2 rounded-lg" title="Location Pricing">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </button>
                                        <button type="button" @click="removeRow(row.id)" x-show="rows.length > 1" class="text-slate-400 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50" title="Remove row">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Location Sub-row -->
                            <tr x-show="row.showLocations" style="display: none;" class="bg-slate-50/50">
                                <td colspan="5" class="px-6 py-4">
                                    <div class="p-4 bg-white rounded-lg border border-slate-200 shadow-sm">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="text-sm font-semibold text-slate-800">Location Price Overrides</h4>
                                            <button type="button" @click="row.showLocations = false" class="text-xs text-slate-500 hover:text-slate-700">Close</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                            @forelse($cities as $city)
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-1 flex justify-between">
                                                    <span>{{ $city->name }}</span>
                                                    <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $city->country->currency }}</span>
                                                </label>
                                                <input type="number" :name="`services[${index}][city_prices][{{ $city->id }}]`" min="0" placeholder="Base Price" class="block w-full px-3 py-1.5 border border-slate-200 rounded focus:ring-1 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-xs transition-all outline-none bg-slate-50 focus:bg-white">
                                            </div>
                                            @empty
                                            <div class="col-span-full text-xs text-slate-500">No active cities available.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </table>
            </div>
            
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                <button type="button" @click="addRow()" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-md hover:bg-blue-100 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add another row
                </button>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-[#0f2557] text-white rounded-xl text-sm font-medium hover:bg-[#0a183d] transition-colors shadow-lg shadow-[#0f2557]/20 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Save All Services
            </button>
        </div>
    </form>
</div>
@endsection
