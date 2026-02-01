<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $featuredServices = Service::active()
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::active()
            ->featured()
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('featuredServices', 'testimonials'));
    }
}
