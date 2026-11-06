@extends('master')
@section('title', 'Departments')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Departments</h1>
      <p class="page-subtitle">Organizational structure, leadership, and team assignments.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.departments.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Department</span>
      </a>
    </div>
  </div>

  <div class="card">
    <div class="table-container">
      <div class="table-toolbar">
        <div class="table-search-input">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" placeholder="Search departments...">
        </div>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Department Head</th>
              <th>Designations</th>
              <th>Employees</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($departments as $department)
            <tr>
              <td>
                <strong>{{ $department->name }}</strong>
              </td>
              <td>
                @if($department->departmentHead)
                  {{ $department->departmentHead->name }}
                @else
                  <span style="color:var(--text-muted);">Not assigned</span>
                @endif
              </td>
              <td>{{ $department->designations->count() }}</td>
              <td>{{ $department->employees->count() }}</td>
              <td>
                <span class="badge {{ $department->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst($department->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('organisation.departments.show', $department) }}" class="btn btn-secondary btn-sm">View</a>
                <a href="{{ route('organisation.departments.edit', $department) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:2rem;">
                No departments found. <a href="{{ route('organisation.departments.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($departments->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $departments->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
