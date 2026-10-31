/**
 * dashboard-barang.js
 * Grafik Jenis Barang & Kategori Barang yang Dibeli dengan Fitur Filter Interaktif
 */

let chartJenis = null;
let chartKategori = null;
let currentJenisMetric = 'qty'; // 'qty' atau 'nominal'
let currentBarangData = null;

// Palette 8 warna kontras tinggi (tanpa pengulangan rumpun warna):
// 1. Oranye Emas (#F59E0B), 2. Biru Langit (#38BDF8), 3. Hijau Emerald (#10B981), 4. Ungu Violet (#A855F7),
// 5. Merah Menyala (#EF4444), 6. Kuning Lemon Muda (#FEF08A), 7. Pink Cerah (#F472B6), 8. Abu-abu Perak (#94A3B8)
const colorPalette = [
    '#F59E0B', '#38BDF8', '#10B981', '#A855F7',
    '#EF4444', '#FEF08A', '#F472B6', '#94A3B8'
];

/**
 * Mengambil data barang dan kategori dari backend berdasarkan parameter filter
 */
function fetchDataBarang(params = {}) {
    const spinner = document.getElementById('spinner-barang');
    if (spinner) spinner.style.display = 'inline-block';

    const jenisContainer = document.getElementById('chart_jenis_barang');
    const katContainer = document.getElementById('chart_kategori_barang');
    const tbodyKat = document.getElementById('table-kategori-body');
    if (jenisContainer) jenisContainer.classList.add('dash-loading-dim');
    if (katContainer) katContainer.classList.add('dash-loading-dim');
    if (tbodyKat) tbodyKat.classList.add('dash-loading-dim');

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
        if (jenisContainer) jenisContainer.classList.remove('dash-loading-dim');
        if (katContainer) katContainer.classList.remove('dash-loading-dim');
        if (tbodyKat) tbodyKat.classList.remove('dash-loading-dim');
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
    const subJenisEl = document.getElementById('jenis-barang-subtitle');
    if (subJenisEl) {
        const cleanLabel = (label || 'Bulan Ini').replace(/^Bulan Ini\s*\((.*)\)$/i, '$1');
        subJenisEl.textContent = `Top 8 berdasarkan ${currentJenisMetric === 'qty' ? 'jumlah' : 'nilai'} · ${cleanLabel}`;
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(subJenisEl);
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

    const topJenisQty = (data.jenis_barang && Array.isArray(data.jenis_barang.qty) && data.jenis_barang.qty.length > 0)
        ? Number(data.jenis_barang.qty[0]).toLocaleString('id-ID') + ' Pcs'
        : '';
    const topKategoriQty = (data.kategori_barang && Array.isArray(data.kategori_barang.qty) && data.kategori_barang.qty.length > 0)
        ? Number(data.kategori_barang.qty[0]).toLocaleString('id-ID') + ' Pcs'
        : '';

    const rawQtyNum = Number(sum.total_qty ?? String(sum.total_qty_formatted || '0').replace(/[^\d]/g, '')) || 0;
    const rawNominalNum = Number(sum.total_nominal ?? String(sum.total_nominal_formatted || '0').replace(/[^\d]/g, '')) || 0;

    if (totalQtyEl) {
        if (typeof window.animateDashNumber === 'function') {
            window.animateDashNumber(totalQtyEl, rawQtyNum, '', ' Pcs', 420);
        } else {
            totalQtyEl.textContent = sum.total_qty_formatted || '0 Pcs';
        }
    }
    if (totalNominalEl) {
        if (typeof window.animateDashNumber === 'function') {
            window.animateDashNumber(totalNominalEl, rawNominalNum, 'Rp ', '', 420);
        } else {
            totalNominalEl.textContent = sum.total_nominal_formatted || 'Rp 0';
        }
    }
    if (topJenisEl) {
        const raw = sum.top_jenis || '-';
        const cleanName = raw.replace(/\s*\([^)]*\)\s*$/, '').trim();
        topJenisEl.innerHTML = `<span class="ref-kpi-main-title">${cleanName}</span> ${topJenisQty ? `<span class="ref-kpi-sub-count">${topJenisQty}</span>` : ''}`;
        topJenisEl.setAttribute('title', `${cleanName} ${topJenisQty}`);
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(topJenisEl);
    }
    if (topKategoriEl) {
        const raw = sum.top_kategori || '-';
        const cleanName = raw.replace(/\s*\([^)]*\)\s*$/, '').trim();
        topKategoriEl.innerHTML = `<span class="ref-kpi-main-title">${cleanName}</span> ${topKategoriQty ? `<span class="ref-kpi-sub-count">${topKategoriQty}</span>` : ''}`;
        topKategoriEl.setAttribute('title', `${cleanName} ${topKategoriQty}`);
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(topKategoriEl);
    }
    if (badgeKategoriEl) {
        badgeKategoriEl.textContent = (sum.total_kategori_count || 0) + ' Kategori';
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(badgeKategoriEl);
    }

    // Sinkronisasi ke Kartu Ke-4 pada Top Executive Summary Strip (TOTAL PRODUK TERJUAL)
    const topProdukBadgeEl = document.getElementById('top-kpi-produk-badge');
    const topProdukQtyEl = document.getElementById('top-kpi-produk-qty');
    const topProdukSubEl = document.getElementById('top-kpi-produk-sub');
    const cleanTopKat = (sum.top_kategori || '-').replace(/\s*\([^)]*\)\s*$/, '').trim();

    if (topProdukBadgeEl) {
        topProdukBadgeEl.textContent = 'Top: ' + (cleanTopKat || '-');
        topProdukBadgeEl.setAttribute('title', 'Kategori Terlaris: ' + (cleanTopKat || '-'));
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(topProdukBadgeEl);
    }
    if (topProdukQtyEl) {
        if (typeof window.animateDashNumber === 'function') {
            window.animateDashNumber(topProdukQtyEl, rawQtyNum, '', ' Pcs', 420);
        } else {
            topProdukQtyEl.textContent = sum.total_qty_formatted || '0 Pcs';
        }
    }
    if (topProdukSubEl) {
        topProdukSubEl.textContent = 'Dari ' + (sum.total_kategori_count || 0) + ' kategori barang aktif';
        if (typeof window.triggerFilterSwap === 'function') window.triggerFilterSwap(topProdukSubEl);
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

    if (currentBarangData) {
        updatePeriodeLabel(currentBarangData.period_label);
        if (currentBarangData.jenis_barang) {
            renderChartJenis(currentBarangData.jenis_barang);
        }
    }
}

