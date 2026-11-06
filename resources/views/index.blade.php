@extends('master')
@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')

      <div class="main-content">
        <!-- Dynamic Header Greeting -->
        <div class="page-header">
          <div class="page-header-title">
            <h1 class="page-title" data-role-greeting-name>Executive Leadership Dashboard</h1>
            <p class="page-subtitle" data-role-greeting-subtitle>Unified cross-functional overview of engineering, HR, payroll, and deliverables.</p>
          </div>
          <div class="page-header-actions">
            <a href="./pages/projects/create.html" class="btn btn-primary">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              <span>New Project</span>
            </a>
            <a href="./pages/tasks/all-tasks.html" class="btn btn-secondary">All Tasks</a>
            <a href="./pages/reports/productivity.html" class="btn btn-secondary">Productivity Report</a>
          </div>
        </div>

        <!-- Dynamic Role Container -->
        <div id="roleDashboardContainer">

          <!-- ================= 1. ADMIN DASHBOARD ================= -->
          <div data-dashboard-view="admin">
            <!-- KPI Cards -->
            <div class="kpi-grid">
              <div class="kpi-card">
                <div class="kpi-header">
                  <span class="kpi-label">Total Employees</span>
                  <div class="kpi-icon indigo"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                </div>
                <div class="kpi-value">42</div>
                <div class="kpi-footer">
                  <span class="trend-up">↑ 3 new</span>
                  <span class="trend-text">joined this quarter</span>
                </div>
              </div>

              <div class="kpi-card">
                <div class="kpi-header">
                  <span class="kpi-label">Active Projects</span>
                  <div class="kpi-icon blue"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></div>
                </div>
                <div class="kpi-value">8</div>
                <div class="kpi-footer">
                  <span class="trend-up">6 on schedule</span>
                  <span class="trend-text">· 2 at risk</span>
                </div>
              </div>

              <div class="kpi-card">
                <div class="kpi-header">
                  <span class="kpi-label">Completed Projects</span>
                  <div class="kpi-icon green"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                </div>
                <div class="kpi-value">21</div>
                <div class="kpi-footer">
                  <span class="trend-up">100% QA pass</span>
                  <span class="trend-text">delivered on budget</span>
                </div>
              </div>

              <div class="kpi-card">
                <div class="kpi-header">
                  <span class="kpi-label">Overdue Tasks</span>
                  <div class="kpi-icon red"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
                </div>
                <div class="kpi-value">2</div>
                <div class="kpi-footer">
                  <span class="trend-down">Action needed</span>
                  <span class="trend-text">in Mobile Banking</span>
                </div>
              </div>
            </div>

            <!-- Middle Row: Projects Overview & Attendance/HR Overview -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(360px, 1fr)); gap:1.5rem; margin-bottom:1.75rem;">
              <!-- Project Overview -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                    <span>Strategic Project Status</span>
                  </h3>
                  <a href="./pages/projects/index.html" class="btn btn-outline btn-sm">View All Projects</a>
                </div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:1.25rem;">
                  <div>
                    <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:0.35rem;">
                      <span style="font-weight:600; color:var(--text-primary);">E-Commerce Platform (ShopSwift)</span>
                      <span style="font-weight:600; color:var(--primary);">82% · Due Oct 24</span>
                    </div>
                    <div class="progress-bar-container"><div class="progress-bar-fill" style="width:82%;"></div></div>
                  </div>

                  <div>
                    <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:0.35rem;">
                      <span style="font-weight:600; color:var(--text-primary);">Mobile Banking App (FinSecure)</span>
                      <span style="font-weight:600; color:var(--danger);">45% · At Risk (QA Blockers)</span>
                    </div>
                    <div class="progress-bar-container"><div class="progress-bar-fill danger" style="width:45%;"></div></div>
                  </div>

                  <div>
                    <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:0.35rem;">
                      <span style="font-weight:600; color:var(--text-primary);">HR Management System</span>
                      <span style="font-weight:600; color:var(--success);">94% · Final Review</span>
                    </div>
                    <div class="progress-bar-container"><div class="progress-bar-fill success" style="width:94%;"></div></div>
                  </div>

                  <div>
                    <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:0.35rem;">
                      <span style="font-weight:600; color:var(--text-primary);">Healthcare Clinical Dashboard</span>
                      <span style="font-weight:600; color:var(--primary);">68% · Sprint 4</span>
                    </div>
                    <div class="progress-bar-container"><div class="progress-bar-fill" style="width:68%;"></div></div>
                  </div>
                </div>
              </div>

              <!-- Employee & Attendance Snapshot -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    <span>Today's Workforce Attendance</span>
                  </h3>
                  <a href="./pages/hr/attendance.html" class="btn btn-outline btn-sm">Full Roster</a>
                </div>
                <div class="card-body">
                  <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem; margin-bottom:1.25rem;">
                    <div style="background:var(--surface-subtle); padding:1rem; border-radius:var(--radius-md); border:1px solid var(--border);">
                      <div style="font-size:11px; text-transform:uppercase; color:var(--text-secondary); font-weight:600;">Present In Office</div>
                      <div style="font-size:1.6rem; font-weight:700; color:var(--success);">29</div>
                    </div>
                    <div style="background:var(--surface-subtle); padding:1rem; border-radius:var(--radius-md); border:1px solid var(--border);">
                      <div style="font-size:11px; text-transform:uppercase; color:var(--text-secondary); font-weight:600;">Remote / WFH</div>
                      <div style="font-size:1.6rem; font-weight:700; color:var(--info);">8</div>
                    </div>
                    <div style="background:var(--surface-subtle); padding:1rem; border-radius:var(--radius-md); border:1px solid var(--border);">
                      <div style="font-size:11px; text-transform:uppercase; color:var(--text-secondary); font-weight:600;">On Approved Leave</div>
                      <div style="font-size:1.6rem; font-weight:700; color:var(--warning);">2</div>
                    </div>
                    <div style="background:var(--surface-subtle); padding:1rem; border-radius:var(--radius-md); border:1px solid var(--border);">
                      <div style="font-size:11px; text-transform:uppercase; color:var(--text-secondary); font-weight:600;">Pending Leave Requests</div>
                      <div style="font-size:1.6rem; font-weight:700; color:var(--primary);">3</div>
                    </div>
                  </div>
                  <div style="font-size:12.5px; color:var(--text-secondary); display:flex; justify-content:space-between; align-items:center;">
                    <span>Overall Monthly Attendance Rate:</span>
                    <strong style="color:var(--text-primary); font-size:14px;">96.4%</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bottom Row: Audit Activity Feed Timeline & Recent Deliverables -->
            <div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem;">
              <!-- Recent Audit Activity Logs -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                    <span>System Audit & Operational Activity</span>
                  </h3>
                  <a href="./pages/administration/activity-logs.html" class="btn btn-outline btn-sm">Audit Log</a>
                </div>
                <div class="card-body">
                  <div class="timeline" data-activity-feed>
                    <div class="timeline-item">
                      <div class="timeline-marker"></div>
                      <div class="timeline-header">
                        <span class="timeline-title">Shahrukh Ahmed created project "E-Commerce Platform"</span>
                        <span class="timeline-time">22 mins ago</span>
                      </div>
                      <div class="timeline-desc">Initialized repository, defined 14 core milestones, and assigned engineering leads.</div>
                    </div>

                    <div class="timeline-item">
                      <div class="timeline-marker"></div>
                      <div class="timeline-header">
                        <span class="timeline-title">Ahmed Khan assigned "Payment Gateway Integration" to Ali Raza</span>
                        <span class="timeline-time">1 hr ago</span>
                      </div>
                      <div class="timeline-desc">High-priority sprint task with 8-hour estimate and Stripe API test credentials.</div>
                    </div>

                    <div class="timeline-item">
                      <div class="timeline-marker"></div>
                      <div class="timeline-header">
                        <span class="timeline-title">Ali Raza moved task: In Progress → Code Review</span>
                        <span class="timeline-time">2 hrs ago</span>
                      </div>
                      <div class="timeline-desc">Authentication API PR #42 submitted with 100% test coverage and Swagger documentation.</div>
                    </div>

                    <div class="timeline-item">
                      <div class="timeline-marker"></div>
                      <div class="timeline-header">
                        <span class="timeline-title">Sara Ahmed (HR) approved leave for Ahmed Khan</span>
                        <span class="timeline-time">3 hrs ago</span>
                      </div>
                      <div class="timeline-desc">Annual vacation request approved for Oct 12-14. Project handover verified.</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Quick Launchpad -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Quick Launchpad</h3>
                </div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:0.75rem;">
                  <a href="./pages/projects/board.html" class="btn btn-secondary" style="justify-content:flex-start;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                    <span>Open Sprint Kanban</span>
                  </a>
                  <a href="./pages/my-work.html" class="btn btn-secondary" style="justify-content:flex-start;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>Developer Time Tracker</span>
                  </a>
                  <a href="./pages/payroll/payroll.html" class="btn btn-secondary" style="justify-content:flex-start;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/></svg>
                    <span>Monthly Payroll Batch</span>
                  </a>
                  <a href="./pages/hr/employees.html" class="btn btn-secondary" style="justify-content:flex-start;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/></svg>
                    <span>Add New Employee</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 2. DEVELOPER DASHBOARD ================= -->
          <div data-dashboard-view="developer" style="display:none;">
            <!-- Signature Countdown Timer Widget -->
            <div class="timer-widget" style="margin-bottom:1.75rem;">
              <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <div>
                  <span class="badge badge-primary">ACTIVE SPRINT TASK</span>
                  <h2 class="timer-task-name" data-timer-task-name style="margin-top:0.35rem;">Implement Authentication API</h2>
                  <p style="font-size:12.5px; color:var(--text-muted);">Project: E-Commerce Platform · Branch: feature/oauth-jwt</p>
                </div>
                <div class="timer-actions">
                  <button class="btn btn-success btn-lg" data-timer-btn-start>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    <span>Start Timer</span>
                  </button>
                  <button class="btn btn-warning btn-lg" data-timer-btn-pause style="display:none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                    <span>Pause</span>
                  </button>
                  <button class="btn btn-secondary" data-timer-btn-stop>Submit Log</button>
                  <button class="btn btn-outline" data-timer-btn-reset>Reset</button>
                </div>
              </div>

              <div class="timer-display-grid">
                <div class="timer-box">
                  <div class="timer-box-label">Estimated Time</div>
                  <div class="timer-box-digits" data-timer-estimated>08:00:00</div>
                </div>
                <div class="timer-box">
                  <div class="timer-box-label">Worked So Far</div>
                  <div class="timer-box-digits active" data-timer-worked>05:13:00</div>
                </div>
                <div class="timer-box">
                  <div class="timer-box-label">Remaining Time</div>
                  <div class="timer-box-digits" data-timer-remaining>02:47:00</div>
                </div>
              </div>

              <div>
                <div style="display:flex; justify-content:space-between; font-size:12.5px; margin-bottom:0.35rem;">
                  <span style="color:var(--text-secondary);">Daily Work Progress</span>
                  <strong data-timer-progress-text>65%</strong>
                </div>
                <div class="progress-bar-container"><div class="progress-bar-fill" data-timer-progress-fill style="width:65%;"></div></div>
              </div>
            </div>

            <!-- Developer Active Tasks & Schedule -->
            <div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem;">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">My Sprint Priority Queue</h3>
                  <a href="./pages/projects/board.html" class="btn btn-primary btn-sm">Board View</a>
                </div>
                <div class="card-body">
                  <div style="display:flex; flex-direction:column; gap:0.85rem;">
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.85rem; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--surface-subtle);">
                      <div>
                        <div style="font-weight:600; font-size:13.5px; color:var(--text-primary);">🔴 Fix Token Expiry Interceptor</div>
                        <div style="font-size:12px; color:var(--text-secondary);">Bug in refresh loop on mobile Safari · 02:14:32 remaining</div>
                      </div>
                      <span class="badge badge-danger">High Priority</span>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.85rem; border:1px solid var(--border); border-radius:var(--radius-md);">
                      <div>
                        <div style="font-weight:600; font-size:13.5px; color:var(--text-primary);">🟡 Payment Webhook Idempotency</div>
                        <div style="font-size:12px; color:var(--text-secondary);">Stripe charge.succeeded handling · 05:42:11 remaining</div>
                      </div>
                      <span class="badge badge-warning">In Progress</span>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; padding:0.85rem; border:1px solid var(--border); border-radius:var(--radius-md);">
                      <div>
                        <div style="font-weight:600; font-size:13.5px; color:var(--text-primary);">🟢 Dashboard Performance Optimization</div>
                        <div style="font-size:12px; color:var(--text-secondary);">Reduced bundle size by 38% · PR merged</div>
                      </div>
                      <span class="badge badge-success">Completed</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Today's Schedule -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Today's Schedule</h3>
                </div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:1rem;">
                  <div style="border-left:3px solid var(--primary); padding-left:0.75rem;">
                    <div style="font-weight:600; font-size:13px; color:var(--text-primary);">Client Architecture Review</div>
                    <div style="font-size:12px; color:var(--text-secondary);">Today — 3:00 PM · Google Meet</div>
                  </div>
                  <div style="border-left:3px solid var(--purple); padding-left:0.75rem;">
                    <div style="font-weight:600; font-size:13px; color:var(--text-primary);">Code Review: PR #104</div>
                    <div style="font-size:12px; color:var(--text-secondary);">Today — 4:30 PM · Ali Raza</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 3. PROJECT MANAGER DASHBOARD ================= -->
          <div data-dashboard-view="pm" style="display:none;">
            <div class="kpi-grid">
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Active Sprints</span><div class="kpi-icon indigo">🏃</div></div>
                <div class="kpi-value">4</div>
                <div class="kpi-footer"><span class="trend-up">94% velocity</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Tasks In Review</span><div class="kpi-icon amber">👀</div></div>
                <div class="kpi-value">9</div>
                <div class="kpi-footer"><span class="trend-text">Average turnaround: 3.2 hrs</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Blocked Tasks</span><div class="kpi-icon red">🔒</div></div>
                <div class="kpi-value">3</div>
                <div class="kpi-footer"><span class="trend-down">Requires dependency clearance</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Team Members Active</span><div class="kpi-icon green">👥</div></div>
                <div class="kpi-value">28</div>
                <div class="kpi-footer"><span class="trend-up">Full capacity</span></div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sprint 24 Workload & Bottlenecks</h3>
                <a href="./pages/projects/board.html" class="btn btn-primary btn-sm">Open Kanban Board</a>
              </div>
              <div class="card-body">
                <p style="font-size:13.5px; color:var(--text-secondary); margin-bottom:1rem;">
                  Task dependencies configured: <strong>Develop Login UI</strong> is currently locked until <strong>Develop Login API</strong> is moved to QA.
                </p>
                <div class="table-container">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Task Name</th>
                        <th>Assignee</th>
                        <th>Sprint</th>
                        <th>Estimated</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><strong>Authentication API</strong></td>
                        <td>Shahrukh Ahmed</td>
                        <td>Sprint 24</td>
                        <td>8 hrs</td>
                        <td><span class="badge status-in-progress">In Progress</span></td>
                        <td><a href="./pages/projects/task-detail.html" class="btn btn-secondary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <td><strong>Payment Gateway Setup</strong></td>
                        <td>Ali Raza</td>
                        <td>Sprint 24</td>
                        <td>12 hrs</td>
                        <td><span class="badge status-review">Code Review</span></td>
                        <td><a href="./pages/projects/task-detail.html" class="btn btn-secondary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <td><strong>Login Screen UI Design</strong></td>
                        <td>Hamza Malik</td>
                        <td>Sprint 24</td>
                        <td>6 hrs</td>
                        <td><span class="badge status-done">Done</span></td>
                        <td><a href="./pages/projects/task-detail.html" class="btn btn-secondary btn-sm">View</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 4. HR DASHBOARD ================= -->
          <div data-dashboard-view="hr" style="display:none;">
            <div class="kpi-grid">
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Headcount</span><div class="kpi-icon indigo">🏢</div></div>
                <div class="kpi-value">42</div>
                <div class="kpi-footer"><span class="trend-text">6 departments</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Present Today</span><div class="kpi-icon green">✅</div></div>
                <div class="kpi-value">37</div>
                <div class="kpi-footer"><span class="trend-up">88% in-office / remote</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Pending Leaves</span><div class="kpi-icon amber">⏳</div></div>
                <div class="kpi-value">3</div>
                <div class="kpi-footer"><span class="trend-down">Awaiting approval</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Next Payroll Due</span><div class="kpi-icon blue">💰</div></div>
                <div class="kpi-value">5 days</div>
                <div class="kpi-footer"><span class="trend-text">Oct 28 disbursement</span></div>
              </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pending Leave Requests</h3>
                  <a href="./pages/hr/leave.html" class="btn btn-outline btn-sm">View All</a>
                </div>
                <div class="card-body">
                  <div style="display:flex; flex-direction:column; gap:0.75rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem; border:1px solid var(--border); border-radius:var(--radius-md);">
                      <div>
                        <strong>Ahmed Khan</strong> (Engineering PM)<br>
                        <span style="font-size:12px; color:var(--text-muted);">Annual Leave · Oct 12 - 14 (3 days)</span>
                      </div>
                      <div style="display:flex; gap:0.4rem;">
                        <button class="btn btn-success btn-sm" onclick="WorkSphere.toast('Leave approved for Ahmed', 'success')">Approve</button>
                        <button class="btn btn-outline btn-sm" onclick="WorkSphere.toast('Leave rejected', 'warning')">Reject</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Upcoming Birthdays & Work Anniversaries</h3>
                </div>
                <div class="card-body">
                  <div style="display:flex; flex-direction:column; gap:0.75rem; font-size:13px;">
                    <div>🎉 <strong>Ali Raza</strong> · Birthday on Oct 14</div>
                    <div>🏆 <strong>Shahrukh Ahmed</strong> · 3-Year Anniversary on Oct 20</div>
                    <div>🎉 <strong>Sara Ahmed</strong> · Birthday on Oct 29</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= 5. EMPLOYEE DASHBOARD ================= -->
          <div data-dashboard-view="employee" style="display:none;">
            <div class="kpi-grid">
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">My Check-In</span><div class="kpi-icon green">🕒</div></div>
                <div class="kpi-value">09:04 AM</div>
                <div class="kpi-footer"><span class="trend-up">On Time</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Leave Balance</span><div class="kpi-icon blue">🏖️</div></div>
                <div class="kpi-value">14 days</div>
                <div class="kpi-footer"><span class="trend-text">Remaining for 2026</span></div>
              </div>
              <div class="kpi-card">
                <div class="kpi-header"><span class="kpi-label">Latest Payslip</span><div class="kpi-icon indigo">📄</div></div>
                <div class="kpi-value">Ready</div>
                <div class="kpi-footer"><a href="./pages/payroll/payslip.html" style="color:var(--primary); font-weight:600;">Download</a></div>
              </div>
            </div>
          </div>

        </div>
      </div>

@endsection

@section('js')
@endsection