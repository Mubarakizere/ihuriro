<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use App\Models\Country;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Do not delete old services to avoid damaging existing ones
        // Service::query()->delete();

        // 2. Ensure Country "Rwanda" exists
        $country = Country::firstOrCreate(
            ['code' => 'RW'],
            ['name' => 'Rwanda', 'currency' => 'RWF', 'is_active' => true]
        );

        // 3. Ensure City "Kigali" exists
        $city = City::firstOrCreate(
            ['name' => 'Kigali'],
            ['country_id' => $country->id, 'is_active' => true]
        );

        // 4. Ensure Categories exist
        $spaCategory = Category::firstOrCreate(
            ['slug' => 'spa'],
            [
                'name' => 'Spa',
                'description' => 'Universal Wellbeing Center Spa Services',
                'image_path' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&q=80',
            ]
        );

        $facialCategory = Category::firstOrCreate(
            ['slug' => 'facial'],
            [
                'name' => 'Facial',
                'description' => 'Premium facial treatments and skincare',
                'image_path' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&q=80',
            ]
        );

        $waxingCategory = Category::firstOrCreate(
            ['slug' => 'waxing'],
            [
                'name' => 'Waxing',
                'description' => 'Professional waxing services',
                'image_path' => 'https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&q=80',
            ]
        );

        $services = [
            // Massages & Body Treatments (Spa)
            ['category_id' => $spaCategory->id, 'name' => 'Reflexology', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Deep tissue', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Classic aromatherapy', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Shiatsu', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Hawaiian', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Swedish', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Hydromassage', 'price_rwf' => 50000, 'duration_minutes' => 120],
            ['category_id' => $spaCategory->id, 'name' => 'Couple hydro massage', 'price_rwf' => 70000, 'duration_minutes' => 120],
            ['category_id' => $spaCategory->id, 'name' => 'Foot massage', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Head & scalp', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Back massage', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['category_id' => $spaCategory->id, 'name' => 'Body scrub', 'price_rwf' => 25000, 'duration_minutes' => 30],
            ['category_id' => $spaCategory->id, 'name' => 'Massage & Body scrub', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Hot stone massage', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Indian head massage', 'price_rwf' => 25000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Candle Massage & Body scrub', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Couple massage', 'price_rwf' => 60000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Couple massage + body scrub', 'price_rwf' => 80000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Trigger point massage', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Lomi Lomi', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Teenager’s Massage', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['category_id' => $spaCategory->id, 'name' => 'Body lap and Massage', 'price_rwf' => 55000, 'duration_minutes' => 60],
            ['category_id' => $spaCategory->id, 'name' => 'Morrocan bath', 'price_rwf' => 50000, 'duration_minutes' => 60],

            // Detoxification Packages (Spa)
            ['category_id' => $spaCategory->id, 'name' => 'Fasting Juice and Massage', 'price_rwf' => 60000, 'duration_minutes' => 4320, 'description' => '3 Days package'],
            ['category_id' => $spaCategory->id, 'name' => 'Master Cleansing, Hydro, Detox and Massage', 'price_rwf' => 70000, 'duration_minutes' => 180],
            ['category_id' => $spaCategory->id, 'name' => 'Soaking and Massage', 'price_rwf' => 30000, 'duration_minutes' => 60],

            // Facial Treatments (Facial)
            ['category_id' => $facialCategory->id, 'name' => 'Anti-Aging Facial', 'price_rwf' => 30000, 'duration_minutes' => 30],
            ['category_id' => $facialCategory->id, 'name' => 'Deep cleansing', 'price_rwf' => 45000, 'duration_minutes' => 45],
            ['category_id' => $facialCategory->id, 'name' => 'Facial Stress Buster', 'price_rwf' => 40000, 'duration_minutes' => 45],
            ['category_id' => $facialCategory->id, 'name' => 'Male facial', 'price_rwf' => 30000, 'duration_minutes' => 30],
            ['category_id' => $facialCategory->id, 'name' => 'Purifying facial (Oily & Imperfection skin)', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['category_id' => $facialCategory->id, 'name' => 'Classic facial', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['category_id' => $facialCategory->id, 'name' => 'Intraceutical facial', 'price_rwf' => 40000, 'duration_minutes' => 45],
            ['category_id' => $facialCategory->id, 'name' => 'Teenagers Facial', 'price_rwf' => 25000, 'duration_minutes' => 45],
            ['category_id' => $facialCategory->id, 'name' => 'Basic Facial', 'price_rwf' => 25000, 'duration_minutes' => 45],

            // Waxing Services (Waxing)
            ['category_id' => $waxingCategory->id, 'name' => 'Full Brazilian waxing', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['category_id' => $waxingCategory->id, 'name' => 'Under arms', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Stomach', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Eyebrows', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Full arms', 'price_rwf' => 25000, 'duration_minutes' => 45],
            ['category_id' => $waxingCategory->id, 'name' => 'Half arm', 'price_rwf' => 15000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Chest', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Bikini line', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['category_id' => $waxingCategory->id, 'name' => 'Full legs', 'price_rwf' => 45000, 'duration_minutes' => 45],
            ['category_id' => $waxingCategory->id, 'name' => 'Half Back', 'price_rwf' => 10000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Full Back', 'price_rwf' => 25000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Chin', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Upper Lip', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Under Lip', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Nose', 'price_rwf' => 10000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Half leg', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['category_id' => $waxingCategory->id, 'name' => 'Full face', 'price_rwf' => 15000, 'duration_minutes' => 30],

            // Special UWC Packages (Spa)
            ['category_id' => $spaCategory->id, 'name' => 'STRESS BUSTER Package', 'price_rwf' => 50000, 'duration_minutes' => 120, 'description' => 'Body Scrub and Massage'],
            ['category_id' => $spaCategory->id, 'name' => 'ME TIME Package', 'price_rwf' => 60000, 'duration_minutes' => 150, 'description' => 'Body Scrub, Massage, Facial'],
            ['category_id' => $spaCategory->id, 'name' => 'Couple Steam & Massage Package', 'price_rwf' => 90000, 'duration_minutes' => 120, 'description' => 'Steam and Massage'],
            ['category_id' => $spaCategory->id, 'name' => 'Steam & Massage Package', 'price_rwf' => 50000, 'duration_minutes' => 90, 'description' => 'Steam and Massage'],
            ['category_id' => $spaCategory->id, 'name' => 'Morrocan Bath & Facial Package', 'price_rwf' => 90000, 'duration_minutes' => 120, 'description' => 'Morrocan Bath and Facial'],
            ['category_id' => $spaCategory->id, 'name' => 'UWC Special Package', 'price_rwf' => 130000, 'duration_minutes' => 240, 'description' => 'Body Scrub, Massage, Facial, Waxing, Beverage'],
        ];

        $sortOrder = 1;
        foreach ($services as $svc) {
            $service = Service::firstOrNew(['name' => $svc['name']]);
            
            if (!$service->exists) {
                $service->slug = Str::slug($svc['name']) . '-' . rand(100, 999);
            }
            
            $service->description = $svc['description'] ?? 'Premium ' . $svc['name'] . ' at Universal Wellbeing Center.';
            $service->category_id = $svc['category_id'];
            $service->duration_minutes = $svc['duration_minutes'];
            $service->price_rwf = null; // Don't give it base price!
            $service->icon = 'sparkles';
            $service->is_active = true;
            $service->sort_order = $sortOrder++;
            $service->save();

            // Attach to city with price
            $service->cities()->syncWithoutDetaching([
                $city->id => ['price_rwf' => $svc['price_rwf']]
            ]);
        }
    }
}
