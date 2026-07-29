<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display all services
     */
    public function index(Request $request)
    {
        $selectedCity = null;
        if ($request->filled('city_id')) {
            $selectedCity = \App\Models\City::with('country')->find($request->city_id);
        }
        $selectedCountry = null;
        if ($request->filled('country_id')) {
            $selectedCountry = \App\Models\Country::find($request->country_id);
        }

        // Get all categories that have active services matching the location filter
        $categories = \App\Models\Category::whereHas('services', function($q) use ($request) {
                $q->active();
                if ($request->filled('city_id')) {
                    $q->whereHas('cities', function($c) use ($request) {
                        $c->where('cities.id', $request->city_id)
                          ->whereNotNull('city_service.price_rwf');
                    });
                } elseif ($request->filled('country_id')) {
                    $q->whereHas('cities', function($c) use ($request) {
                        $c->where('country_id', $request->country_id)
                          ->whereNotNull('city_service.price_rwf');
                    });
                }
            })
            ->with(['services' => function($q) use ($request) {
                $q->active()->orderBy('sort_order')->with('cities.country');
                if ($request->filled('city_id')) {
                    $q->whereHas('cities', function($c) use ($request) {
                        $c->where('cities.id', $request->city_id)
                          ->whereNotNull('city_service.price_rwf');
                    });
                } elseif ($request->filled('country_id')) {
                    $q->whereHas('cities', function($c) use ($request) {
                        $c->where('country_id', $request->country_id)
                          ->whereNotNull('city_service.price_rwf');
                    });
                }
            }])
            ->get();

        // Get active countries and their cities for the location selector
        $countries = \App\Models\Country::where('is_active', true)
            ->with(['cities' => function($q) {
                $q->where('is_active', true)->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        // Get the services hero image from settings
        $servicesHeroImage = \App\Models\Setting::get('services_hero_image');

        return view('services.index', compact('categories', 'countries', 'selectedCity', 'selectedCountry', 'servicesHeroImage'));
    }

    /**
     * Display a single service
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->active()->with('cities.country')->firstOrFail();
        
        $relatedServices = Service::active()
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->with('cities.country')
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
