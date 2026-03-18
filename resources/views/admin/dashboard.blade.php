@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Services -->
    <div class="content-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#0f2557]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-[#0f2557]" style="font-family: 'Outfit', sans-serif;">{{ $stats['total_services'] }}</div>
        <p class="text-sm text-slate-500 mt-1">Total Services</p>
    </div>

    <!-- Active Services -->
    <div class="content-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-emerald-600" style="font-family: 'Outfit', sans-serif;">{{ $stats['active_services'] }}</div>
        <p class="text-sm text-slate-500 mt-1">Active Services</p>
    </div>

    <!-- Categories -->
    <div class="content-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-amber-600" style="font-family: 'Outfit', sans-serif;">{{ $stats['categories'] }}</div>
        <p class="text-sm text-slate-500 mt-1">Categories</p>
    </div>

    <!-- Total Bookings -->
    <div class="content-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-purple-600" style="font-family: 'Outfit', sans-serif;">{{ $stats['total_bookings'] }}</div>
        <p class="text-sm text-slate-500 mt-1">Total Bookings</p>
    </div>
</div>

<!-- Quick Actions & Recent Bookings -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Quick Actions -->
    <div class="content-card p-6">
        <h3 class="text-lg font-bold text-[#0f2557] mb-4" style="font-family: 'Outfit', sans-serif;">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.services.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-[#0f2557] flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-[#0f2557] text-sm">Add New Service</p>
                    <p class="text-xs text-slate-500">Create a new beauty service</p>
                </div>
            </a>

            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-slate-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-700 text-sm">Manage Services</p>
                    <p class="text-xs text-slate-500">Edit or remove services</p>
                </div>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-700 text-sm">View Website</p>
                    <p class="text-xs text-slate-500">See how your site looks</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="lg:col-span-2 content-card p-6">
        <h3 class="text-lg font-bold text-[#0f2557] mb-4" style="font-family: 'Outfit', sans-serif;">Recent Bookings</h3>

        @if($recentBookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left py-3 px-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Client</th>
                            <th class="text-left py-3 px-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Service</th>
                            <th class="text-left py-3 px-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                            <th class="text-left py-3 px-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $booking)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50">
                                <td class="py-3 px-2">
                                    <p class="text-sm font-medium text-slate-800">{{ $booking->client_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $booking->client_email ?? '' }}</p>
                                </td>
                                <td class="py-3 px-2 text-sm text-slate-600">{{ $booking->service->name ?? 'N/A' }}</td>
                                <td class="py-3 px-2 text-sm text-slate-600">{{ $booking->booking_date ?? $booking->created_at->format('M d, Y') }}</td>
                                <td class="py-3 px-2">
                                    <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full
                                        {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-700' :
                                           ($booking->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                        {{ ucfirst($booking->status ?? 'pending') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-slate-500 text-sm">No bookings yet</p>
            </div>
        @endif
    </div>
</div>
@endsection
