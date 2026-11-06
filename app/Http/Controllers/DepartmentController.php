<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $departments = Department::with('departmentHead', 'designations', 'employees')
            ->orderBy('name')
            ->paginate(10);

        return view('organisation.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('organisation.departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        try {
            $department = $this->departmentService->createDepartment($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Department created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Department $department)
    {
        $department->load('departmentHead', 'designations', 'employees', 'teams');

        return view('organisation.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('organisation.departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        try {
            $this->departmentService->updateDepartment($department, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Department updated successfully.',
                'action' => 'update',
                'redirect' => route('organisation.departments.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Department $department)
    {
        try {
            $this->departmentService->deleteDepartment($department);

            return response()->json([
                'status' => 'success',
                'message' => 'Department deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Department $department)
    {
        try {
            $department = $this->departmentService->toggleDepartmentStatus($department);

            return response()->json([
                'status' => 'success',
                'message' => 'Department status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
