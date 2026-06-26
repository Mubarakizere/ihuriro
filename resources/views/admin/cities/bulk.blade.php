@extends('admin.layout')

@section('title', 'Bulk Add Cities')

@section('content')
<div x-data="{
    rows: [{ id: 1, name: '', country_id: '' }],
    addRow() {
        this.rows.push({
            id: Date.now(),
            name: '',
            country_id: ''
        });
    },
    removeRow(index) {
        if (this.rows.length > 1) {
            this.rows.splice(index, 1);
        }
    }
}">
    <div class="mb-6 animate-fade-in" style="animation-delay: 0.05s;">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.cities.index') }}" class="text-slate-400 hover:text-[#0f2557] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Bulk Add Cities</h1>
        </div>
        <p class="text-sm text-slate-500 ml-8">Quickly add multiple cities to various countries at once.</p>
    </div>

    <form action="{{ route('admin.cities.bulk-store') }}" method="POST" class="animate-fade-in" style="animation-delay: 0.1s;">
        @csrf
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-1/2">Country *</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-1/2">City Name *</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        <template x-for="(row, index) in rows" :key="row.id">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 align-top">
                                    <select :name="`cities[${index}][country_id]`" x-model="row.country_id" required class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                        <option value="" disabled>Select a country...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }} ({{ $country->currency }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <input type="text" :name="`cities[${index}][name]`" x-model="row.name" required placeholder="e.g. Kigali" class="block w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-white">
                                </td>
                                <td class="px-6 py-4 align-top text-center">
                                    <button type="button" @click="removeRow(index)" x-show="rows.length > 1" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors inline-flex mt-0.5" title="Remove row">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                <button type="button" @click="addRow()" class="inline-flex items-center gap-2 text-sm font-medium text-[#0f2557] hover:text-[#0a183d] transition-colors">
                    <div class="w-8 h-8 rounded-full bg-[#0f2557]/10 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Add Another City
                </button>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.cities.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                Cancel
            </a>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-[#0f2557] rounded-lg hover:bg-[#0a183d] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0f2557]/50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Save All Cities
            </button>
        </div>
    </form>
</div>
@endsection
