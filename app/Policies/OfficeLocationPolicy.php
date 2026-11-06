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
        return $user->can('locations.view');
    }

    public function view(User $user, OfficeLocation $location)
    {
        return $user->can('locations.view');
    }

    public function create(User $user)
    {
        return $user->can('locations.create');
    }

    public function update(User $user, OfficeLocation $location)
    {
        return $user->can('locations.update');
    }

    public function delete(User $user, OfficeLocation $location)
    {
        return $user->can('locations.delete');
    }
}
