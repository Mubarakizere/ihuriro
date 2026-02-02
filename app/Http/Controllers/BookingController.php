<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
    /**
     * Show the booking form
     */
    public function create(Request $request)
    {
        $services = Service::active()->orderBy('sort_order')->get()->groupBy('category');
        $selectedServiceSlug = $request->get('service');
        $selectedService = $selectedServiceSlug 
            ? Service::where('slug', $selectedServiceSlug)->active()->first() 
            : null;

        return view('booking.create', compact('services', 'selectedService'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $service = Service::findOrFail($request->service_id);

        $booking = Booking::create([
            'service_id' => $service->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'total_price_rwf' => $service->price_rwf,
            'status' => 'pending',
        ]);

        // Load the service relationship for email
        $booking->load('service');

        // Send emails with error handling
        try {
            // Send email to customer
            \Log::info('Attempting to send email to customer: ' . $booking->customer_email);
            Mail::to($booking->customer_email)
                ->send(new BookingConfirmation($booking));
            \Log::info('Customer email sent successfully');

            // Send email to admin addresses
            $adminEmails = ['divahousebeauty@gmail.com', 'info@divahousebeauty.com'];
            \Log::info('Attempting to send email to admins: ' . implode(', ', $adminEmails));
            Mail::to($adminEmails)
                ->send(new BookingConfirmation($booking));
            \Log::info('Admin emails sent successfully');
        } catch (\Exception $e) {
            // Log the error but don't fail the booking
            \Log::error('Email sending failed: ' . $e->getMessage());
            \Log::error('Email error trace: ' . $e->getTraceAsString());
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking confirmed successfully!',
            'booking' => [
                'reference' => $booking->booking_reference,
                'service' => $service->name,
                'date' => $booking->formatted_date,
                'time' => $booking->formatted_time,
                'price' => $service->formatted_price_rwf,
            ],
        ]);
    }

    /**
     * Get available time slots for a date
     */
    public function getAvailableSlots(Request $request)
    {
        $date = $request->get('date');
        $serviceId = $request->get('service_id');

        if (!$date || !$serviceId) {
            return response()->json(['slots' => []]);
        }

        // Business hours: 8 AM to 6 PM
        $slots = [];
        $startHour = 8;
        $endHour = 18;

        // Get booked slots for this date
        $bookedTimes = Booking::where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('booking_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        for ($hour = $startHour; $hour < $endHour; $hour++) {
            foreach (['00', '30'] as $minute) {
                $timeSlot = sprintf('%02d:%s', $hour, $minute);
                $displayTime = Carbon::createFromFormat('H:i', $timeSlot)->format('g:i A');
                
                $isAvailable = !in_array($timeSlot, $bookedTimes);
                
                // Don't show past times for today
                if ($date === now()->toDateString()) {
                    $slotTime = Carbon::createFromFormat('Y-m-d H:i', "$date $timeSlot");
                    if ($slotTime->isPast()) {
                        $isAvailable = false;
                    }
                }

                $slots[] = [
                    'time' => $timeSlot,
                    'display' => $displayTime,
                    'available' => $isAvailable,
                ];
            }
        }

        return response()->json(['slots' => $slots]);
    }
}
