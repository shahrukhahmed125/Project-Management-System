@extends('master')
@section('title', 'Employees')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Employees</h1>
      <p class="page-subtitle">Manage software engineers, managers, designers, and operational personnel.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Employee</span>
      </a>
    </div>
  </div>

  <div class="card">
    <div class="table-container">
      <div class="table-toolbar">
        <div class="table-search-input">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" placeholder="Search employees by name, role, ID...">
        </div>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Employee</th>
              <th>Employee ID</th>
              <th>Department</th>
              <th>Designation</th>
              <th>Manager</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($employees as $employee)
            <tr>
              <td>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                  <div class="avatar avatar-md" style="background:var(--primary);">
                    {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                  </div>
                  <div>
                    <strong>{{ $employee->full_name }}</strong>
                    <div style="font-size:12px; color:var(--text-muted);">{{ $employee->user->email }}</div>
                  </div>
                </div>
              </td>
              <td><strong>{{ $employee->employee_id }}</strong></td>
              <td>{{ $employee->department->name ?? '-' }}</td>
              <td>{{ $employee->designation->name ?? '-' }}</td>
              <td>{{ $employee->manager->full_name ?? '-' }}</td>
              <td>
                <span class="badge {{ $employee->employment_status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst(str_replace('-', ' ', $employee->employment_status)) }}
                </span>
              </td>
              <td>
                <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary btn-sm">View</a>
                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center; padding:2rem;">
                No employees found. <a href="{{ route('employees.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($employees->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $employees->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
