<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Auth\Access\HandlesAuthorization;

class DesignationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('designations.view');
    }

    public function view(User $user, Designation $designation)
    {
        return $user->can('designations.view');
    }

    public function create(User $user)
    {
        return $user->can('designations.create');
    }

    public function update(User $user, Designation $designation)
    {
        return $user->can('designations.update');
    }

    public function delete(User $user, Designation $designation)
    {
        return $user->can('designations.delete');
    }
}
