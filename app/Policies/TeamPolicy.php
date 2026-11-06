<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view teams');
    }

    public function view(User $user, Team $team)
    {
        return $user->can('view teams') || $team->employees->contains($user->employee);
    }

    public function create(User $user)
    {
        return $user->can('create teams');
    }

    public function update(User $user, Team $team)
    {
        return $user->can('edit teams') || $team->team_leader_id === $user->id;
    }

    public function delete(User $user, Team $team)
    {
        return $user->can('delete teams');
    }

    public function addMember(User $user, Team $team)
    {
        return $user->can('edit teams') || $team->team_leader_id === $user->id;
    }

    public function removeMember(User $user, Team $team)
    {
        return $user->can('edit teams') || $team->team_leader_id === $user->id;
    }
}
