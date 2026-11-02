/**
 * WorkSphere — Sidebar Navigation & Role Switcher
 * Pure Vanilla JavaScript
 */

(function () {
  const SIDEBAR_COLLAPSED_KEY = 'worksphere_sidebar_collapsed';
  const CURRENT_ROLE_KEY = 'worksphere_active_role';

  document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initRoleSwitcher();
    highlightActiveRoute();
  });

  function initSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const collapseBtn = document.querySelector('.sidebar-collapse-btn');
    const mobileToggleBtn = document.querySelector('.mobile-sidebar-toggle');

    if (!sidebar) return;

    // Create mobile backdrop if not present
    let backdrop = document.querySelector('.sidebar-backdrop');
    if (!backdrop) {
      backdrop = document.createElement('div');
      backdrop.className = 'sidebar-backdrop';
      document.body.appendChild(backdrop);
    }

    // Restore desktop collapsed state
    const isCollapsed = localStorage.getItem(SIDEBAR_COLLAPSED_KEY) === 'true';
    if (isCollapsed && window.innerWidth > 1024) {
      sidebar.classList.add('collapsed');
    }

    // Collapse toggle
    if (collapseBtn) {
      collapseBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        localStorage.setItem(SIDEBAR_COLLAPSED_KEY, sidebar.classList.contains('collapsed'));
      });
    }

    // Mobile toggle
    if (mobileToggleBtn) {
      mobileToggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('mobile-open');
        backdrop.classList.toggle('active');
      });
    }

    backdrop.addEventListener('click', () => {
      sidebar.classList.remove('mobile-open');
      backdrop.classList.remove('active');
    });
  }

  function initRoleSwitcher() {
    const select = document.querySelector('.role-switcher-select');
    if (!select) return;

    const savedRole = localStorage.getItem(CURRENT_ROLE_KEY) || 'admin';
    select.value = savedRole;

    select.addEventListener('change', (e) => {
      const newRole = e.target.value;
      localStorage.setItem(CURRENT_ROLE_KEY, newRole);
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Switched perspective to ${e.target.options[e.target.selectedIndex].text}`, 'info');
      }
      // If on dashboard or index, dispatch custom event or reload view
      window.dispatchEvent(new CustomEvent('worksphere:roleChanged', { detail: { role: newRole } }));
    });
  }

  function highlightActiveRoute() {
    const currentPath = window.location.pathname;
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
      const href = link.getAttribute('href');
      if (!href) return;

      // Extract filename from href and current path
      const linkFileName = href.split('/').pop().split('#')[0].split('?')[0];
      const currentFileName = currentPath.split('/').pop().split('#')[0].split('?')[0] || 'index.html';

      if (linkFileName === currentFileName && linkFileName !== '') {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }
})();
