(function () {
  'use strict';

  var dataEl = document.getElementById('dashboard-data');
  if (!dataEl) return;

  var data;
  try { data = JSON.parse(dataEl.textContent); } catch (e) { return; }

  var gridColor = 'rgba(255,255,255,0.06)';
  var textColor = '#a1a1aa';

  var revCanvas = document.getElementById('revenueChart');
  if (revCanvas && data.chartData) {
    new Chart(revCanvas, {
      type: 'line',
      data: {
        labels: data.chartData.labels,
        datasets: [{
          label: data.lang.revenue,
          data: data.chartData.revenue,
          borderColor: '#e58e26',
          backgroundColor: 'rgba(229,142,38,0.1)',
          fill: true,
          tension: 0.3,
          pointRadius: 4,
          pointBackgroundColor: '#e58e26',
          pointBorderColor: '#e58e26',
          pointHoverRadius: 6,
        }, {
          label: data.lang.profit,
          data: data.chartData.profit,
          borderColor: '#10b981',
          backgroundColor: 'rgba(16,185,129,0.08)',
          fill: true,
          tension: 0.3,
          pointRadius: 4,
          pointBackgroundColor: '#10b981',
          pointBorderColor: '#10b981',
          pointHoverRadius: 6,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: { labels: { color: textColor, font: { size: 11 } } },
          tooltip: {
            backgroundColor: '#18181b', titleColor: '#f4f4f5', bodyColor: '#f4f4f5',
            borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, padding: 10, cornerRadius: 8,
          }
        },
        scales: {
          x: { grid: { color: gridColor }, ticks: { color: textColor, font: { size: 10 } } },
          y: {
            grid: { color: gridColor },
            ticks: {
              color: textColor, font: { size: 10 },
              callback: function (v) { return 'Rp' + v.toLocaleString('id-ID'); }
            }
          }
        }
      }
    });
  }

  var stCanvas = document.getElementById('statusChart');
  if (stCanvas && data.statusBreakdown) {
    new Chart(stCanvas, {
      type: 'doughnut',
      data: {
        labels: data.statusBreakdown.map(function (s) { return s.label; }),
        datasets: [{
          data: data.statusBreakdown.map(function (s) { return s.value; }),
          backgroundColor: data.statusBreakdown.map(function (s) { return s.color; }),
          borderWidth: 0,
          hoverOffset: 8,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        cutout: '65%',
        plugins: {
          legend: {
            position: 'bottom',
            labels: { color: textColor, font: { size: 11 }, padding: 12, usePointStyle: true, pointStyleWidth: 8 }
          },
          tooltip: {
            backgroundColor: '#18181b', titleColor: '#f4f4f5', bodyColor: '#f4f4f5',
            borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, padding: 10, cornerRadius: 8,
            callbacks: {
              label: function (ctx) {
                var total = ctx.dataset.data.reduce(function (a, b) { return a + b; }, 0);
                var pct = total > 0 ? (ctx.parsed / total * 100).toFixed(1) : 0;
                return ctx.label + ': ' + ctx.parsed + ' (' + pct + '%)';
              }
            }
          }
        }
      }
    });
  }
})();
