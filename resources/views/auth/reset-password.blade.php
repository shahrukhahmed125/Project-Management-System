<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Set New Password — WorkSphere</title>
  <meta name="description" content="Set a new password for your WorkSphere account.">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/themes.css') }}">
</head>
<body style="display:flex; align-items:center; justify-content:center; min-height:100vh; background:var(--background); padding:1.5rem;">

  <div class="card" style="width:100%; max-width:440px; padding:2.5rem; box-shadow:var(--shadow-xl);">
    <div style="text-align:center; margin-bottom:2rem;">
      <h1 style="font-size:1.35rem; font-weight:700; color:var(--text-primary);">Set New Password</h1>
      <p style="font-size:13px; color:var(--text-secondary); margin-top:0.35rem;">Must be at least 8 characters with numbers and symbols.</p>
    </div>

    <form onsubmit="event.preventDefault(); window.location.href='./login.html';">
      <div class="form-group">
        <label class="form-label">New Password</label>
        <input type="password" class="form-control" required placeholder="••••••••••••">
      </div>

      <div class="form-group">
        <label class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" required placeholder="••••••••••••">
      </div>

      <button type="submit" class="btn btn-primary btn-lg" style="width:100%; margin-top:0.5rem;">Update Password & Sign In</button>
    </form>
  </div>

  <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>
