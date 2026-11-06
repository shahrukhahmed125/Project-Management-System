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
            'legal_name' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'founded_date' => 'nullable|date',
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
        $settings = CompanySetting::pluck('value', 'key')->toArray();
        return view('company.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->all();

        // Handle checkboxes - unchecked checkboxes aren't sent in form submissions
        $data['email_notifications'] = $request->has('email_notifications') ? true : false;
        $data['slack_notifications'] = $request->has('slack_notifications') ? true : false;

        foreach ($data as $key => $value) {
            if (in_array($key, ['timezone', 'date_format', 'currency', 'email_notifications', 'slack_notifications'])) {
                CompanySetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'type' => is_bool($value) ? 'boolean' : 'string']
                );
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Company settings updated successfully.'
        ]);
    }
}
