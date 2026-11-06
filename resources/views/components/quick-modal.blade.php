<div>
  <div class="modal" id="quickCreateModal">
    <div class="modal-backdrop" data-close-modal></div>
    <div class="modal-dialog">
      <div class="modal-header">
        <h3 class="modal-title">Quick Create</h3>
        <button class="modal-close-btn" data-close-modal><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
      <form data-form-type="Quick Task">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Item Type</label>
            <select class="form-control" id="quickItemType">
              <option value="task">Sprint Task</option>
              <option value="project">Project</option>
              <option value="bug">Defect / Bug</option>
              <option value="leave">Leave Request</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Title / Name <span class="required">*</span></label>
            <input type="text" class="form-control" placeholder="e.g. Implement OAuth Callback" required>
          </div>
          <div class="form-group">
            <label class="form-label">Project</label>
            <select class="form-control">
              <option>E-Commerce Platform</option>
              <option>Mobile Banking App</option>
              <option>HR Management System</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-close-modal>Cancel</button>
          <button type="submit" class="btn btn-primary">Create Item</button>
        </div>
      </form>
    </div>
  </div>
</div>