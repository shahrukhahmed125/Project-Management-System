/**
 * WorkSphere — Dynamic Role-Based Dashboard Controller
 * Supports 5 Perspectives: Admin, Project Manager, Developer, HR, Employee
 * Pure Vanilla JavaScript
 */

(function () {
  const CURRENT_ROLE_KEY = 'worksphere_active_role';

  document.addEventListener('DOMContentLoaded', () => {
    initRoleDashboard();
  });

  window.addEventListener('worksphere:roleChanged', (e) => {
    renderDashboardForRole(e.detail.role);
  });

  function initRoleDashboard() {
    const savedRole = localStorage.getItem(CURRENT_ROLE_KEY) || 'admin';
    renderDashboardForRole(savedRole);
  }

  function renderDashboardForRole(role) {
    const container = document.getElementById('roleDashboardContainer');
    if (!container) return;

    // Hide all role dashboard templates if using tab/template containers
    const sections = container.querySelectorAll('[data-dashboard-view]');
    let matched = false;

    sections.forEach(sec => {
      if (sec.dataset.dashboardView === role) {
        sec.style.display = 'block';
        matched = true;
      } else {
        sec.style.display = 'none';
      }
    });

    // Update greeting banner if present
    const greetingName = document.querySelector('[data-role-greeting-name]');
    const greetingSubtitle = document.querySelector('[data-role-greeting-subtitle]');

    if (greetingName && greetingSubtitle) {
      switch (role) {
        case 'developer':
          greetingName.textContent = 'Shahrukh Ahmed (Lead Developer)';
          greetingSubtitle.textContent = "Here's your active sprint priorities and countdown timer for today.";
          break;
        case 'pm':
          greetingName.textContent = 'Ahmed Khan (Engineering Project Manager)';
          greetingSubtitle.textContent = 'Sprint 24 velocity is on track. 2 tasks require dependency clearance.';
          break;
        case 'hr':
          greetingName.textContent = 'Sara Ahmed (Head of People & HR)';
          greetingSubtitle.textContent = '37 employees present today. 3 leave approvals pending review.';
          break;
        case 'employee':
          greetingName.textContent = 'Hamza Malik (UI/UX Designer)';
          greetingSubtitle.textContent = 'Your work week summary, attendance record, and upcoming design milestones.';
          break;
        default: // admin
          greetingName.textContent = 'Executive Leadership Dashboard';
          greetingSubtitle.textContent = 'Unified cross-functional overview of engineering, HR, payroll, and deliverables.';
          break;
      }
    }
  }

  window.WorkSphereDashboard = {
    setRole(role) {
      localStorage.setItem(CURRENT_ROLE_KEY, role);
      renderDashboardForRole(role);
      const sel = document.querySelector('.role-switcher-select');
      if (sel) sel.value = role;
    }
  };
})();
