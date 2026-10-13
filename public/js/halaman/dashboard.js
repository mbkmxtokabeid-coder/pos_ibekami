function initDashboard() {
  if (typeof timeFrame === 'function') {
    timeFrame('year');
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initDashboard);
} else {
  initDashboard();
}

window.onload = initDashboard;
function getChartColorsArray(e) {
  if (null !== document.getElementById(e)) {
    var o = document.getElementById(e).getAttribute("data-colors");
    if (o)
      return (o = JSON.parse(o)).map(function (e) {
        var o = e.replace(" ", "");
        return -1 === o.indexOf(",")
          ? getComputedStyle(
            document.documentElement
          ).getPropertyValue(o) || o
          : 2 == (e = e.split(",")).length
            ? "rgba(" +
            getComputedStyle(
              document.documentElement
            ).getPropertyValue(e[0]) +
            "," +
            e[1] +
            ")"
            : o;
      });
    // console.warn("data-colors atributes not found on", e);
  }
}

// Helper formatters
function formatYAxisIndo(val) {
  if (val === 0) return "Rp 0";
  const abs = Math.abs(val);
  const sign = val < 0 ? "-" : "";
  if (abs >= 1000000000) {
    const formatted = (abs / 1000000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
    return sign + "Rp " + formatted + " M";
  } else if (abs >= 1000000) {
    const formatted = (abs / 1000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
    return sign + "Rp " + formatted + " jt";
  } else if (abs >= 1000) {
    const formatted = (abs / 1000).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 1 });
    return sign + "Rp " + formatted + " rb";
  }
  return sign + "Rp " + abs.toLocaleString('id-ID');
}
window.formatYAxisIndo = formatYAxisIndo;

