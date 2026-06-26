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
        // 1. Delete old services
        Service::query()->delete();

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

        // 4. Ensure Category "Spa" exists
        $spaCategory = Category::firstOrCreate(
            ['slug' => 'spa'],
            [
                'name' => 'Spa',
                'description' => 'Universal Wellbeing Center Spa Services',
                'image_path' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&q=80',
            ]
        );

        $services = [
            // Massages & Body Treatments
            ['name' => 'Reflexology', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['name' => 'Deep tissue', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['name' => 'Classic aromatherapy', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['name' => 'Shiatsu', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['name' => 'Hawaiian', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['name' => 'Swedish', 'price_rwf' => 30000, 'duration_minutes' => 60],
            ['name' => 'Hydromassage', 'price_rwf' => 50000, 'duration_minutes' => 120],
            ['name' => 'Couple hydro massage', 'price_rwf' => 70000, 'duration_minutes' => 120],
            ['name' => 'Foot massage', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['name' => 'Head & scalp', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['name' => 'Back massage', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['name' => 'Body scrub', 'price_rwf' => 25000, 'duration_minutes' => 30],
            ['name' => 'Massage & Body scrub', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['name' => 'Hot stone massage', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['name' => 'Indian head massage', 'price_rwf' => 25000, 'duration_minutes' => 60],
            ['name' => 'Candle Massage & Body scrub', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['name' => 'Couple massage', 'price_rwf' => 60000, 'duration_minutes' => 60],
            ['name' => 'Couple massage + body scrub', 'price_rwf' => 80000, 'duration_minutes' => 60],
            ['name' => 'Trigger point massage', 'price_rwf' => 20000, 'duration_minutes' => 60],
            ['name' => 'Lomi Lomi', 'price_rwf' => 35000, 'duration_minutes' => 60],
            ['name' => 'Teenager’s Massage', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['name' => 'Body lap and Massage', 'price_rwf' => 55000, 'duration_minutes' => 60],
            ['name' => 'Morrocan bath', 'price_rwf' => 50000, 'duration_minutes' => 60],

            // Detoxification Packages
            ['name' => 'Fasting Juice and Massage', 'price_rwf' => 60000, 'duration_minutes' => 4320, 'description' => '3 Days package'],
            ['name' => 'Master Cleansing, Hydro, Detox and Massage', 'price_rwf' => 70000, 'duration_minutes' => 180],
            ['name' => 'Soaking and Massage', 'price_rwf' => 30000, 'duration_minutes' => 60],

            // Facial Treatments
            ['name' => 'Anti-Aging Facial', 'price_rwf' => 30000, 'duration_minutes' => 30],
            ['name' => 'Deep cleansing', 'price_rwf' => 45000, 'duration_minutes' => 45],
            ['name' => 'Facial Stress Buster', 'price_rwf' => 40000, 'duration_minutes' => 45],
            ['name' => 'Male facial', 'price_rwf' => 30000, 'duration_minutes' => 30],
            ['name' => 'Purifying facial (Oily & Imperfection skin)', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['name' => 'Classic facial', 'price_rwf' => 50000, 'duration_minutes' => 60],
            ['name' => 'Intraceutical facial', 'price_rwf' => 40000, 'duration_minutes' => 45],
            ['name' => 'Teenagers Facial', 'price_rwf' => 25000, 'duration_minutes' => 45],
            ['name' => 'Basic Facial', 'price_rwf' => 25000, 'duration_minutes' => 45],

            // Waxing Services
            ['name' => 'Full Brazilian waxing', 'price_rwf' => 40000, 'duration_minutes' => 60],
            ['name' => 'Under arms', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['name' => 'Stomach', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['name' => 'Eyebrows', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['name' => 'Full arms', 'price_rwf' => 25000, 'duration_minutes' => 45],
            ['name' => 'Half arm', 'price_rwf' => 15000, 'duration_minutes' => 30],
            ['name' => 'Chest', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['name' => 'Bikini line', 'price_rwf' => 20000, 'duration_minutes' => 45],
            ['name' => 'Full legs', 'price_rwf' => 45000, 'duration_minutes' => 45],
            ['name' => 'Half Back', 'price_rwf' => 10000, 'duration_minutes' => 30],
            ['name' => 'Full Back', 'price_rwf' => 25000, 'duration_minutes' => 30],
            ['name' => 'Chin', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['name' => 'Upper Lip', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['name' => 'Under Lip', 'price_rwf' => 5000, 'duration_minutes' => 30],
            ['name' => 'Nose', 'price_rwf' => 10000, 'duration_minutes' => 30],
            ['name' => 'Half leg', 'price_rwf' => 20000, 'duration_minutes' => 30],
            ['name' => 'Full face', 'price_rwf' => 15000, 'duration_minutes' => 30],

            // Special UWC Packages
            ['name' => 'STRESS BUSTER Package', 'price_rwf' => 50000, 'duration_minutes' => 120, 'description' => 'Body Scrub and Massage'],
            ['name' => 'ME TIME Package', 'price_rwf' => 60000, 'duration_minutes' => 150, 'description' => 'Body Scrub, Massage, Facial'],
            ['name' => 'Couple Steam & Massage Package', 'price_rwf' => 90000, 'duration_minutes' => 120, 'description' => 'Steam and Massage'],
            ['name' => 'Steam & Massage Package', 'price_rwf' => 50000, 'duration_minutes' => 90, 'description' => 'Steam and Massage'],
            ['name' => 'Morrocan Bath & Facial Package', 'price_rwf' => 90000, 'duration_minutes' => 120, 'description' => 'Morrocan Bath and Facial'],
            ['name' => 'UWC Special Package', 'price_rwf' => 130000, 'duration_minutes' => 240, 'description' => 'Body Scrub, Massage, Facial, Waxing, Beverage'],
        ];

        $sortOrder = 1;
        foreach ($services as $svc) {
            $service = Service::create([
                'name' => $svc['name'],
                'slug' => Str::slug($svc['name']) . '-' . rand(100, 999),
                'description' => $svc['description'] ?? 'Premium ' . $svc['name'] . ' at Universal Wellbeing Center.',
                'category_id' => $spaCategory->id,
                'duration_minutes' => $svc['duration_minutes'],
                'price_rwf' => $svc['price_rwf'],
                'icon' => 'sparkles',
                'is_active' => true,
                'sort_order' => $sortOrder++,
            ]);

            // Attach to city
            $service->cities()->attach($city->id, ['price_rwf' => $svc['price_rwf']]);
        }
    }
}
