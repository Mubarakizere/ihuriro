<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::with('country');

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('country', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('currency', 'like', "%{$search}%");
                  });
            });
        }

        $cities = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $countries = Country::where('is_active', true)->get();
        return view('admin.cities.index', compact('cities', 'countries'));
    }

    public function bulkCreate()
    {
        $countries = Country::where('is_active', true)->get();
        return view('admin.cities.bulk', compact('countries'));
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'cities' => 'required|array|min:1',
            'cities.*.name' => 'required|string|max:255',
            'cities.*.country_id' => 'required|exists:countries,id',
        ]);

        $createdCount = 0;
        foreach ($validated['cities'] as $cityData) {
            $cityData['is_active'] = true;
            City::create($cityData);
            $createdCount++;
        }

        return redirect()->route('admin.cities.index')->with('success', "{$createdCount} cities created successfully.");
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->get();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255'
        ]);

        $validated['is_active'] = $request->has('is_active');

        City::create($validated);

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
    }

    public function edit(City $city)
    {
        $countries = Country::where('is_active', true)->get();
        return view('admin.cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $city->update($validated);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}