/**
 * Render Grafik Jenis Barang (Custom Progress-Track Horizontal List sesuai referensi desain)
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

    if (chartJenis && typeof chartJenis.destroy === 'function') {
        chartJenis.destroy();
        chartJenis = null;
    }

    const isQty = currentJenisMetric === 'qty';
    const items = data.labels.map((lbl, idx) => ({
        label: lbl || '-',
        qty: (data.qty && Number(data.qty[idx])) || 0,
        nominal: (data.nominal && Number(data.nominal[idx])) || 0
    }));

    // Urutkan berdasarkan metrik aktif (Qty atau Nilai Rp) dari terbesar ke terkecil
    items.sort((a, b) => isQty ? (b.qty - a.qty) : (b.nominal - a.nominal));

    const topItems = items.slice(0, 8);
    const maxVal = Math.max(...topItems.map(it => isQty ? it.qty : it.nominal), 1);
    const rowModifier = isQty ? '' : 'ref-jenis-row--nominal';

    let html = `<div class="ref-jenis-list">`;
    topItems.forEach((item, i) => {
        const val = isQty ? item.qty : item.nominal;
        const pct = Math.max(2, Math.min(100, (val / maxVal) * 100));
        const color = colorPalette[i % colorPalette.length];
        const displayVal = isQty
            ? val.toLocaleString('id-ID')
            : 'Rp ' + val.toLocaleString('id-ID');
        const delayMs = i * 75;

        html += `
            <div class="ref-jenis-row ${rowModifier} dash-row-anim" style="animation-delay: ${delayMs}ms;" title="${item.label} — ${item.qty.toLocaleString('id-ID')} Pcs (Rp ${item.nominal.toLocaleString('id-ID')})">
                <div class="ref-jenis-name text-truncate">${item.label}</div>
                <div class="ref-jenis-track">
                    <div class="ref-jenis-fill" data-target-width="${pct.toFixed(1)}%" style="width: 0%; background: ${color}; box-shadow: 0 0 12px ${color}66;"></div>
                </div>
                <div class="ref-jenis-val tabular-nums">${displayVal}</div>
            </div>
        `;
    });
    html += `</div>`;
    container.innerHTML = html;

    container.querySelectorAll('.ref-jenis-fill').forEach((bar, i) => {
        setTimeout(() => {
            bar.style.width = bar.getAttribute('data-target-width') || '0%';
        }, 110 + i * 75);
    });
}

/**
 * Render Grafik Kategori Barang (Donut Chart dengan Legend di Kanan sesuai referensi)
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

    const isLightMode = document.body.classList.contains('theme-light');
    const options = {
        series: data.qty,
        labels: data.labels,
        chart: {
            type: 'donut',
            height: 205,
            fontFamily: "'Plus Jakarta Sans', 'Inter', sans-serif",
            toolbar: {
                show: false
            }
        },
        colors: colorPalette.slice(0, data.labels.length),
        stroke: { width: 0 },
        plotOptions: {
            pie: {
                donut: {
                    size: '72%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '11px',
                            fontWeight: 500,
                            color: isLightMode ? '#64748B' : '#94A3B8',
                            offsetY: -5
                        },
                        value: {
                            show: true,
                            fontSize: '18px',
                            fontFamily: "'Plus Jakarta Sans', 'Inter', sans-serif",
                            fontWeight: 800,
                            color: isLightMode ? '#0F172A' : '#FFFFFF',
                            offsetY: 5,
                            formatter: function (val) {
                                return parseInt(val).toLocaleString('id-ID') + ' pcs';
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total Qty',
                            fontSize: '11px',
                            fontWeight: 500,
                            color: isLightMode ? '#64748B' : '#94A3B8',
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
            position: 'right',
            fontSize: '12px',
            fontWeight: 500,
            labels: {
                colors: isLightMode ? '#334155' : '#CBD5E1'
            },
            markers: {
                width: 8,
                height: 8,
                radius: 12
            },
            itemMargin: {
                horizontal: 6,
                vertical: 4
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
                    <div class="px-3 py-2 rounded-3 text-light" style="min-width: 170px; background: rgba(15, 19, 34, 0.96); border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 12px 28px rgba(0,0,0,0.65);">
                        <div class="fw-bold fs-13 mb-1 border-bottom pb-1" style="color: #F59E0B; border-color: rgba(255,255,255,0.08) !important;">${label}</div>
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
                    height: 230
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
        const pctStr = String(item.percentage).replace('.', ',');
        const qtyClean = String(item.qty_formatted || item.qty || 0).replace(/\s*pcs$/i, '');
        const itemColor = colorPalette[idx % colorPalette.length];
        const delayMs = Math.min(idx * 75, 450);
        rowsHtml += `
            <tr class="dash-row-anim" style="animation-delay: ${delayMs}ms;">
                <td>
                    <span class="d-inline-flex align-items-center gap-2">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: ${itemColor}; box-shadow: 0 0 8px ${itemColor}88; display: inline-block; flex-shrink: 0;"></span>
                        <span class="fw-semibold text-white">${item.nama}</span>
                    </span>
                </td>
                <td class="text-center fw-medium tabular-nums" style="color: #CBD5E1;">${qtyClean}</td>
                <td class="text-end tabular-nums" style="color: #CBD5E1;">${item.nominal_formatted}</td>
                <td class="text-end">
                    <span class="ref-pct-pill tabular-nums" style="background: ${itemColor}22; border-color: ${itemColor}55; color: ${itemColor};">${pctStr}%</span>
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
        timeFrame('year');
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
        const dayWidth = typeof window.setPaymentChartScrollableWidth === 'function'
            ? window.setPaymentChartScrollableWidth((data.chart_data.categories || []).length, 62)
            : '100%';
        window.chart.updateOptions({
            chart: { width: dayWidth },
            dataLabels: { enabled: false },
            series: data.chart_data.series,
            colors: ['#F59E0B'],
            xaxis: {
                type: 'category',
                categories: data.chart_data.categories,
                labels: {
                    rotate: 0,
                    hideOverlappingLabels: false,
                    style: { colors: '#94A3B8', fontSize: '11px' },
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            yaxis: {
                min: 0,
                tickAmount: 4,
                forceNiceScale: true,
                labels: {
                    style: { colors: '#64748B', fontSize: '11px' },
                    formatter: function (val) {
                        return typeof formatYAxisIndo === 'function' ? formatYAxisIndo(val) : "Rp " + val.toLocaleString('id-ID');
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 4,
                    columnWidth: "54%",
                    endingShape: "rounded",
                    colors: { ranges: [] }
                }
            }
        });
    } else if (data.view_type === 'range') {
        const seriesData = data.chart_data.series[0].data;
        const minVal = seriesData.length > 0 ? Math.min(...seriesData, 0) : 0;
        const maxVal = seriesData.length > 0 ? Math.max(...seriesData, 0) : 0;
        const safeMax = maxVal > 0 ? Math.ceil((maxVal * 1.12) / 2000000) * 2000000 : 4000000;
        const safeMin = minVal < 0 ? (minVal < -1500000 ? Math.floor((minVal * 1.15) / 1000000) * 1000000 : -2000000) : 0;
        const rangeWidth = typeof window.setPaymentChartScrollableWidth === 'function'
            ? window.setPaymentChartScrollableWidth((data.chart_data.categories || []).length, 62)
            : '100%';

        window.chart.updateOptions({
            chart: { width: rangeWidth },
            dataLabels: {
                enabled: true,
                offsetY: -18,
                style: {
                    fontSize: '10px',
                    fontWeight: 600,
                    colors: ['#CBD5E1']
                },
                formatter: function (val) {
                    if (!val || val === 0 || val === -500000) return '';
                    const abs = Math.abs(val);
                    const sign = val < 0 ? '-' : '';
                    if (abs >= 1000000) return sign + (abs / 1000000).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + 'jt';
                    if (abs >= 1000) return sign + Math.round(abs / 1000) + 'rb';
                    return sign + abs;
                }
            },
            series: data.chart_data.series,
            colors: ['#F59E0B'],
            xaxis: {
                type: 'category',
                categories: data.chart_data.categories,
                labels: {
                    rotate: 0,
                    hideOverlappingLabels: false,
                    style: { colors: '#94A3B8', fontSize: '11px', fontWeight: 600 },
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            yaxis: {
                min: safeMin,
                max: safeMax,
                tickAmount: 4,
                forceNiceScale: false,
                labels: {
                    style: { colors: '#64748B', fontSize: '11px' },
                    formatter: function (val) {
                        return typeof formatYAxisIndo === 'function' ? formatYAxisIndo(val) : "Rp " + val.toLocaleString('id-ID');
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: false,
                    borderRadius: 4,
                    columnWidth: "56%",
                    dataLabels: {
                        position: 'top'
                    },
                    colors: {
                        ranges: [
                            { from: -Infinity, to: -1, color: '#F87171' },
                            { from: 0, to: Infinity, color: '#F59E0B' }
                        ]
                    }
                }
            }
        });
    } else if (data.view_type === 'year') {
        const formulaData = (data.chart_data.series[0].data || []).map(v => Math.max(0, Number(v) || 0));
        const asliData = data.chart_data.series.length > 1 ? data.chart_data.series[1].data : [];
        const maxVal = Math.max(...formulaData, ...asliData, 0);
        const safeMax = maxVal > 150000000 ? 200000000 : (maxVal > 5000000 ? Math.ceil(maxVal / 50000000) * 50000000 : 50000000);
        const yearWidth = typeof window.setPaymentChartScrollableWidth === 'function'
            ? window.setPaymentChartScrollableWidth((data.chart_data.categories || []).length, 68)
            : '100%';

        const updatedSeries = [
            { name: "Pendapatan Bersih", data: formulaData },
            { name: "Pendapatan Asli", data: asliData }
        ];

        window.chart.updateOptions({
            chart: { width: yearWidth },
            dataLabels: { enabled: false },
            series: updatedSeries,
            colors: ['#F59E0B', '#34D399'],
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
                min: 0,
                max: safeMax,
                tickAmount: 4,
                forceNiceScale: false,
                labels: {
                    style: { colors: '#64748B', fontSize: '11px' },
                    formatter: function (val) {
                        if (val === 0) return "0";
                        return Math.round(val / 1000000).toString();
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: false,
                    borderRadius: 5,
                    columnWidth: "46%",
                    colors: {
                        ranges: []
                    }
                }
            }
        });
    }

    // Perbarui Structure Widget (Donut Chart) jika ada datanya
    if (window.charts && data.structure) {
        const structSeries = (data.structure.series || [0, 0, 0]).map(v => Number(v) || 0);
        const sumSeries = structSeries.reduce((a, b) => a + b, 0);
        const widgetEmpty = document.getElementById('structure_widget_empty');
        const widgetChart = document.getElementById('structure_widget');
        const heroAkumulasiEl = document.getElementById('hero-pendapatan-akumulasi');

        if (sumSeries === 0) {
            if (widgetEmpty) widgetEmpty.style.display = 'block';
            if (widgetChart) widgetChart.style.display = 'none';
        } else {
            if (widgetEmpty) widgetEmpty.style.display = 'none';
            if (widgetChart) widgetChart.style.display = 'block';
            window.charts.updateOptions({
                series: structSeries,
                colors: ["#34D399", "#EF4444", "#64748B"]
            });
        }

        if (heroAkumulasiEl) {
            if (typeof window.animateDashNumber === 'function') {
                window.animateDashNumber(heroAkumulasiEl, sumSeries, 'Rp ', '', 420);
            } else {
                heroAkumulasiEl.innerText = 'Rp ' + sumSeries.toLocaleString('id-ID');
            }
        }

        const terbayarEl = document.getElementById('terbayar');
        const belumTerbayarEl = document.getElementById('belumTerbayar');
        const batalEl = document.getElementById('batal');
        const periodeEl = document.getElementById('periode');
        const tagKasEl = document.getElementById('tag-periode-kas');
        const persenTerbayarEl = document.getElementById('persenTerbayar');
        const persenBlmTerbayarEl = document.getElementById('persenBlmTerbayar');
        const persenBatalEl = document.getElementById('persenBatal');

        if (terbayarEl) {
            if (typeof window.animateDashNumber === 'function') window.animateDashNumber(terbayarEl, structSeries[0], 'Rp ', '', 420);
            else terbayarEl.innerText = (data.structure.terbayar_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        }
        if (belumTerbayarEl) {
            if (typeof window.animateDashNumber === 'function') window.animateDashNumber(belumTerbayarEl, structSeries[1], 'Rp ', '', 420);
            else belumTerbayarEl.innerText = (data.structure.belum_terbayar_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        }
        if (batalEl) {
            if (typeof window.animateDashNumber === 'function') window.animateDashNumber(batalEl, structSeries[2], 'Rp ', '', 420);
            else batalEl.innerText = (data.structure.batal_formatted || 'Rp 0').replace('Rp. ', 'Rp ');
        }
        if (periodeEl) periodeEl.innerText = data.period_label;
        if (tagKasEl) tagKasEl.innerText = data.period_label;

        const pct0 = sumSeries > 0 ? ((structSeries[0] / sumSeries) * 100) : 0;
        const pct1 = sumSeries > 0 ? ((structSeries[1] / sumSeries) * 100) : 0;
        const pct2 = sumSeries > 0 ? ((structSeries[2] / sumSeries) * 100) : 0;

        if (persenTerbayarEl) {
            persenTerbayarEl.className = 'ref-status-pill ref-status-pill--emerald tabular-nums';
            persenTerbayarEl.innerText = (pct0 === 0 ? '0%' : pct0.toFixed(1).replace('.', ',') + '%');
        }
        if (persenBlmTerbayarEl) {
            persenBlmTerbayarEl.className = 'ref-status-pill ref-status-pill--danger tabular-nums';
            persenBlmTerbayarEl.innerText = (pct1 === 0 ? '0%' : pct1.toFixed(1).replace('.', ',') + '%');
        }
        if (persenBatalEl) {
            persenBatalEl.className = 'ref-status-pill ref-status-pill--slate tabular-nums';
            persenBatalEl.innerText = (pct2 === 0 ? '0%' : pct2.toFixed(1).replace('.', ',') + '%');
        }

        if (typeof window.triggerFilterSwap === 'function') {
            window.triggerFilterSwap('#harga .ref-summary-box');
            window.triggerFilterSwap('.ref-status-row');
            window.triggerFilterSwap('#periode');
            window.triggerFilterSwap('#payment_chart_scroll_wrapper');
        }
    }
}

// Inisialisasi awal saat DOM siap
document.addEventListener('DOMContentLoaded', function () {
    // Muat data default (Bulan Ini)
    fetchDataBarang({ filter: 'month' });
});
