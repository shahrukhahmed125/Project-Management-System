@extends('master')
@section('title', 'Office Locations')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Office Locations</h1>
      <p class="page-subtitle">Company office locations and addresses.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('configuration.locations.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Location</span>
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
              <th>Address</th>
              <th>City</th>
              <th>Country</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($locations as $location)
            <tr>
              <td><strong>{{ $location->name }}</strong></td>
              <td>{{ $location->address }}</td>
              <td>{{ $location->city }}</td>
              <td>{{ $location->country }}</td>
              <td>
                <span class="badge {{ $location->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                  {{ ucfirst($location->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('configuration.locations.edit', $location) }}" class="btn btn-secondary btn-sm">Edit</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:2rem;">
                No locations found. <a href="{{ route('configuration.locations.create') }}" style="color:var(--primary);">Create one</a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($locations->hasPages())
      <div style="padding:1rem; text-align:center;">
        {{ $locations->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
