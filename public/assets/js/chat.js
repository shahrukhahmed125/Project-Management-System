/**
 * WorkSphere — Internal Communication & Messaging System
 * Direct Messages, Team Channels, Code Snippets, Attachments & Reactions
 * Pure Vanilla JavaScript
 */

(function () {
  const activeChat = {
    name: '# Frontend Team',
    type: 'group',
    members: 8
  };

  document.addEventListener('DOMContentLoaded', () => {
    initChat();
  });

  function initChat() {
    const channelItems = document.querySelectorAll('.chat-channel-item');
    const sendBtn = document.getElementById('chatSendBtn');
    const inputField = document.getElementById('chatMessageInput');
    const messagesContainer = document.getElementById('chatMessagesArea');
    const activeHeaderTitle = document.getElementById('chatActiveTitle');

    // Channel / Direct Message switching
    channelItems.forEach(item => {
      item.addEventListener('click', () => {
        channelItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        const name = item.querySelector('.channel-name')?.textContent || 'Conversation';
        if (activeHeaderTitle) {
          activeHeaderTitle.textContent = name;
        }

        if (window.WorkSphere && window.WorkSphere.toast) {
          window.WorkSphere.toast(`Opened channel: ${name}`, 'info');
        }
      });
    });

    // Send Message
    function sendMessage() {
      if (!inputField || !inputField.value.trim() || !messagesContainer) return;
      const text = inputField.value.trim();
      inputField.value = '';

      const msgEl = document.createElement('div');
      msgEl.className = 'chat-message-item';
      msgEl.innerHTML = `
        <div class="avatar avatar-md" style="background:#4f46e5;">SA</div>
        <div style="flex:1;">
          <div style="display:flex; align-items:baseline; gap:0.5rem; margin-bottom:0.25rem;">
            <span style="font-weight:600; font-size:13px; color:var(--text-primary);">Shahrukh Ahmed</span>
            <span style="font-size:11px; color:var(--text-muted);">Just now</span>
          </div>
          <div class="chat-bubble">
            <p>${escapeHtml(text)}</p>
          </div>
        </div>
      `;

      messagesContainer.appendChild(msgEl);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    if (sendBtn) {
      sendBtn.addEventListener('click', sendMessage);
    }

    if (inputField) {
      inputField.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
          e.preventDefault();
          sendMessage();
        }
      });
    }

    // Reaction click events
    document.addEventListener('click', (e) => {
      const reactionBtn = e.target.closest('[data-reaction-btn]');
      if (reactionBtn) {
        const countSpan = reactionBtn.querySelector('.reaction-count');
        if (countSpan) {
          let count = parseInt(countSpan.textContent, 10) || 0;
          count++;
          countSpan.textContent = count;
          reactionBtn.classList.toggle('active');
        }
      }
    });
  }

  function escapeHtml(string) {
    const div = document.createElement('div');
    div.textContent = string;
    return div.innerHTML;
  }
})();