function formatCenterDonut(val) {
  const abs = Math.abs(val);
  const sign = val < 0 ? "-" : "";
  if (abs >= 1000000000) {
    const formatted = (abs / 1000000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
    return sign + "Rp " + formatted + " M";
  } else if (abs >= 1000000) {
    const formatted = (abs / 1000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
    return sign + "Rp " + formatted + " jt";
  }
  return sign + "Rp " + Number(val).toLocaleString('id-ID');
}
window.formatCenterDonut = formatCenterDonut;

// CHART BAR UNTUK UMUM (DILUAR PO)
var options,
  chart,
  linechartBasicColors = ['#6B73F0', '#34C28B'],
  barchartColors =
    (linechartBasicColors &&
      ((options = {
        chart: {
          height: 350,
          type: "bar",
          toolbar: { show: false },
          zoom: { enabled: false },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "45%",
            borderRadius: 3,
            endingShape: "rounded",
          },
        },
        dataLabels: { enabled: false },
        labels: typeof hourArrayJS !== 'undefined' ? hourArrayJS : [],
        series: [
          {
            name: "Pendapatan",
            data: typeof totalJamArrayJS !== 'undefined' ? totalJamArrayJS : [],
          },
        ],
        xaxis: {
          categories: typeof hourArrayJS !== 'undefined' ? hourArrayJS : [],
          labels: {
            style: { colors: '#94A3B8', fontSize: '11px' }
          },
          axisBorder: { show: false },
          axisTicks: { show: false }
        },
        yaxis: {
          tickAmount: 6,
          axisBorder: { show: false },
          axisTicks: { show: false },
          labels: {
            show: true,
            style: { colors: '#94A3B8', fontSize: '11px' },
            formatter: function (val) {
              return formatYAxisIndo(val);
            },
          },
        },
        grid: {
          borderColor: '#232A35',
          xaxis: { lines: { show: false } },
          yaxis: { lines: { show: true } },
        },
        colors: linechartBasicColors,
        legend: { show: false },
        fill: { opacity: 1 },
        tooltip: {
          theme: 'dark',
          y: {
            formatter: function (val) {
              return "Rp " + Number(val).toLocaleString('id-ID');
            }
          }
        }
      }),
      (chart = new ApexCharts(
        document.querySelector("#stacked_column_chart"),
        options
      )).render()));
if (chart) window.chart = chart;

var options, charts,
  donutchartColors = ["#34C28B", "#E3A33B", "#6B7686"],
  initDonutSeries = (typeof datasMonthJS !== 'undefined' && Array.isArray(datasMonthJS))
    ? [Number(datasMonthJS[0]) || 0, Number(datasMonthJS[1]) || 0, Number(datasMonthJS[2]) || 0]
    : [0, 0, 0],
  initDonutSum = initDonutSeries.reduce((a, b) => a + b, 0),
  chartColors =
    (donutchartColors &&
      ((options = {
        chart: { height: 300, type: "donut" },
        series: initDonutSeries,
        labels: ["Terbayar", "Belum Bayar", "Batal"],
        colors: donutchartColors,
        plotOptions: {
          pie: {
            donut: {
              size: "74%",
              labels: {
                show: true,
                name: { show: true, fontSize: '12px', fontWeight: 500, color: '#94A3B8', offsetY: -6 },
                value: {
                  show: true,
                  fontSize: '20px',
                  fontWeight: 700,
                  color: '#FFFFFF',
                  offsetY: 6,
                  formatter: function (val) {
                    return formatCenterDonut(val);
                  }
                },
                total: {
                  show: true,
                  label: 'Total Tagihan',
                  fontSize: '12px',
                  fontWeight: 500,
                  color: '#94A3B8',
                  formatter: function (w) {
                    const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                    return formatCenterDonut(sum);
                  }
                }
              }
            }
          }
        },
        legend: { show: false },
        dataLabels: { enabled: false },
        tooltip: {
          theme: 'dark',
          y: {
            formatter: function (val) {
              return "Rp " + Number(val).toLocaleString('id-ID');
            }
          }
        },
        responsive: [
          {
            breakpoint: 600,
            options: { chart: { height: 240 }, legend: { show: false } },
          },
        ],
      }),
        (charts = new ApexCharts(
          document.querySelector("#structure_widget"),
          options
        )).render())
    );
if (charts) window.charts = charts;

// Check initial donut empty state
if (initDonutSum === 0) {
  const wEmpty = document.getElementById('structure_widget_empty');
  const wChart = document.getElementById('structure_widget');
  if (wEmpty) wEmpty.style.display = 'block';
  if (wChart) wChart.style.display = 'none';
}

// TimeFrame untuk button
function timeFrame(period) {
  const elementHarga = document.getElementById('harga');
  const tagKas = document.getElementById('tag-periode-kas');
  const badgeKas = document.getElementById('badge-payment-period-text');
  const buttons = document.querySelectorAll('.segmented-item.tombol, .segmented-item, .dash-btn-filter.tombol, .tombol');
  buttons.forEach(btn => btn.classList.remove('active'));
  const selectedButton = document.getElementById('btn-' + period);
  if (selectedButton) {
    selectedButton.classList.add('active');
  }

  const customPanel = document.getElementById('panel-custom-filter-payment');
  if (customPanel) customPanel.style.setProperty('display', 'none', 'important');
  const customBtn = document.getElementById('btn-payment-custom-toggle') || document.getElementById('btn-payment-custom');
  if (customBtn) customBtn.classList.remove('open', 'active');
  const iconCustom = document.getElementById('icon-toggle-payment-custom');
  if (iconCustom) iconCustom.className = 'ri-arrow-down-s-line chevron-rotate';

  // Sinkronisasi otomatis ke widget Donut Chart (Structure)
  if (typeof timeRange === 'function') {
    timeRange(period);
  }

  const now = new Date();
  const currentYear = now.getFullYear();
  const lastYear = currentYear - 1;

  let periodLabel = 'Bulan Ini';
  if (period === 'day') periodLabel = 'Hari Ini (' + now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ')';
  else if (period === 'week') periodLabel = 'Minggu Ini';
  else if (period === 'month') periodLabel = 'Bulan Ini (' + now.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) + ')';
  else if (period === 'year') periodLabel = 'Tahun Ini (' + currentYear + ')';
  else if (period === 'lastYear') periodLabel = 'Tahun Lalu (' + lastYear + ')';

  if (tagKas) tagKas.innerText = periodLabel;
  if (badgeKas) badgeKas.innerText = periodLabel;

  const bulanIndoList = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

  if (period === 'day') {
    chart.updateOptions({
      dataLabels: { enabled: false },
      labels: hourArrayJS,
      series: [
        {
          name: "Pendapatan",
          data: totalJamArrayJS.map((value, index) => {
            let utcTime = new Date(hourArrayJS[index]);
            let localTime = new Date(utcTime.setHours(utcTime.getHours() + 7));
            return { x: localTime.toISOString().slice(11, 16), y: value };
          }),
          color: '#34C28B',
        },
      ],
      xaxis: {
        type: 'category',
        categories: hourArrayJS.map(time => {
          let utcTime = new Date(time);
          let localTime = new Date(utcTime.setHours(utcTime.getHours()));
          return localTime.toISOString().slice(11, 16);
        }),
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (val) {
            return val;
          },
        },
      },
      yaxis: {
        min: 0,
        tickAmount: 5,
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: {
          show: true,
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (val) {
            return formatYAxisIndo(val);
          },
        },
      },
      grid: {
        borderColor: '#232A35'
      },
      plotOptions: {
        bar: {
          distributed: true,
          borderRadius: 3,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
    });

    if (elementHarga) {
      elementHarga.innerHTML = `
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Transaksi Hari Ini</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(totalPerHari || 0).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Estimasi Beban</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp 0</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
            <span class="fs-12" style="color: #6B73F0;">Pendapatan Bersih</span>
            <span class="fw-bold fs-13 tabular-nums" style="color: #6B73F0;">Rp ${Number(totalPerHari || 0).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    }
  }

  else if (period === 'week') {
    let today = new Date();
    let dayOfWeek = today.getDay();

    let startOfWeek = new Date(today);
    startOfWeek.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));
    startOfWeek.setHours(0, 0, 0, 0);
    startOfWeek.setTime(startOfWeek.getTime() + (7 * 60 * 60 * 1000));

    let endOfWeek = new Date(today);
    endOfWeek.setHours(23, 59, 59, 999);
    endOfWeek.setTime(endOfWeek.getTime() + (7 * 60 * 60 * 1000));

    let fullWeekDates = [];
    let currentDate = new Date(startOfWeek);

    while (currentDate <= endOfWeek) {
      let formattedDate = currentDate.toISOString().split("T")[0];
      fullWeekDates.push(formattedDate);
      currentDate.setDate(currentDate.getDate() + 1);
    }

    let dataMap = new Map(weekArrayJS.map((date, index) => [date, Number(totalMingguanArrayJS[index])]));

    let totalTransaksiAsli = fullWeekDates.reduce((total, date) => {
      return total + (dataMap.get(date) ?? 0);
    }, 0);

    let finalWeeklyData = fullWeekDates.map(date => {
      const transaksi = dataMap.get(date);
      return transaksi !== undefined ? transaksi - 500000 : -500000;
    });

    let totalPositif = finalWeeklyData.filter(val => val > 0).reduce((acc, val) => acc + val, 0);
    let totalNegatif = finalWeeklyData.filter(val => val < 0).reduce((acc, val) => acc + val, 0);
    let netIncome = totalPositif + totalNegatif;

    let maxValWeek = Math.max(...finalWeeklyData, 0);
    let minValWeek = Math.min(...finalWeeklyData, 0);
    let yaxisMaxWeek = maxValWeek > 0 ? (maxValWeek > 5000000 ? maxValWeek * 1.15 : 5000000) : 5000000;
    let yaxisMinWeek = minValWeek < 0 ? (minValWeek <= -1000000 ? minValWeek * 1.2 : -1000000) : 0;

    chart.updateOptions({
      dataLabels: { enabled: false },
      labels: fullWeekDates,
      series: [{
        name: "Pendapatan",
        data: finalWeeklyData,
      }],
      xaxis: {
        type: 'category',
        categories: fullWeekDates,
        labels: {
          format: 'dd MMM',
          style: { colors: '#94A3B8', fontSize: '11px' }
        },
      },
      yaxis: {
        min: yaxisMinWeek,
        max: yaxisMaxWeek,
        tickAmount: 6,
        forceNiceScale: true,
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (val) {
            return formatYAxisIndo(val);
          },
        },
      },
      grid: {
        borderColor: '#232A35'
      },
      colors: ['#34C28B'],
      plotOptions: {
        bar: {
          borderRadius: 3,
          columnWidth: "45%",
          colors: {
            ranges: [
              { from: -1000000000, to: -1, color: '#E5586B' },
              { from: 0, to: 5000000000, color: '#34C28B' }
            ]
          }
        }
      },
    });

    if (elementHarga) {
      elementHarga.innerHTML = `
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Transaksi Minggu Ini</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(totalTransaksiAsli || 0).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Beban Operasional</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(Math.abs(totalNegatif || 0)).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
            <span class="fs-12" style="color: #6B73F0;">Pendapatan Bersih</span>
            <span class="fw-bold fs-13 tabular-nums" style="color: #6B73F0;">Rp ${Number(netIncome || 0).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    }
  } else if (period === 'month') {
    let now = new Date();
    let currentYear = now.getFullYear();
    let currentMonth = ("0" + (now.getMonth() + 1)).slice(-2);

    let fullDateArray = Array.from({ length: now.getDate() }, (_, i) =>
      `${currentYear}-${currentMonth}-${("0" + (i + 1)).slice(-2)}`
    );

    let dataMap = new Map(dateArrayJS.map((date, index) => [date, Number(totalHarianArrayJS[index])]));

    let totalTransaksiAsli = fullDateArray.reduce((total, date) => {
      return total + (dataMap.get(date) ?? 0);
    }, 0);

    let filteredTotalHarianArray = fullDateArray.map(date => {
      const transaksi = dataMap.get(date);
      return transaksi !== undefined ? (transaksi - 500000) : -500000;
    });

    let totalPositif = filteredTotalHarianArray
      .filter(val => val > 0)
      .reduce((acc, val) => acc + val, 0);

    let totalNegatif = filteredTotalHarianArray
      .filter(val => val < 0)
      .reduce((acc, val) => acc + val, 0);

    let totalIncome = totalPositif + totalNegatif;

    let maxValMonth = Math.max(...filteredTotalHarianArray, 0);
    let minValMonth = Math.min(...filteredTotalHarianArray, 0);
    // Keep max at 5.000.000 so that minus bars stay low and short at the bottom
    let yaxisMaxMonth = maxValMonth > 0 ? (maxValMonth > 5000000 ? maxValMonth * 1.15 : 5000000) : 5000000;
    let yaxisMinMonth = minValMonth < 0 ? (minValMonth <= -1000000 ? minValMonth * 1.2 : -1000000) : 0;

    chart.updateOptions({
      series: [{
        name: "Pendapatan",
        data: filteredTotalHarianArray
      }],
      xaxis: {
        type: 'category',
        categories: fullDateArray,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (value) {
            return value.split("-")[2];
          }
        }
      },
      yaxis: {
        min: yaxisMinMonth,
        max: yaxisMaxMonth,
        tickAmount: 6,
        forceNiceScale: true,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (val) {
            return formatYAxisIndo(val);
          }
        }
      },
      grid: {
        borderColor: '#232A35'
      },
      colors: ['#34C28B'],
      plotOptions: {
        bar: {
          borderRadius: 3,
          columnWidth: "45%",
          colors: {
            ranges: [
              { from: -1000000000, to: -1, color: '#E5586B' },
              { from: 0, to: 5000000000, color: '#34C28B' }
            ]
          }
        }
      },
      dataLabels: { enabled: false }
    });

    if (elementHarga) {
      elementHarga.innerHTML = `
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Transaksi Bulan Ini</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(totalTransaksiAsli || 0).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Beban Operasional</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(Math.abs(totalNegatif || 0)).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
            <span class="fs-12" style="color: #6B73F0;">Pendapatan Bersih</span>
            <span class="fw-bold fs-13 tabular-nums" style="color: #6B73F0;">Rp ${Number(totalIncome || 0).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    }
  }
  else if (period === 'year') {
    let now = new Date();
    let currentYear = now.getFullYear();
    let currentMonth = now.getMonth() + 1;
    let currentDate = now.getDate();

    let fullMonthArray = Array.from({ length: currentMonth }, (_, i) =>
      `${currentYear}-${("0" + (i + 1)).slice(-2)}`
    );

    let monthlyTotalMap = new Map();

    monthArrayJS.forEach((month, index) => {
      let year = month.slice(0, 4);
      let income = Number(totalBulananArrayJS[index]);

      if (isNaN(income) || !/\d{4}-\d{2}/.test(month)) return;

      if (year === String(currentYear)) {
        if (monthlyTotalMap.has(month)) {
          monthlyTotalMap.set(month, monthlyTotalMap.get(month) + income);
        } else {
          monthlyTotalMap.set(month, income);
        }
      }
    });

    let totalBulananArray = fullMonthArray.map(month => {
      return monthlyTotalMap.has(month) ? monthlyTotalMap.get(month) : 0;
    });

    let totalNegatifPerBulan = Array.from({ length: currentMonth }, (_, month) => {
      let daysInMonth = (month + 1 === currentMonth)
        ? currentDate
        : new Date(currentYear, month + 1, 0).getDate();

      let totalNegatif = daysInMonth * -500000;
      return totalNegatif;
    });

    let totalWithFormulaArray = totalBulananArray.map((value, index) =>
      value + totalNegatifPerBulan[index]
    );

    let maxValYear = Math.max(...totalBulananArray, ...totalWithFormulaArray, 0);
    let minValYear = Math.min(...totalWithFormulaArray, 0);
    let yaxisMaxYear = maxValYear > 0 ? (maxValYear > 5000000 ? maxValYear * 1.15 : 5000000) : 5000000;
    let yaxisMinYear = minValYear < 0 ? (minValYear <= -1000000 ? minValYear * 1.2 : -1000000) : 0;

    chart.updateOptions({
      colors: ['#6B73F0', '#34C28B'],
      series: [
        {
          name: "Pendapatan Bersih",
          data: totalWithFormulaArray,
        },
        {
          name: "Pendapatan Asli",
          data: totalBulananArray,
        }
      ],
      xaxis: {
        type: 'category',
        categories: fullMonthArray,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (value) {
            const mIdx = parseInt(value.split("-")[1], 10) - 1;
            return bulanIndoList[mIdx] || value;
          }
        }
      },
      yaxis: {
        min: yaxisMinYear,
        max: yaxisMaxYear,
        tickAmount: 6,
        forceNiceScale: true,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: function (val) {
            return formatYAxisIndo(val);
          }
        }
      },
      grid: {
        borderColor: '#232A35',
        xaxis: { lines: { show: false } },
        yaxis: { lines: { show: true } }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          borderRadius: 3,
          columnWidth: "45%",
          endingShape: "rounded",
          colors: {
            ranges: [
              { from: -1000000000, to: -1, color: '#E5586B' }
            ]
          }
        }
      },
      dataLabels: { enabled: false }
    });

    if (elementHarga) {
      const totalOriginalTahunIni = totalBulananArray.reduce((acc, val) => acc + val, 0);
      const totalNegatifTahunIni = totalNegatifPerBulan.reduce((acc, val) => acc + val, 0);
      const totalWithFormulaTahunIni = totalOriginalTahunIni + totalNegatifTahunIni;

      elementHarga.innerHTML = `
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Pendapatan (${currentYear})</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(totalOriginalTahunIni || 0).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Beban (${currentYear})</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(Math.abs(totalNegatifTahunIni || 0)).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
            <span class="fs-12" style="color: #6B73F0;">Pendapatan Bersih (${currentYear})</span>
            <span class="fw-bold fs-13 tabular-nums" style="color: #6B73F0;">Rp ${Number(totalWithFormulaTahunIni || 0).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    }
  } else if (period === 'lastYear') {

    let now = new Date();
    let lastYear = now.getFullYear() - 1;

    let fullMonthArrayLastYear = Array.from({ length: 12 }, (_, i) =>
      `${lastYear}-${("0" + (i + 1)).slice(-2)}`
    );

    let monthlyTotalMapLastYear = new Map();
    monthArrayLastYearJS.forEach((month, index) => {
      if (month.startsWith(`${lastYear}-`)) {
        let income = Number(totalBulananArrayLastYearJS[index]);
        if (monthlyTotalMapLastYear.has(month)) {
          monthlyTotalMapLastYear.set(month, monthlyTotalMapLastYear.get(month) + income);
        } else {
          monthlyTotalMapLastYear.set(month, income);
        }
      }
    });

    let totalBulananArrayLastYear = fullMonthArrayLastYear.map(month => {
      return monthlyTotalMapLastYear.get(month) || 0;
    });

    let totalNegatifPerBulanLastYear = Array.from({ length: 12 }, (_, month) => {
      let daysInMonth = new Date(lastYear, month + 1, 0).getDate();
      let totalNegatif = daysInMonth * -500000;
      return totalNegatif;
    });

    let totalWithFormulaArrayLastYear = totalBulananArrayLastYear.map((val, index) => 
      val + totalNegatifPerBulanLastYear[index]
    );

    let maxValLastYear = Math.max(...totalBulananArrayLastYear, ...totalWithFormulaArrayLastYear, 0);
    let minValLastYear = Math.min(...totalWithFormulaArrayLastYear, 0);
    let yaxisMaxLastYear = maxValLastYear > 0 ? (maxValLastYear > 5000000 ? maxValLastYear * 1.15 : 5000000) : 5000000;
    let yaxisMinLastYear = minValLastYear < 0 ? (minValLastYear <= -1000000 ? minValLastYear * 1.2 : -1000000) : 0;

    chart.updateOptions({
      colors: ['#6B73F0', '#34C28B'],
      series: [
        {
          name: "Pendapatan Bersih",
          data: totalWithFormulaArrayLastYear,
        },
        {
          name: "Pendapatan Asli",
          data: totalBulananArrayLastYear,
        }
      ],
      xaxis: {
        categories: fullMonthArrayLastYear,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: value => {
            const mIdx = parseInt(value.split("-")[1], 10) - 1;
            return bulanIndoList[mIdx] || value;
          }
        }
      },
      yaxis: {
        min: yaxisMinLastYear,
        max: yaxisMaxLastYear,
        tickAmount: 6,
        forceNiceScale: true,
        labels: {
          style: { colors: '#94A3B8', fontSize: '11px' },
          formatter: val => formatYAxisIndo(val)
        }
      },
      grid: {
        borderColor: '#232A35',
        xaxis: { lines: { show: false } },
        yaxis: { lines: { show: true } }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          borderRadius: 3,
          columnWidth: "45%",
          endingShape: "rounded",
          colors: {
            ranges: [
              { from: -1000000000, to: -1, color: '#E5586B' }
            ]
          }
        }
      },
      dataLabels: { enabled: false }
    });

    if (elementHarga) {
      const totalOriginalTahunLalu = totalBulananArrayLastYear.reduce((acc, val) => acc + val, 0);
      const totalNegatifTahunLalu = totalNegatifPerBulanLastYear.reduce((acc, val) => acc + val, 0);
      const totalWithFormulaTahunLalu = totalOriginalTahunLalu + totalNegatifTahunLalu;

      elementHarga.innerHTML = `
        <div class="d-flex flex-column gap-2">
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Pendapatan (${lastYear})</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(totalOriginalTahunLalu || 0).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted fs-12">Total Beban (${lastYear})</span>
            <span class="fw-bold text-light fs-13 tabular-nums">Rp ${Number(Math.abs(totalNegatifTahunLalu || 0)).toLocaleString('id-ID')}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
            <span class="fs-12" style="color: #6B73F0;">Pendapatan Bersih (${lastYear})</span>
            <span class="fw-bold fs-13 tabular-nums" style="color: #6B73F0;">Rp ${Number(totalWithFormulaTahunLalu || 0).toLocaleString('id-ID')}</span>
          </div>
        </div>
      `;
    }
  }
}

