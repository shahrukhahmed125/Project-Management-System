<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'WorkSphere — Internal Software Company Management System')</title>
  <meta name="description" content="One workspace. Every team. Everything connected. Enterprise management platform for software companies combining projects, tasks, developer timers, HRMS, payroll, communication, and audit logs.">
  <meta property="og:title" content="WorkSphere — Internal Software Company Management System">
  <meta property="og:description" content="One workspace. Every team. Everything connected.">
  <meta property="og:type" content="website">
      
  <!-- All CSS -->
  <x-all-css />
</head>
<body>

  <div class="app-layout">

    <x-sidebar />

    <!-- Main Content Area -->
    <main class="app-main">
      <!-- Top Header -->
      <x-header />

      <!-- Main Body Content -->
      @yield('content')

      <!-- App Footer -->
      <x-footer />
    </main>
  </div>

  <!-- Global Command Palette Modal (Ctrl+K) -->
  <x-search-modal />

  <!-- Quick Create Modal --> 
  <x-quick-modal />

  <x-all-js />
</body>
</html>