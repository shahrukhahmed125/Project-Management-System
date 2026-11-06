<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard
            'dashboard.view',
            'dashboard.admin',
            'dashboard.employee',

            // Company
            'company.view',
            'company.update',
            'company.settings',

            // Departments
            'departments.view',
            'departments.create',
            'departments.update',
            'departments.delete',

            // Designations
            'designations.view',
            'designations.create',
            'designations.update',
            'designations.delete',

            // Employees
            'employees.view',
            'employees.create',
            'employees.update',
            'employees.delete',
            'employees.assign',

            // Teams
            'teams.view',
            'teams.create',
            'teams.update',
            'teams.delete',
            'teams.assign',

            // Office Locations
            'locations.view',
            'locations.create',
            'locations.update',
            'locations.delete',

            // Working Hours
            'working_hours.view',
            'working_hours.manage',

            // Holidays
            'holidays.view',
            'holidays.create',
            'holidays.update',
            'holidays.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $this->command->info('Permissions seeded successfully.');
    }
}
