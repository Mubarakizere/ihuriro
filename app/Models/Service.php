<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
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
     * Get price for a specific city
     */
    public function getPriceForCity(?City $city): float
    {
        if (!$city) {
            return $this->price_rwf;
        }

        $cityService = $this->cities()->where('cities.id', $city->id)->first();
        if ($cityService && $cityService->pivot->price_rwf !== null) {
            return (float) $cityService->pivot->price_rwf;
        }

        return $this->price_rwf;
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
    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get the category that owns the service.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get bookings for this service
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get cities where this service is available
     */
    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'city_service')
                    ->withPivot('price_rwf')
                    ->withTimestamps();
    }
}
