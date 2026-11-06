<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('departments.view');
    }

    public function view(User $user, Department $department)
    {
        return $user->can('departments.view');
    }

    public function create(User $user)
    {
        return $user->can('departments.create');
    }

    public function update(User $user, Department $department)
    {
        return $user->can('departments.update');
    }

    public function delete(User $user, Department $department)
    {
        return $user->can('departments.delete');
    }
}
