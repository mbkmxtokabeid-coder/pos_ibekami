window.onload = function () {
  timeFrame('week')
}

$(document).ready(function () {
  $('.hapus-btn').click(function (e) {
    e.preventDefault();

    var spk_id = $(this).attr('value');
    var deleteUrl = $(this).data('url') || ('/delete-spk/' + spk_id);
    $('#deleteForm').attr('action', deleteUrl); // Update the form action URL dynamically

    $('#deleteModal').modal('show');
  });
});


var options = {
  theme: {
    mode: 'dark',
    palette: 'palette1'
  },
  noData: {
    text: 'Belum ada data timeline SPK pada periode ini',
    align: 'center',
    verticalAlign: 'middle',
    style: {
      color: '#94A3B8',
      fontSize: '13px'
    }
  },
  series: [{
    name: 'Waktu Desain',
    data: tlDesignsWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
  }, {
    name: 'Waktu Produksi',
    data: tlProductionsWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
  }, {
    name: 'Waktu Keseluruhan',
    data: tlKeseluruhanWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
  }],
  chart: {
    type: 'bar',
    height: 350,
    background: 'transparent',
    foreColor: '#CBD5E1',
    toolbar: {
      show: false
    }
  },
  grid: {
    borderColor: '#28354A',
    strokeDashArray: 4
  },
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
    labels: {
      style: {
        colors: '#CBD5E1',
        fontSize: '12px',
        fontWeight: 500
      }
    }
  },
  yaxis: {
    title: {
      text: 'Waktu (Jam)',
      style: {
        color: '#E2E8F0',
        fontSize: '12px',
        fontWeight: 600
      }
    },
    labels: {
      style: {
        colors: '#CBD5E1',
        fontSize: '12px'
      }
    }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    labels: {
      colors: '#E2E8F0'
    },
    markers: {
      radius: 4
    },
    itemMargin: {
      horizontal: 12,
      vertical: 6
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    theme: 'dark',
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
  colors: ['#38BDF8', '#818CF8', '#34D399'],
};
var chart = new ApexCharts(document.querySelector("#column_chart"), options);
chart.render();
function timeFrame(period) {
  const buttons = document.getElementsByClassName('tombol');
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('active');
  }
  const selectedButton = document.getElementById('btn-' + period);
  if (selectedButton) {
    selectedButton.classList.add('active');
  }

  switch (period) {
    case 'week':
      chart.updateOptions({
        series: [{
          name: 'Waktu Desain',
          data: tlDesignsWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Produksi',
          data: tlProductionsWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Keseluruhan',
          data: tlKeseluruhanWeek.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }],
        xaxis: {
          categories: nomorInvWeek,
        },
      });
      break;
    case 'month':
      chart.updateOptions({
        series: [{
          name: 'Waktu Desain',
          data: tlDesignsMonth.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Produksi',
          data: tlProductionsMonth.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }, {
          name: 'Waktu Keseluruhan',
          data: tlKeseluruhanMonth.map(val => parseFloat(Number(val || 0).toFixed(2)))
        }],
        xaxis: {
          categories: nomorInvMonth,
        },
      });
      break;
    default:
      break;
  }
}
