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
        return $user->can('working_hours.view');
    }

    public function update(User $user, WorkingHour $workingHour)
    {
        return $user->can('working_hours.manage');
    }
}
