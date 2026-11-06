<?php

namespace App\Http\Controllers;

use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    public function index()
    {
        $workingHours = WorkingHour::orderBy('day_of_week')->get();
        return view('configuration.working-hours.index', compact('workingHours'));
    }

    public function update(Request $request)
    {
        foreach ($request->working_hours as $dayOfWeek => $data) {
            WorkingHour::updateOrCreate(
                ['day_of_week' => $dayOfWeek],
                [
                    'is_working_day' => $data['is_working_day'] ?? false,
                    'start_time' => $data['start_time'] ?? null,
                    'end_time' => $data['end_time'] ?? null,
                    'break_duration_minutes' => $data['break_duration_minutes'] ?? 0,
                ]
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Working hours updated successfully.'
        ]);
    }
}
