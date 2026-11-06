<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'department_id',
        'team_leader_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'team_members')->withPivot('joined_at')->withTimestamps();
    }
}
