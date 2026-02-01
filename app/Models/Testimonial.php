<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'location',
        'avatar',
        'rating',
        'comment',
        'service_used',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];

    /**
     * Scope for active testimonials
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get stars as array for display
     */
    public function getStarsAttribute(): array
    {
        return array_fill(0, $this->rating, true);
    }

    /**
     * Get initials for avatar fallback
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }
}
