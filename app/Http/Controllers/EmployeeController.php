<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = Employee::with('user', 'department', 'designation', 'manager', 'officeLocation')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = \App\Models\Department::where('status', 'active')->get();
        $designations = \App\Models\Designation::where('status', 'active')->get();
        $officeLocations = \App\Models\OfficeLocation::where('status', 'active')->get();
        $managers = Employee::with('user')->where('employment_status', 'active')->get();

        return view('employees.create', compact('departments', 'designations', 'officeLocations', 'managers'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = $this->employeeService->createEmployee($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Employee $employee)
    {
        $employee->load('user', 'department', 'designation', 'manager.user', 'officeLocation', 'teams');

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $employee->load('user');
        $departments = \App\Models\Department::where('status', 'active')->get();
        $designations = \App\Models\Designation::where('status', 'active')->get();
        $officeLocations = \App\Models\OfficeLocation::where('status', 'active')->get();
        $managers = Employee::with('user')->where('employment_status', 'active')->where('id', '!=', $employee->id)->get();

        return view('employees.edit', compact('employee', 'departments', 'designations', 'officeLocations', 'managers'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $this->employeeService->updateEmployee($employee, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Employee updated successfully.',
                'action' => 'update',
                'redirect' => route('employees.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $this->employeeService->deleteEmployee($employee);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Employee $employee)
    {
        try {
            $employee = $this->employeeService->toggleEmployeeStatus($employee);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function profile(Employee $employee)
    {
        $employee->load('user', 'department', 'designation', 'manager.user', 'officeLocation', 'teams');

        return view('employees.profile', compact('employee'));
    }
}
