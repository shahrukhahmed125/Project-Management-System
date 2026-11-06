<?php

namespace App\Services;

use App\Models\Designation;
use Illuminate\Support\Str;

class DesignationService
{
    public function createDesignation(array $data): Designation
    {
        $data['slug'] = $this->generateSlug($data['name'], $data['department_id']);

        return Designation::create($data);
    }

    public function updateDesignation(Designation $designation, array $data): Designation
    {
        if (isset($data['name']) && $data['name'] !== $designation->name) {
            $data['slug'] = $this->generateSlug($data['name'], $data['department_id'] ?? $designation->department_id);
        }

        $designation->update($data);

        return $designation->fresh();
    }

    public function deleteDesignation(Designation $designation): bool
    {
        if ($designation->employees()->count() > 0) {
            throw new \Exception('Cannot delete designation with assigned employees. Please reassign or delete employees first.');
        }

        return $designation->delete();
    }

    protected function generateSlug(string $name, int $departmentId): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Designation::where('slug', $slug)->where('department_id', $departmentId)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
