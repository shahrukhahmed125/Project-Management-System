<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In — WorkSphere</title>
  <meta name="description" content="Sign in to your WorkSphere software company workspace.">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <link rel="stylesheet" href="../assets/css/responsive.css">
  <link rel="stylesheet" href="../assets/css/themes.css">
</head>
<body style="display:flex; align-items:center; justify-content:center; min-height:100vh; background:var(--background); padding:1.5rem;">

  <div class="card" style="width:100%; max-width:440px; padding:2.5rem; box-shadow:var(--shadow-xl);">
    <!-- Brand Logo -->
    <div style="text-align:center; margin-bottom:2rem;">
      <a href="../index.html" style="display:inline-flex; align-items:center; gap:0.75rem; text-decoration:none; margin-bottom:1rem;">
        <div class="brand-icon" style="width:40px; height:40px;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
        </div>
        <span style="font-size:1.5rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.03em;">WorkSphere</span>
      </a>
      <h1 style="font-size:1.4rem; font-weight:700; color:var(--text-primary);">Welcome back 👋</h1>
      <p style="font-size:13.5px; color:var(--text-secondary); margin-top:0.35rem;">Sign in to your engineering and operations workspace.</p>
    </div>

    <!-- Login Form -->
    <form onsubmit="event.preventDefault(); window.location.href='../index.html';">
      <div class="form-group">
        <label class="form-label">Corporate Email Address</label>
        <input type="email" class="form-control" value="shahrukh@worksphere.internal" required>
      </div>

      <div class="form-group">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.4rem;">
          <label class="form-label" style="margin-bottom:0;">Password</label>
          <a href="./forgot-password.html" style="font-size:12.5px; color:var(--primary); font-weight:500;">Forgot password?</a>
        </div>
        <input type="password" class="form-control" value="••••••••••••" required>
      </div>

      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; font-size:13px;">
        <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; color:var(--text-secondary);">
          <input type="checkbox" checked style="accent-color:var(--primary);">
          <span>Remember this device</span>
        </label>
        <a href="./2fa.html" style="color:var(--primary); font-weight:500; font-size:12.5px;">2FA Login</a>
      </div>

      <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">Sign In to Workspace</button>
    </form>

    <div style="text-align:center; margin-top:1.75rem; font-size:12.5px; color:var(--text-muted);">
      SSO Enabled · Protected by Enterprise IAM Security
    </div>
  </div>

  <script src="../assets/js/theme.js"></script>
</body>
</html>
