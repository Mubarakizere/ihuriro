<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'booking_reference',
        'service_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'booking_date',
        'booking_time',
        'status',
        'notes',
        'total_price_rwf',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i',
        'total_price_rwf' => 'decimal:2',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'IHU-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the service for this booking
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get formatted booking date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->booking_date->format('l, F j, Y');
    }

    /**
     * Get formatted booking time
     */
    public function getFormattedTimeAttribute(): string
    {
        return \Carbon\Carbon::parse($this->booking_time)->format('g:i A');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Scope for pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString());
    }
}
