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
    Route::prefix('company')->name('company.')->middleware(['can:view company'])->group(function () {
        Route::get('/profile', [CompanyController::class, 'profile'])->name('profile');
        Route::post('/profile', [CompanyController::class, 'updateProfile'])->name('profile.update')->middleware('can:edit company');
        Route::get('/settings', [CompanyController::class, 'settings'])->name('settings');
        Route::post('/settings', [CompanyController::class, 'updateSettings'])->name('settings.update')->middleware('can:edit company');
    });

    // Organisation - Departments
    Route::prefix('organisation/departments')->name('organisation.departments.')->middleware(['can:view departments'])->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create')->middleware('can:create departments');
        Route::post('/', [DepartmentController::class, 'store'])->name('store')->middleware('can:create departments');
        Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit')->middleware('can:edit departments');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update')->middleware('can:edit departments');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy')->middleware('can:delete departments');
        Route::post('/{department}/toggle-status', [DepartmentController::class, 'toggleStatus'])->name('toggle-status')->middleware('can:edit departments');
    });

    // Organisation - Designations
    Route::prefix('organisation/designations')->name('organisation.designations.')->middleware(['can:view designations'])->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('index');
        Route::get('/create', [DesignationController::class, 'create'])->name('create')->middleware('can:create designations');
        Route::post('/', [DesignationController::class, 'store'])->name('store')->middleware('can:create designations');
        Route::get('/{designation}', [DesignationController::class, 'show'])->name('show');
        Route::get('/{designation}/edit', [DesignationController::class, 'edit'])->name('edit')->middleware('can:edit designations');
        Route::put('/{designation}', [DesignationController::class, 'update'])->name('update')->middleware('can:edit designations');
        Route::delete('/{designation}', [DesignationController::class, 'destroy'])->name('destroy')->middleware('can:delete designations');
    });

    // Organisation - Teams
    Route::prefix('organisation/teams')->name('organisation.teams.')->middleware(['can:view teams'])->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::get('/create', [TeamController::class, 'create'])->name('create')->middleware('can:create teams');
        Route::post('/', [TeamController::class, 'store'])->name('store')->middleware('can:create teams');
        Route::get('/{team}', [TeamController::class, 'show'])->name('show');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit')->middleware('can:edit teams');
        Route::put('/{team}', [TeamController::class, 'update'])->name('update')->middleware('can:edit teams');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy')->middleware('can:delete teams');
        Route::post('/{team}/members', [TeamController::class, 'addMember'])->name('add-member')->middleware('can:edit teams');
        Route::delete('/{team}/members/{employee}', [TeamController::class, 'removeMember'])->name('remove-member')->middleware('can:edit teams');
    });

    // Employees
    Route::prefix('employees')->name('employees.')->middleware(['can:view employees'])->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create')->middleware('can:create employees');
        Route::post('/', [EmployeeController::class, 'store'])->name('store')->middleware('can:create employees');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit')->middleware('can:edit employees');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update')->middleware('can:edit employees');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy')->middleware('can:delete employees');
        Route::post('/{employee}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('toggle-status')->middleware('can:edit employees');
        Route::get('/{employee}/profile', [EmployeeController::class, 'profile'])->name('profile');
    });

    // Configuration - Office Locations
    Route::prefix('configuration/locations')->name('configuration.locations.')->middleware(['can:view locations'])->group(function () {
        Route::get('/', [OfficeLocationController::class, 'index'])->name('index');
        Route::get('/create', [OfficeLocationController::class, 'create'])->name('create')->middleware('can:create locations');
        Route::post('/', [OfficeLocationController::class, 'store'])->name('store')->middleware('can:create locations');
        Route::get('/{location}', [OfficeLocationController::class, 'show'])->name('show');
        Route::get('/{location}/edit', [OfficeLocationController::class, 'edit'])->name('edit')->middleware('can:edit locations');
        Route::put('/{location}', [OfficeLocationController::class, 'update'])->name('update')->middleware('can:edit locations');
        Route::delete('/{location}', [OfficeLocationController::class, 'destroy'])->name('destroy')->middleware('can:delete locations');
    });

    // Configuration - Working Hours
    Route::prefix('configuration/working-hours')->name('configuration.working-hours.')->middleware(['can:view working hours'])->group(function () {
        Route::get('/', [WorkingHourController::class, 'index'])->name('index');
        Route::post('/', [WorkingHourController::class, 'update'])->name('update')->middleware('can:edit working hours');
    });

    // Configuration - Holidays
    Route::prefix('configuration/holidays')->name('configuration.holidays.')->middleware(['can:view holidays'])->group(function () {
        Route::get('/', [HolidayController::class, 'index'])->name('index');
        Route::get('/create', [HolidayController::class, 'create'])->name('create')->middleware('can:create holidays');
        Route::post('/', [HolidayController::class, 'store'])->name('store')->middleware('can:create holidays');
        Route::get('/{holiday}', [HolidayController::class, 'show'])->name('show');
        Route::get('/{holiday}/edit', [HolidayController::class, 'edit'])->name('edit')->middleware('can:edit holidays');
        Route::put('/{holiday}', [HolidayController::class, 'update'])->name('update')->middleware('can:edit holidays');
        Route::delete('/{holiday}', [HolidayController::class, 'destroy'])->name('destroy')->middleware('can:delete holidays');
    });
});
