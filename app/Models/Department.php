<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'department_head_id',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function departmentHead()
    {
        return $this->belongsTo(User::class, 'department_head_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    protected static function booted()
    {
        static::creating(function ($department) {
            if (empty($department->slug)) {
                $department->slug = Str::slug($department->name);
            }
        });
    }
}
