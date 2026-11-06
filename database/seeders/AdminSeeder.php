<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $admin = User::where('email', 'admin@mail.com')->first();

        if (!$admin) {
            // Create a default department if none exists
            $department = Department::firstOrCreate(
                ['name' => 'Administration'],
                [
                    'slug' => 'administration',
                    'description' => 'Administration department',
                    'status' => 'active',
                ]
            );

            $this->command->info('Department created/verified: ' . $department->name);

            // Create a default designation if none exists
            $designation = Designation::firstOrCreate(
                ['name' => 'Super Administrator'],
                [
                    'slug' => 'super-administrator',
                    'department_id' => $department->id,
                    'description' => 'Super Administrator role',
                    'status' => 'active',
                ]
            );

            $this->command->info('Designation created/verified: ' . $designation->name);

            // Create admin user
            $admin = User::create([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'user_id' => User::GenerateEmployeeId(),
                'name' => 'Super Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
                'is_online' => false,
                'last_seen_at' => now(),
            ]);

            $this->command->info('Admin user created: ' . $admin->email);

            // Get or create Super Admin role
            $superAdminRole = Role::firstOrCreate(
                ['name' => 'Super Admin', 'guard_name' => 'web']
            );

            // Assign Super Admin role
            $admin->assignRole($superAdminRole);
            $this->command->info('Role assigned: ' . $superAdminRole->name);

            // Explicitly sync all permissions to ensure admin has complete access
            $allPermissions = Permission::all();
            $admin->syncPermissions($allPermissions);
            $this->command->info('Permissions synced: ' . $allPermissions->count() . ' permissions');

            // Verify role assignment
            $assignedRole = $admin->roles->first();
            $this->command->info('Verified role: ' . ($assignedRole ? $assignedRole->name : 'None'));

            // Verify permission count
            $permissionCount = $admin->permissions->count();
            $this->command->info('Verified permissions: ' . $permissionCount);

            // Create employee record for admin
            Employee::create([
                'user_id' => $admin->id,
                'employee_id' => 'EMP-ADMIN-001',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'phone' => null,
                'address' => null,
                'emergency_contact' => null,
                'department_id' => $department->id,
                'designation_id' => $designation->id,
                'manager_id' => null,
                'office_location_id' => null,
                'joining_date' => now(),
                'employment_type' => 'full-time',
                'employment_status' => 'active',
            ]);

            $this->command->info('Employee record created: ' . $admin->employee->employee_id);
            $this->command->info('--------------------------------------------------');
            $this->command->info('Admin user created successfully.');
            $this->command->info('Email: admin@mail.com');
            $this->command->info('Password: 123456789');
            $this->command->info('Role: Super Admin');
            $this->command->info('Permissions: ' . $permissionCount);
            $this->command->info('--------------------------------------------------');
        } else {
            // Update existing admin to ensure they have all permissions
            $superAdminRole = Role::where('name', 'Super Admin')->first();
            if ($superAdminRole) {
                $admin->syncRoles($superAdminRole);
                $allPermissions = Permission::all();
                $admin->syncPermissions($allPermissions);
                $this->command->info('Admin user already exists. Permissions updated.');
                $this->command->info('Current permissions: ' . $admin->permissions->count());
            } else {
                $this->command->info('Admin user already exists. Super Admin role not found.');
            }
        }
    }
}
