@extends('master')
@section('title', 'Create Department')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Create Department</h1>
      <p class="page-subtitle">Add a new department to the organization.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.departments.index') }}" class="btn btn-secondary">Back to Departments</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <x-ajax-form
        formId="createDepartmentForm"
        btnId="createDepartmentBtn"
        :action="route('organisation.departments.store')"
        method="POST"
      >
        @csrf

        <div class="form-group">
          <label class="form-label">Department Name *</label>
          <input type="text" name="name" class="form-control" placeholder="e.g., Engineering" required>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the department..."></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Department Head</label>
          <select name="department_head_id" class="form-control">
            <option value="">Select Department Head</option>
            @foreach(App\Models\User::all() as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <button type="submit" id="createDepartmentBtn" class="btn btn-primary" data-original-text="Create Department">
          <span id="btnText">Create Department</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </x-ajax-form>
    </div>
  </div>
</div>

<style>
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>
@endsection
