@extends('master')
@section('title', 'Company Profile')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Company Profile</h1>
      <p class="page-subtitle">Manage company information and details.</p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <x-ajax-form
        formId="companyProfileForm"
        btnId="companyProfileBtn"
        :action="route('company.profile.update')"
        method="PUT"
      >
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label">Company Name *</label>
          <input type="text" name="name" class="form-control" value="{{ $profile->name ?? '' }}" required>
        </div>

        <div class="form-group">
          <label class="form-label">Legal Name</label>
          <input type="text" name="legal_name" class="form-control" value="{{ $profile->legal_name ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Registration Number</label>
          <input type="text" name="registration_number" class="form-control" value="{{ $profile->registration_number ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Tax ID</label>
          <input type="text" name="tax_id" class="form-control" value="{{ $profile->tax_id ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Industry</label>
          <input type="text" name="industry" class="form-control" value="{{ $profile->industry ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Company Size</label>
          <select name="company_size" class="form-control">
            <option value="">Select Size</option>
            <option value="1-10" {{ ($profile->company_size ?? '') === '1-10' ? 'selected' : '' }}>1-10 employees</option>
            <option value="11-50" {{ ($profile->company_size ?? '') === '11-50' ? 'selected' : '' }}>11-50 employees</option>
            <option value="51-200" {{ ($profile->company_size ?? '') === '51-200' ? 'selected' : '' }}>51-200 employees</option>
            <option value="201-500" {{ ($profile->company_size ?? '') === '201-500' ? 'selected' : '' }}>201-500 employees</option>
            <option value="500+" {{ ($profile->company_size ?? '') === '500+' ? 'selected' : '' }}>500+ employees</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Website</label>
          <input type="url" name="website" class="form-control" value="{{ $profile->website ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Founded Date</label>
          <input type="date" name="founded_date" class="form-control" value="{{ $profile->founded_date ?? '' }}">
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ $profile->description ?? '' }}</textarea>
        </div>

        <button type="submit" id="companyProfileBtn" class="btn btn-primary" data-original-text="Save Profile">
          <span id="btnText">Save Profile</span>
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
