@extends('master')
@section('title', 'Edit Employee')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Edit Employee</h1>
      <p class="page-subtitle">Update employee information and assignments.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="editEmployeeForm" action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem; padding-bottom:0.5rem; border-bottom:1px solid var(--border);">Account Information</h3>

        <div class="form-group">
          <label class="form-label">Email Address *</label>
          <input type="email" name="email" class="form-control" value="{{ $employee->user->email }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Password (leave blank to keep current)</label>
          <input type="password" name="password" class="form-control">
        </div>

        <h3 style="font-size:1.1rem; font-weight:700; margin:1.5rem 0 1rem 0; padding-bottom:0.5rem; border-bottom:1px solid var(--border);">Employee Information</h3>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
          <div class="form-group">
            <label class="form-label">First Name *</label>
            <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
          </div>

          <div class="form-group">
            <label class="form-label">Last Name *</label>
            <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
          </div>

          <div class="form-group">
            <label class="form-label">Employee ID *</label>
            <input type="text" name="employee_id" class="form-control" value="{{ $employee->employee_id }}" required>
          </div>

          <div class="form-group">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
          </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
          <div class="form-group">
            <label class="form-label">Department *</label>
            <select name="department_id" class="form-control" required>
              <option value="">Select Department</option>
              @foreach($departments as $department)
              <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Designation *</label>
            <select name="designation_id" class="form-control" required>
              <option value="">Select Designation</option>
              @foreach($designations as $designation)
              <option value="{{ $designation->id }}" {{ $employee->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Manager</label>
            <select name="manager_id" class="form-control">
              <option value="">Select Manager</option>
              @foreach($managers as $manager)
              <option value="{{ $manager->id }}" {{ $employee->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->full_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Office Location</label>
            <select name="office_location_id" class="form-control">
              <option value="">Select Location</option>
              @foreach($officeLocations as $location)
              <option value="{{ $location->id }}" {{ $employee->office_location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
          <div class="form-group">
            <label class="form-label">Joining Date *</label>
            <input type="date" name="joining_date" class="form-control" value="{{ $employee->joining_date }}" required>
          </div>

          <div class="form-group">
            <label class="form-label">Employment Type *</label>
            <select name="employment_type" class="form-control" required>
              <option value="full-time" {{ $employee->employment_type === 'full-time' ? 'selected' : '' }}>Full-Time</option>
              <option value="part-time" {{ $employee->employment_type === 'part-time' ? 'selected' : '' }}>Part-Time</option>
              <option value="contract" {{ $employee->employment_type === 'contract' ? 'selected' : '' }}>Contract</option>
              <option value="intern" {{ $employee->employment_type === 'intern' ? 'selected' : '' }}>Intern</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Employment Status *</label>
            <select name="employment_status" class="form-control" required>
              <option value="active" {{ $employee->employment_status === 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ $employee->employment_status === 'inactive' ? 'selected' : '' }}>Inactive</option>
              <option value="on-leave" {{ $employee->employment_status === 'on-leave' ? 'selected' : '' }}>On Leave</option>
              <option value="terminated" {{ $employee->employment_status === 'terminated' ? 'selected' : '' }}>Terminated</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" rows="2">{{ $employee->address }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Emergency Contact</label>
          <input type="text" name="emergency_contact" class="form-control" value="{{ $employee->emergency_contact }}">
        </div>

        <button type="submit" id="editEmployeeBtn" class="btn btn-primary" data-original-text="Update Employee">
          <span id="btnText">Update Employee</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="editEmployeeForm"
        btnId="editEmployeeBtn"
        :action="route('employees.update', $employee)"
        method="PUT"
      />
    </div>
  </div>
</div>

<style>
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>
@endsection
