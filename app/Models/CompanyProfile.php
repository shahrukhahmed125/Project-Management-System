<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'country',
        'postal_code',
        'description',
    ];
}