function timeRange(period) {
  const periodeElement = document.getElementById('periode');
  const terbayarElement = document.getElementById('terbayar');
  const belumTerbayarElement = document.getElementById('belumTerbayar');
  const batalElement = document.getElementById('batal');
  const persenTerbayarElement = document.getElementById('persenTerbayar');
  const persenBlmTerbayarElement = document.getElementById('persenBlmTerbayar');
  const persenBatalElement = document.getElementById('persenBatal');

  function updateDonutState(series) {
    const s0 = Number(series[0]) || 0;
    const s1 = Number(series[1]) || 0;
    const s2 = Number(series[2]) || 0;
    const sum = s0 + s1 + s2;
    const widgetEmpty = document.getElementById('structure_widget_empty');
    const widgetChart = document.getElementById('structure_widget');
    if (sum === 0) {
      if (widgetEmpty) widgetEmpty.style.display = 'block';
      if (widgetChart) widgetChart.style.display = 'none';
    } else {
      if (widgetEmpty) widgetEmpty.style.display = 'none';
      if (widgetChart) widgetChart.style.display = 'block';
      if (window.charts || charts) {
        (window.charts || charts).updateOptions({
          series: [s0, s1, s2],
          colors: ["#34C28B", "#E3A33B", "#6B7686"]
        });
      }
    }
  }

  switch (period) {
    case 'day':
    case 'today':
      if (typeof fetchPaymentActivity === 'function') {
        fetchPaymentActivity({ filter: 'today' });
        return;
      }
      break;

    case 'lastYear':
      if (typeof datasLastYearJS !== 'undefined') {
        updateDonutState(datasLastYearJS);
      }
      if (periodeElement) periodeElement.innerText = 'Tahun Lalu';
      if (terbayarElement) terbayarElement.innerText = 'Rp ' + Number(datasLastYearJS[0] || 0).toLocaleString('id-ID');
      if (belumTerbayarElement) belumTerbayarElement.innerText = 'Rp ' + Number(datasLastYearJS[1] || 0).toLocaleString('id-ID');
      if (batalElement) batalElement.innerText = 'Rp ' + Number(datasLastYearJS[2] || 0).toLocaleString('id-ID');
      
      if (persenTerbayarElement) formatPersentaseTerbayar(percentInLastYearJS);
      if (persenBlmTerbayarElement) formatPersentase(percentNotPaidLastYearJS);
      if (persenBatalElement) formatPersentaseBatal(percentCanceledLastYearJS);
      break;
      
    case 'year':
      if (typeof datasYearJS !== 'undefined') {
        updateDonutState(datasYearJS);
      }
      if (periodeElement) periodeElement.innerText = 'Tahun Ini';
      if (terbayarElement) terbayarElement.innerText = 'Rp ' + Number(datasYearJS[0] || 0).toLocaleString('id-ID');
      if (belumTerbayarElement) belumTerbayarElement.innerText = 'Rp ' + Number(datasYearJS[1] || 0).toLocaleString('id-ID');
      if (batalElement) batalElement.innerText = 'Rp ' + Number(datasYearJS[2] || 0).toLocaleString('id-ID');
      if (persenTerbayarElement) formatPersentaseTerbayar(percentInYearJS);
      if (persenBlmTerbayarElement) formatPersentase(percentNotPaidYearJS);
      if (persenBatalElement) formatPersentaseBatal(percentCanceledYearJS);
      break;

    case 'month':
      if (typeof datasMonthJS !== 'undefined') {
        updateDonutState(datasMonthJS);
      }
      if (periodeElement) periodeElement.innerText = 'Bulan Ini';
      if (terbayarElement) terbayarElement.innerText = 'Rp ' + Number(datasMonthJS[0] || 0).toLocaleString('id-ID');
      if (belumTerbayarElement) belumTerbayarElement.innerText = 'Rp ' + Number(datasMonthJS[1] || 0).toLocaleString('id-ID');
      if (batalElement) batalElement.innerText = 'Rp ' + Number(datasMonthJS[2] || 0).toLocaleString('id-ID');
      if (persenTerbayarElement) formatPersentaseTerbayar(percentInMonthJS);
      if (persenBlmTerbayarElement) formatPersentase(percentNotPaidMonthJS);
      if (persenBatalElement) formatPersentaseBatal(percentCanceledMonthJS);
      break;

    default:
      if (typeof datasWeekJS !== 'undefined') {
        updateDonutState(datasWeekJS);
      }
      if (periodeElement) periodeElement.innerText = 'Minggu Ini';
      if (terbayarElement) terbayarElement.innerText = 'Rp ' + Number(datasWeekJS[0] || 0).toLocaleString('id-ID');
      if (belumTerbayarElement) belumTerbayarElement.innerText = 'Rp ' + Number(datasWeekJS[1] || 0).toLocaleString('id-ID');
      if (batalElement) batalElement.innerText = 'Rp ' + Number(datasWeekJS[2] || 0).toLocaleString('id-ID');
      if (persenTerbayarElement) formatPersentaseTerbayar(percentInWeekJS);
      if (persenBlmTerbayarElement) formatPersentase(percentNotPaidWeekJS);
      if (persenBatalElement) formatPersentaseBatal(percentCanceledWeekJS);
      break;
  }
}

