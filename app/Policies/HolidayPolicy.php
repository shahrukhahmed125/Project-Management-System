<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Holiday;
use Illuminate\Auth\Access\HandlesAuthorization;

class HolidayPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('holidays.view');
    }

    public function view(User $user, Holiday $holiday)
    {
        return $user->can('holidays.view');
    }

    public function create(User $user)
    {
        return $user->can('holidays.create');
    }

    public function update(User $user, Holiday $holiday)
    {
        return $user->can('holidays.update');
    }

    public function delete(User $user, Holiday $holiday)
    {
        return $user->can('holidays.delete');
    }
}
