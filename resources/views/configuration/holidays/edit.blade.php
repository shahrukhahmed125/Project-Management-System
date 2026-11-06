@extends('master')
@section('title', 'Edit Holiday')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Edit Holiday</h1>
      <p class="page-subtitle">Update holiday information.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.holidays.index') }}" class="btn btn-secondary">Back to Holidays</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="editHolidayForm" action="{{ route('configuration.holidays.update', $holiday) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
          <label class="form-label">Holiday Name *</label>
          <input type="text" name="name" class="form-control" value="{{ $holiday->name }}" required>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
          <div class="form-group">
            <label class="form-label">Start Date *</label>
            <input type="date" name="start_date" class="form-control" value="{{ $holiday->start_date }}" required>
          </div>

          <div class="form-group">
            <label class="form-label">End Date *</label>
            <input type="date" name="end_date" class="form-control" value="{{ $holiday->end_date }}" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Type *</label>
          <select name="type" class="form-control" required>
            <option value="public" {{ $holiday->type === 'public' ? 'selected' : '' }}>Public Holiday</option>
            <option value="company" {{ $holiday->type === 'company' ? 'selected' : '' }}>Company Holiday</option>
            <option value="religious" {{ $holiday->type === 'religious' ? 'selected' : '' }}>Religious Holiday</option>
            <option value="other" {{ $holiday->type === 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ $holiday->description }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active" {{ $holiday->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $holiday->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

        <button type="submit" id="editHolidayBtn" class="btn btn-primary" data-original-text="Update Holiday">
          <span id="btnText">Update Holiday</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="editHolidayForm"
        btnId="editHolidayBtn"
        :action="route('configuration.holidays.update', $holiday)"
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