function formatPersentaseTerbayar(persen) {
  const el = document.getElementById('persenTerbayar');
  const p = parseFloat(persen);
  if (!el) return persen + '%';
  if (isNaN(p) || p === 0) {
    el.className = 'badge-tint badge-tint-neutral tabular-nums';
    el.innerHTML = '0.00%';
  } else if (p < 0) {
    el.className = 'badge-tint badge-tint-danger tabular-nums';
    el.innerHTML = `${persen}%`;
  } else {
    el.className = 'badge-tint badge-tint-success tabular-nums';
    el.innerHTML = `+${persen}%`;
  }
  return el.innerHTML;
}

function formatPersentase(persen) {
  const el = document.getElementById('persenBlmTerbayar');
  if (!el) return persen + '%';
  const p = parseFloat(persen);
  if (isNaN(p) || p === 0) {
    el.className = 'badge-tint badge-tint-neutral tabular-nums';
    el.innerHTML = '0.00%';
  } else if (p > 0) {
    el.className = 'badge-tint badge-tint-warning tabular-nums';
    el.innerHTML = `${persen}%`;
  } else {
    el.className = 'badge-tint badge-tint-warning tabular-nums';
    el.innerHTML = `${persen}%`;
  }
  return el.innerHTML;
}

function formatPersentaseBatal(persen) {
  const el = document.getElementById('persenBatal');
  if (!el) return persen + '%';
  el.className = 'badge-tint badge-tint-neutral tabular-nums';
  const p = parseFloat(persen);
  if (isNaN(p) || p === 0) {
    el.innerHTML = '0.00%';
  } else {
    el.innerHTML = `${persen}%`;
  }
  return el.innerHTML;
}

