<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function profile()
    {
        $company = CompanyProfile::firstOrNew();
        return view('company.profile', compact('company'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:2000',
        ]);

        CompanyProfile::updateOrCreate([], $validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Company profile updated successfully.'
        ]);
    }

    public function settings()
    {
        $settings = CompanySetting::all()->groupBy('group');
        return view('company.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            CompanySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'string']
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Company settings updated successfully.'
        ]);
    }
}
