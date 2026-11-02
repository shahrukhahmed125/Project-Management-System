/**
 * WorkSphere — Data Table Engine
 * Search, Column Sorting, Bulk Selection, Row Actions & CSV Export
 * Pure Vanilla JavaScript
 */

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    initDataTables();
  });

  function initDataTables() {
    document.querySelectorAll('.table-container').forEach(container => {
      const table = container.querySelector('.table');
      if (!table) return;

      const searchInput = container.querySelector('.table-search-input input');
      const selectAll = table.querySelector('thead input[type="checkbox"]');
      const rowCheckboxes = table.querySelectorAll('tbody input[type="checkbox"]');
      const sortableHeaders = table.querySelectorAll('th.sortable');
      const bulkToolbar = container.querySelector('.bulk-bar');

      // Live search
      if (searchInput) {
        searchInput.addEventListener('input', (e) => {
          const query = e.target.value.toLowerCase();
          const rows = table.querySelectorAll('tbody tr');
          rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
          });
        });
      }

      // Select All Checkbox
      if (selectAll) {
        selectAll.addEventListener('change', () => {
          rowCheckboxes.forEach(cb => {
            cb.checked = selectAll.checked;
            cb.closest('tr')?.classList.toggle('selected', selectAll.checked);
          });
          updateBulkState(container, rowCheckboxes);
        });
      }

      // Row Checkboxes
      rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          cb.closest('tr')?.classList.toggle('selected', cb.checked);
          if (selectAll) {
            selectAll.checked = [...rowCheckboxes].every(c => c.checked);
          }
          updateBulkState(container, rowCheckboxes);
        });
      });

      // Column Sorting
      sortableHeaders.forEach((th, colIdx) => {
        th.addEventListener('click', () => {
          const isAsc = th.dataset.sortOrder !== 'asc';
          th.dataset.sortOrder = isAsc ? 'asc' : 'desc';

          // Reset other headers
          sortableHeaders.forEach(other => {
            if (other !== th) delete other.dataset.sortOrder;
          });

          sortTableByColumn(table, colIdx, isAsc);
        });
      });
    });

    // Global CSV export button handler
    document.querySelectorAll('[data-export-csv]').forEach(btn => {
      btn.addEventListener('click', () => {
        const tableContainer = btn.closest('.table-container') || document.querySelector('.table-container');
        if (tableContainer) {
          exportTableToCSV(tableContainer.querySelector('.table'));
        }
      });
    });
  }

  function updateBulkState(container, checkboxes) {
    const selectedCount = [...checkboxes].filter(cb => cb.checked).length;
    const bulkBar = container.querySelector('.bulk-bar');
    const bulkCountEl = container.querySelector('.bulk-count');

    if (bulkBar) {
      if (selectedCount > 0) {
        bulkBar.classList.add('active');
        if (bulkCountEl) bulkCountEl.textContent = `${selectedCount} selected`;
      } else {
        bulkBar.classList.remove('active');
      }
    }
  }

  function sortTableByColumn(table, colIdx, ascending) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort((a, b) => {
      const aText = a.children[colIdx]?.textContent.trim() || '';
      const bText = b.children[colIdx]?.textContent.trim() || '';

      const aNum = parseFloat(aText.replace(/[^0-9.-]+/g, ''));
      const bNum = parseFloat(bText.replace(/[^0-9.-]+/g, ''));

      if (!isNaN(aNum) && !isNaN(bNum)) {
        return ascending ? aNum - bNum : bNum - aNum;
      }
      return ascending ? aText.localeCompare(bText) : bText.localeCompare(aText);
    });

    rows.forEach(r => tbody.appendChild(r));
  }

  function exportTableToCSV(table, filename = 'WorkSphere_Export.csv') {
    if (!table) return;
    let csv = [];
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
      const cols = row.querySelectorAll('th, td');
      const rowData = [];
      cols.forEach(col => {
        let text = col.innerText.replace(/"/g, '""').trim();
        rowData.push(`"${text}"`);
      });
      csv.push(rowData.join(','));
    });

    const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
    const downloadLink = document.createElement('a');
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);

    if (window.WorkSphere && window.WorkSphere.toast) {
      window.WorkSphere.toast('Table data exported to CSV successfully', 'success');
    }
  }

  window.WorkSphereTables = {
    exportCSV: exportTableToCSV
  };
})();