// Payment Custom Filter Toolbar Handlers
window.currentPaymentSubmode = 'date';

function setPaymentSubmode(mode) {
  window.currentPaymentSubmode = mode;
  document.querySelectorAll('.payment-submode').forEach(btn => {
    if (btn.getAttribute('data-mode') === mode) {
      btn.classList.add('active');
    } else {
      btn.classList.remove('active');
    }
  });

  const ctrlDate = document.getElementById('payment-input-date');
  const ctrlMonth = document.getElementById('payment-ctrl-month');
  const ctrlYear = document.getElementById('payment-ctrl-year');
  const ctrlRange = document.getElementById('payment-ctrl-range');

  if (ctrlDate) ctrlDate.classList.toggle('active', mode === 'date');
  if (ctrlMonth) ctrlMonth.classList.toggle('active', mode === 'month');
  if (ctrlYear) ctrlYear.classList.toggle('active', mode === 'year');
  if (ctrlRange) ctrlRange.classList.toggle('active', mode === 'range');
}
window.setPaymentSubmode = setPaymentSubmode;
window.setPaymentCustomFilterMode = setPaymentSubmode;

function submitPaymentCustomFilter() {
  const mode = window.currentPaymentSubmode || 'date';
  const params = {
    filter: 'custom',
    custom_type: mode === 'month' ? 'month_year' : mode
  };

  if (mode === 'date') {
    const d = document.getElementById('payment-input-date').value;
    if (!d) return;
    params.start_date = d;
    params.end_date = d;
  } else if (mode === 'month') {
    params.bulan = document.getElementById('payment-input-bulan').value;
    params.tahun = document.getElementById('payment-input-tahun-month').value;
  } else if (mode === 'year') {
    params.tahun = document.getElementById('payment-input-year').value;
  } else if (mode === 'range') {
    const s = document.getElementById('payment-range-start').value;
    const e = document.getElementById('payment-range-end').value;
    if (!s || !e) return;
    params.start_date = s;
    params.end_date = e;
  }

  // Deactivate preset buttons and activate custom button
  document.querySelectorAll('.segmented-item.tombol, .segmented-item, .dash-btn-filter.tombol, .tombol').forEach(b => b.classList.remove('active'));
  const btnCustom = document.getElementById('btn-payment-custom-toggle') || document.getElementById('btn-payment-custom');
  if (btnCustom) btnCustom.classList.add('active', 'open');

  if (typeof fetchPaymentActivity === 'function') {
    fetchPaymentActivity(params);
  }
}
window.submitPaymentCustomFilter = submitPaymentCustomFilter;
window.applyPaymentCustomFilter = submitPaymentCustomFilter;

// CHART PO

var options,
  chartPO,
  linechartBasicColorsPO = getChartColorsArray("stacked_column_chart_po"),
  barchartColors =
    (linechartBasicColorsPO &&
      ((options = {
        chart: {
          height: 362,
          type: "bar",
          toolbar: { show: !1 },
          zoom: { enabled: !0 },
        },
        plotOptions: {
          bar: {
            horizontal: !1,
            columnWidth: "35%",
            endingShape: "rounded",
          },
        },
        dataLabels: { enabled: !1 },
        labels: hourArrayJSPO,
        series: [
          {
            name: "Income",
            data: totalJamArrayJSPO,
          },

        ],
        xaxis: {

        },
        grid: {
          xaxis: { lines: { show: !1 } },
          yaxis: { lines: { show: !1 } },
        },
        colors: linechartBasicColorsPO,
        legend: { show: !1 },
        fill: { opacity: 1 },
      }),
        (chartPO = new ApexCharts(
          document.querySelector("#stacked_column_chart_po"),
          options
        )).render())
    );

