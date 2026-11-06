<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = [
        'day_of_week',
        'is_working_day',
        'start_time',
        'end_time',
        'break_duration_minutes',
    ];

    protected $casts = [
        'is_working_day' => 'boolean',
        'break_duration_minutes' => 'integer',
    ];

    public function getDayNameAttribute()
    {
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return $days[$this->day_of_week] ?? 'Unknown';
    }
}
