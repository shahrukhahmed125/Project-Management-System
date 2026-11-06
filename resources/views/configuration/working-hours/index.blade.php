@extends('master')
@section('title', 'Working Hours')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">Working Hours</h1>
      <p class="page-subtitle">Configure weekly working schedule.</p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

      <form id="workingHoursForm" action="{{ route('configuration.working-hours.update') }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Day</th>
                <th>Working Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Break Duration (min)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($workingHours as $hour)
              <tr>
                <td>{{ $hour->day_name }}</td>
                <td>
                  <input type="checkbox" name="is_working_day[{{ $hour->id }}]" {{ $hour->is_working_day ? 'checked' : '' }}>
                </td>
                <td>
                  <input type="time" name="start_time[{{ $hour->id }}]" class="form-control" value="{{ $hour->start_time }}" {{ !$hour->is_working_day ? 'disabled' : '' }}>
                </td>
                <td>
                  <input type="time" name="end_time[{{ $hour->id }}]" class="form-control" value="{{ $hour->end_time }}" {{ !$hour->is_working_day ? 'disabled' : '' }}>
                </td>
                <td>
                  <input type="number" name="break_duration[{{ $hour->id }}]" class="form-control" value="{{ $hour->break_duration }}" min="0" {{ !$hour->is_working_day ? 'disabled' : '' }}>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <button type="submit" id="workingHoursBtn" class="btn btn-primary" data-original-text="Save Working Hours">
          <span id="btnText">Save Working Hours</span>
          <span id="btnSpinner" class="d-none" style="display:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
              <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
              <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
            </svg>
          </span>
        </button>
      </form>

      <x-ajax-form
        formId="workingHoursForm"
        btnId="workingHoursBtn"
        :action="route('configuration.working-hours.update')"
        method="PUT"
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
