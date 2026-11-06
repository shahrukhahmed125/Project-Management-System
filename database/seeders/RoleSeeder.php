<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles with their permissions
        $roles = [
            'Super Admin' => [
                'dashboard.view',
                'dashboard.admin',
                'dashboard.employee',
                'company.view',
                'company.update',
                'company.settings',
                'departments.view',
                'departments.create',
                'departments.update',
                'departments.delete',
                'designations.view',
                'designations.create',
                'designations.update',
                'designations.delete',
                'employees.view',
                'employees.create',
                'employees.update',
                'employees.delete',
                'employees.assign',
                'teams.view',
                'teams.create',
                'teams.update',
                'teams.delete',
                'teams.assign',
                'locations.view',
                'locations.create',
                'locations.update',
                'locations.delete',
                'working_hours.view',
                'working_hours.manage',
                'holidays.view',
                'holidays.create',
                'holidays.update',
                'holidays.delete',
            ],
            'Admin' => [
                'dashboard.view',
                'dashboard.admin',
                'dashboard.employee',
                'company.view',
                'company.update',
                'company.settings',
                'departments.view',
                'departments.create',
                'departments.update',
                'departments.delete',
                'designations.view',
                'designations.create',
                'designations.update',
                'designations.delete',
                'employees.view',
                'employees.create',
                'employees.update',
                'employees.assign',
                'teams.view',
                'teams.create',
                'teams.update',
                'teams.delete',
                'teams.assign',
                'locations.view',
                'locations.create',
                'locations.update',
                'locations.delete',
                'working_hours.view',
                'working_hours.manage',
                'holidays.view',
                'holidays.create',
                'holidays.update',
                'holidays.delete',
            ],
            'HR Manager' => [
                'dashboard.view',
                'company.view',
                'company.update',
                'departments.view',
                'departments.create',
                'departments.update',
                'designations.view',
                'designations.create',
                'designations.update',
                'employees.view',
                'employees.create',
                'employees.update',
                'employees.assign',
                'teams.view',
                'teams.create',
                'teams.update',
                'teams.assign',
                'locations.view',
                'locations.create',
                'locations.update',
                'working_hours.view',
                'working_hours.manage',
                'holidays.view',
                'holidays.create',
                'holidays.update',
                'holidays.delete',
            ],
            'Project Manager' => [
                'dashboard.view',
                'departments.view',
                'designations.view',
                'employees.view',
                'teams.view',
                'teams.create',
                'teams.update',
                'teams.assign',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
            'Team Lead' => [
                'dashboard.view',
                'departments.view',
                'designations.view',
                'employees.view',
                'teams.view',
                'teams.update',
                'teams.assign',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
            'Developer' => [
                'dashboard.view',
                'departments.view',
                'designations.view',
                'employees.view',
                'teams.view',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
            'Designer' => [
                'dashboard.view',
                'departments.view',
                'designations.view',
                'employees.view',
                'teams.view',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
            'QA' => [
                'dashboard.view',
                'departments.view',
                'designations.view',
                'employees.view',
                'teams.view',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
            'Employee' => [
                'dashboard.view',
                'employees.view',
                'teams.view',
                'locations.view',
                'working_hours.view',
                'holidays.view',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($permissions);
        }

        $this->command->info('Roles and permissions seeded successfully.');
    }
}
