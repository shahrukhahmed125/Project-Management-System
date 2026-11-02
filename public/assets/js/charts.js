/**
 * ApexCRM - Vanilla SVG Charts Engine
 * Pure SVG, CSS, and Vanilla JavaScript Charts
 * Interactive tooltips, responsive viewBox, smooth curves
 */

const ApexCharts = {
  // Smooth cubic bezier spline generator for Area & Line charts
  createSvgPath(points) {
    if (!points || points.length === 0) return '';
    if (points.length === 1) return `M ${points[0].x} ${points[0].y}`;

    let path = `M ${points[0].x} ${points[0].y}`;
    for (let i = 0; i < points.length - 1; i++) {
      const p0 = i > 0 ? points[i - 1] : points[i];
      const p1 = points[i];
      const p2 = points[i + 1];
      const p3 = i != points.length - 2 ? points[i + 2] : p2;

      const cp1x = p1.x + (p2.x - p0.x) / 6;
      const cp1y = p1.y + (p2.y - p0.y) / 6;
      const cp2x = p2.x - (p3.x - p1.x) / 6;
      const cp2y = p2.y - (p3.y - p1.y) / 6;

      path += ` C ${cp1x.toFixed(1)} ${cp1y.toFixed(1)}, ${cp2x.toFixed(1)} ${cp2y.toFixed(1)}, ${p2.x.toFixed(1)} ${p2.y.toFixed(1)}`;
    }
    return path;
  },

  /**
   * Render Multi-series Area / Line Chart
   * container: HTMLElement or selector
   */
  renderAreaChart(container, options = {}) {
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return;

    const {
      labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      series = [
        { name: 'Revenue', data: [32, 45, 42, 68, 85, 92, 110], color: '#2563eb' },
        { name: 'Expenses', data: [18, 22, 29, 34, 42, 38, 45], color: '#ef4444' }
      ],
      height = 280,
      currency = '$'
    } = options;

    const width = 800;
    const padding = { top: 25, right: 30, bottom: 40, left: 50 };
    const chartW = width - padding.left - padding.right;
    const chartH = height - padding.top - padding.bottom;

    // Calculate max value
    let maxVal = 0;
    series.forEach((s) => {
      s.data.forEach((val) => {
        if (val > maxVal) maxVal = val;
      });
    });
    maxVal = Math.ceil(maxVal * 1.15) || 100;

    // Grid steps
    const steps = 4;
    let gridLinesSvg = '';
    for (let i = 0; i <= steps; i++) {
      const yVal = Math.round((maxVal / steps) * (steps - i));
      const yPos = padding.top + (chartH / steps) * i;
      gridLinesSvg += `
        <line x1="${padding.left}" y1="${yPos}" x2="${width - padding.right}" y2="${yPos}" stroke="var(--border)" stroke-dasharray="4 4" stroke-width="1" />
        <text x="${padding.left - 10}" y="${yPos + 4}" font-size="11" fill="var(--text-muted)" text-anchor="end">${currency}${yVal >= 1000 ? (yVal/1000).toFixed(1) + 'k' : yVal}</text>
      `;
    }

    // X-Axis labels
    const stepX = chartW / (labels.length - 1);
    let xLabelsSvg = '';
    labels.forEach((label, i) => {
      const xPos = padding.left + i * stepX;
      xLabelsSvg += `
        <text x="${xPos}" y="${height - 12}" font-size="11" fill="var(--text-muted)" text-anchor="middle">${label}</text>
      `;
    });

    // Render gradients and series paths
    let defsSvg = '';
    let seriesPathsSvg = '';

    series.forEach((s, idx) => {
      const gradId = `areaGrad_${idx}_${Math.random().toString(36).substr(2, 6)}`;
      defsSvg += `
        <linearGradient id="${gradId}" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="${s.color}" stop-opacity="0.25" />
          <stop offset="100%" stop-color="${s.color}" stop-opacity="0.0" />
        </linearGradient>
      `;

      const pts = s.data.map((val, i) => ({
        x: padding.left + i * stepX,
        y: padding.top + chartH - (val / maxVal) * chartH,
        val: val,
        label: labels[i]
      }));

      const linePath = ApexCharts.createSvgPath(pts);
      const firstPt = pts[0];
      const lastPt = pts[pts.length - 1];
      const bottomY = padding.top + chartH;
      const areaPath = `${linePath} L ${lastPt.x} ${bottomY} L ${firstPt.x} ${bottomY} Z`;

      // Area fill
      seriesPathsSvg += `<path d="${areaPath}" fill="url(#${gradId})" />`;
      // Line stroke
      seriesPathsSvg += `<path d="${linePath}" fill="none" stroke="${s.color}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />`;

      // Interactive points
      pts.forEach((pt) => {
        seriesPathsSvg += `
          <circle cx="${pt.x}" cy="${pt.y}" r="4" fill="var(--surface)" stroke="${s.color}" stroke-width="2" class="chart-point" data-series="${s.name}" data-val="${currency}${pt.val}" data-label="${pt.label}" style="cursor: pointer; transition: r 0.2s;" />
        `;
      });
    });

    el.innerHTML = `
      <div style="position: relative; width: 100%;">
        <svg viewBox="0 0 ${width} ${height}" style="width: 100%; height: auto; display: block; overflow: visible;">
          <defs>${defsSvg}</defs>
          ${gridLinesSvg}
          ${xLabelsSvg}
          ${seriesPathsSvg}
        </svg>
        <div class="chart-tooltip" style="position: absolute; display: none; pointer-events: none; background: var(--sidebar-bg); color: #fff; padding: 6px 10px; border-radius: 6px; font-size: 11px; font-weight: 500; box-shadow: var(--shadow-md); z-index: 10; white-space: nowrap;"></div>
      </div>
    `;

    // Tooltip interaction
    const tooltip = el.querySelector('.chart-tooltip');
    el.querySelectorAll('.chart-point').forEach((dot) => {
      dot.addEventListener('mouseenter', (e) => {
        dot.setAttribute('r', '6');
        const sName = dot.getAttribute('data-series');
        const val = dot.getAttribute('data-val');
        const label = dot.getAttribute('data-label');
        tooltip.innerHTML = `<strong>${label}</strong><br/>${sName}: <strong>${val}</strong>`;
        tooltip.style.display = 'block';

        const parentRect = el.getBoundingClientRect();
        const dotRect = dot.getBoundingClientRect();
        tooltip.style.left = `${dotRect.left - parentRect.left - tooltip.offsetWidth / 2 + 5}px`;
        tooltip.style.top = `${dotRect.top - parentRect.top - tooltip.offsetHeight - 8}px`;
      });

      dot.addEventListener('mouseleave', () => {
        dot.setAttribute('r', '4');
        tooltip.style.display = 'none';
      });
    });
  },

  /**
   * Render Bar Chart
   */
  renderBarChart(container, options = {}) {
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return;

    const {
      labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
      series = [
        { name: 'Deals Won', data: [12, 18, 15, 24, 30, 28, 35, 42], color: '#2563eb' },
        { name: 'Deals Lost', data: [4, 6, 8, 5, 7, 6, 9, 8], color: '#94a3b8' }
      ],
      height = 260
    } = options;

    const width = 750;
    const padding = { top: 25, right: 25, bottom: 40, left: 45 };
    const chartW = width - padding.left - padding.right;
    const chartH = height - padding.top - padding.bottom;

    let maxVal = 0;
    series.forEach((s) => {
      s.data.forEach((val) => {
        if (val > maxVal) maxVal = val;
      });
    });
    maxVal = Math.ceil(maxVal * 1.2) || 50;

    // Grid lines
    let gridLinesSvg = '';
    const steps = 4;
    for (let i = 0; i <= steps; i++) {
      const yVal = Math.round((maxVal / steps) * (steps - i));
      const yPos = padding.top + (chartH / steps) * i;
      gridLinesSvg += `
        <line x1="${padding.left}" y1="${yPos}" x2="${width - padding.right}" y2="${yPos}" stroke="var(--border)" stroke-dasharray="3 3" />
        <text x="${padding.left - 8}" y="${yPos + 4}" font-size="11" fill="var(--text-muted)" text-anchor="end">${yVal}</text>
      `;
    }

    const groupW = chartW / labels.length;
    const numSeries = series.length;
    const barW = Math.min(22, (groupW * 0.7) / numSeries);
    const gap = 3;

    let barsSvg = '';
    let xLabelsSvg = '';

    labels.forEach((label, grpIdx) => {
      const grpX = padding.left + grpIdx * groupW + groupW / 2;
      xLabelsSvg += `
        <text x="${grpX}" y="${height - 12}" font-size="11" fill="var(--text-muted)" text-anchor="middle">${label}</text>
      `;

      series.forEach((s, sIdx) => {
        const val = s.data[grpIdx] || 0;
        const bHeight = (val / maxVal) * chartH;
        const bX = grpX - ((numSeries * barW + (numSeries - 1) * gap) / 2) + sIdx * (barW + gap);
        const bY = padding.top + chartH - bHeight;

        barsSvg += `
          <rect x="${bX}" y="${bY}" width="${barW}" height="${bHeight}" rx="4" fill="${s.color}" class="bar-rect" data-series="${s.name}" data-val="${val}" data-label="${label}" style="cursor: pointer; transition: opacity 0.2s;" />
        `;
      });
    });

    el.innerHTML = `
      <div style="position: relative; width: 100%;">
        <svg viewBox="0 0 ${width} ${height}" style="width: 100%; height: auto; display: block;">
          ${gridLinesSvg}
          ${xLabelsSvg}
          ${barsSvg}
        </svg>
        <div class="chart-tooltip" style="position: absolute; display: none; pointer-events: none; background: var(--sidebar-bg); color: #fff; padding: 6px 10px; border-radius: 6px; font-size: 11px; font-weight: 500; box-shadow: var(--shadow-md); z-index: 10;"></div>
      </div>
    `;

    const tooltip = el.querySelector('.chart-tooltip');
    el.querySelectorAll('.bar-rect').forEach((bar) => {
      bar.addEventListener('mouseenter', () => {
        bar.style.opacity = '0.85';
        const sName = bar.getAttribute('data-series');
        const val = bar.getAttribute('data-val');
        const label = bar.getAttribute('data-label');
        tooltip.innerHTML = `<strong>${label}</strong><br/>${sName}: <strong>${val}</strong>`;
        tooltip.style.display = 'block';

        const parentRect = el.getBoundingClientRect();
        const barRect = bar.getBoundingClientRect();
        tooltip.style.left = `${barRect.left - parentRect.left - tooltip.offsetWidth / 2 + barRect.width / 2}px`;
        tooltip.style.top = `${barRect.top - parentRect.top - tooltip.offsetHeight - 8}px`;
      });
      bar.addEventListener('mouseleave', () => {
        bar.style.opacity = '1';
        tooltip.style.display = 'none';
      });
    });
  },

  /**
   * Render Donut Chart with Legend
   */
  renderDonutChart(container, options = {}) {
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return;

    const {
      data = [
        { label: 'Organic Search', value: 45, color: '#2563eb' },
        { label: 'Referrals', value: 25, color: '#10b981' },
        { label: 'Social Media', value: 18, color: '#8b5cf6' },
        { label: 'Direct', value: 12, color: '#f59e0b' }
      ],
      centerText = { value: '100%', title: 'Sources' },
      size = 200
    } = options;

    const total = data.reduce((sum, item) => sum + item.value, 0);
    const radius = 70;
    const strokeWidth = 24;
    const circumference = 2 * Math.PI * radius;

    let accumulatedAngle = 0;
    let segmentsSvg = '';

    data.forEach((item) => {
      const percentage = item.value / total;
      const strokeDashoffset = circumference - (circumference * percentage);
      const rotation = (accumulatedAngle / total) * 360 - 90;

      segmentsSvg += `
        <circle cx="${size / 2}" cy="${size / 2}" r="${radius}"
          fill="none"
          stroke="${item.color}"
          stroke-width="${strokeWidth}"
          stroke-dasharray="${circumference}"
          stroke-dashoffset="${strokeDashoffset}"
          transform="rotate(${rotation} ${size / 2} ${size / 2})"
          class="donut-segment"
          data-label="${item.label}"
          data-val="${item.value}"
          style="transition: stroke-width 0.2s; cursor: pointer;"
        />
      `;
      accumulatedAngle += item.value;
    });

    let legendHtml = `
      <div style="display: flex; flex-direction: column; gap: 8px; justify-content: center; flex: 1;">
    `;
    data.forEach((item) => {
      const pct = Math.round((item.value / total) * 100);
      legendHtml += `
        <div style="display: flex; align-items: center; justify-content: space-between; font-size: 13px;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <span style="width: 10px; height: 10px; border-radius: 3px; background-color: ${item.color};"></span>
            <span style="color: var(--text-secondary);">${item.label}</span>
          </div>
          <span style="font-weight: 600; color: var(--text-primary);">${pct}%</span>
        </div>
      `;
    });
    legendHtml += `</div>`;

    el.innerHTML = `
      <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
        <div style="position: relative; width: ${size}px; height: ${size}px; flex-shrink: 0;">
          <svg width="${size}" height="${size}" viewBox="0 0 ${size} ${size}">
            ${segmentsSvg}
          </svg>
          <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; pointer-events: none;">
            <span style="font-size: 20px; font-weight: 700; color: var(--text-primary); line-height: 1.1;">${centerText.value}</span>
            <span style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 500;">${centerText.title}</span>
          </div>
        </div>
        ${legendHtml}
      </div>
    `;
  },

  /**
   * Render Sales Funnel Chart
   */
  renderFunnelChart(container, options = {}) {
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return;

    const {
      stages = [
        { name: 'Visitors', count: '48,200', pct: 100, color: '#3b82f6' },
        { name: 'Leads', count: '14,650', pct: 68, color: '#2563eb' },
        { name: 'Qualified', count: '6,420', pct: 45, color: '#1d4ed8' },
        { name: 'Opportunities', count: '2,890', pct: 28, color: '#1e40af' },
        { name: 'Customers', count: '1,120', pct: 16, color: '#10b981' }
      ]
    } = options;

    let funnelHtml = `<div style="display: flex; flex-direction: column; gap: 14px; width: 100%;">`;
    stages.forEach((st, idx) => {
      funnelHtml += `
        <div style="display: flex; flex-direction: column; gap: 4px;">
          <div style="display: flex; justify-content: space-between; font-size: 13px;">
            <span style="font-weight: 600; color: var(--text-primary); display: flex; align-items: center; gap: 6px;">
              <span style="font-size: 11px; color: var(--text-muted); font-weight: 500;">0${idx+1}.</span>
              ${st.name}
            </span>
            <span style="font-weight: 600; color: var(--text-primary);">${st.count} <span style="font-size: 11px; color: var(--text-muted); font-weight: 400;">(${st.pct}%)</span></span>
          </div>
          <div style="height: 10px; width: 100%; background: var(--surface-subtle); border-radius: 999px; overflow: hidden; position: relative;">
            <div style="height: 100%; width: ${st.pct}%; background: ${st.color}; border-radius: 999px; transition: width 0.8s ease-out;"></div>
          </div>
        </div>
      `;
    });
    funnelHtml += `</div>`;
    el.innerHTML = funnelHtml;
  }
};

window.ApexCharts = ApexCharts;
