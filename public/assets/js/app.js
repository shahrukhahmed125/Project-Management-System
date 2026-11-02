/**
 * WorkSphere — Global Application Controller
 * Global Command Palette (Ctrl+K), Toast Notifications, Quick Create & User Menus
 * Pure Vanilla JavaScript
 */

(function () {
  // Global Namespace
  window.WorkSphere = {
    toast(message, type = 'info', duration = 3500) {
      let container = document.querySelector('.toast-container');
      if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
      }

      const toast = document.createElement('div');
      toast.className = `toast toast-${type}`;

      let iconSvg = '';
      if (type === 'success') {
        iconSvg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
      } else if (type === 'danger' || type === 'error') {
        iconSvg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>';
      } else if (type === 'warning') {
        iconSvg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>';
      } else {
        iconSvg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';
      }

      toast.innerHTML = `
        <div style="display:flex; align-items:center; gap:0.5rem;">
          ${iconSvg}
          <span>${message}</span>
        </div>
      `;

      container.appendChild(toast);

      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all 200ms ease';
        setTimeout(() => toast.remove(), 200);
      }, duration);
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    initCommandPalette();
    initQuickActions();
    initDropdowns();
  });

  // Global Command Palette (Ctrl+K or ⌘+K)
  function initCommandPalette() {
    const modal = document.getElementById('searchCommandModal');
    const searchTriggers = document.querySelectorAll('.header-search, [data-search-trigger]');
    const searchInput = document.getElementById('commandSearchInput');
    const searchResults = document.getElementById('commandSearchResults');

    function openPalette() {
      if (!modal) return;
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      if (searchInput) {
        searchInput.value = '';
        setTimeout(() => searchInput.focus(), 50);
      }
    }

    function closePalette() {
      if (!modal) return;
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    searchTriggers.forEach(t => t.addEventListener('click', openPalette));

    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        if (modal && modal.classList.contains('active')) {
          closePalette();
        } else {
          openPalette();
        }
      }
    });

    if (searchInput && searchResults) {
      searchInput.addEventListener('input', (e) => {
        const q = e.target.value.toLowerCase().trim();
        const items = searchResults.querySelectorAll('.command-item');
        items.forEach(item => {
          const txt = item.textContent.toLowerCase();
          item.style.display = txt.includes(q) ? 'flex' : 'none';
        });
      });
    }
  }

  function initQuickActions() {
    // Quick create modals and buttons
    document.querySelectorAll('[data-quick-create]').forEach(btn => {
      btn.addEventListener('click', () => {
        const modal = document.getElementById('quickCreateModal');
        if (modal) modal.classList.add('active');
      });
    });
  }

  function initDropdowns() {
    // Dropdown toggles
    document.addEventListener('click', (e) => {
      const toggle = e.target.closest('[data-dropdown-toggle]');
      if (toggle) {
        e.stopPropagation();
        const dropdown = toggle.closest('.dropdown');
        if (dropdown) dropdown.classList.toggle('active');
      } else {
        document.querySelectorAll('.dropdown.active').forEach(d => d.classList.remove('active'));
      }
    });
  }
})();
