<div>
  <div class="modal" id="searchCommandModal">
    <div class="modal-backdrop" data-close-modal></div>
    <div class="modal-dialog" style="max-width:620px;">
      <div style="padding:1rem 1.25rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:0.75rem;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="commandSearchInput" placeholder="Type to search projects, tasks, employees, files..." style="border:none; outline:none; font-size:15px; width:100%; background:transparent; color:var(--text-primary);">
        <button class="modal-close-btn" data-close-modal><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
      <div id="commandSearchResults" style="max-height:360px; overflow-y:auto; padding:0.75rem;">
        <div style="font-size:11px; font-weight:700; text-transform:uppercase; color:var(--text-muted); padding:0.4rem 0.6rem;">Quick Navigation</div>
        <a href="./pages/projects/index.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">📁 Projects Directory</a>
        <a href="./pages/projects/board.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">📋 Kanban Sprint Board</a>
        <a href="./pages/my-work.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">⏱️ My Work & Task Countdown</a>
        <a href="./pages/hr/employees.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">👥 Employee Directory (42 Staff)</a>
        <a href="./pages/payroll/payslip.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">💰 Latest Payslips</a>
        <a href="./pages/files/index.html" class="command-item" style="display:flex; align-items:center; gap:0.75rem; padding:0.6rem; border-radius:var(--radius-sm); text-decoration:none; color:var(--text-primary);">📂 File Manager & Assets</a>
      </div>
    </div>
  </div>
</div>