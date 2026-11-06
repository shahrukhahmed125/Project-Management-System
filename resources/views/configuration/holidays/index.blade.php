@extends('master')
@section('title', 'Holidays')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Holidays</h1>
      <p class="page-subtitle">Manage company holidays and time off.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.holidays.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Holiday</span>
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
              <th>Date Range</th>
              <th>Type</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($holidays as $holiday)
            <tr>
              <td><strong>{{ $holiday->name }}</strong></td>
              <td>
                @if($holiday->start_date->eq($holiday->end_date))
                  {{ $holiday->start_date->format('M d, Y') }}
                @else
                  {{ $holiday->start_date->format('M d') }} - {{ $holiday->end_date->format('M d, Y') }}
                @endif
              </td>
              <td>{{ ucfirst($holiday->type) }}</td>
              <td>
                <span class="badge {{ $holiday->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst($holiday->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('configuration.holidays.edit', $holiday) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align:center; padding:2rem;">
                No holidays found. <a href="{{ route('configuration.holidays.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($holidays->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $holidays->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
