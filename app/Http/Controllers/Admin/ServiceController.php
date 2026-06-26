<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $services = $query->with('cities.country', 'category')->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        return view('admin.services.index', compact('services'));
    }

    public function bulkCreate()
    {
        $cities = City::where('is_active', true)->with('country')->get();
        $categories = \App\Models\Category::all();
        return view('admin.services.bulk', compact('cities', 'categories'));
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'services' => 'required|array|min:1',
            'services.*.name' => 'required|string|max:255',
            'services.*.category_id' => 'required|exists:categories,id',
            'services.*.duration_minutes' => 'required|integer|min:1',
            'services.*.price_rwf' => 'nullable|numeric|min:0',
            'services.*.city_prices' => 'array',
            'services.*.city_prices.*' => 'nullable|numeric|min:0'
        ]);

        $createdCount = 0;
        foreach ($validated['services'] as $svcData) {
            $cityPrices = $svcData['city_prices'] ?? [];
            unset($svcData['city_prices']);

            $svcData['slug'] = Str::slug($svcData['name']) . '-' . time() . '-' . uniqid();
            $svcData['description'] = 'Bulk imported service. Edit to update description.';
            $svcData['is_active'] = true;
            
            $service = Service::create($svcData);

            if (!empty($cityPrices)) {
                $syncData = [];
                foreach ($cityPrices as $cityId => $price) {
                    if ($price !== null && $price !== '') {
                        $syncData[$cityId] = ['price_rwf' => $price];
                    }
                }
                $service->cities()->sync($syncData);
            }
            
            $createdCount++;
        }

        return redirect()->route('admin.services.index')->with('success', "{$createdCount} services created successfully.");
    }

    public function create()
    {
        $cities = City::where('is_active', true)->with('country')->get();
        $categories = \App\Models\Category::all();
        return view('admin.services.create', compact('cities', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'duration_minutes' => 'required|integer|min:1',
            'price_rwf' => 'nullable|numeric|min:0',
            'city_prices' => 'array',
            'city_prices.*' => 'nullable|numeric|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        $validated['is_active'] = $request->has('is_active');

        $service = Service::create($validated);

        if ($request->has('city_prices')) {
            $syncData = [];
            foreach ($request->city_prices as $cityId => $price) {
                if ($price !== null && $price !== '') {
                    $syncData[$cityId] = ['price_rwf' => $price];
                }
            }
            $service->cities()->sync($syncData);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $cities = City::where('is_active', true)->with('country')->get();
        $categories = \App\Models\Category::all();
        return view('admin.services.edit', compact('service', 'cities', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'duration_minutes' => 'required|integer|min:1',
            'price_rwf' => 'nullable|numeric|min:0',
            'city_prices' => 'array',
            'city_prices.*' => 'nullable|numeric|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($service->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }

        $service->update($validated);

        if ($request->has('city_prices')) {
            $syncData = [];
            foreach ($request->city_prices as $cityId => $price) {
                if ($price !== null && $price !== '') {
                    $syncData[$cityId] = ['price_rwf' => $price];
                }
            }
            $service->cities()->sync($syncData);
        } else {
            $service->cities()->sync([]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
