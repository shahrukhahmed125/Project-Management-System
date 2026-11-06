@extends('master')
@section('title', 'Designations')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Designations</h1>
      <p class="page-subtitle">Job titles and role hierarchy within departments.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.designations.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Designation</span>
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
              <th>Employees</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($designations as $designation)
            <tr>
              <td><strong>{{ $designation->name }}</strong></td>
              <td>{{ $designation->department->name ?? '-' }}</td>
              <td>{{ $designation->employees->count() }}</td>
              <td>
                <span class="badge {{ $designation->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst($designation->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('organisation.designations.edit', $designation) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align:center; padding:2rem;">
                No designations found. <a href="{{ route('organisation.designations.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($designations->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $designations->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
