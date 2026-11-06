<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDesignationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:active,inactive',
        ];
    }
}
