@extends('master')
@section('title', 'Holiday Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $holiday->name }}</h1>
      <p class="page-subtitle">Holiday details and information.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.holidays.edit', $holiday) }}" class="btn btn-primary">Edit Holiday</a>
      <a href="{{ route('configuration.holidays.index') }}" class="btn btn-secondary">Back to Holidays</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Holiday Information</h3>
      <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Date Range</div>
          <div style="font-weight:600;">
            @if($holiday->start_date->eq($holiday->end_date))
              {{ $holiday->start_date->format('M d, Y') }}
            @else
              {{ $holiday->start_date->format('M d') }} - {{ $holiday->end_date->format('M d, Y') }}
            @endif
          </div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Type</div>
          <div style="font-weight:600;">{{ ucfirst($holiday->type) }}</div>
        </div>
        <div>
          <div style="font-size:12px; color:var(--text-secondary);">Status</div>
          <div style="font-weight:600; color:{{ $holiday->status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst($holiday->status) }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Description</h3>
    </div>
    <div class="card-body">
      {{ $holiday->description ?? 'No description provided.' }}
    </div>
  </div>
</div>
@endsection
