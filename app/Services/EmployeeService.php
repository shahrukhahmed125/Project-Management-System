<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    public function createEmployee(array $data): Employee
    {
        return DB::transaction(function () use ($data) {
            // Extract user data
            $userData = [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_id' => User::GenerateEmployeeId(),
            ];

            // Create user
            $user = User::create($userData);

            // Create employee
            $employeeData = [
                'user_id' => $user->id,
                'employee_id' => $data['employee_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
                'department_id' => $data['department_id'],
                'designation_id' => $data['designation_id'],
                'manager_id' => $data['manager_id'] ?? null,
                'joining_date' => $data['joining_date'],
                'employment_type' => $data['employment_type'],
                'employment_status' => $data['employment_status'],
                'office_location_id' => $data['office_location_id'] ?? null,
                'address' => $data['address'] ?? null,
                'emergency_contact' => $data['emergency_contact'] ?? null,
            ];

            return Employee::create($employeeData);
        });
    }

    public function updateEmployee(Employee $employee, array $data): Employee
    {
        return DB::transaction(function () use ($employee, $data) {
            // Update user if email or password changed
            if (isset($data['email']) || isset($data['password'])) {
                $userData = [];
                if (isset($data['email'])) {
                    $userData['email'] = $data['email'];
                }
                if (isset($data['password'])) {
                    $userData['password'] = Hash::make($data['password']);
                }
                if (!empty($userData)) {
                    $employee->user->update($userData);
                }
            }

            // Update employee
            $employeeData = [
                'first_name' => $data['first_name'] ?? $employee->first_name,
                'last_name' => $data['last_name'] ?? $employee->last_name,
                'phone' => $data['phone'] ?? $employee->phone,
                'date_of_birth' => $data['date_of_birth'] ?? $employee->date_of_birth,
                'gender' => $data['gender'] ?? $employee->gender,
                'department_id' => $data['department_id'] ?? $employee->department_id,
                'designation_id' => $data['designation_id'] ?? $employee->designation_id,
                'manager_id' => $data['manager_id'] ?? $employee->manager_id,
                'joining_date' => $data['joining_date'] ?? $employee->joining_date,
                'employment_type' => $data['employment_type'] ?? $employee->employment_type,
                'employment_status' => $data['employment_status'] ?? $employee->employment_status,
                'office_location_id' => $data['office_location_id'] ?? $employee->office_location_id,
                'address' => $data['address'] ?? $employee->address,
                'emergency_contact' => $data['emergency_contact'] ?? $employee->emergency_contact,
            ];

            $employee->update($employeeData);

            // Update user name if employee name changed
            if (isset($data['first_name']) || isset($data['last_name'])) {
                $employee->user->update([
                    'name' => $employee->first_name . ' ' . $employee->last_name
                ]);
            }

            return $employee->fresh();
        });
    }

    public function deleteEmployee(Employee $employee): bool
    {
        return DB::transaction(function () use ($employee) {
            // Delete employee
            $employee->delete();

            // Delete associated user
            $employee->user->delete();

            return true;
        });
    }

    public function toggleEmployeeStatus(Employee $employee): Employee
    {
        $employee->employment_status = $employee->employment_status === 'active' ? 'inactive' : 'active';
        $employee->save();

        return $employee->fresh();
    }

    public function validateEmployeeId(string $employeeId): bool
    {
        return !Employee::where('employee_id', $employeeId)->exists();
    }

    public function checkDuplicateEmail(string $email, ?int $exceptUserId = null): bool
    {
        $query = User::where('email', $email);
        if ($exceptUserId) {
            $query->where('id', '!=', $exceptUserId);
        }
        return !$query->exists();
    }
}
