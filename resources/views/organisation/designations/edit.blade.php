@extends('master')
@section('title', 'Edit Designation')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Edit Designation</h1>
      <p class="page-subtitle">Update designation information.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.designations.index') }}" class="btn btn-secondary">Back to Designations</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <x-ajax-form
        formId="editDesignationForm"
        btnId="editDesignationBtn"
        :action="route('organisation.designations.update', $designation)"
        method="PUT"
      >
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label">Department *</label>
          <select name="department_id" class="form-control" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ $designation->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Designation Name *</label>
          <input type="text" name="name" class="form-control" value="{{ $designation->name }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ $designation->description }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active" {{ $designation->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $designation->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

        <button type="submit" id="editDesignationBtn" class="btn btn-primary" data-original-text="Update Designation">
          <span id="btnText">Update Designation</span>
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