var options, chartsPO,
  donutchartColorsPO = getChartColorsArray("structure_widget_po"),
  chartColors =
    (donutchartColorsPO &&
      ((options = {
        chart: { height: 300, type: "donut" },
        series: datasMonthJSPO,
        labels: ["Terbayar", "Belum Bayar", "Batal"],
        colors: donutchartColorsPO,
        plotOptions: { pie: { startAngle: 25, donut: { size: "78%" } } },
        legend: { show: !1 },
        dataLabels: {
          style: {
            fontSize: "11px",
            fontFamily: "DM Sans,sans-serif",
            colors: void 0,
          },
          background: {
            enabled: !0,
            foreColor: "#fff",
            padding: 4,
            borderRadius: 2,
            borderWidth: 1,
            borderColor: "#fff",
            opacity: 1,
          },
        },
        responsive: [
          {
            breakpoint: 600,
            options: { chart: { height: 240 }, legend: { show: !1 } },
          },
        ],
      }),
        (chartsPO = new ApexCharts(
          document.querySelector("#structure_widget_po"),
          options
        )).render())
    );

function timeFramePO(period) {
  const buttons = document.getElementsByClassName('tombolPO');
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('btn-info');
    buttons[i].classList.add('btn-soft-info');
  }
  const elementHarga = document.getElementById('jumlahPO');
  const selectedButton = document.getElementById('btn_' + period);
  selectedButton.classList.remove('btn-soft-info');
  selectedButton.classList.add('btn-info');

  const now = new Date();
  const startOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 15, 0); //start pukul 8 karena indonesia gmt+7 maka 8+7
  const endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 24, 0); //end pukul 17 karena Indonesia gmt+7 maka 17+7
  const startOfWeek = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  startOfWeek.setDate(now.getDate() - now.getDay() + 1);
  const endOfWeek = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  endOfWeek.setDate(now.getDate() - now.getDay() + 6);
  const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1, 0, 1, 0, 0);
  const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59);
  const startOfYear = new Date(now.getFullYear(), 0, 1);
  const endOfYear = new Date(now.getFullYear(), 10, 31, 23, 59, 59);
  
  switch (period) {
    case 'day':

      chartPO.updateOptions({
        dataLabels: { enabled: !1 },
        labels: hourArrayJSPO,
        series: [
          {
            name: "Income",
            data: totalJamArrayJSPO,
          },

        ],
        xaxis: {
          type: 'datetime',
          min: startOfDay.getTime(),
          max: endOfDay.getTime(),
          labels: {
            format: 'HH:mm',
          },
        },
      });
      elementHarga.innerHTML = `Rp. ${totalPerHariPO}<span class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">PO</span>`;
      break;
    case 'week':
      // const formattedWeek = totalMingguanArrayJSPO.map(val => parse(val).toLocaleString());
      // console.log(formattedWeek)
      chartPO.updateOptions({
        dataLabels: { enabled: !1 },
        labels: weekArrayJSPO,
        // {
        //   show: true,
        //   formatter: function (val) {
        //     return "Rp " + val.toLocaleString();
        //   }
        // },
        series: [
          {
            name: "Income",
            data: totalMingguanArrayJSPO,
          },

        ],
        xaxis: {
          type: 'datetime',
          min: startOfWeek.getTime(),
          max: endOfWeek.getTime(),
          labels: {
            format: 'dd MMM',
          },
        },
      });
      elementHarga.innerHTML = `Rp. ${totalPerMingguPO}<span class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">PO</span>`;
      break;
    case 'month':
      chartPO.updateOptions({
        dataLabels: { enabled: !1 },
        labels: dateArrayJSPO,
        series: [
          {
            name: "Income",
            data: totalHarianArrayJSPO,
          },

        ],
        xaxis: {
          type: 'datetime',
          min: startOfMonth.getTime(),
          max: endOfMonth.getTime(),
          labels: {
            format: 'dd',
          },
        },
      });
      if (elementHarga) {
        elementHarga.innerHTML = `Rp. ${totalPerBulanPO}<span class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">PO</span>`;
      }
      break;
    case 'year':
      chartPO.updateOptions({
        dataLabels: { enabled: !1 },
        labels: monthArrayJSPO,
        series: [
          {
            name: "Income",
            data: totalBulananArrayJSPO,
          },

        ],
        xaxis: {
          type: 'datetime',
          min: startOfYear.getTime(),
          max: endOfYear.getTime(),
          labels: {
            format: 'MMM',
          },
        },
      });
      elementHarga.innerHTML = `Rp. ${totalPerTahunPO}<span class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">PO</span>`;
      break;
    default:
      Alert('error')
      break;
  }


}

// =========================================================================
// Chart Hutang Tagihan Vendor (Modern, Filterable, & Interactive)
// =========================================================================
// GRAFIK PEMBELIAN BELUM DIBAYAR PER VENDOR (VERTIKAL + FILTER)
// =========================================================================

var currentVendorFilter = 'has_debt';

function formatRingkasNominal(val) {
  if (val <= 0) return '';
  if (val >= 1000000) {
    var num = (val / 1000000);
    var str = (num % 1 === 0) ? num.toFixed(0) : num.toFixed(1).replace('.', ',');
    return 'Rp ' + str + ' Jt';
  }
  if (val >= 1000) {
    return 'Rp ' + Math.round(val / 1000) + ' Rb';
  }
  return 'Rp ' + Number(val).toLocaleString('id-ID');
}

function getFilteredVendorData() {
  if (typeof allVendorData === 'undefined' || !Array.isArray(allVendorData) || allVendorData.length === 0) {
    var rawNames = (typeof namaVendor !== 'undefined' && Array.isArray(namaVendor)) ? namaVendor : [];
    var rawSisa = (typeof totalSisa !== 'undefined' && Array.isArray(totalSisa)) ? totalSisa : [];
    return {
      categories: rawNames,
      data: rawSisa,
      isSingleVendor: false,
      count: rawNames.length,
      totalHutang: rawSisa.reduce(function (sum, val) { return sum + Number(val || 0); }, 0)
    };
  }

  // Cek jika filter adalah vendor tertentu
  if (currentVendorFilter && currentVendorFilter.indexOf('vendor:') === 0) {
    var targetName = currentVendorFilter.substring(7);
    var vendor = allVendorData.find(function (v) { return v.nama_vendor === targetName; });
    if (vendor) {
      return {
        categories: ['Total Pembelian', 'Sudah Dibayar', 'Sisa Hutang'],
        data: [
          Number(vendor.total_pembelian || 0),
          Number(vendor.pembelian_terbayar || 0),
          Number(vendor.pembelian_sisa || 0)
        ],
        isSingleVendor: true,
        vendor: vendor
      };
    }
  }

  // Hanya ambil vendor yang memiliki sisa hutang > 0, urutkan dari terbesar ke terkecil
  var list = allVendorData.slice().filter(function (v) {
    return Number(v.pembelian_sisa || 0) > 0;
  }).sort(function (a, b) {
    return Number(b.pembelian_sisa || 0) - Number(a.pembelian_sisa || 0);
  });

  if (currentVendorFilter === 'top5') {
    list = list.slice(0, 5);
  } else if (currentVendorFilter === 'top10') {
    list = list.slice(0, 10);
  }

  var categories = list.map(function (v) { return v.nama_vendor; });
  var data = list.map(function (v) { return Number(v.pembelian_sisa || 0); });
  var totalHutang = data.reduce(function (sum, val) { return sum + val; }, 0);

  return {
    categories: categories,
    data: data,
    isSingleVendor: false,
    count: list.length,
    totalHutang: totalHutang
  };
}

