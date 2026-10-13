/**
 * dashboard-barang.js
 * Grafik Jenis Barang & Kategori Barang yang Dibeli dengan Fitur Filter Interaktif
 */

let chartJenis = null;
let chartKategori = null;
let currentJenisMetric = 'qty'; // 'qty' atau 'nominal'
let currentBarangData = null;

// Palette warna modern sesuai DESIGN.md
const colorPalette = [
    '#818CF8', '#38BDF8', '#34D399', '#FBBF24', '#F472B6',
    '#A78BFA', '#2DD4BF', '#64748B'
];

/**
 * Mengambil data barang dan kategori dari backend berdasarkan parameter filter
 */
function fetchDataBarang(params = {}) {
    const spinner = document.getElementById('spinner-barang');
    if (spinner) spinner.style.display = 'inline-block';

    const urlParams = new URLSearchParams(params);
    const url = '/dashboard/data-barang-dibeli?' + urlParams.toString();

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Gagal memuat data barang');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            currentBarangData = data;
            updateSummaryCards(data);
            updatePeriodeLabel(data.period_label);
            renderChartJenis(data.jenis_barang);
            renderChartKategori(data.kategori_barang);
            renderTableKategori(data.kategori_barang.list || []);
        }
    })
    .catch(error => {
        console.error('Error fetching data barang:', error);
    })
    .finally(() => {
        if (spinner) spinner.style.display = 'none';
    });
}

/**
 * Memperbarui label periode aktif di header
 */
function updatePeriodeLabel(label) {
    const labelEl = document.getElementById('label-periode-barang');
    if (labelEl) {
        labelEl.textContent = label || '-';
    }
}

/**
 * Memperbarui angka-angka summary card
 */
function updateSummaryCards(data) {
    const sum = data.summary || {};
    const totalQtyEl = document.getElementById('summary-total-qty');
    const totalNominalEl = document.getElementById('summary-total-nominal');
    const topJenisEl = document.getElementById('summary-top-jenis');
    const topKategoriEl = document.getElementById('summary-top-kategori');
    const badgeKategoriEl = document.getElementById('badge-total-kategori');

    if (totalQtyEl) totalQtyEl.textContent = sum.total_qty_formatted || '0 Pcs';
    if (totalNominalEl) totalNominalEl.textContent = sum.total_nominal_formatted || 'Rp 0';
    if (topJenisEl) {
        topJenisEl.textContent = sum.top_jenis || '-';
        topJenisEl.setAttribute('title', sum.top_jenis || '-');
    }
    if (topKategoriEl) {
        topKategoriEl.textContent = sum.top_kategori || '-';
        topKategoriEl.setAttribute('title', sum.top_kategori || '-');
    }
    if (badgeKategoriEl) {
        badgeKategoriEl.textContent = (sum.total_kategori_count || 0) + ' Kategori';
    }
}

/**
 * Filter cepat berdasarkan tombol preset: today, week, month, year, last_year
 */
function filterBarang(preset, btnElement) {
    // Reset status tombol filter
    document.querySelectorAll('.btn-filter-barang').forEach(btn => {
        btn.classList.remove('active');
    });

    if (btnElement) {
        btnElement.classList.add('active');
    }

    // Sembunyikan panel custom filter jika sedang terbuka
    const customPanel = document.getElementById('panel-custom-filter');
    const btnCustom = document.getElementById('btn-barang-custom');
    if (customPanel) {
        customPanel.style.setProperty('display', 'none', 'important');
    }
    if (btnCustom) {
        btnCustom.classList.remove('open', 'active');
    }

    fetchDataBarang({ filter: preset });
}

/**
 * Menampilkan / menyembunyikan panel filter custom (Unified Toolbar)
 */
function toggleCustomFilter() {
    const panel = document.getElementById('panel-custom-filter');
    const btn = document.getElementById('btn-barang-custom');
    if (!panel) return;

    const isHidden = window.getComputedStyle(panel).display === 'none';
    if (isHidden) {
        panel.style.setProperty('display', 'flex', 'important');
        if (btn) btn.classList.add('open');
        // Default ke mode aktif yang ada
        if (!window.currentBarangSubmode) {
            setBarangSubmode('date');
        }
    } else {
        panel.style.setProperty('display', 'none', 'important');
        if (btn) btn.classList.remove('open');
    }
}

