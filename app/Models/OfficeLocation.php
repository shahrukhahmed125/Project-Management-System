<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeLocation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'postal_code',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
