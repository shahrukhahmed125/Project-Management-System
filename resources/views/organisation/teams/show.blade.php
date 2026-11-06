@extends('master')
@section('title', 'Team Details')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">{{ $team->name }}</h1>
      <p class="page-subtitle">Team details and member management.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.teams.edit', $team) }}" class="btn btn-primary">Edit Team</a>
      <a href="{{ route('organisation.teams.index') }}" class="btn btn-secondary">Back to Teams</a>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:1.5rem; margin-bottom:1.5rem;">
    <div class="card">
      <div class="card-body">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Overview</h3>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem;">
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Department</div>
            <div style="font-weight:600;">{{ $team->department->name ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Team Leader</div>
            <div style="font-weight:600;">{{ $team->teamLeader->name ?? '-' }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Members</div>
            <div style="font-size:1.5rem; font-weight:700; color:var(--primary);">{{ $team->employees->count() }}</div>
          </div>
          <div>
            <div style="font-size:12px; color:var(--text-secondary);">Status</div>
            <div style="font-weight:600; color:{{ $team->status === 'active' ? 'var(--success)' : 'var(--danger)' }};">{{ ucfirst($team->status) }}</div>
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
      {{ $team->description ?? 'No description provided.' }}
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Team Members</h3>
    </div>
    <div class="card-body">
      @if($team->employees->count() > 0)
      <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
        @foreach($team->employees as $employee)
        <div style="display:flex; align-items:center; gap:0.5rem; padding:0.5rem 1rem; background:var(--surface-subtle); border-radius:var(--radius-md);">
          <div class="avatar avatar-sm" style="background:var(--primary);">
            {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
          </div>
          <span>{{ $employee->full_name }}</span>
        </div>
        @endforeach
      </div>
      @else
      <div style="color:var(--text-muted);">No team members assigned</div>
      @endif
    </div>
  </div>
</div>
@endsection
