<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'services_hero_image' => Setting::get('services_hero_image'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'services_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_services_hero_image' => 'nullable|boolean',
        ]);

        // Handle services hero image
        if ($request->hasFile('services_hero_image')) {
            // Delete old image if exists
            $oldImage = Setting::get('services_hero_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('services_hero_image')->store('settings', 'public');
            Setting::set('services_hero_image', $path);
        }

        // Handle image removal
        if ($request->boolean('remove_services_hero_image')) {
            $oldImage = Setting::get('services_hero_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            Setting::set('services_hero_image', null);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