function buildVendorChartOptions(filtered) {
  // Mode Single Vendor (Perbandingan Total, Bayar, Sisa)
  if (filtered.isSingleVendor) {
    return {
      series: [{
        name: 'Nominal',
        data: filtered.data
      }],
      chart: {
        type: 'bar',
        height: 380,
        toolbar: { show: false },
        animations: { enabled: true, easing: 'easeinout', speed: 500 }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          distributed: true,
          borderRadius: 8,
          borderRadiusApplication: 'end',
          columnWidth: '35%',
          dataLabels: {
            position: 'top'
          }
        }
      },
      colors: ['#3b82f6', '#10b981', '#5051F9'], // Biru (Total), Hijau (Terbayar), Ungu/Indigo (Sisa Hutang)
      dataLabels: {
        enabled: true,
        offsetY: -22,
        formatter: function (val) {
          return formatRingkasNominal(val);
        },
        style: {
          fontSize: '11.5px',
          fontWeight: 600,
          colors: ['#cbd5e1']
        }
      },
      xaxis: {
        categories: filtered.categories,
        labels: {
          style: { fontSize: '12px', fontWeight: 600 }
        },
        axisBorder: { show: true, color: 'rgba(128, 128, 128, 0.2)' },
        axisTicks: { show: false }
      },
      yaxis: {
        labels: {
          formatter: function (val) {
            return formatRingkasNominal(val);
          },
          style: { fontSize: '11px' }
        }
      },
      tooltip: {
        theme: 'dark',
        y: {
          formatter: function (val) {
            return 'Rp ' + Number(val).toLocaleString('id-ID');
          }
        }
      },
      legend: { show: false },
      grid: {
        borderColor: 'rgba(128, 128, 128, 0.15)',
        strokeDashArray: 3
      }
    };
  }

  // Mode Multi Vendor (Kolom Vertikal Sisa Hutang)
  var numBars = filtered.categories.length;
  var colWidth = numBars <= 4 ? '26%' : (numBars <= 8 ? '36%' : '44%');

  return {
    series: [{
      name: 'Sisa Tagihan (Hutang)',
      data: filtered.data
    }],
    chart: {
      type: 'bar',
      height: 400,
      toolbar: { show: false },
      animations: { enabled: true, easing: 'easeinout', speed: 500 }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 6,
        borderRadiusApplication: 'end',
        columnWidth: colWidth,
        dataLabels: {
          position: 'top'
        }
      }
    },
    colors: ['#5051F9'], // Warna ungu/indigo cerah elegan sesuai screenshot referensi
    dataLabels: {
      enabled: true,
      offsetY: -20,
      formatter: function (val) {
        return formatRingkasNominal(val);
      },
      style: {
        fontSize: '10.5px',
        fontWeight: 600,
        colors: ['#cbd5e1']
      }
    },
    xaxis: {
      categories: filtered.categories,
      labels: {
        rotate: -45,
        rotateAlways: true,
        trim: false, // Jangan memotong nama vendor dengan '...'
        maxHeight: 130,
        style: {
          fontSize: '11px',
          fontWeight: 500,
          colors: '#94a3b8'
        }
      },
      axisBorder: {
        show: true,
        color: 'rgba(128, 128, 128, 0.2)'
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return formatRingkasNominal(val);
        },
        style: {
          fontSize: '11px'
        }
      }
    },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: function (val) {
          return 'Rp ' + Number(val).toLocaleString('id-ID');
        }
      }
    },
    grid: {
      borderColor: 'rgba(128, 128, 128, 0.12)',
      strokeDashArray: 3,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } }
    }
  };
}

function renderOrUpdateVendorChart() {
  var vendorEl = document.querySelector("#vendorChart");
  if (!vendorEl) return;

  var filtered = getFilteredVendorData();
  var opts = buildVendorChartOptions(filtered);

  // Perbarui badge & alert info
  var badgeEl = document.getElementById('vendorChartBadge');
  var alertEl = document.getElementById('vendorDetailAlert');

  var btnSemuaVendor = document.getElementById('btnSemuaVendor');

  if (filtered.isSingleVendor && filtered.vendor) {
    var v = filtered.vendor;
    if (btnSemuaVendor) {
      btnSemuaVendor.className = 'btn btn-soft-primary btn-sm py-1 px-2 fs-11';
      btnSemuaVendor.innerHTML = '<i class="ri-refresh-line me-1"></i> Semua Vendor';
    }
    if (badgeEl) {
      badgeEl.className = 'badge bg-soft-info text-info fs-11';
      badgeEl.innerText = 'Vendor: ' + v.nama_vendor;
    }
    if (alertEl) {
      var persenTerbayar = Number(v.total_pembelian) > 0 ? ((Number(v.pembelian_terbayar) / Number(v.total_pembelian)) * 100).toFixed(1) : 0;
      var persenSisa = Number(v.total_pembelian) > 0 ? ((Number(v.pembelian_sisa) / Number(v.total_pembelian)) * 100).toFixed(1) : 0;
      alertEl.innerHTML = `<strong>${v.nama_vendor}</strong> &mdash; Total Pembelian: <strong>Rp ${Number(v.total_pembelian).toLocaleString('id-ID')}</strong> | Terbayar: <span class="text-success fw-semibold">Rp ${Number(v.pembelian_terbayar).toLocaleString('id-ID')} (${persenTerbayar}%)</span> | Sisa Hutang: <span class="text-danger fw-semibold">Rp ${Number(v.pembelian_sisa).toLocaleString('id-ID')} (${persenSisa}%)</span>`;
      alertEl.classList.remove('d-none');
    }
  } else {
    if (btnSemuaVendor) {
      btnSemuaVendor.className = 'btn btn-primary btn-sm py-1 px-2 fs-11';
      btnSemuaVendor.innerHTML = '<i class="ri-bar-chart-fill me-1"></i> Semua Vendor';
    }
    if (badgeEl) {
      badgeEl.style.display = 'none';
      badgeEl.innerText = '';
    }
    if (alertEl) {
      alertEl.classList.add('d-none');
    }
  }

  if (window.chartOut) {
    window.chartOut.destroy();
  }
  window.chartOut = new ApexCharts(vendorEl, opts);
  window.chartOut.render();
}

