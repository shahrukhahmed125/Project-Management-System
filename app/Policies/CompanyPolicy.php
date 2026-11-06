<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewProfile(User $user)
    {
        return $user->can('view company');
    }

    public function updateProfile(User $user)
    {
        return $user->can('edit company');
    }

    public function viewSettings(User $user)
    {
        return $user->can('view company');
    }

    public function updateSettings(User $user)
    {
        return $user->can('edit company');
    }
}