/**
 * Mengatur submode filter custom statistik barang (Tanggal, Bulan, Tahun, Rentang)
 */
window.currentBarangSubmode = 'date';
function setBarangSubmode(mode) {
    window.currentBarangSubmode = mode;

    document.querySelectorAll('.barang-submode').forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-mode') === mode);
    });

    const ctrlDate = document.getElementById('barang-input-date');
    const ctrlMonth = document.getElementById('barang-ctrl-month');
    const ctrlYear = document.getElementById('barang-ctrl-year');
    const ctrlRange = document.getElementById('barang-ctrl-range');

    if (ctrlDate) ctrlDate.classList.toggle('active', mode === 'date');
    if (ctrlMonth) ctrlMonth.classList.toggle('active', mode === 'month');
    if (ctrlYear) ctrlYear.classList.toggle('active', mode === 'year');
    if (ctrlRange) ctrlRange.classList.toggle('active', mode === 'range');
}
window.setBarangSubmode = setBarangSubmode;

/**
 * Menerapkan filter custom yang diinputkan pengguna
 */
function applyCustomFilter() {
    const mode = window.currentBarangSubmode || 'date';
    const params = {
        filter: 'custom'
    };

    if (mode === 'date') {
        const val = document.getElementById('barang-input-date')?.value;
        if (!val) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan pilih tanggal terlebih dahulu!' });
            }
            return;
        }
        params.custom_type = 'date';
        params.start_date = val;
        params.end_date = val;
    } else if (mode === 'month') {
        const bulan = document.getElementById('barang-input-bulan')?.value;
        const tahun = document.getElementById('barang-input-tahun-month')?.value;
        params.custom_type = 'month_year';
        params.bulan = bulan;
        params.tahun = tahun;
    } else if (mode === 'year') {
        const tahun = document.getElementById('barang-input-year')?.value;
        params.custom_type = 'year';
        params.tahun = tahun;
    } else if (mode === 'range') {
        const start = document.getElementById('barang-range-start')?.value;
        const end = document.getElementById('barang-range-end')?.value;
        if (!start || !end) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan pilih rentang tanggal lengkap!' });
            }
            return;
        }
        params.custom_type = 'date';
        params.start_date = start;
        params.end_date = end;
    }

    // Tandai tombol preset mati, tombol custom aktif
    document.querySelectorAll('.btn-filter-barang').forEach(btn => {
        btn.classList.remove('active');
    });
    const btnCustom = document.getElementById('btn-barang-custom');
    if (btnCustom) {
        btnCustom.classList.add('active');
    }

    fetchDataBarang(params);
}

/**
 * Reset filter custom kembali ke bulan ini
 */
function resetCustomFilter() {
    const btnMonth = document.getElementById('btn-barang-month');
    if (btnMonth) {
        btnMonth.click();
    } else {
        filterBarang('month');
    }
}

/**
 * Mengganti tampilan metrik pada grafik jenis barang (Qty vs Nilai)
 */
function switchJenisMetric(metric) {
    currentJenisMetric = metric;
    const btnQty = document.getElementById('btn-metric-qty');
    const btnNominal = document.getElementById('btn-metric-nominal');

    if (metric === 'qty') {
        if (btnQty) btnQty.classList.add('active');
        if (btnNominal) btnNominal.classList.remove('active');
    } else {
        if (btnQty) btnQty.classList.remove('active');
        if (btnNominal) btnNominal.classList.add('active');
    }

    if (currentBarangData && currentBarangData.jenis_barang) {
        renderChartJenis(currentBarangData.jenis_barang);
    }
}

/**
 * Render Grafik Jenis Barang (Horizontal Bar Chart)
 */
