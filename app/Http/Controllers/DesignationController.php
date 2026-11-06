<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;
use App\Services\DesignationService;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    protected $designationService;

    public function __construct(DesignationService $designationService)
    {
        $this->designationService = $designationService;
    }

    public function index()
    {
        $designations = Designation::with('department', 'employees')
            ->orderBy('department_id')
            ->orderBy('name')
            ->paginate(10);

        return view('organisation.designations.index', compact('designations'));
    }

    public function create()
    {
        $departments = \App\Models\Department::where('status', 'active')->get();
        return view('organisation.designations.create', compact('departments'));
    }

    public function store(StoreDesignationRequest $request)
    {
        try {
            $designation = $this->designationService->createDesignation($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Designation created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Designation $designation)
    {
        $designation->load('department', 'employees');

        return view('organisation.designations.show', compact('designation'));
    }

    public function edit(Designation $designation)
    {
        $departments = \App\Models\Department::where('status', 'active')->get();
        return view('organisation.designations.edit', compact('designation', 'departments'));
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        try {
            $this->designationService->updateDesignation($designation, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Designation updated successfully.',
                'action' => 'update',
                'redirect' => route('organisation.designations.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Designation $designation)
    {
        try {
            $this->designationService->deleteDesignation($designation);

            return response()->json([
                'status' => 'success',
                'message' => 'Designation deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