window.filterTableDebt = function (onlyUnpaid) {};

window.resetVendorFilter = function () {
  var selectFilter = document.getElementById('filterVendorSelect');
  if (selectFilter) {
    selectFilter.value = 'has_debt';
  }
  currentVendorFilter = 'has_debt';
  document.querySelectorAll('.vendor-table-row').forEach(function (r) {
    r.classList.remove('table-active');
  });
  renderOrUpdateVendorChart();
};

window.showAllVendorChart = window.resetVendorFilter;

// Inisialisasi awal saat DOM siap
document.addEventListener("DOMContentLoaded", function () {
  renderOrUpdateVendorChart();

  // Handler dropdown filter vendor
  var selectFilter = document.getElementById('filterVendorSelect');
  if (selectFilter) {
    selectFilter.addEventListener('change', function () {
      currentVendorFilter = this.value;
      renderOrUpdateVendorChart();

      // Sinkronisasi highlight pada tabel vendor
      if (currentVendorFilter.indexOf('vendor:') === 0) {
        var vendorName = currentVendorFilter.substring(7);
        // Pastikan baris vendor terlihat jika sedang dalam filter
        document.querySelectorAll('.vendor-table-row').forEach(function (row) {
          if (row.getAttribute('data-vendor') === vendorName) {
            row.classList.remove('d-none');
            row.classList.add('table-active');
            row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          } else {
            row.classList.remove('table-active');
          }
        });
      } else {
        document.querySelectorAll('.vendor-table-row').forEach(function (r) {
          r.classList.remove('table-active');
        });
      }
    });
  }

  // Handler klik baris tabel vendor untuk filter cepat
  document.querySelectorAll('.vendor-table-row').forEach(function (row) {
    row.addEventListener('click', function () {
      var vendorName = this.getAttribute('data-vendor');
      if (vendorName) {
        if (selectFilter) {
          selectFilter.value = 'vendor:' + vendorName;
        }
        currentVendorFilter = 'vendor:' + vendorName;
        renderOrUpdateVendorChart();

        // Highlight baris tabel yang aktif
        document.querySelectorAll('.vendor-table-row').forEach(function (r) {
          r.classList.remove('table-active');
        });
        row.classList.add('table-active');
      }
    });
  });
});



// function timeRangePO(period) {
//   const periodeElement = document.getElementById('periodePO');
//   const terbayarElement = document.getElementById('terbayarPO');
//   const belumTerbayarElement = document.getElementById('belumTerbayarPO');
//   const batalElement = document.getElementById('batalPO');
//   const persenTerbayarElement = document.getElementById('persenTerbayarPO');
//   const persenBlmTerbayarElement = document.getElementById('persenBlmTerbayarPO');
//   const persenBatalElement = document.getElementById('persenBatalPO');

//   switch (period) {
//     case 'year':
//       chartsPO.updateOptions({
//         series: datasYearJSPO,
//       });
//       periodeElement.innerText = 'Yearly';
//       terbayarElement.innerText = 'Rp.' + datasYearJSPO[0].toLocaleString();
//       belumTerbayarElement.innerText = ' Rp.' + datasYearJSPO[1].toLocaleString();
//       batalElement.innerText = 'Rp.' + datasYearJSPO[2].toLocaleString();
//       persenTerbayarElement.innerText = formatPersentaseTerbayarPO(percentInYearJSPO) + '%';
//       persenBlmTerbayarElement.innerText = formatPersentasePO(percentNotPaidYearJSPO) + '%';
//       persenBatalElement.innerText = formatPersentaseBatalPO(percentCanceledYearJSPO) + '%';
//       break;
//     case 'month':
//       chartsPO.updateOptions({
//         series: datasMonthJSPO,
//       });
//       periodeElement.innerText = 'Monthly';
//       terbayarElement.innerText = 'Rp.' + datasMonthJSPO[0].toLocaleString();
//       belumTerbayarElement.innerText = ' Rp.' + datasMonthJSPO[1].toLocaleString();
//       batalElement.innerText = 'Rp.' + datasMonthJSPO[2].toLocaleString();
//       persenTerbayarElement.innerText = formatPersentaseTerbayarPO(percentInMonthJSPO) + '%';
//       persenBlmTerbayarElement.innerText = formatPersentasePO(percentNotPaidMonthJSPO) + '%';
//       persenBatalElement.innerText = formatPersentaseBatalPO(percentCanceledMonthJSPO) + '%';
//       break;
//     default:
//       chartsPO.updateOptions({
//         series: datasWeekJS,
//       });
//       periodeElement.innerText = 'Weekly';
//       terbayarElement.innerText = 'Rp.' + datasWeekJSPO[0].toLocaleString();
//       belumTerbayarElement.innerText = ' Rp.' + datasWeekJSPO[1].toLocaleString();
//       batalElement.innerText = 'Rp.' + datasWeekJSPO[2].toLocaleString();
//       persenTerbayarElement.innerText = formatPersentaseTerbayarPO(percentInWeekJSPO) + '%';
//       persenBlmTerbayarElement.innerText = formatPersentasePO(percentNotPaidWeekJSPO) + '%';
//       persenBatalElement.innerText = formatPersentaseBatalPO(percentCanceledWeekJSPO) + '%';
//       break;
//   }

// }

// function formatPersentaseTerbayarPO(persen) {
//   const persenTerbayarElement = document.getElementById('persenTerbayarPO');
//   if (persen < 0) {
//     persenTerbayarElement.classList.remove('badge', 'bg-primary');
//     persenTerbayarElement.classList.add('badge', 'bg-danger');
//     return persen;
//   } else {
//     persenTerbayarElement.classList.remove('badge', 'bg-danger');
//     persenTerbayarElement.classList.add('badge', 'bg-primary');
//     return '+' + persen;
//   }
// }

// function formatPersentasePO(persen) {
//   const persenBlmTerbayarElement = document.getElementById('persenBlmTerbayarPO');

//   if (persen > 0) {
//     persenBlmTerbayarElement.classList.remove('badge', 'bg-primary');
//     persenBlmTerbayarElement.classList.add('badge', 'bg-danger');
//     return '+' + persen;
//   } else {
//     persenBlmTerbayarElement.classList.remove('badge', 'bg-danger');
//     persenBlmTerbayarElement.classList.add('badge', 'bg-primary');
//     return persen;
//   }
// }

// function formatPersentaseBatalPO(persen) {
//   const persenBatalElement = document.getElementById('persenBatalPO');
//   if (persen > 0) {
//     persenBatalElement.classList.remove('badge', 'bg-primary');
//     persenBatalElement.classList.add('badge', 'bg-danger');
//     return '+' + persen;
//   }
//   persenBatalElement.classList.remove('badge', 'bg-danger');
//   persenBatalElement.classList.add('badge', 'bg-primary');

//   return persen
// }