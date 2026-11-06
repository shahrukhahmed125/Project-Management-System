@extends('master')
@section('title', 'Location Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $location->name }}</h1>
      <p class="page-subtitle">Office location details.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.locations.edit', $location) }}" class="btn btn-primary">Edit Location</a>
      <a href="{{ route('configuration.locations.index') }}" class="btn btn-secondary">Back to Locations</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Address Information</h3>
      <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Address</div>
          <div style="font-weight:600;">{{ $location->address }}</div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">City</div>
          <div style="font-weight:600;">{{ $location->city }}</div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Country</div>
          <div style="font-weight:600;">{{ $location->country }}</div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Postal Code</div>
          <div style="font-weight:600;">{{ $location->postal_code }}</div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Status</div>
          <div style="font-weight:600; color:{{ $location->status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst($location->status) }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
