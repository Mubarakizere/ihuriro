<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makeup',
                'slug' => 'makeup',
                'image_path' => 'https://loremflickr.com/2000/1200/blackwoman,makeup?lock=1',
                'description' => 'Professional makeup services for any occasion.',
            ],
            [
                'name' => 'Hair',
                'slug' => 'hair',
                'image_path' => 'https://loremflickr.com/2000/1200/african,braids?lock=2',
                'description' => 'Hair styling, cuts, and braiding.',
            ],
            [
                'name' => 'Lashes',
                'slug' => 'lashes',
                'image_path' => 'https://loremflickr.com/2000/1200/lashes,eye,makeup?lock=3',
                'description' => 'Eyelash extensions and tinting.',
            ],
            [
                'name' => 'Nails',
                'slug' => 'nails',
                'image_path' => 'https://loremflickr.com/800/600/manicure,nails?lock=4',
                'description' => 'Manicure, pedicure, and nail art.',
            ],
            [
                'name' => 'Tattoo',
                'slug' => 'tattoo',
                'image_path' => 'https://loremflickr.com/800/600/tattoo,machine?lock=5', // 'tattoo' matches category link in home.blade.php
                'description' => 'Professional body art and tattoo services.',
            ],
            [
                'name' => 'Piercing',
                'slug' => 'piercing',
                'image_path' => 'https://loremflickr.com/800/600/piercing,tools?lock=6',
                'description' => 'Safe and stylish body piercing.',
            ],
            // 'waxing' is a category in ServiceSeeder but not in Home grid. We should add it or ignore.
            // ServiceSeeder had 'waxing'. 
            // I'll add it without image (or use a placeholder) just in case.
            [
                'name' => 'Waxing',
                'slug' => 'waxing',
                'image_path' => 'https://loremflickr.com/800/600/waxing,spa',
                'description' => 'Full body waxing services.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
