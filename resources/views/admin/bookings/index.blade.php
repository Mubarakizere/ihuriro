@extends('admin.layout')

@section('title', 'Manage Bookings')

@section('content')
<div x-data="{
    showModal: false,
    modalTitle: '',
    modalMessage: '',
    modalAction: '',
    modalMethod: 'PATCH',
    confirmText: 'Confirm',
    confirmColor: 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500',
    modalStatus: '',
    openModal(title, message, action, method, confirmBtn, color, status = '') {
        this.modalTitle = title;
        this.modalMessage = message;
        this.modalAction = action;
        this.modalMethod = method;
        this.confirmText = confirmBtn;
        this.confirmColor = color;
        this.modalStatus = status;
        this.showModal = true;
    }
}">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 animate-fade-in" style="animation-delay: 0.05s;">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Bookings</h1>
            <p class="text-sm text-slate-500 mt-1">Manage and track customer appointments.</p>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6 animate-fade-in" style="animation-delay: 0.1s;">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone, reference, or service..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0f2557]/20 focus:border-[#0f2557] sm:text-sm transition-all outline-none bg-slate-50 focus:bg-white text-slate-800 font-medium">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2.5 bg-[#0f2557] text-white rounded-lg text-sm font-medium hover:bg-[#0a183d] transition-colors shadow-sm">
                    Search
                </button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden animate-fade-in" style="animation-delay: 0.15s;">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium">Customer</th>
                        <th scope="col" class="px-6 py-4 font-medium">Reference</th>
                        <th scope="col" class="px-6 py-4 font-medium">Service & Location</th>
                        <th scope="col" class="px-6 py-4 font-medium">Date & Time</th>
                        <th scope="col" class="px-6 py-4 font-medium">Status</th>
                        <th scope="col" class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <!-- Customer -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($booking->customer_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $booking->customer_name }}</div>
                                    <div class="text-slate-500 text-xs mt-0.5 flex flex-col gap-0.5">
                                        <span>{{ $booking->customer_email }}</span>
                                        <span>{{ $booking->customer_phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Reference -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-xs font-semibold px-2 py-1 bg-slate-100 text-slate-600 rounded">
                                {{ $booking->booking_reference ?? '#' . $booking->id }}
                            </span>
                        </td>

                        <!-- Service & Location -->
                        <td class="px-6 py-4">
                            <div class="text-slate-900 font-medium">{{ $booking->service->name ?? 'Unknown Service' }}</div>
                            <div class="text-slate-500 text-xs mt-0.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $booking->city ? $booking->city->name : 'No location specified' }}
                            </div>
                            @if($booking->total_price_rwf > 0)
                                <div class="text-emerald-600 text-xs font-semibold mt-1">{{ number_format($booking->total_price_rwf) }} RWF</div>
                            @endif
                        </td>

                        <!-- Date & Time -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[10px] font-bold text-red-500 uppercase leading-none">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M') }}</span>
                                    <span class="text-sm font-bold text-slate-700 leading-none mt-0.5">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d') }}</span>
                                </div>
                                <div>
                                    <div class="text-slate-900 font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y') }}</div>
                                    <div class="text-slate-500 text-xs mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($booking->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5 animate-pulse"></span>
                                    Pending
                                </span>
                            @elseif($booking->status == 'confirmed')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                    Confirmed
                                </span>
                            @elseif($booking->status == 'cancelled')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    Cancelled
                                </span>
                            @elseif($booking->status == 'completed')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                    Completed
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800 border border-slate-200">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" @click.away="open = false" type="button" class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                </button>

                                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 z-20 focus:outline-none">
                                    <div class="py-1">
                                        @if($booking->status === 'pending')
                                        <button @click.prevent="openModal('Confirm Booking', 'Are you sure you want to confirm this booking for {{ addslashes($booking->customer_name) }}?', '{{ route('admin.bookings.status', $booking) }}', 'PATCH', 'Confirm Booking', 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500', 'confirmed')" class="group flex items-center w-full px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50">
                                            <svg class="mr-3 h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Confirm
                                        </button>
                                        @endif
                                        
                                        @if($booking->status === 'confirmed')
                                        <button @click.prevent="openModal('Mark Completed', 'Are you sure you want to mark this booking as completed?', '{{ route('admin.bookings.status', $booking) }}', 'PATCH', 'Mark Completed', 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500', 'completed')" class="group flex items-center w-full px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                            <svg class="mr-3 h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Complete
                                        </button>
                                        @endif

                                        @if($booking->status !== 'cancelled')
                                        <button @click.prevent="openModal('Cancel Booking', 'Are you sure you want to cancel this booking? This will notify the customer.', '{{ route('admin.bookings.status', $booking) }}', 'PATCH', 'Cancel Booking', 'bg-red-600 hover:bg-red-700 focus:ring-red-500', 'cancelled')" class="group flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg class="mr-3 h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Cancel
                                        </button>
                                        @endif

                                        <!-- Delete is always available, maybe except if it's already deleted (which it won't be since it's not soft deleted by default) -->
                                        <button @click.prevent="openModal('Delete Booking', 'Are you sure you want to permanently delete this booking? This action cannot be undone.', '{{ route('admin.bookings.destroy', $booking) }}', 'DELETE', 'Delete Booking', 'bg-red-600 hover:bg-red-700 focus:ring-red-500', '')" class="group flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 border-t border-slate-100">
                                            <svg class="mr-3 h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-slate-900">No bookings found</h3>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ request()->has('search') ? 'Try adjusting your search criteria.' : 'You don\'t have any bookings yet.' }}
                            </p>
                            @if(request()->has('search'))
                                <a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                    Clear search filters
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bookings->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>

    <!-- Reusable Alpine Modal -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" 
                 aria-hidden="true" 
                 @click="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                
                <form :action="modalAction" method="POST">
                    @csrf
                    <!-- Dynamic method spoofing -->
                    <input type="hidden" name="_method" :value="modalMethod">
                    <!-- Dynamic status if provided -->
                    <template x-if="modalStatus !== ''">
                        <input type="hidden" name="status" :value="modalStatus">
                    </template>
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-slate-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title" x-text="modalTitle"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500" x-text="modalMessage"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                        <button type="submit" :class="confirmColor" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm transition-colors" x-text="confirmText">
                        </button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f2557] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
