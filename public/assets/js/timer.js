/**
 * WorkSphere — Task Countdown & Work Timer Engine
 * Signature Developer Productivity Tool
 * Pure Vanilla JavaScript with LocalStorage Persistence
 */

(function () {
  const STORAGE_KEY = 'worksphere_timer_state';

  // Default state: 8 hours estimate, 5h 13m worked
  let state = {
    taskName: 'Implement Authentication API',
    taskProject: 'E-Commerce Platform',
    estimatedSeconds: 8 * 3600, // 8 hours
    workedSeconds: (5 * 3600) + (13 * 60), // 5h 13m 00s
    isRunning: false,
    lastStartedTimestamp: null
  };

  let timerInterval = null;

  function loadState() {
    try {
      const saved = localStorage.getItem(STORAGE_KEY);
      if (saved) {
        const parsed = JSON.parse(saved);
        state = { ...state, ...parsed };

        // If it was running when page reloaded, calculate elapsed time
        if (state.isRunning && state.lastStartedTimestamp) {
          const now = Date.now();
          const elapsedSec = Math.floor((now - state.lastStartedTimestamp) / 1000);
          state.workedSeconds += elapsedSec;
          state.lastStartedTimestamp = now;
        }
      }
    } catch (e) {
      console.error('Failed to load timer state', e);
    }
  }

  function saveState() {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    } catch (e) {
      console.error('Failed to save timer state', e);
    }
  }

  function formatTime(totalSec) {
    const isNegative = totalSec < 0;
    const absSec = Math.abs(totalSec);
    const h = String(Math.floor(absSec / 3600)).padStart(2, '0');
    const m = String(Math.floor((absSec % 3600) / 60)).padStart(2, '0');
    const s = String(absSec % 60).padStart(2, '0');
    return `${isNegative ? '-' : ''}${h}:${m}:${s}`;
  }

  function renderTimerUI() {
    const remainingSeconds = state.estimatedSeconds - state.workedSeconds;

    document.querySelectorAll('[data-timer-task-name]').forEach(el => {
      el.textContent = state.taskName;
    });

    document.querySelectorAll('[data-timer-estimated]').forEach(el => {
      el.textContent = formatTime(state.estimatedSeconds);
    });

    document.querySelectorAll('[data-timer-worked]').forEach(el => {
      el.textContent = formatTime(state.workedSeconds);
      if (state.isRunning) {
        el.classList.add('active');
      } else {
        el.classList.remove('active');
      }
    });

    document.querySelectorAll('[data-timer-remaining]').forEach(el => {
      el.textContent = formatTime(remainingSeconds);
      if (remainingSeconds < 0) {
        el.style.color = 'var(--danger)';
      }
    });

    // Toggle Play / Pause buttons
    document.querySelectorAll('[data-timer-btn-start]').forEach(btn => {
      btn.style.display = state.isRunning ? 'none' : 'inline-flex';
    });

    document.querySelectorAll('[data-timer-btn-pause]').forEach(btn => {
      btn.style.display = state.isRunning ? 'inline-flex' : 'none';
    });

    // Update progress rings / bars if present
    const pct = Math.min(100, Math.round((state.workedSeconds / state.estimatedSeconds) * 100));
    document.querySelectorAll('[data-timer-progress-fill]').forEach(bar => {
      bar.style.width = `${pct}%`;
      if (pct > 100) {
        bar.classList.add('danger');
      }
    });
    document.querySelectorAll('[data-timer-progress-text]').forEach(el => {
      el.textContent = `${pct}%`;
    });
  }

  function tick() {
    state.workedSeconds++;
    state.lastStartedTimestamp = Date.now();
    saveState();
    renderTimerUI();
  }

  window.WorkSphereTimer = {
    start() {
      if (state.isRunning) return;
      state.isRunning = true;
      state.lastStartedTimestamp = Date.now();
      timerInterval = setInterval(tick, 1000);
      saveState();
      renderTimerUI();
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Timer started for "${state.taskName}"`, 'success');
      }
    },

    pause() {
      if (!state.isRunning) return;
      state.isRunning = false;
      clearInterval(timerInterval);
      timerInterval = null;
      saveState();
      renderTimerUI();
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Timer paused (${formatTime(state.workedSeconds)} logged)`, 'info');
      }
    },

    stop() {
      if (state.isRunning) {
        this.pause();
      }
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Time entry submitted: ${formatTime(state.workedSeconds)}`, 'success');
      }
    },

    reset() {
      state.isRunning = false;
      clearInterval(timerInterval);
      timerInterval = null;
      state.workedSeconds = 0;
      saveState();
      renderTimerUI();
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast('Timer reset to 00:00:00', 'warning');
      }
    },

    setTask(taskTitle, estHours = 8) {
      state.taskName = taskTitle;
      state.estimatedSeconds = estHours * 3600;
      saveState();
      renderTimerUI();
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    loadState();
    renderTimerUI();

    if (state.isRunning) {
      timerInterval = setInterval(tick, 1000);
    }

    // Attach button click listeners
    document.addEventListener('click', (e) => {
      const startBtn = e.target.closest('[data-timer-btn-start]');
      const pauseBtn = e.target.closest('[data-timer-btn-pause]');
      const stopBtn = e.target.closest('[data-timer-btn-stop]');
      const resetBtn = e.target.closest('[data-timer-btn-reset]');

      if (startBtn) {
        e.preventDefault();
        window.WorkSphereTimer.start();
      } else if (pauseBtn) {
        e.preventDefault();
        window.WorkSphereTimer.pause();
      } else if (stopBtn) {
        e.preventDefault();
        window.WorkSphereTimer.stop();
      } else if (resetBtn) {
        e.preventDefault();
        window.WorkSphereTimer.reset();
      }
    });
  });
})();
