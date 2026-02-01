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
        $services = Service::active()->orderBy('sort_order')->get()->groupBy('category');
        
        $categoryLabels = [
            'waxing' => 'Waxing Services',
            'makeup' => 'Makeup & Beauty',
            'lashes' => 'Lash Extensions',
            'nails' => 'Nail Services',
            'hair' => 'Hair Services',
            'tattoo' => 'Tattoo',
            'piercing' => 'Piercing',
        ];

        return view('services.index', compact('services', 'categoryLabels'));
    }

    /**
     * Display a single service
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->active()->firstOrFail();
        
        $relatedServices = Service::active()
            ->where('category', $service->category)
            ->where('id', '!=', $service->id)
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
