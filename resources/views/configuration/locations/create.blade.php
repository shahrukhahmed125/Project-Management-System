@extends('master')
@section('title', 'Create Office Location')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Create Office Location</h1>
      <p class="page-subtitle">Add a new office location.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.locations.index') }}" class="btn btn-secondary">Back to Locations</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="createLocationForm" action="{{ route('configuration.locations.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label">Location Name *</label>
          <input type="text" name="name" class="form-control" placeholder="e.g., Headquarters" required>
        </div>

        <div class="form-group">
          <label class="form-label">Address *</label>
          <textarea name="address" class="form-control" rows="2" required></textarea>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
          <div class="form-group">
            <label class="form-label">City *</label>
            <input type="text" name="city" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Country *</label>
            <input type="text" name="country" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Postal Code *</label>
            <input type="text" name="postal_code" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <button type="submit" id="createLocationBtn" class="btn btn-primary" data-original-text="Create Location">
          <span id="btnText">Create Location</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="createLocationForm"
        btnId="createLocationBtn"
        :action="route('configuration.locations.store')"
        method="POST"
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
