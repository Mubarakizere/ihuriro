@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Overview</h1>
        <p class="text-sm text-slate-500 mt-1">Track your booking metrics and recent activity.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
            View All Bookings
        </a>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-[#0f2557] text-white rounded-lg text-sm font-medium hover:bg-[#0a183d] transition-colors shadow-sm">
            + New Service
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Card 1 -->
    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm transition-all duration-200 hover:shadow-md animate-fade-in" style="animation-delay: 0.05s;">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-slate-500">Total Bookings</h3>
            <span class="p-2 bg-blue-50 text-blue-600 rounded-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </span>
        </div>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_bookings']) }}</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm transition-all duration-200 hover:shadow-md animate-fade-in" style="animation-delay: 0.1s;">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-slate-500">Pending Approvals</h3>
            <span class="p-2 bg-amber-50 text-amber-600 rounded-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </span>
        </div>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['pending_bookings']) }}</p>
            @if($stats['pending_bookings'] > 0)
                <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-0.5 rounded-full">Action required</span>
            @endif
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm transition-all duration-200 hover:shadow-md animate-fade-in" style="animation-delay: 0.15s;">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-slate-500">Today's Appointments</h3>
            <span class="p-2 bg-emerald-50 text-emerald-600 rounded-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </span>
        </div>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['today_bookings']) }}</p>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm transition-all duration-200 hover:shadow-md animate-fade-in" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-slate-500">Active Categories</h3>
            <span class="p-2 bg-purple-50 text-purple-600 rounded-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </span>
        </div>
        <div class="flex items-baseline gap-2">
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_categories']) }}</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Recent Bookings Table -->
    <div class="lg:col-span-2 flex flex-col gap-4 animate-fade-in" style="animation-delay: 0.25s;">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex-1">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
                <h2 class="font-semibold text-slate-800">Recent Bookings</h2>
                <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">View all &rarr;</a>
            </div>
            
            @if($recentBookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Customer</th>
                            <th scope="col" class="px-6 py-3 font-medium">Service</th>
                            <th scope="col" class="px-6 py-3 font-medium">Date & Time</th>
                            <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentBookings as $booking)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $booking->customer_name }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $booking->customer_email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900">{{ $booking->service->name ?? 'N/A' }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $booking->city ? $booking->city->name : 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-slate-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                        Pending
                                    </span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Confirmed
                                    </span>
                                @elseif($booking->status == 'completed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800 border border-slate-200">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900">No bookings yet</h3>
                <p class="mt-1 text-sm text-slate-500">Get started by sharing your booking link.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Right Sidebar Items -->
    <div class="flex flex-col gap-6 animate-fade-in" style="animation-delay: 0.3s;">
        
        <!-- Quick Setup / Links -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                <h2 class="font-semibold text-slate-800">Quick Configuration</h2>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.countries.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                    <div class="w-8 h-8 rounded-md bg-slate-100 text-slate-500 flex items-center justify-center border border-slate-200 group-hover:bg-white group-hover:border-slate-300 group-hover:shadow-sm transition-all mr-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-800 group-hover:text-blue-600 transition-colors">Manage Locations</h4>
                        <p class="text-xs text-slate-500">Configure countries and cities</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition-colors group mt-1">
                    <div class="w-8 h-8 rounded-md bg-slate-100 text-slate-500 flex items-center justify-center border border-slate-200 group-hover:bg-white group-hover:border-slate-300 group-hover:shadow-sm transition-all mr-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-800 group-hover:text-blue-600 transition-colors">Update Visuals</h4>
                        <p class="text-xs text-slate-500">Change homepage category images</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-[#f8fafc] border border-slate-200 rounded-xl p-6 shadow-sm">
            <h3 class="font-semibold text-slate-800 mb-2">Live Environment</h3>
            <p class="text-sm text-slate-500 mb-4 leading-relaxed">Your booking system is currently live and accepting appointments. Review your pending bookings regularly.</p>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center justify-center w-full bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-lg px-4 py-2.5 text-sm font-medium transition-colors shadow-sm">
                Open Customer View
                <svg class="w-4 h-4 ml-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>
    </div>
</div>
@endsection
