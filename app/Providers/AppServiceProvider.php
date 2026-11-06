<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Team;
use App\Models\OfficeLocation;
use App\Models\WorkingHour;
use App\Models\Holiday;
use App\Policies\DepartmentPolicy;
use App\Policies\DesignationPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\TeamPolicy;
use App\Policies\OfficeLocationPolicy;
use App\Policies\WorkingHourPolicy;
use App\Policies\HolidayPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

    protected function registerPolicies()
    {
        Gate::policy(Department::class, DepartmentPolicy::class);
        Gate::policy(Designation::class, DesignationPolicy::class);
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(Team::class, TeamPolicy::class);
        Gate::policy(OfficeLocation::class, OfficeLocationPolicy::class);
        Gate::policy(WorkingHour::class, WorkingHourPolicy::class);
        Gate::policy(Holiday::class, HolidayPolicy::class);
    }
}
