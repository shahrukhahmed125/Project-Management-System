<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // User fields
            'email' => 'required|email|unique:users,email,' . $this->employee->user_id,
            'password' => 'nullable|min:8|string',

            // Employee fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:employees,employee_id,' . $this->employee->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'manager_id' => 'nullable|exists:employees,id',
            'joining_date' => 'required|date',
            'employment_type' => 'required|in:full-time,part-time,contract,intern',
            'employment_status' => 'required|in:active,inactive,on-leave,terminated',
            'office_location_id' => 'nullable|exists:office_locations,id',
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:500',
        ];
    }
}
