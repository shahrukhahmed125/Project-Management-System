<div>
    <header class="top-header">
        <div class="header-left">
          <button class="mobile-sidebar-toggle" aria-label="Toggle Navigation">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
          <div class="breadcrumbs">
            <span class="breadcrumb-item"><a href="./index.html">WorkSphere</a></span>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-item active">Dashboard</span>
          </div>
        </div>

        <div class="header-search">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <span>Search projects, tasks, employees...</span>
          <span class="search-shortcut">Ctrl+K</span>
        </div>

        <div class="header-right">
          <!-- Role Switcher (Simulates the 5 role-based dashboards) -->
          <div style="display:flex; align-items:center; gap:0.4rem;">
            <label style="font-size:11px; text-transform:uppercase; color:var(--text-secondary); font-weight:700;">Role:</label>
            <select class="role-switcher-select" title="Switch Role Perspective">
              <option value="admin">Admin / Management</option>
              <option value="developer">Developer</option>
              <option value="pm">Project Manager</option>
              <option value="hr">HR Manager</option>
              <option value="employee">Employee</option>
            </select>
          </div>

          <!-- Quick Create -->
          <button class="btn btn-primary btn-sm" data-modal-target="#quickCreateModal">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Create</span>
          </button>

          <!-- Notifications -->
          <a href="./pages/notifications.html" class="header-action-btn" title="Notifications">
            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            <span class="header-badge-dot"></span>
          </a>

          <!-- Messages -->
          <a href="./pages/communication/messages.html" class="header-action-btn" title="Chat & Channels">
            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span class="header-badge-dot"></span>
          </a>

          <!-- Dark / Light Theme Toggle -->
          <button class="header-action-btn" data-theme-toggle title="Toggle Dark/Light Mode">
            <svg class="icon-sun" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            <svg class="icon-moon" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
          </button>

          <!-- User Profile Dropdown -->
          <div class="dropdown">
            <div class="header-user-btn" data-dropdown-toggle>
              <div class="header-avatar">SA</div>
            </div>
            <div class="dropdown-menu">
              <div class="dropdown-header">Logged in as Shahrukh</div>
              <a href="./pages/my-work.html" class="dropdown-item">My Workspace</a>
              <a href="./pages/hr/employee-profile.html" class="dropdown-item">My Profile</a>
              <a href="./pages/administration/company-settings.html" class="dropdown-item">Account Settings</a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item danger">Sign Out</a>
            </div>
          </div>
        </div>
    </header>
</div>