function renderChartJenis(data) {
    const container = document.querySelector('#chart_jenis_barang');
    const emptyEl = document.getElementById('chart_jenis_empty');
    if (!container) return;

    if (!data || !data.labels || data.labels.length === 0) {
        container.style.display = 'none';
        if (emptyEl) emptyEl.style.display = 'block';
        return;
    }

    container.style.display = 'block';
    if (emptyEl) emptyEl.style.display = 'none';

    const isQty = currentJenisMetric === 'qty';
    const seriesData = isQty ? data.qty : data.nominal;
    const seriesName = isQty ? 'Jumlah Qty' : 'Nilai Penjualan';

    const options = {
        series: [{
            name: seriesName,
            data: seriesData
        }],
        chart: {
            type: 'bar',
            height: 380,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                distributed: true,
                barHeight: '70%',
                dataLabels: {
                    position: 'top'
                }
            }
        },
        colors: colorPalette.slice(0, data.labels.length),
        dataLabels: {
            enabled: true,
            textAnchor: 'start',
            offsetX: 8,
            style: {
                fontSize: '12px',
                fontWeight: 600,
                colors: ['#F1F5F9']
            },
            formatter: function (val) {
                return isQty ? val.toLocaleString('id-ID') + ' pcs' : 'Rp ' + val.toLocaleString('id-ID');
            }
        },
        xaxis: {
            categories: data.labels,
            labels: {
                style: {
                    colors: '#94A3B8',
                    fontSize: '11px'
                },
                formatter: function (val) {
                    if (isQty) {
                        return val.toLocaleString('id-ID');
                    }
                    if (val >= 1000000) {
                        return 'Rp ' + (val / 1000000).toFixed(1) + 'M';
                    } else if (val >= 1000) {
                        return 'Rp ' + (val / 1000).toFixed(0) + 'K';
                    }
                    return 'Rp ' + val;
                }
            }
        },
        yaxis: {
            labels: {
                maxWidth: 160,
                style: {
                    fontSize: '12px',
                    fontWeight: 500,
                    colors: '#CBD5E1'
                }
            }
        },
        grid: {
            borderColor: '#1E293B',
            xaxis: {
                lines: { show: true }
            },
            yaxis: {
                lines: { show: false }
            }
        },
        legend: {
            show: false
        },
        tooltip: {
            theme: 'dark',
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                const label = data.labels[dataPointIndex] || '';
                const qtyVal = (data.qty && data.qty[dataPointIndex]) || 0;
                const nominalVal = (data.nominal && data.nominal[dataPointIndex]) || 0;

                return `
                    <div class="px-3 py-2 rounded-2 text-light" style="min-width: 170px; background: #1E293B; border: 1px solid rgba(255,255,255,0.1);">
                        <div class="fw-bold fs-13 mb-1 text-primary border-bottom pb-1" style="border-color: rgba(255,255,255,0.08) !important;">${label}</div>
                        <div class="d-flex justify-content-between fs-12 py-1">
                            <span class="text-muted me-3">Qty Terjual:</span>
                            <span class="fw-semibold text-light tabular-nums">${qtyVal.toLocaleString('id-ID')} Pcs</span>
                        </div>
                        <div class="d-flex justify-content-between fs-12">
                            <span class="text-muted me-3">Nilai Total:</span>
                            <span class="fw-bold text-success tabular-nums">Rp ${nominalVal.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                `;
            }
        }
    };

    if (chartJenis) {
        chartJenis.updateOptions(options, true, true);
    } else {
        chartJenis = new ApexCharts(container, options);
        chartJenis.render();
    }
    window.chartJenis = chartJenis;
}

/**
 * Render Grafik Kategori Barang (Donut Chart)
 */
