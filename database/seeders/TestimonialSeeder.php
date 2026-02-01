<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Uwimana Grace',
                'location' => 'Kigali, Rwanda',
                'rating' => 5,
                'comment' => 'IHURIRO transformed my look completely! The hairstyling team is incredibly talented. I received so many compliments at my wedding. Highly recommend their services!',
                'service_used' => 'Hairstyle',
                'is_featured' => true,
            ],
            [
                'name' => 'Mugisha Jean',
                'location' => 'Kigali, Rwanda',
                'rating' => 5,
                'comment' => 'Best haircut I\'ve ever had in Kigali. The stylist really listened to what I wanted and delivered perfectly. The atmosphere is so welcoming and professional.',
                'service_used' => 'Haircut',
                'is_featured' => true,
            ],
            [
                'name' => 'Ishimwe Diane',
                'location' => 'Musanze, Rwanda',
                'rating' => 5,
                'comment' => 'The lash extensions are absolutely stunning! They look so natural and have lasted for weeks. The technician was very careful and made me feel comfortable throughout.',
                'service_used' => 'Lashes',
                'is_featured' => true,
            ],
            [
                'name' => 'Habimana Eric',
                'location' => 'Huye, Rwanda',
                'rating' => 5,
                'comment' => 'Got my first tattoo here and the experience was amazing. The artist was patient, creative, and the final result exceeded my expectations. Very clean and professional studio.',
                'service_used' => 'Tattoo',
                'is_featured' => true,
            ],
            [
                'name' => 'Uwase Claire',
                'location' => 'Rubavu, Rwanda',
                'rating' => 5,
                'comment' => 'The spa treatment was heavenly! After months of stress, I finally found relaxation. The massage therapists are skilled and the ambiance is perfect. Will definitely return.',
                'service_used' => 'Spa',
                'is_featured' => true,
            ],
            [
                'name' => 'Niyonzima Patrick',
                'location' => 'Kigali, Rwanda',
                'rating' => 5,
                'comment' => 'My wife\'s makeup for our anniversary dinner was flawless. The makeup artist understood exactly what she wanted and enhanced her natural beauty perfectly.',
                'service_used' => 'Makeup',
                'is_featured' => false,
            ],
            [
                'name' => 'Mukamana Jeanne',
                'location' => 'Nyagatare, Rwanda',
                'rating' => 5,
                'comment' => 'Love my new nails! The nail art is so intricate and beautiful. The technician was friendly and took her time to ensure everything was perfect. Great value for money!',
                'service_used' => 'Nails',
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                ...$testimonial,
                'is_active' => true,
            ]);
        }
    }
}
