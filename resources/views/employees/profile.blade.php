@extends('master')
@section('title', 'Employee Profile')

@section('content')
<div class="main-content">
  <div class="page-header">
    <div class="page-header-title">
      <h1 class="page-title">My Profile</h1>
      <p class="page-subtitle">View and manage your profile information.</p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div style="text-align:center; padding:2rem;">
        <div class="avatar avatar-lg" style="background:var(--primary); margin:0 auto 1rem; width:80px; height:80px; font-size:2rem;">
          {{ substr(auth()->user->employee->first_name, 0, 1) }}{{ substr(auth()->user->employee->last_name, 0, 1) }}
        </div>
        <h2 style="font-size:1.5rem; font-weight:700;">{{ auth()->user->employee->full_name }}</h2>
        <p style="color:var(--text-secondary);">{{ auth()->user->email }}</p>
        <p style="color:var(--text-muted); margin-top:0.5rem;">{{ auth()->user->employee->employee_id }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
