<?php

namespace App\Http\Controllers;

use App\Models\OfficeLocation;
use Illuminate\Http\Request;

class OfficeLocationController extends Controller
{
    public function index()
    {
        $locations = OfficeLocation::orderBy('name')->paginate(10);
        return view('configuration.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('configuration.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:office_locations,name',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        OfficeLocation::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Office location created successfully.'
        ]);
    }

    public function show(OfficeLocation $location)
    {
        return view('configuration.locations.show', compact('location'));
    }

    public function edit(OfficeLocation $location)
    {
        return view('configuration.locations.edit', compact('location'));
    }

    public function update(Request $request, OfficeLocation $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:office_locations,name,' . $location->id,
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $location->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Office location updated successfully.',
            'action' => 'update',
            'redirect' => route('configuration.locations.index')
        ]);
    }

    public function destroy(OfficeLocation $location)
    {
        if ($location->employees()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete location with assigned employees.'
            ], 422);
        }

        $location->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Office location deleted successfully.'
        ]);
    }
}
