<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OfficeLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficeLocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view locations');
    }

    public function view(User $user, OfficeLocation $location)
    {
        return $user->can('view locations');
    }

    public function create(User $user)
    {
        return $user->can('create locations');
    }

    public function update(User $user, OfficeLocation $location)
    {
        return $user->can('edit locations');
    }

    public function delete(User $user, OfficeLocation $location)
    {
        return $user->can('delete locations');
    }
}
