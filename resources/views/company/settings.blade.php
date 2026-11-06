@extends('master')
@section('title', 'Company Settings')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Company Settings</h1>
      <p class="page-subtitle">Configure company-wide settings and preferences.</p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="companySettingsForm" action="{{ route('company.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem; padding-bottom:0.5rem; border-bottom:1px solid var(--border);">General Settings</h3>

        <div class="form-group">
          <label class="form-label">Timezone</label>
          <select name="timezone" class="form-control">
            <option value="UTC" {{ ($settings['timezone'] ?? 'UTC') === 'UTC' ? 'selected' : '' }}>UTC</option>
            <option value="America/New_York" {{ ($settings['timezone'] ?? '') === 'America/New_York' ? 'selected' : '' }}>Eastern Time (US & Canada)</option>
            <option value="America/Chicago" {{ ($settings['timezone'] ?? '') === 'America/Chicago' ? 'selected' : '' }}>Central Time (US & Canada)</option>
            <option value="America/Denver" {{ ($settings['timezone'] ?? '') === 'America/Denver' ? 'selected' : '' }}>Mountain Time (US & Canada)</option>
            <option value="America/Los_Angeles" {{ ($settings['timezone'] ?? '') === 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time (US & Canada)</option>
            <option value="Europe/London" {{ ($settings['timezone'] ?? '') === 'Europe/London' ? 'selected' : '' }}>London</option>
            <option value="Europe/Paris" {{ ($settings['timezone'] ?? '') === 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
            <option value="Asia/Dubai" {{ ($settings['timezone'] ?? '') === 'Asia/Dubai' ? 'selected' : '' }}>Dubai</option>
            <option value="Asia/Kolkata" {{ ($settings['timezone'] ?? '') === 'Asia/Kolkata' ? 'selected' : '' }}>India Standard Time</option>
            <option value="Asia/Tokyo" {{ ($settings['timezone'] ?? '') === 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
            <option value="Australia/Sydney" {{ ($settings['timezone'] ?? '') === 'Australia/Sydney' ? 'selected' : '' }}>Sydney</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Date Format</label>
          <select name="date_format" class="form-control">
            <option value="Y-m-d" {{ ($settings['date_format'] ?? 'Y-m-d') === 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
            <option value="m/d/Y" {{ ($settings['date_format'] ?? '') === 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
            <option value="d/m/Y" {{ ($settings['date_format'] ?? '') === 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
            <option value="F j, Y" {{ ($settings['date_format'] ?? '') === 'F j, Y' ? 'selected' : '' }}>Month Day, Year</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Currency</label>
          <select name="currency" class="form-control">
            <option value="USD" {{ ($settings['currency'] ?? 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
            <option value="EUR" {{ ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
            <option value="GBP" {{ ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
            <option value="INR" {{ ($settings['currency'] ?? '') === 'INR' ? 'selected' : '' }}>INR (₹)</option>
            <option value="AED" {{ ($settings['currency'] ?? '') === 'AED' ? 'selected' : '' }}>AED (د.إ)</option>
          </select>
        </div>

        <h3 style="font-size:1.1rem; font-weight:700; margin:1.5rem 0 1rem 0; padding-bottom:0.5rem; border-bottom:1px solid var(--border);">Notification Settings</h3>

        <div class="form-group">
          <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
            <input type="checkbox" name="email_notifications" {{ ($settings['email_notifications'] ?? true) ? 'checked' : '' }}>
            <span>Enable Email Notifications</span>
          </label>
        </div>

        <div class="form-group">
          <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
            <input type="checkbox" name="slack_notifications" {{ ($settings['slack_notifications'] ?? false) ? 'checked' : '' }}>
            <span>Enable Slack Notifications</span>
          </label>
        </div>

        <button type="submit" id="companySettingsBtn" class="btn btn-primary" data-original-text="Save Settings">
          <span id="btnText">Save Settings</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>
    </div>
  </div>
</div>

<x-ajax-form
  formId="companySettingsForm"
  btnId="companySettingsBtn"
  :action="route('company.settings.update')"
  method="PUT"
/>

<style>
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>
@endsection
