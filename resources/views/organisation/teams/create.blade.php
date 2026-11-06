@extends('master')
@section('title', 'Create Team')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Create Team</h1>
      <p class="page-subtitle">Create a new cross-functional team.</p>
    </div>
    <div class="page-header-actions">
      <a href="{{ route('organisation.teams.index') }}" class="btn btn-secondary">Back to Teams</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="createTeamForm" action="{{ route('organisation.teams.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label">Department *</label>
          <select name="department_id" class="form-control" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Team Name *</label>
          <input type="text" name="name" class="form-control" placeholder="e.g., Mobile Development Team" required>
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Team purpose and objectives..."></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Team Leader</label>
          <select name="team_leader_id" class="form-control">
            <option value="">Select Team Leader</option>
            @foreach(\App\Models\User::all() as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <button type="submit" id="createTeamBtn" class="btn btn-primary" data-original-text="Create Team">
          <span id="btnText">Create Team</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="createTeamForm"
        btnId="createTeamBtn"
        :action="route('organisation.teams.store')"
        method="POST"
      />
    </div>
  </div>
</div>

<style>
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>
@endsection