function renderChartKategori(data) {
    const container = document.querySelector('#chart_kategori_barang');
    const emptyEl = document.getElementById('chart_kategori_empty');
    if (!container) return;

    if (!data || !data.labels || data.labels.length === 0) {
        container.style.display = 'none';
        if (emptyEl) emptyEl.style.display = 'block';
        return;
    }

    container.style.display = 'block';
    if (emptyEl) emptyEl.style.display = 'none';

    const totalQty = data.qty.reduce((acc, curr) => acc + curr, 0);

    const options = {
        series: data.qty,
        labels: data.labels,
        chart: {
            type: 'donut',
            height: 290,
            toolbar: {
                show: false
            }
        },
        colors: colorPalette.slice(0, data.labels.length),
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '13px',
                            fontWeight: 600,
                            color: '#94A3B8',
                            offsetY: -5
                        },
                        value: {
                            show: true,
                            fontSize: '18px',
                            fontWeight: 700,
                            color: '#F1F5F9',
                            offsetY: 5,
                            formatter: function (val) {
                                return parseInt(val).toLocaleString('id-ID') + ' pcs';
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total Qty',
                            fontSize: '12px',
                            fontWeight: 500,
                            color: '#94A3B8',
                            formatter: function (w) {
                                return totalQty.toLocaleString('id-ID') + ' pcs';
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom',
            fontSize: '12px',
            labels: {
                colors: '#CBD5E1'
            },
            markers: {
                radius: 12
            },
            itemMargin: {
                horizontal: 8,
                vertical: 3
            }
        },
        tooltip: {
            theme: 'dark',
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                const label = data.labels[seriesIndex] || '';
                const qtyVal = (data.qty && data.qty[seriesIndex]) || 0;
                const nominalVal = (data.nominal && data.nominal[seriesIndex]) || 0;
                const percent = totalQty > 0 ? ((qtyVal / totalQty) * 100).toFixed(1) : 0;

                return `
                    <div class="px-3 py-2 rounded-2 text-light" style="min-width: 170px; background: #1E293B; border: 1px solid rgba(255,255,255,0.1);">
                        <div class="fw-bold fs-13 mb-1 text-primary border-bottom pb-1" style="border-color: rgba(255,255,255,0.08) !important;">${label}</div>
                        <div class="d-flex justify-content-between fs-12 py-1">
                            <span class="text-muted me-3">Qty:</span>
                            <span class="fw-semibold text-light tabular-nums">${qtyVal.toLocaleString('id-ID')} Pcs (${percent}%)</span>
                        </div>
                        <div class="d-flex justify-content-between fs-12">
                            <span class="text-muted me-3">Nilai Total:</span>
                            <span class="fw-bold text-success tabular-nums">Rp ${nominalVal.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                `;
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    if (chartKategori) {
        chartKategori.updateOptions(options, true, true);
    } else {
        chartKategori = new ApexCharts(container, options);
        chartKategori.render();
    }
    window.chartKategori = chartKategori;
}

/**
 * Render Tabel Rincian Kategori di bawah Donut Chart
 */
function renderTableKategori(list) {
    const tbody = document.getElementById('table-kategori-body');
    if (!tbody) return;

    if (!list || list.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-muted py-3">Tidak ada data kategori.</td>
            </tr>
        `;
        return;
    }

    let rowsHtml = '';
    list.forEach((item, idx) => {
        const color = colorPalette[idx % colorPalette.length];
        rowsHtml += `
            <tr>
                <td>
                    <span class="d-inline-block rounded-circle me-1" style="width: 8px; height: 8px; background-color: ${color};"></span>
                    <span class="fw-medium text-light">${item.nama}</span>
                </td>
                <td class="text-end fw-semibold tabular-nums text-light">${item.qty_formatted}</td>
                <td class="text-end text-muted tabular-nums">${item.nominal_formatted}</td>
                <td class="text-end">
                    <span class="dash-badge dash-badge--neutral tabular-nums">${item.percentage}%</span>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = rowsHtml;
}

/* ==========================================================================
 * FITUR FILTER CUSTOM UNTUK GRAFIK PAYMENT ACTIVITY & STRUCTURE
 * ========================================================================== */

/**
 * Menampilkan / menyembunyikan panel filter custom pada kartu Payment Activity
 */
function togglePaymentCustomFilter() {
    const panel = document.getElementById('panel-custom-filter-payment');
    const btn = document.getElementById('btn-payment-custom-toggle') || document.getElementById('btn-payment-custom');
    if (!panel) return;

    const isHidden = window.getComputedStyle(panel).display === 'none';
    if (isHidden) {
        panel.style.setProperty('display', 'flex', 'important');
        if (btn) btn.classList.add('open');
    } else {
        panel.style.setProperty('display', 'none', 'important');
        if (btn) btn.classList.remove('open');
    }
}

/**
 * Mengubah input form filter custom Payment Activity sesuai mode
 */
function changePaymentCustomMode(mode) {
    const groupStartDate = document.getElementById('group-payment-start-date');
    const groupEndDate = document.getElementById('group-payment-end-date');
    const groupBulan = document.getElementById('group-payment-bulan');
    const groupTahun = document.getElementById('group-payment-tahun');

    if (groupStartDate) groupStartDate.style.display = 'none';
    if (groupEndDate) groupEndDate.style.display = 'none';
    if (groupBulan) groupBulan.style.display = 'none';
    if (groupTahun) groupTahun.style.display = 'none';

    if (mode === 'date') {
        if (groupStartDate) groupStartDate.style.display = 'block';
        if (groupEndDate) groupEndDate.style.display = 'block';
    } else if (mode === 'month_year') {
        if (groupBulan) groupBulan.style.display = 'block';
        if (groupTahun) groupTahun.style.display = 'block';
    } else if (mode === 'year') {
        if (groupTahun) groupTahun.style.display = 'block';
    }
}

/**
 * Eksekusi filter custom pada grafik Payment Activity
 */
function applyPaymentCustomFilter() {
    const mode = document.getElementById('payment-custom-filter-mode').value;
    const params = {
        filter: 'custom',
        custom_type: mode
    };

    if (mode === 'date') {
        const start = document.getElementById('payment-start-date').value;
        const end = document.getElementById('payment-end-date').value;
        if (!start && !end) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Silakan pilih tanggal terlebih dahulu!'
            });
            return;
        }
        params.start_date = start;
        params.end_date = end || start;
    } else if (mode === 'month_year') {
        params.bulan = document.getElementById('payment-bulan').value;
        params.tahun = document.getElementById('payment-tahun').value;
    } else if (mode === 'year') {
        params.tahun = document.getElementById('payment-tahun').value;
    }

    // Ubah status tombol aktif
    const buttons = document.getElementsByClassName('tombol');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('btn-info');
        buttons[i].classList.add('btn-soft-info');
    }
    const btnCustom = document.getElementById('btn-payment-custom');
    if (btnCustom) {
        btnCustom.classList.remove('btn-soft-info');
        btnCustom.classList.add('btn-info');
    }

    fetchPaymentActivity(params);
}

