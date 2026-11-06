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
        return $user->can('employees.view');
    }

    public function view(User $user, Employee $employee)
    {
        return $user->can('employees.view') || $user->employee->id === $employee->id;
    }

    public function create(User $user)
    {
        return $user->can('employees.create');
    }

    public function update(User $user, Employee $employee)
    {
        return $user->can('employees.update') || $user->employee->id === $employee->id;
    }

    public function delete(User $user, Employee $employee)
    {
        return $user->can('employees.delete');
    }

    public function toggleStatus(User $user, Employee $employee)
    {
        return $user->can('employees.update');
    }
}
