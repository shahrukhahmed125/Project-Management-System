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
        return $user->can('view holidays');
    }

    public function view(User $user, Holiday $holiday)
    {
        return $user->can('view holidays');
    }

    public function create(User $user)
    {
        return $user->can('create holidays');
    }

    public function update(User $user, Holiday $holiday)
    {
        return $user->can('edit holidays');
    }

    public function delete(User $user, Holiday $holiday)
    {
        return $user->can('delete holidays');
    }
}
