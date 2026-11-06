@extends('master')
@section('title', 'Employee Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $employee->full_name }}</h1>
      <p class="page-subtitle">Employee profile and details.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Edit Employee</a>
      <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees</a>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:1.5rem; margin-bottom:1.5rem;">
    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Personal Information</h3>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem;">
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Employee ID</div>
            <div style="font-weight:600;">{{ $employee->employee_id }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Email</div>
            <div style="font-weight:600;">{{ $employee->user->email }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Phone</div>
            <div style="font-weight:600;">{{ $employee->phone ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Joining Date</div>
            <div style="font-weight:600;">{{ $employee->joining_date->format('M d, Y') }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Employment</h3>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem;">
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Department</div>
            <div style="font-weight:600;">{{ $employee->department->name ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Designation</div>
            <div style="font-weight:600;">{{ $employee->designation->name ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Employment Type</div>
            <div style="font-weight:600;">{{ ucfirst($employee->employment_type) }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Status</div>
            <div style="font-weight:600; color:{{ $employee->employment_status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst(str_replace('-', ' ', $employee->employment_status)) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Teams</h3>
    </div>
    <div class="card-body">
      @if($employee->teams->count() > 0)
      <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
        @foreach($employee->teams as $team)
        <span class="badge badge-primary">{{ $team->name }}</span>
        @endforeach
      </div>
      @else
      <div style="color:var(--text-muted);">No teams assigned</div>
      @endif
    </div>
  </div>
</div>
@endsection
