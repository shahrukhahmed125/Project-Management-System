<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::orderBy('start_date')->paginate(10);
        return view('configuration.holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('configuration.holidays.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
        ]);

        Holiday::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Holiday created successfully.'
        ]);
    }

    public function show(Holiday $holiday)
    {
        return view('configuration.holidays.show', compact('holiday'));
    }

    public function edit(Holiday $holiday)
    {
        return view('configuration.holidays.edit', compact('holiday'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
        ]);

        $holiday->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Holiday updated successfully.',
            'action' => 'update',
            'redirect' => route('configuration.holidays.index')
        ]);
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Holiday deleted successfully.'
        ]);
    }
}
