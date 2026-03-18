@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-[#0f2557]" style="font-family: 'Outfit', sans-serif;">Manage Services</h1>
        <p class="text-sm text-slate-500 mt-1">{{ $services->total() }} services total</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0f2557] text-white text-sm font-semibold rounded-xl hover:bg-[#051638] transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add New Service
    </a>
</div>

<!-- Filters -->
<div class="content-card p-4 mb-6">
    <form method="GET" action="{{ route('admin.services.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..."
                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] focus:bg-white transition-all">
        </div>
        <select name="category" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] transition-all">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
            Filter
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 text-slate-500 text-sm font-medium rounded-xl hover:bg-slate-100 transition-colors text-center">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Services Table -->
<div class="content-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100">
                    <th class="text-left py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Service</th>
                    <th class="text-left py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Category</th>
                    <th class="text-left py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Duration</th>
                    <th class="text-left py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Price</th>
                    <th class="text-center py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="text-right py-3.5 px-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors" id="service-row-{{ $service->id }}">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-[#0f2557] flex-shrink-0">
                                    @include('components.service-icon', ['icon' => $service->icon])
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 text-sm truncate">{{ $service->name }}</p>
                                    <p class="text-xs text-slate-400 md:hidden">{{ ucfirst($service->category) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5 hidden md:table-cell">
                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 text-slate-600">
                                {{ ucfirst($service->category) }}
                            </span>
                        </td>
                        <td class="py-4 px-5 text-sm text-slate-600 hidden lg:table-cell">{{ $service->formatted_duration }}</td>
                        <td class="py-4 px-5 text-sm font-semibold text-[#0f2557]">{{ number_format($service->price_rwf) }} RWF</td>
                        <td class="py-4 px-5 text-center">
                            <button onclick="toggleActive({{ $service->id }})"
                                    id="status-btn-{{ $service->id }}"
                                    class="inline-flex px-3 py-1.5 text-xs font-semibold rounded-full cursor-pointer transition-colors
                                    {{ $service->is_active ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-red-50 text-red-600 hover:bg-red-100' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <div class="flex items-center gap-1 justify-end">
                                <a href="{{ route('admin.services.edit', $service) }}" class="p-2 rounded-lg text-slate-400 hover:text-[#0f2557] hover:bg-blue-50 transition-all" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this service?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <p class="text-slate-500 font-medium">No services found</p>
                            <a href="{{ route('admin.services.create') }}" class="text-[#0f2557] text-sm font-medium hover:underline mt-2 inline-block">Add your first service</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($services->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $services->withQueryString()->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    function toggleActive(serviceId) {
        const btn = document.getElementById('status-btn-' + serviceId);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/admin/services/${serviceId}/toggle-active`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (data.is_active) {
                    btn.textContent = 'Active';
                    btn.className = 'inline-flex px-3 py-1.5 text-xs font-semibold rounded-full cursor-pointer transition-colors bg-emerald-50 text-emerald-700 hover:bg-emerald-100';
                } else {
                    btn.textContent = 'Inactive';
                    btn.className = 'inline-flex px-3 py-1.5 text-xs font-semibold rounded-full cursor-pointer transition-colors bg-red-50 text-red-600 hover:bg-red-100';
                }
            }
        })
        .catch(err => console.error('Error:', err));
    }
</script>
@endpush
@endsection
