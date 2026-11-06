<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'employee_id',
        'first_name',
        'last_name',
        'profile_image',
        'phone',
        'date_of_birth',
        'gender',
        'department_id',
        'designation_id',
        'manager_id',
        'joining_date',
        'employment_type',
        'employment_status',
        'office_location_id',
        'address',
        'emergency_contact',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'employment_type' => 'string',
        'employment_status' => 'string',
        'gender' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function officeLocation()
    {
        return $this->belongsTo(OfficeLocation::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members')->withPivot('joined_at')->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
