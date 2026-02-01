<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'duration_minutes',
        'price_rwf',
        'image',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price_rwf' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Exchange rate: 1 USD = approximately 1300 RWF
    const USD_EXCHANGE_RATE = 1300;

    /**
     * Get the price in USD
     */
    public function getPriceUsdAttribute(): float
    {
        return round($this->price_rwf / self::USD_EXCHANGE_RATE, 2);
    }

    /**
     * Get formatted RWF price
     */
    public function getFormattedPriceRwfAttribute(): string
    {
        return number_format($this->price_rwf, 0, '.', ',') . ' RWF';
    }

    /**
     * Get formatted USD price
     */
    public function getFormattedPriceUsdAttribute(): string
    {
        return '$' . number_format($this->price_usd, 2);
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0 && $minutes > 0) {
            return "{$hours}h {$minutes}min";
        } elseif ($hours > 0) {
            return "{$hours}h";
        }
        return "{$minutes} min";
    }

    /**
     * Scope for active services
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for services by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get bookings for this service
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
