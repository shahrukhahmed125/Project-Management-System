@extends('master')
@section('title', 'Teams')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Teams</h1>
      <p class="page-subtitle">Cross-functional teams and project groups.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.teams.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Team</span>
      </a>
    </div>
  </div>

  <div class="card">
    <div class="table-container">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Department</th>
              <th>Team Leader</th>
              <th>Members</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($teams as $team)
            <tr>
              <td><strong>{{ $team->name }}</strong></td>
              <td>{{ $team->department->name ?? '-' }}</td>
              <td>{{ $team->teamLeader->name ?? '-' }}</td>
              <td>{{ $team->employees->count() }}</td>
              <td>
                <span class="badge {{ $team->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst($team->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('organisation.teams.show', $team) }}" class="btn btn-secondary btn-sm">View</a>
                <a href="{{ route('organisation.teams.edit', $team) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:2rem;">
                No teams found. <a href="{{ route('organisation.teams.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($teams->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $teams->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
