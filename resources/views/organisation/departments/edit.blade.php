@extends('master')
@section('title', 'Edit Department')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Edit Department</h1>
      <p class="page-subtitle">Update department information and settings.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.departments.index') }}" class="btn btn-secondary">Back to Departments</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="editDepartmentForm" action="{{ route('organisation.departments.update', $department) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label class="form-label">Department Name *</label>
          <input type="text" name="name" class="form-control" value="{{ $department->name }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ $department->description }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Department Head</label>
          <select name="department_head_id" class="form-control">
            <option value="">Select Department Head</option>
            @foreach(App\Models\User::all() as $user)
            <option value="{{ $user->id }}" {{ $department->department_head_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active" {{ $department->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $department->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

        <button type="submit" id="editDepartmentBtn" class="btn btn-primary" data-original-text="Update Department">
          <span id="btnText">Update Department</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="editDepartmentForm"
        btnId="editDepartmentBtn"
        :action="route('organisation.departments.update', $department)"
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
