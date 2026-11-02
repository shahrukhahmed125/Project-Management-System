/**
 * WorkSphere — Kanban Drag & Drop Engine
 * Supports 6 Columns: BACKLOG, TODO, IN PROGRESS, CODE REVIEW, QA, DONE
 * Pure Vanilla JavaScript HTML5 Drag & Drop + Activity Feed Recording
 */

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    initKanbanBoard();
  });

  function initKanbanBoard() {
    const board = document.querySelector('.kanban-board');
    if (!board) return;

    const cards = board.querySelectorAll('.kanban-card');
    const columns = board.querySelectorAll('.kanban-cards-list');

    cards.forEach(card => {
      card.setAttribute('draggable', 'true');

      card.addEventListener('dragstart', (e) => {
        card.classList.add('dragging');
        e.dataTransfer.setData('text/plain', card.dataset.id || card.querySelector('.kanban-card-title')?.innerText || '');
        e.dataTransfer.effectAllowed = 'move';
      });

      card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        columns.forEach(col => col.classList.remove('drop-target'));
      });
    });

    columns.forEach(column => {
      column.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        column.classList.add('drop-target');

        const draggingCard = document.querySelector('.kanban-card.dragging');
        if (!draggingCard) return;

        const afterElement = getDragAfterElement(column, e.clientY);
        if (afterElement == null) {
          column.appendChild(draggingCard);
        } else {
          column.insertBefore(draggingCard, afterElement);
        }
      });

      column.addEventListener('dragleave', (e) => {
        if (!column.contains(e.relatedTarget)) {
          column.classList.remove('drop-target');
        }
      });

      column.addEventListener('drop', (e) => {
        e.preventDefault();
        column.classList.remove('drop-target');

        const draggingCard = document.querySelector('.kanban-card.dragging');
        if (!draggingCard) return;

        const targetColumnEl = column.closest('.kanban-column');
        const targetColumnName = targetColumnEl?.querySelector('.kanban-column-title')?.textContent?.trim() || 'New Column';
        const taskTitle = draggingCard.querySelector('.kanban-card-title')?.textContent?.trim() || 'Task';

        // Update card status badge if present
        const badge = draggingCard.querySelector('.badge');
        if (badge) {
          badge.textContent = targetColumnName;
          badge.className = 'badge ' + getBadgeClassForStatus(targetColumnName);
        }

        // Update counts
        updateColumnCounts();

        // Display toast
        if (window.WorkSphere && window.WorkSphere.toast) {
          window.WorkSphere.toast(`Moved "${taskTitle}" to ${targetColumnName}`, 'success');
        }

        // Add to global activity feed if present
        logActivity('Task Moved', `Moved "${taskTitle}" to ${targetColumnName}`, 'Ali Raza');
      });
    });

    updateColumnCounts();
  }

  function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.kanban-card:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
  }

  function getBadgeClassForStatus(status) {
    const s = status.toLowerCase();
    if (s.includes('backlog')) return 'status-backlog';
    if (s.includes('todo')) return 'status-todo';
    if (s.includes('in progress')) return 'status-in-progress';
    if (s.includes('review') || s.includes('code review')) return 'status-review';
    if (s.includes('qa')) return 'status-qa';
    if (s.includes('done')) return 'status-done';
    return 'badge-neutral';
  }

  function updateColumnCounts() {
    document.querySelectorAll('.kanban-column').forEach(col => {
      const countEl = col.querySelector('.kanban-column-count');
      const cards = col.querySelectorAll('.kanban-card');
      if (countEl) {
        countEl.textContent = cards.length;
      }
    });
  }

  function logActivity(action, details, user = 'Current User') {
    const activityFeed = document.querySelector('[data-activity-feed]');
    if (!activityFeed) return;

    const item = document.createElement('div');
    item.className = 'timeline-item';
    item.innerHTML = `
      <div class="timeline-marker"></div>
      <div class="timeline-header">
        <span class="timeline-title">${user} ${action.toLowerCase()}</span>
        <span class="timeline-time">Just now</span>
      </div>
      <div class="timeline-desc">${details}</div>
    `;
    activityFeed.prepend(item);
  }

  window.WorkSphereKanban = {
    updateCounts: updateColumnCounts
  };
})();
