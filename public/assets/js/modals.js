/**
 * WorkSphere — Modals, Drawers & Tabs Engine
 * Pure Vanilla JavaScript
 */

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    initModals();
    initTabs();
  });

  function initModals() {
    // Open trigger
    document.querySelectorAll('[data-modal-target]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = btn.getAttribute('data-modal-target');
        const modal = document.querySelector(targetId);
        if (modal) {
          modal.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    });

    // Close triggers
    document.querySelectorAll('[data-close-modal]').forEach(btn => {
      btn.addEventListener('click', () => {
        closeAllModals();
      });
    });

    // Backdrop click
    document.querySelectorAll('.modal').forEach(modal => {
      modal.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal') || e.target.classList.contains('modal-backdrop')) {
          closeAllModals();
        }
      });
    });

    // Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeAllModals();
      }
    });

    // Handle form submissions inside modals
    document.querySelectorAll('.modal form').forEach(form => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        closeAllModals();
        const formType = form.dataset.formType || 'Record';
        if (window.WorkSphere && window.WorkSphere.toast) {
          window.WorkSphere.toast(`${formType} saved successfully!`, 'success');
        }
      });
    });
  }

  function closeAllModals() {
    document.querySelectorAll('.modal.active').forEach(modal => {
      modal.classList.remove('active');
    });
    document.body.style.overflow = '';
  }

  function initTabs() {
    document.querySelectorAll('.tabs-container, [data-tabs]').forEach(container => {
      const tabBtns = container.querySelectorAll('.tab-btn');
      const tabContents = container.querySelectorAll('.tab-content, .tab-pane');

      tabBtns.forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          tabBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          const targetId = btn.getAttribute('data-tab-target');
          if (targetId) {
            tabContents.forEach(content => {
              content.classList.toggle('active', '#' + content.id === targetId || content.id === targetId);
            });
          } else if (tabContents[index]) {
            tabContents.forEach(c => c.classList.remove('active'));
            tabContents[index].classList.add('active');
          }
        });
      });
    });
  }

  window.WorkSphereModals = {
    open(modalSelector) {
      const m = document.querySelector(modalSelector);
      if (m) {
        m.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    },
    close: closeAllModals
  };
})();
