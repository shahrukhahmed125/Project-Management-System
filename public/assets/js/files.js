/**
 * WorkSphere — File Management & Preview Engine
 * Pure Vanilla JavaScript
 */

(function () {
  const sampleFiles = [
    { name: 'System_Architecture_v2.4.pdf', size: '4.2 MB', owner: 'Shahrukh Ahmed', date: 'Oct 04, 2026', type: 'pdf', folder: 'Architecture' },
    { name: 'Employee_Handbook_2026.docx', size: '1.8 MB', owner: 'Sara Ahmed', date: 'Sep 28, 2026', type: 'doc', folder: 'HR' },
    { name: 'Brand_Assets_Pack.zip', size: '45.1 MB', owner: 'Hamza Malik', date: 'Oct 02, 2026', type: 'zip', folder: 'Designs' },
    { name: 'API_Security_Policy.pdf', size: '890 KB', owner: 'Ali Raza', date: 'Sep 15, 2026', type: 'pdf', folder: 'Policies' },
    { name: 'Database_Schema_Diagram.png', size: '3.1 MB', owner: 'Usman Tariq', date: 'Oct 05, 2026', type: 'img', folder: 'Architecture' }
  ];

  document.addEventListener('DOMContentLoaded', () => {
    initFileManager();
  });

  function initFileManager() {
    const fileCards = document.querySelectorAll('.file-card');
    const previewModal = document.getElementById('filePreviewModal');

    fileCards.forEach(card => {
      card.addEventListener('click', () => {
        const fileName = card.dataset.fileName || card.querySelector('.file-name')?.textContent || 'Document';
        const fileSize = card.dataset.fileSize || '2.4 MB';
        const fileOwner = card.dataset.fileOwner || 'Shahrukh Ahmed';
        const fileDate = card.dataset.fileDate || 'Oct 05, 2026';

        openFilePreview(fileName, fileSize, fileOwner, fileDate);
      });
    });

    // Search files
    const fileSearchInput = document.getElementById('fileSearchInput');
    if (fileSearchInput) {
      fileSearchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('.file-card').forEach(card => {
          const title = card.textContent.toLowerCase();
          card.style.display = title.includes(query) ? '' : 'none';
        });
      });
    }
  }

  function openFilePreview(name, size, owner, date) {
    const modal = document.getElementById('filePreviewModal');
    if (!modal) {
      if (window.WorkSphere && window.WorkSphere.toast) {
        window.WorkSphere.toast(`Previewing "${name}" (${size})`, 'info');
      }
      return;
    }

    const titleEl = modal.querySelector('[data-preview-title]');
    const sizeEl = modal.querySelector('[data-preview-size]');
    const ownerEl = modal.querySelector('[data-preview-owner]');
    const dateEl = modal.querySelector('[data-preview-date]');

    if (titleEl) titleEl.textContent = name;
    if (sizeEl) sizeEl.textContent = size;
    if (ownerEl) ownerEl.textContent = owner;
    if (dateEl) dateEl.textContent = date;

    modal.classList.add('active');
  }

  window.WorkSphereFiles = {
    openPreview: openFilePreview
  };
})();
