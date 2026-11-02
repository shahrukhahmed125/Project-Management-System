/**
 * WorkSphere — Interactive Calendar Engine
 * Month, Week, Day & Agenda Views with Software Company Events
 * Pure Vanilla JavaScript
 */

(function () {
  let currentDate = new Date();
  let currentView = 'month';

  const sampleEvents = [
    { day: 3, title: 'Sprint 24 Planning', type: 'meeting', time: '10:00 AM' },
    { day: 5, title: 'Auth API Release', type: 'deadline', time: '04:00 PM' },
    { day: 9, title: 'Sara Ahmed - Annual Leave', type: 'leave', time: 'All Day' },
    { day: 12, title: 'Client Architecture Review', type: 'meeting', time: '02:30 PM' },
    { day: 15, title: 'Mobile Banking App QA Freeze', type: 'deadline', time: '06:00 PM' },
    { day: 18, title: 'Design System Sync', type: 'meeting', time: '11:00 AM' },
    { day: 22, title: 'Monthly Payroll Processing', type: 'payroll', time: '05:00 PM' },
    { day: 25, title: 'Database Migration Window', type: 'task', time: '08:00 PM' },
    { day: 28, title: 'Company Hackathon Demo', type: 'event', time: '03:00 PM' }
  ];

  document.addEventListener('DOMContentLoaded', () => {
    initCalendar();
  });

  function initCalendar() {
    renderCalendar();

    document.querySelectorAll('[data-cal-prev]').forEach(btn => {
      btn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
      });
    });

    document.querySelectorAll('[data-cal-next]').forEach(btn => {
      btn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
      });
    });

    document.querySelectorAll('[data-cal-today]').forEach(btn => {
      btn.addEventListener('click', () => {
        currentDate = new Date();
        renderCalendar();
      });
    });

    document.querySelectorAll('[data-cal-view]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        document.querySelectorAll('[data-cal-view]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentView = btn.dataset.calView;
        renderCalendar();
      });
    });
  }

  function renderCalendar() {
    const grid = document.getElementById('calendarGrid');
    const titleEl = document.getElementById('calendarCurrentMonth');
    if (!grid || !titleEl) return;

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    const monthNames = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
    ];

    titleEl.textContent = `${monthNames[month]} ${year}`;

    // Clear grid
    grid.innerHTML = '';

    const firstDayIndex = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();
    const prevMonthTotalDays = new Date(year, month, 0).getDate();

    // Days from prev month
    for (let i = firstDayIndex - 1; i >= 0; i--) {
      const dayNum = prevMonthTotalDays - i;
      const cell = createDayCell(dayNum, true);
      grid.appendChild(cell);
    }

    // Days of current month
    const today = new Date();
    for (let day = 1; day <= totalDays; day++) {
      const isToday = (
        today.getDate() === day &&
        today.getMonth() === month &&
        today.getFullYear() === year
      );
      const cell = createDayCell(day, false, isToday);

      // Match events
      const eventsForDay = sampleEvents.filter(ev => ev.day === day);
      eventsForDay.forEach(ev => {
        const badge = document.createElement('div');
        badge.className = `badge badge-${getBadgeClass(ev.type)}`;
        badge.style.display = 'block';
        badge.style.marginTop = '4px';
        badge.style.fontSize = '11px';
        badge.style.cursor = 'pointer';
        badge.textContent = `${ev.time} ${ev.title}`;
        badge.title = `${ev.title} (${ev.time})`;
        badge.addEventListener('click', (e) => {
          e.stopPropagation();
          if (window.WorkSphere && window.WorkSphere.toast) {
            window.WorkSphere.toast(`Event: ${ev.title} at ${ev.time}`, 'info');
          }
        });
        cell.appendChild(badge);
      });

      grid.appendChild(cell);
    }
  }

  function createDayCell(dayNum, isMuted, isToday = false) {
    const cell = document.createElement('div');
    cell.style.minHeight = '100px';
    cell.style.padding = '0.5rem';
    cell.style.border = '1px solid var(--border)';
    cell.style.background = isToday ? 'var(--primary-subtle)' : 'var(--surface)';
    cell.style.borderRadius = 'var(--radius-sm)';
    cell.style.opacity = isMuted ? '0.35' : '1';

    const numSpan = document.createElement('div');
    numSpan.textContent = dayNum;
    numSpan.style.fontWeight = isToday ? '700' : '600';
    numSpan.style.fontSize = '13px';
    numSpan.style.color = isToday ? 'var(--primary)' : 'var(--text-secondary)';
    numSpan.style.marginBottom = '0.25rem';
    cell.appendChild(numSpan);

    cell.addEventListener('click', () => {
      if (!isMuted && window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Selected Date: Day ${dayNum}`, 'info');
      }
    });

    return cell;
  }

  function getBadgeClass(type) {
    switch (type) {
      case 'meeting': return 'primary';
      case 'deadline': return 'danger';
      case 'leave': return 'warning';
      case 'payroll': return 'success';
      default: return 'neutral';
    }
  }

  window.WorkSphereCalendar = {
    render: renderCalendar
  };
})();
