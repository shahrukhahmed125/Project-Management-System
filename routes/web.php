<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\OfficeLocationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WorkingHourController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_auth'])->name('login.auth');

// Password Reset Routes (placeholder - to be implemented)
Route::get('/forgot-password', function() {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password/{token}', function() {
    return view('auth.reset-password');
})->name('password.reset');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Company
    Route::prefix('company')->name('company.')->middleware(['can:company.view'])->group(function () {
        Route::get('/profile', [CompanyController::class, 'profile'])->name('profile');
        Route::post('/profile', [CompanyController::class, 'updateProfile'])->name('profile.update')->middleware('can:company.update');
        Route::get('/settings', [CompanyController::class, 'settings'])->name('settings');
        Route::post('/settings', [CompanyController::class, 'updateSettings'])->name('settings.update')->middleware('can:company.settings');
    });

    // Organisation - Departments
    Route::prefix('organisation/departments')->name('organisation.departments.')->middleware(['can:departments.view'])->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create')->middleware('can:departments.create');
        Route::post('/', [DepartmentController::class, 'store'])->name('store')->middleware('can:departments.create');
        Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit')->middleware('can:departments.update');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update')->middleware('can:departments.update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy')->middleware('can:departments.delete');
        Route::post('/{department}/toggle-status', [DepartmentController::class, 'toggleStatus'])->name('toggle-status')->middleware('can:departments.update');
    });

    // Organisation - Designations
    Route::prefix('organisation/designations')->name('organisation.designations.')->middleware(['can:designations.view'])->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('index');
        Route::get('/create', [DesignationController::class, 'create'])->name('create')->middleware('can:designations.create');
        Route::post('/', [DesignationController::class, 'store'])->name('store')->middleware('can:designations.create');
        Route::get('/{designation}', [DesignationController::class, 'show'])->name('show');
        Route::get('/{designation}/edit', [DesignationController::class, 'edit'])->name('edit')->middleware('can:designations.update');
        Route::put('/{designation}', [DesignationController::class, 'update'])->name('update')->middleware('can:designations.update');
        Route::delete('/{designation}', [DesignationController::class, 'destroy'])->name('destroy')->middleware('can:designations.delete');
    });

    // Organisation - Teams
    Route::prefix('organisation/teams')->name('organisation.teams.')->middleware(['can:teams.view'])->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::get('/create', [TeamController::class, 'create'])->name('create')->middleware('can:teams.create');
        Route::post('/', [TeamController::class, 'store'])->name('store')->middleware('can:teams.create');
        Route::get('/{team}', [TeamController::class, 'show'])->name('show');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit')->middleware('can:teams.update');
        Route::put('/{team}', [TeamController::class, 'update'])->name('update')->middleware('can:teams.update');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy')->middleware('can:teams.delete');
        Route::post('/{team}/members', [TeamController::class, 'addMember'])->name('add-member')->middleware('can:teams.update');
        Route::delete('/{team}/members/{employee}', [TeamController::class, 'removeMember'])->name('remove-member')->middleware('can:teams.update');
    });

    // Employees
    Route::prefix('employees')->name('employees.')->middleware(['can:employees.view'])->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create')->middleware('can:employees.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store')->middleware('can:employees.create');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit')->middleware('can:employees.update');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update')->middleware('can:employees.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy')->middleware('can:employees.delete');
        Route::post('/{employee}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('toggle-status')->middleware('can:employees.update');
        Route::get('/{employee}/profile', [EmployeeController::class, 'profile'])->name('profile');
    });

    // Configuration - Office Locations
    Route::prefix('configuration/locations')->name('configuration.locations.')->middleware(['can:locations.view'])->group(function () {
        Route::get('/', [OfficeLocationController::class, 'index'])->name('index');
        Route::get('/create', [OfficeLocationController::class, 'create'])->name('create')->middleware('can:locations.create');
        Route::post('/', [OfficeLocationController::class, 'store'])->name('store')->middleware('can:locations.create');
        Route::get('/{location}', [OfficeLocationController::class, 'show'])->name('show');
        Route::get('/{location}/edit', [OfficeLocationController::class, 'edit'])->name('edit')->middleware('can:locations.update');
        Route::put('/{location}', [OfficeLocationController::class, 'update'])->name('update')->middleware('can:locations.update');
        Route::delete('/{location}', [OfficeLocationController::class, 'destroy'])->name('destroy')->middleware('can:locations.delete');
    });

    // Configuration - Working Hours
    Route::prefix('configuration/working-hours')->name('configuration.working-hours.')->middleware(['can:working_hours.view'])->group(function () {
        Route::get('/', [WorkingHourController::class, 'index'])->name('index');
        Route::post('/', [WorkingHourController::class, 'update'])->name('update')->middleware('can:working_hours.manage');
    });

    // Configuration - Holidays
    Route::prefix('configuration/holidays')->name('configuration.holidays.')->middleware(['can:holidays.view'])->group(function () {
        Route::get('/', [HolidayController::class, 'index'])->name('index');
        Route::get('/create', [HolidayController::class, 'create'])->name('create')->middleware('can:holidays.create');
        Route::post('/', [HolidayController::class, 'store'])->name('store')->middleware('can:holidays.create');
        Route::get('/{holiday}', [HolidayController::class, 'show'])->name('show');
        Route::get('/{holiday}/edit', [HolidayController::class, 'edit'])->name('edit')->middleware('can:holidays.update');
        Route::put('/{holiday}', [HolidayController::class, 'update'])->name('update')->middleware('can:holidays.update');
        Route::delete('/{holiday}', [HolidayController::class, 'destroy'])->name('destroy')->middleware('can:holidays.delete');
    });
});
