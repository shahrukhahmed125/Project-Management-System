<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index()
    {
        $teams = Team::with('department', 'teamLeader', 'employees')
            ->orderBy('department_id')
            ->orderBy('name')
            ->paginate(10);

        return view('organisation.teams.index', compact('teams'));
    }

    public function create()
    {
        $departments = \App\Models\Department::where('status', 'active')->get();
        return view('organisation.teams.create', compact('departments'));
    }

    public function store(StoreTeamRequest $request)
    {
        try {
            $team = $this->teamService->createTeam($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Team created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Team $team)
    {
        $team->load('department', 'teamLeader', 'employees.user', 'employees.department');

        return view('organisation.teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $departments = \App\Models\Department::where('status', 'active')->get();
        return view('organisation.teams.edit', compact('team', 'departments'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        try {
            $this->teamService->updateTeam($team, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Team updated successfully.',
                'action' => 'update',
                'redirect' => route('organisation.teams.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Team $team)
    {
        try {
            $this->teamService->deleteTeam($team);

            return response()->json([
                'status' => 'success',
                'message' => 'Team deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addMember(Request $request, Team $team)
    {
        try {
            $this->teamService->addMember($team, $request->employee_id);

            return response()->json([
                'status' => 'success',
                'message' => 'Team member added successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function removeMember(Team $team, $employeeId)
    {
        try {
            $this->teamService->removeMember($team, $employeeId);

            return response()->json([
                'status' => 'success',
                'message' => 'Team member removed successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
