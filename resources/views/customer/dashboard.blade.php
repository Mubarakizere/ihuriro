@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-24 pb-12 bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-display text-3xl font-bold text-[#0f2557]">My Dashboard</h1>
                <p class="text-gray-500 mt-1">Manage your appointments and profile</p>
            </div>
            <a href="{{ route('booking.create') }}" class="btn-primary">
                New Booking
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium">Total Bookings</p>
                <p class="text-3xl font-bold text-[#0f2557] mt-2">{{ $bookings->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium">Upcoming</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $bookings->where('status', '!=', 'cancelled')->where('booking_date', '>=', now()->toDateString())->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium">Past Visits</p>
                <p class="text-3xl font-bold text-gray-400 mt-2">{{ $bookings->where('booking_date', '<', now()->toDateString())->count() }}</p>
            </div>
        </div>

        <!-- Bookings List -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-bold text-xl text-[#0f2557]">Appointment History</h2>
            </div>
            
            @if($bookings->isEmpty())
                <div class="p-12 text-center text-gray-500">
                    <p class="mb-4">You haven't made any bookings yet.</p>
                    <a href="{{ route('booking.create') }}" class="text-[#0f2557] font-bold hover:underline">Book your first appointment</a>
                </div>
            @else
                <div class="divide-y divide-gray-100">
                    @foreach($bookings as $booking)
                        <div class="p-6 hover:bg-gray-50 transition-colors flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-[#0f2557]">
                                    <!-- Simple Calendar Icon -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $booking->service->name }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $booking->formatted_date }} at {{ $booking->formatted_time }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6">
                                <div class="text-right hidden md:block">
                                    <p class="font-medium text-gray-900">{{ $booking->service->formatted_price_rwf }}</p>
                                    <p class="text-xs text-gray-500">{{ '#' . ($booking->booking_reference ?? $booking->id) }}</p>
                                </div>
                                
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-700
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ $booking->status }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
