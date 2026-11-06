<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view employees');
    }

    public function view(User $user, Employee $employee)
    {
        return $user->can('view employees') || $user->employee->id === $employee->id;
    }

    public function create(User $user)
    {
        return $user->can('create employees');
    }

    public function update(User $user, Employee $employee)
    {
        return $user->can('edit employees') || $user->employee->id === $employee->id;
    }

    public function delete(User $user, Employee $employee)
    {
        return $user->can('delete employees');
    }

    public function toggleStatus(User $user, Employee $employee)
    {
        return $user->can('edit employees');
    }
}
