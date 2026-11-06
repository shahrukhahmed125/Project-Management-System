<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentService
{
    public function createDepartment(array $data): Department
    {
        $data['slug'] = $this->generateSlug($data['name']);
        $data['created_by'] = auth()->id();

        return Department::create($data);
    }

    public function updateDepartment(Department $department, array $data): Department
    {
        if (isset($data['name']) && $data['name'] !== $department->name) {
            $data['slug'] = $this->generateSlug($data['name']);
        }

        $department->update($data);

        return $department->fresh();
    }

    public function deleteDepartment(Department $department): bool
    {
        // Check if department has employees
        if ($department->employees()->count() > 0) {
            throw new \Exception('Cannot delete department with assigned employees. Please reassign or delete employees first.');
        }

        // Check if department has designations
        if ($department->designations()->count() > 0) {
            throw new \Exception('Cannot delete department with existing designations. Please delete designations first.');
        }

        // Check if department has teams
        if ($department->teams()->count() > 0) {
            throw new \Exception('Cannot delete department with existing teams. Please delete teams first.');
        }

        return $department->delete();
    }

    public function toggleDepartmentStatus(Department $department): Department
    {
        $department->status = $department->status === 'active' ? 'inactive' : 'active';
        $department->save();

        return $department->fresh();
    }

    protected function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Department::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
