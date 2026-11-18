$(document).ready(function () {
  $(document).on('click', '.hapus-btn', function (e) {
    e.preventDefault();

    var spk_id = $(this).attr('value');
    var deleteUrl = $(this).data('url') || ('/delete-spk/' + spk_id);
    $('#deleteForm').attr('action', deleteUrl);

    $('#deleteModal').modal('show');
  });
});

// Helper to determine active theme mode
function isTokabeLight() {
  return document.body.classList.contains('theme-light') || 
         document.documentElement.classList.contains('theme-light') || 
         localStorage.getItem('tokabe_theme') === 'light';
}

function getChartThemeOptions(light) {
  return {
    theme: {
      mode: light ? 'light' : 'dark',
      palette: 'palette1'
    },
    chart: {
      type: 'bar',
      height: 350,
      background: 'transparent',
      foreColor: light ? '#64748B' : '#A1A1AA',
      toolbar: {
        show: false
      },
      animations: {
        enabled: false
      }
    },
    grid: {
      borderColor: light ? '#EAE4DC' : 'rgba(255, 255, 255, 0.08)',
      strokeDashArray: 4
    },
    xaxis: {
      labels: {
        style: {
          colors: light ? '#64748B' : '#A1A1AA',
          fontSize: '12px',
          fontWeight: 500
        }
      }
    },
    yaxis: {
      title: {
        text: 'Waktu (Jam)',
        style: {
          color: light ? '#0F172A' : '#FAFAFA',
          fontSize: '12px',
          fontWeight: 600
        }
      },
      labels: {
        style: {
          colors: light ? '#64748B' : '#A1A1AA',
          fontSize: '12px'
        }
      }
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      labels: {
        colors: light ? '#0F172A' : '#FAFAFA'
      },
      markers: {
        radius: 4
      },
      itemMargin: {
        horizontal: 12,
        vertical: 6
      }
    },
    tooltip: {
      theme: light ? 'light' : 'dark'
    }
  };
}

var currentIsLight = isTokabeLight();
var themeOpts = getChartThemeOptions(currentIsLight);

var options = {
  theme: themeOpts.theme,
  noData: {
    text: 'Belum ada data timeline SPK pada periode ini',
    align: 'center',
    verticalAlign: 'middle',
    style: {
      color: currentIsLight ? '#94A3B8' : '#71717A',
      fontSize: '13px'
    }
  },
  series: [{
    name: 'Waktu Desain',
    data: (typeof tlDesignsWeek !== 'undefined' ? tlDesignsWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
  }, {
    name: 'Waktu Produksi',
    data: (typeof tlProductionsWeek !== 'undefined' ? tlProductionsWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
  }, {
    name: 'Waktu Keseluruhan',
    data: (typeof tlKeseluruhanWeek !== 'undefined' ? tlKeseluruhanWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
  }],
  chart: themeOpts.chart,
  grid: themeOpts.grid,
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      borderRadius: 4
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: (typeof nomorInvWeek !== 'undefined' ? nomorInvWeek : []),
    labels: themeOpts.xaxis.labels
  },
  yaxis: themeOpts.yaxis,
  legend: themeOpts.legend,
  fill: {
    opacity: 1
  },
  tooltip: {
    theme: themeOpts.tooltip.theme,
    y: {
      formatter: function (val) {
        if (!val || val === 0) return '0 menit';
        var days = Math.floor(val / 24);
        var hours = Math.floor(val % 24);
        var minutes = Math.floor((val * 60) % 60);
        var formattedTime = '';

        if (days > 0) {
          formattedTime += days + ' hari ';
        }
        if (hours > 0) {
          formattedTime += hours + ' jam ';
        }
        if (minutes > 0) {
          formattedTime += minutes + ' menit';
        }
        if (formattedTime === '') {
          formattedTime = 'Kurang dari 1 menit';
        }

        return formattedTime.trim();
      },
    },
  },
  colors: ['#F59E0B', '#EA580C', '#10B981'],
};

var chart = null;
function initSpkChart() {
  var chartEl = document.querySelector("#column_chart");
  if (!chartEl) return;
  if (chart) {
    try { chart.destroy(); } catch(e) {}
  }
  chart = new ApexCharts(chartEl, options);
  chart.render();
  window.spkChart = chart;
}
initSpkChart();

// Function to dynamically update chart on theme switch
window.updateSpkChartTheme = function (isLight) {
  if (!chart) return;
  var newOpts = getChartThemeOptions(isLight);
  chart.updateOptions(newOpts);
};

function timeFrame(period) {
  const buttons = document.getElementsByClassName('tombol');
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('active');
  }
  const selectedButton = document.getElementById('btn-' + period);
  if (selectedButton) {
    selectedButton.classList.add('active');
  }

  if (!chart) return;

  switch (period) {
    case 'week':
      chart.updateOptions({
        series: [{
          name: 'Waktu Desain',
          data: (typeof tlDesignsWeek !== 'undefined' ? tlDesignsWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Produksi',
          data: (typeof tlProductionsWeek !== 'undefined' ? tlProductionsWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Keseluruhan',
          data: (typeof tlKeseluruhanWeek !== 'undefined' ? tlKeseluruhanWeek : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }],
        xaxis: {
          categories: (typeof nomorInvWeek !== 'undefined' ? nomorInvWeek : []),
        },
      });
      break;
    case 'month':
      chart.updateOptions({
        series: [{
          name: 'Waktu Desain',
          data: (typeof tlDesignsMonth !== 'undefined' ? tlDesignsMonth : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Produksi',
          data: (typeof tlProductionsMonth !== 'undefined' ? tlProductionsMonth : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Keseluruhan',
          data: (typeof tlKeseluruhanMonth !== 'undefined' ? tlKeseluruhanMonth : []).map(val => parseFloat(Number(val || 0).toFixed(2)))
        }],
        xaxis: {
          categories: (typeof nomorInvMonth !== 'undefined' ? nomorInvMonth : []),
        },
      });
      break;
    default:
      break;
  }
}
