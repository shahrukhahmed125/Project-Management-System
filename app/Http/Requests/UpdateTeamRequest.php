<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'department_id' => 'required|exists:departments,id',
            'team_leader_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ];
    }
}
