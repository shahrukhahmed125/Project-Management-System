<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:departments,name,' . $this->department->id,
            'description' => 'nullable|string|max:2000',
            'department_head_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ];
    }
}