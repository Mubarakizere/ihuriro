<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'today_bookings' => Booking::whereDate('booking_date', today())->count(),
            'total_categories' => Category::count(),
        ];

        $recentBookings = Booking::with(['service', 'city'])
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
