<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Designation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected static function booted()
    {
        static::creating(function ($designation) {
            if (empty($designation->slug)) {
                $designation->slug = Str::slug($designation->name);
            }
        });
    }
}
