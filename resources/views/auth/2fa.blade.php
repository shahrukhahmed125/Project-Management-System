<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Two-Factor Authentication — WorkSphere</title>
  <meta name="description" content="Verify two-factor code to sign in to WorkSphere.">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/themes.css') }}">
</head>
<body style="display:flex; align-items:center; justify-content:center; min-height:100vh; background:var(--background); padding:1.5rem;">

  <div class="card" style="width:100%; max-width:440px; padding:2.5rem; box-shadow:var(--shadow-xl); text-align:center;">
    <div style="width:52px; height:52px; background:var(--primary-subtle); color:var(--primary); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.25rem;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
    </div>

    <h1 style="font-size:1.35rem; font-weight:700; color:var(--text-primary); margin-bottom:0.35rem;">Two-Factor Verification</h1>
    <p style="font-size:13px; color:var(--text-secondary); margin-bottom:1.75rem;">Enter the 6-digit authentication code from your authenticator app.</p>

    <form onsubmit="event.preventDefault(); window.location.href='../index.html';">
      <div style="display:flex; justify-content:center; gap:0.5rem; margin-bottom:1.5rem;">
        <input type="text" maxlength="1" value="4" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
        <input type="text" maxlength="1" value="8" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
        <input type="text" maxlength="1" value="2" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
        <input type="text" maxlength="1" value="9" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
        <input type="text" maxlength="1" value="1" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
        <input type="text" maxlength="1" value="7" class="form-control" style="width:44px; text-align:center; font-size:18px; font-weight:700;" required>
      </div>

      <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">Verify & Continue</button>
    </form>

    <div style="margin-top:1.5rem; font-size:13px;">
      <a href="./login.html" style="color:var(--text-secondary); text-decoration:none;">Cancel & Back to Sign In</a>
    </div>
  </div>

  <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>
