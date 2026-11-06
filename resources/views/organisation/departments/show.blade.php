@extends('master')
@section('title', 'Department Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $department->name }}</h1>
      <p class="page-subtitle">Department overview and team composition.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.departments.edit', $department) }}" class="btn btn-primary">Edit Department</a>
      <a href="{{ route('organisation.departments.index') }}" class="btn btn-secondary">Back to Departments</a>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:1.5rem; margin-bottom:1.5rem;">
    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Overview</h3>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem;">
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Total Employees</div>
            <div style="font-size:1.5rem; font-weight:700; color:var(--primary);">{{ $department->employees->count() }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Designations</div>
            <div style="font-size:1.5rem; font-weight:700; color:var(--primary);">{{ $department->designations->count() }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Teams</div>
            <div style="font-size:1.5rem; font-weight:700; color:var(--primary);">{{ $department->teams->count() }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Status</div>
            <div style="font-size:1.5rem; font-weight:700; color:{{ $department->status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst($department->status) }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Leadership</h3>
        @if($department->departmentHead)
        <div style="display:flex; align-items:center; gap:0.75rem;">
          <div class="avatar avatar-md" style="background:var(--primary);">
            {{ substr($department->departmentHead->name, 0, 2) }}
          </div>
          <div>
            <div style="font-weight:600;">{{ $department->departmentHead->name }}</div>
            <div style="font-size:12px; color:var(--text-secondary);">{{ $department->departmentHead->email }}</div>
          </div>
        </div>
        @else
        <div style="color:var(--text-muted);">No department head assigned</div>
        @endif
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Description</h3>
    </div>
    <div class="card-body">
      {{ $department->description ?? 'No description provided.' }}
    </div>
  </div>
</div>
@endsection
