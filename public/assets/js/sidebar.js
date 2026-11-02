/**
 * ApexCRM - Sidebar Navigation Logic
 * Pure Vanilla JavaScript
 */

(function () {
  const SIDEBAR_STATE_KEY = 'apex_sidebar_collapsed';

  document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');
    if (!sidebar) return;

    const overlay = document.querySelector('.sidebar-overlay') || createOverlay();
    const desktopToggleBtns = document.querySelectorAll('.sidebar-collapse-btn, .header-toggle-btn');

    // Restore desktop collapsed state
    const isCollapsed = localStorage.getItem(SIDEBAR_STATE_KEY) === 'true';
    if (isCollapsed && window.innerWidth > 768) {
      sidebar.classList.add('collapsed');
    }

    // Toggle handlers
    desktopToggleBtns.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        if (window.innerWidth <= 768) {
          // Mobile drawer mode
          const isOpen = sidebar.classList.contains('mobile-open');
          if (isOpen) {
            closeMobileSidebar();
          } else {
            openMobileSidebar();
          }
        } else {
          // Desktop collapse mode
          sidebar.classList.toggle('collapsed');
          const collapsedNow = sidebar.classList.contains('collapsed');
          localStorage.setItem(SIDEBAR_STATE_KEY, collapsedNow);
        }
      });
    });

    function openMobileSidebar() {
      sidebar.classList.add('mobile-open');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
      sidebar.classList.remove('mobile-open');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    overlay.addEventListener('click', closeMobileSidebar);

    // Accordion Submenus
    const submenuToggles = sidebar.querySelectorAll('.nav-item.has-submenu > .nav-link');
    submenuToggles.forEach((link) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const parentItem = link.closest('.nav-item');
        const wasOpen = parentItem.classList.contains('open');

        // Optional: close siblings
        sidebar.querySelectorAll('.nav-item.has-submenu').forEach((item) => {
          if (item !== parentItem) {
            item.classList.remove('open');
          }
        });

        if (wasOpen) {
          parentItem.classList.remove('open');
        } else {
          parentItem.classList.add('open');
        }
      });
    });

    // Auto-highlight active link based on current page URL
    highlightActiveRoute(sidebar);

    // Resize handler
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        closeMobileSidebar();
      }
    });
  });

  function highlightActiveRoute(sidebar) {
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const allLinks = sidebar.querySelectorAll('.nav-link, .submenu-link');

    allLinks.forEach((link) => {
      const href = link.getAttribute('href');
      if (!href) return;
      const targetPage = href.split('/').pop();

      // Check match (e.g. index.html vs dashboard.html)
      const isMatch = (targetPage === currentPath) ||
        (currentPath === '' && (targetPage === 'index.html' || targetPage === 'dashboard.html')) ||
        (currentPath === 'index.html' && targetPage === 'dashboard.html');

      if (isMatch) {
        link.classList.add('active');
        const parentSubmenu = link.closest('.nav-item.has-submenu');
        if (parentSubmenu) {
          parentSubmenu.classList.add('open');
          const parentLink = parentSubmenu.querySelector('.nav-link');
          if (parentLink) parentLink.classList.add('active');
        }
      }
    });
  }

  function createOverlay() {
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.className = 'sidebar-overlay';
      document.body.appendChild(overlay);
    }
    return overlay;
  }
})();
