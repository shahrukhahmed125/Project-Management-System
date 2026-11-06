<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewProfile(User $user)
    {
        return $user->can('company.view');
    }

    public function updateProfile(User $user)
    {
        return $user->can('company.update');
    }

    public function viewSettings(User $user)
    {
        return $user->can('company.view');
    }

    public function updateSettings(User $user)
    {
        return $user->can('company.settings');
    }
}
