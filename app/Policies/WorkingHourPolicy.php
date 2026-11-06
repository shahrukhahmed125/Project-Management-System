<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkingHour;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkingHourPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view working hours');
    }

    public function update(User $user, WorkingHour $workingHour)
    {
        return $user->can('edit working hours');
    }
}
