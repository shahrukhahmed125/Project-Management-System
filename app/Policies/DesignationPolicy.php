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
        return $user->can('view designations');
    }

    public function view(User $user, Designation $designation)
    {
        return $user->can('view designations');
    }

    public function create(User $user)
    {
        return $user->can('create designations');
    }

    public function update(User $user, Designation $designation)
    {
        return $user->can('edit designations');
    }

    public function delete(User $user, Designation $designation)
    {
        return $user->can('delete designations');
    }
}
