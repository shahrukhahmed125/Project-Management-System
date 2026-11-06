@extends('master')
@section('title', 'Designation Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $designation->name }}</h1>
      <p class="page-subtitle">Designation details and assigned employees.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.designations.edit', $designation) }}" class="btn btn-primary">Edit Designation</a>
      <a href="{{ route('organisation.designations.index') }}" class="btn btn-secondary">Back to Designations</a>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:1.5rem; margin-bottom:1.5rem;">
    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Overview</h3>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem;">
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Department</div>
            <div style="font-weight:600;">{{ $designation->department->name ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Employees</div>
            <div style="font-size:1.5rem; font-weight:700; color:var(--primary);">{{ $designation->employees->count() }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Status</div>
            <div style="font-weight:600; color:{{ $designation->status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst($designation->status) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Description</h3>
    </div>
    <div class="card-body">
      {{ $designation->description ?? 'No description provided.' }}
    </div>
  </div>
</div>
@endsection