/**
 * Reset filter custom Payment Activity kembali ke bulan ini
 */
function resetPaymentCustomFilter() {
    const panel = document.getElementById('panel-custom-filter-payment');
    if (panel) panel.style.display = 'none';
    const icon = document.getElementById('icon-toggle-payment-custom');
    if (icon) icon.className = 'ri-arrow-down-s-line align-middle ms-1';

    if (typeof timeFrame === 'function') {
        timeFrame('month');
    }
}

/**
 * Mengambil data Payment Activity dari backend
 */
function fetchPaymentActivity(params = {}) {
    const urlParams = new URLSearchParams(params);
    const url = '/dashboard/data-payment-activity?' + urlParams.toString();

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Gagal mengambil data Payment Activity');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            updatePaymentActivityChart(data);
        }
    })
    .catch(error => {
        console.error('Error fetching payment activity:', error);
    });
}

/**
 * Memperbarui grafik Payment Activity dan Structure Donut Chart
 */
function updatePaymentActivityChart(data) {
    const elementHarga = document.getElementById('harga');
    if (elementHarga && data.income_html) {
        elementHarga.innerHTML = data.income_html;
    }

    if (!window.chart) return;

    if (data.view_type === 'day') {
        window.chart.updateOptions({
            dataLabels: { enabled: false },
            series: data.chart_data.series,
            xaxis: {
                type: 'category',
                categories: data.chart_data.categories,
                labels: {
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            yaxis: {
                min: 0,
                forceNiceScale: true,
                labels: {
                    formatter: function (val) {
                        return "Rp " + val.toLocaleString();
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 2,
                    columnWidth: "50%",
                    endingShape: "rounded",
                    colors: { ranges: [] }
                }
            }
        });
    } else if (data.view_type === 'range') {
        const seriesData = data.chart_data.series[0].data;
        const minVal = seriesData.length > 0 ? Math.min(...seriesData, 0) : 0;
        const maxVal = seriesData.length > 0 ? Math.max(...seriesData, 0) : 0;
        const safeMax = maxVal > 0 ? (maxVal > 5000000 ? maxVal * 1.15 : 5000000) : 5000000;
        const safeMin = minVal < 0 ? (minVal <= -1000000 ? minVal * 1.2 : -1000000) : 0;

        window.chart.updateOptions({
            dataLabels: { enabled: false },
            series: data.chart_data.series,
            colors: ['#34C28B'],
            xaxis: {
                type: 'category',
                categories: data.chart_data.categories,
                labels: {
                    style: { colors: '#94A3B8', fontSize: '11px' },
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            yaxis: {
                min: safeMin,
                max: safeMax,
                tickAmount: 6,
                forceNiceScale: true,
                labels: {
                    style: { colors: '#94A3B8', fontSize: '11px' },
                    formatter: function (val) {
                        return typeof formatYAxisIndo === 'function' ? formatYAxisIndo(val) : "Rp " + val.toLocaleString('id-ID');
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: false,
                    borderRadius: 3,
                    columnWidth: "50%",
                    colors: {
                        ranges: [
                            { from: -Infinity, to: -1, color: '#E5586B' },
                            { from: 0, to: Infinity, color: '#34C28B' }
                        ]
                    }
                }
            }
        });
    } else if (data.view_type === 'year') {
        const formulaData = data.chart_data.series[0].data;
        const asliData = data.chart_data.series.length > 1 ? data.chart_data.series[1].data : [];
        const minVal = formulaData.length > 0 ? Math.min(...formulaData, 0) : 0;
        const maxVal = Math.max(...formulaData, ...asliData, 0);
        const safeMax = maxVal > 0 ? (maxVal > 5000000 ? maxVal * 1.15 : 5000000) : 5000000;
        const safeMin = minVal < 0 ? (minVal <= -1000000 ? minVal * 1.2 : -1000000) : 0;

        window.chart.updateOptions({
            dataLabels: { enabled: false },
            series: data.chart_data.series,
            colors: ['#6B73F0', '#34C28B'],
            xaxis: {
                type: 'category',
                categories: data.chart_data.categories,
                labels: {
                    style: { colors: '#94A3B8', fontSize: '11px' },
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            yaxis: {
                min: safeMin,
                max: safeMax,
                tickAmount: 6,
                forceNiceScale: true,
                labels: {
                    style: { colors: '#94A3B8', fontSize: '11px' },
                    formatter: function (val) {
                        return typeof formatYAxisIndo === 'function' ? formatYAxisIndo(val) : "Rp " + val.toLocaleString('id-ID');
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: false,
                    borderRadius: 3,
                    columnWidth: "50%",
                    colors: {
                        ranges: [
                            { from: -Infinity, to: -1, color: '#E5586B' }
                        ]
                    }
                }
            }
        });
    }

    // Perbarui Structure Widget (Donut Chart) jika ada datanya
    if (window.charts && data.structure) {
        const structSeries = data.structure.series || [0, 0, 0];
        const sumSeries = structSeries.reduce((a, b) => a + Number(b || 0), 0);
        const widgetEmpty = document.getElementById('structure_widget_empty');
        const widgetChart = document.getElementById('structure_widget');

        if (sumSeries === 0) {
            if (widgetEmpty) widgetEmpty.style.display = 'block';
            if (widgetChart) widgetChart.style.display = 'none';
        } else {
            if (widgetEmpty) widgetEmpty.style.display = 'none';
            if (widgetChart) widgetChart.style.display = 'block';
            window.charts.updateOptions({
                series: structSeries,
                colors: ["#34C28B", "#E3A33B", "#6B7686"]
            });
        }

        const terbayarEl = document.getElementById('terbayar');
        const belumTerbayarEl = document.getElementById('belumTerbayar');
        const batalEl = document.getElementById('batal');
        const periodeEl = document.getElementById('periode');
        const tagKasEl = document.getElementById('tag-periode-kas');

        if (terbayarEl) terbayarEl.innerText = (data.structure.terbayar_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        if (belumTerbayarEl) belumTerbayarEl.innerText = (data.structure.belum_terbayar_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        if (batalEl) batalEl.innerText = (data.structure.batal_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        if (periodeEl) periodeEl.innerText = data.period_label;
        if (tagKasEl) tagKasEl.innerText = data.period_label;

        if (data.structure.persen_terbayar !== undefined && typeof formatPersentaseTerbayar === 'function') {
            formatPersentaseTerbayar(data.structure.persen_terbayar);
        }
        if (data.structure.persen_belum_terbayar !== undefined && typeof formatPersentase === 'function') {
            formatPersentase(data.structure.persen_belum_terbayar);
        }
        if (data.structure.persen_batal !== undefined && typeof formatPersentaseBatal === 'function') {
            formatPersentaseBatal(data.structure.persen_batal);
        }
    }
}

// Inisialisasi awal saat DOM siap
document.addEventListener('DOMContentLoaded', function () {
    // Muat data default (Bulan Ini)
    fetchDataBarang({ filter: 'month' });
});
