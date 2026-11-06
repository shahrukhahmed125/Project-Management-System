<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In — WorkSphere</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/themes.css') }}">
</head>
<body style="display:flex; align-items:center; justify-content:center; min-height:100vh; background:var(--background); padding:1.5rem;">

  <div class="card" style="width:100%; max-width:440px; padding:2.5rem; box-shadow:var(--shadow-xl);">
    <!-- Brand Logo -->
    <div style="text-align:center; margin-bottom:2rem;">
      <a href="{{ route('login') }}" style="display:inline-flex; align-items:center; gap:0.75rem; text-decoration:none; margin-bottom:1rem;">
        <div class="brand-icon" style="width:40px; height:40px;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
        </div>
        <span style="font-size:1.5rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.03em;">WorkSphere</span>
      </a>
      <h1 style="font-size:1.4rem; font-weight:700; color:var(--text-primary);">Welcome back 👋</h1>
      <p style="font-size:13.5px; color:var(--text-secondary); margin-top:0.35rem;">Sign in to your engineering and operations workspace.</p>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999;"></div>

    <!-- Login Form with AJAX -->
    <form id="loginForm" action="{{ route('login.auth') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label">Corporate Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
      </div>

      <div class="form-group">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.4rem;">
          <label class="form-label" style="margin-bottom:0;">Password</label>
          <a href="{{ route('password.request') }}" style="font-size:12.5px; color:var(--primary); font-weight:500;">Forgot password?</a>
        </div>
        <input type="password" name="password" class="form-control" placeholder="••••••••••••" required>
      </div>

      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; font-size:13px;">
        <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; color:var(--text-secondary);">
          <input type="checkbox" name="remember" style="accent-color:var(--primary);">
          <span>Remember this device</span>
        </label>
      </div>

      <button type="submit" id="loginBtn" class="btn btn-primary btn-lg" style="width:100%;" data-original-text="Sign In to Workspace">
        <span id="btnText">Sign In to Workspace</span>
        <span id="btnSpinner" class="d-none" style="display:none;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
            <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
            <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="0.75"/>
          </svg>
        </span>
      </button>
    </form>

    <div style="text-align:center; margin-top:1.75rem; font-size:12.5px; color:var(--text-muted);">
      SSO Enabled · Protected by Enterprise IAM Security
    </div>
  </div>

  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        // Reset UI
        $('.invalid-feedback').remove();
        $('input').removeClass('is-invalid');
        $('input').prop('disabled', false);

        // Button loading state
        $('#btnSpinner').removeClass('d-none').show();
        $('#btnText').text('Signing in...');
        $('#loginBtn').prop('disabled', true);

        let formData = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',

          success: function(response) {
            if (response.redirect) {
              window.location.href = response.redirect;
            }
          },

          error: function(xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.message;

              $.each(errors, function(key, value) {
                let field = $('[name="' + key + '"]');
                field.addClass('is-invalid');
                field.after('<p class="invalid-feedback" style="color:var(--danger); font-size:12px; margin-top:0.25rem;">' + value[0] + '</p>');
              });
            } else {
              alert('Something went wrong. Please try again.');
            }
          },

          complete: function() {
            let originalText = $('#loginBtn').data('original-text');
            $('#btnSpinner').addClass('d-none').hide();
            $('#btnText').text(originalText);
            $('#loginBtn').prop('disabled', false);
          }
        });
      });
    });
  </script>
  <style>
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</body>
</html>
