<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_image')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
            $table->foreignId('designation_id')->constrained('designations')->restrictOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->date('joining_date');
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'intern'])->default('full-time');
            $table->enum('employment_status', ['active', 'inactive', 'on-leave', 'terminated'])->default('active');
            $table->foreignId('office_location_id')->nullable()->constrained('office_locations')->nullOnDelete();
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('employee_id');
            $table->index('department_id');
            $table->index('designation_id');
            $table->index('employment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
