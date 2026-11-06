<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Str;

class TeamService
{
    public function createTeam(array $data): Team
    {
        $data['slug'] = $this->generateSlug($data['name'], $data['department_id']);

        return Team::create($data);
    }

    public function updateTeam(Team $team, array $data): Team
    {
        if (isset($data['name']) && $data['name'] !== $team->name) {
            $data['slug'] = $this->generateSlug($data['name'], $data['department_id'] ?? $team->department_id);
        }

        $team->update($data);

        return $team->fresh();
    }

    public function deleteTeam(Team $team): bool
    {
        // Detach all employees first
        $team->employees()->detach();

        return $team->delete();
    }

    public function addMember(Team $team, int $employeeId): void
    {
        $team->employees()->attach($employeeId, ['joined_at' => now()]);
    }

    public function removeMember(Team $team, int $employeeId): void
    {
        $team->employees()->detach($employeeId);
    }

    public function updateTeamLeader(Team $team, int $userId): void
    {
        $team->team_leader_id = $userId;
        $team->save();
    }

    protected function generateSlug(string $name, int $departmentId): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Team::where('slug', $slug)->where('department_id', $departmentId)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
