@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<style>
  :root {
    --al-bg: #0C0A09;
    --al-surface: #161311;
    --al-surface-soft: #1E1A17;
    --al-border: #2C2622;
    --al-text: #F5F5F4;
    --al-muted: #A8A29E;
    --al-accent: #EA580C;
    --al-accent-soft: rgba(234, 88, 12, 0.14);
  }
  body.theme-light {
    --al-bg: #F7F6F2;
    --al-surface: #FFFFFF;
    --al-surface-soft: #FAF9F6;
    --al-border: #E7E5E0;
    --al-text: #1C1917;
    --al-muted: #78716C;
    --al-accent: #EA580C;
    --al-accent-soft: #FFF7ED;
  }

  .al-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }
  .al-title {
    margin: 0;
    font-size: 22px;
    font-weight: 800;
    color: var(--al-text);
    letter-spacing: -0.02em;
  }
  .al-subtitle {
    margin: 4px 0 0;
    font-size: 13px;
    color: var(--al-muted);
  }
  .al-scope-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 14px;
    border-radius: 999px;
    background: var(--al-accent-soft);
    color: var(--al-accent);
    border: 1px solid rgba(234, 88, 12, 0.28);
    font-size: 12px;
    font-weight: 700;
  }

  .al-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 20px;
  }
  @media (max-width: 991px) {
    .al-kpi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }
  @media (max-width: 576px) {
    .al-kpi-grid { grid-template-columns: 1fr; }
  }
  .al-kpi-card {
    background: var(--al-surface);
    border: 1px solid var(--al-border);
    border-radius: 14px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .al-kpi-label {
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--al-muted);
    margin-bottom: 4px;
  }
  .al-kpi-val {
    font-size: 24px;
    font-weight: 800;
    color: var(--al-text);
    line-height: 1.1;
  }
  .al-kpi-icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .al-card {
    background: var(--al-surface);
    border: 1px solid var(--al-border);
    border-radius: 16px;
    overflow: hidden;
  }
  .al-card-header {
    padding: 16px 24px;
    border-bottom: 1px solid var(--al-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }
  .al-card-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: var(--al-text);
  }
  .al-toolbar {
    padding: 14px 24px;
    border-bottom: 1px solid var(--al-border);
    background: var(--al-surface-soft);
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }
  .al-search-wrap {
    position: relative;
    flex: 1 1 240px;
    max-width: 320px;
  }
  .al-search-wrap i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--al-muted);
    pointer-events: none;
  }
  .al-input,
  .al-select {
    height: 38px;
    border-radius: 10px;
    border: 1px solid var(--al-border);
    background: var(--al-surface);
    color: var(--al-text);
    font-size: 13px;
    padding: 0 12px;
    outline: none;
  }
  .al-search-wrap .al-input {
    width: 100%;
    padding-left: 34px;
  }
  .al-input:focus,
  .al-select:focus {
    border-color: var(--al-accent);
  }
  .al-btn {
    height: 38px;
    padding: 0 14px;
    border-radius: 10px;
    font-size: 12.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid var(--al-border);
    background: var(--al-surface);
    color: var(--al-text);
    cursor: pointer;
    text-decoration: none;
  }
  .al-btn:hover {
    border-color: var(--al-accent);
    color: var(--al-accent);
  }
  .al-btn-primary {
    background: #EA580C;
    border-color: #EA580C;
    color: #FFFFFF;
  }
  .al-btn-primary:hover {
    background: #C2410C;
    color: #FFFFFF;
  }

  .al-table-wrap {
    overflow-x: auto;
    position: relative;
  }
  .al-table-wrap .row {
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  .al-table-wrap .row > [class*="col-"] {
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
  .al-card .dataTables_wrapper {
    position: relative;
    min-height: 240px;
    width: 100%;
  }
  /* Custom Warm Stone + Orange Dual-Ring Loader (Light & Dark Mode) */
  .al-card div.dataTables_processing,
  .al-card div.dt-processing {
    position: absolute !important;
    top: 135px !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
    margin: 0 !important;
    width: auto !important;
    min-width: 210px !important;
    padding: 16px 24px !important;
    border-radius: 14px !important;
    background: var(--al-surface) !important;
    border: 1px solid var(--al-border) !important;
    box-shadow: 0 16px 38px rgba(0, 0, 0, 0.28), 0 0 0 1px rgba(234, 88, 12, 0.14) !important;
    color: var(--al-text) !important;
    z-index: 20 !important;
    text-align: center !important;
  }
  body.theme-light .al-card div.dataTables_processing,
  body.theme-light .al-card div.dt-processing {
    box-shadow: 0 14px 32px rgba(28, 25, 23, 0.10), 0 0 0 1px rgba(234, 88, 12, 0.12) !important;
  }
  .al-card div.dataTables_processing > div:last-child,
  .al-card div.dt-processing > div:last-child {
    display: none !important; /* Hide default DataTables blue dots */
  }
  .al-loader-box {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }
  .al-spinner-ring {
    position: relative;
    width: 34px;
    height: 34px;
  }
  .al-spinner-ring::before,
  .al-spinner-ring::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 3px solid transparent;
  }
  .al-spinner-ring::before {
    border-top-color: #EA580C;
    border-right-color: rgba(234, 88, 12, 0.35);
    animation: alSpin 0.85s cubic-bezier(0.55, 0.15, 0.45, 0.85) infinite;
  }
  .al-spinner-ring::after {
    inset: 5px;
    border-bottom-color: #F59E0B;
    border-left-color: rgba(245, 158, 11, 0.35);
    animation: alSpinReverse 1.15s linear infinite;
  }
  .al-loader-text {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--al-text);
    letter-spacing: 0.01em;
  }
  .al-loader-sub {
    font-size: 11px;
    color: var(--al-muted);
    margin-top: -6px;
  }
  @keyframes alSpin {
    to { transform: rotate(360deg); }
  }
  @keyframes alSpinReverse {
    to { transform: rotate(-360deg); }
  }

  .al-theme-toggle {
    height: 38px;
    padding: 0 14px;
    border-radius: 999px;
    border: 1px solid var(--al-border);
    background: var(--al-surface);
    color: var(--al-text);
    font-size: 12.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .al-theme-toggle:hover {
    border-color: var(--al-accent);
    color: var(--al-accent);
  }
  table.al-table {
    width: 100% !important;
    border-collapse: collapse;
    margin: 0 !important;
  }
  table.al-table thead th {
    background: var(--al-surface-soft);
    color: var(--al-muted);
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 12px 16px;
    border-bottom: 1px solid var(--al-border) !important;
    white-space: nowrap;
  }
  table.al-table tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--al-border) !important;
    color: var(--al-text);
    font-size: 13px;
    vertical-align: middle;
  }
  .al-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    white-space: nowrap;
  }
  .al-role-pemilik  { background: rgba(124, 58, 237, 0.14); color: #7C3AED; }
  .al-role-admin    { background: rgba(37, 99, 235, 0.14); color: #2563EB; }
  .al-role-produksi { background: rgba(13, 148, 136, 0.14); color: #0D9488; }
  .al-role-stockist { background: rgba(234, 88, 12, 0.14); color: #EA580C; }
  .al-role-other    { background: rgba(120, 113, 108, 0.16); color: var(--al-muted); }

  .al-sev-info     { background: rgba(14, 165, 233, 0.14); color: #0284C7; }
  .al-sev-warning  { background: rgba(245, 158, 11, 0.16); color: #D97706; }
  .al-sev-critical { background: rgba(239, 68, 68, 0.14); color: #DC2626; }

  .al-diff-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12.5px;
  }
  .al-diff-table th,
  .al-diff-table td {
    padding: 8px 10px;
    border-bottom: 1px solid var(--al-border);
    vertical-align: top;
    word-break: break-word;
  }
  .al-diff-table th {
    background: var(--al-surface-soft);
    color: var(--al-muted);
    font-size: 11px;
    text-transform: uppercase;
  }
  .al-old-val { color: #DC2626; background: rgba(239, 68, 68, 0.08); padding: 2px 6px; border-radius: 4px; display: inline-block; }
  .al-new-val { color: #16A34A; background: rgba(22, 163, 74, 0.08); padding: 2px 6px; border-radius: 4px; display: inline-block; font-weight: 600; }

  .al-card .dataTables_wrapper > .row:first-child { display: none !important; }
  .al-card .dataTables_wrapper > .row:last-child {
    padding: 14px 24px !important;
    margin: 0 !important;
    align-items: center;
  }
</style>
@endsection

@extends('layout.template')
@section('content')
<div class="page-content">
  <div class="container-fluid">

    <div class="al-page-header">
      <div>
        <h1 class="al-title"><i class="ri-history-line me-2" style="color:#EA580C;"></i>Log Activity</h1>
        <p class="al-subtitle">Rekam jejak aktivitas pengguna secara real-time dan tidak dapat dimanipulasi (immutable audit log)</p>
      </div>
      <div class="d-flex align-items-center gap-2 flex-wrap">
        <span class="al-scope-pill">
          <i class="las la-shield-alt"></i> {{ $scopeLabel }}
        </span>
        <button type="button" class="al-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
          <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
          <span id="theme-toggle-text">Mode Terang</span>
        </button>
        @if($isOwner)
          <a href="{{ route('activity-logs.export') }}" id="btnExportCsv" class="al-btn al-btn-primary">
            <i class="las la-file-csv"></i> Export CSV
          </a>
        @endif
      </div>
    </div>

    <!-- 4 KPI Cards -->
    <div class="al-kpi-grid">
      <div class="al-kpi-card">
        <div>
          <div class="al-kpi-label">Aktivitas Hari Ini</div>
          <div class="al-kpi-val">{{ number_format($totalToday, 0, ',', '.') }}</div>
        </div>
        <div class="al-kpi-icon" style="background: rgba(234,88,12,0.14); color: #EA580C;">
          <i class="ri-pulse-line"></i>
        </div>
      </div>
      <div class="al-kpi-card">
        <div>
          <div class="al-kpi-label">Aktivitas Kritis</div>
          <div class="al-kpi-val" style="color: #EF4444;">{{ number_format($criticalCount, 0, ',', '.') }}</div>
        </div>
        <div class="al-kpi-icon" style="background: rgba(239,68,68,0.14); color: #EF4444;">
          <i class="las la-exclamation-triangle"></i>
        </div>
      </div>
      <div class="al-kpi-card">
        <div>
          <div class="al-kpi-label">Pengguna Aktif Hari Ini</div>
          <div class="al-kpi-val" style="color: #10B981;">{{ number_format($activeUsersToday, 0, ',', '.') }}</div>
        </div>
        <div class="al-kpi-icon" style="background: rgba(16,185,129,0.14); color: #10B981;">
          <i class="las la-users"></i>
        </div>
      </div>
      <div class="al-kpi-card">
        <div>
          <div class="al-kpi-label">Login Gagal Hari Ini</div>
          <div class="al-kpi-val" style="color: #D97706;">{{ number_format($failedLoginsToday, 0, ',', '.') }}</div>
        </div>
        <div class="al-kpi-icon" style="background: rgba(245,158,11,0.16); color: #D97706;">
          <i class="las la-user-lock"></i>
        </div>
      </div>
    </div>

    <!-- Main Table Card -->
    <div class="al-card">
      <div class="al-card-header">
        <h2 class="al-card-title">Riwayat Aktivitas Sistem</h2>
        <span class="small" style="color: var(--al-muted);">Urutan terbaru &middot; Read-only</span>
      </div>

      <div class="al-toolbar">
        <div class="al-search-wrap">
          <i class="las la-search"></i>
          <input type="text" id="filterSearch" class="al-input" placeholder="Cari pengguna, invoice, atau deskripsi...">
        </div>

        @if(!empty($availableRoles))
          <select id="filterRole" class="al-select">
            <option value="">Semua Role</option>
            @foreach($availableRoles as $r)
              <option value="{{ $r }}">{{ $r }}</option>
            @endforeach
          </select>
        @endif

        <select id="filterModule" class="al-select">
          <option value="">Semua Modul</option>
          @foreach($availableModules as $mKey => $mLabel)
            <option value="{{ $mKey }}">{{ $mLabel }}</option>
          @endforeach
        </select>

        <select id="filterSeverity" class="al-select">
          <option value="">Semua Tingkat</option>
          <option value="info">Info</option>
          <option value="warning">Warning</option>
          <option value="critical">Critical</option>
        </select>

        <input type="date" id="filterDateFrom" class="al-input" title="Dari tanggal">
        <input type="date" id="filterDateTo" class="al-input" title="Sampai tanggal">

        <button type="button" id="btnResetFilter" class="al-btn">
          <i class="las la-redo-alt"></i> Reset
        </button>
      </div>

      <div class="al-table-wrap">
        <table id="activityLogTable" class="table al-table">
          <thead>
            <tr>
              <th>Waktu</th>
              <th>Pengguna</th>
              <th>Modul</th>
              <th>Aksi</th>
              <th>Target &amp; Deskripsi</th>
              @if($isOwner)
                <th>IP</th>
              @endif
              <th style="width: 85px; text-align: center;">Detail</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Detail Modal (Before -> After) -->
<div class="modal fade" id="activityDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background: var(--al-surface); border: 1px solid var(--al-border); color: var(--al-text); border-radius: 14px;">
      <div class="modal-header" style="border-bottom: 1px solid var(--al-border);">
        <h5 class="modal-title fw-bold" style="font-size: 15.5px; color: var(--al-text);">
          <i class="ri-file-list-3-line me-1" style="color:#EA580C;"></i> Detail Aktivitas
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="activityDetailBody">
        <p class="text-muted mb-0">Memuat detail...</p>
      </div>
      <div class="modal-footer" style="border-top: 1px solid var(--al-border);">
        <button type="button" class="al-btn" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function () {
  var isOwner = @json($isOwner);

  function esc(str) {
    return String(str === null || str === undefined ? '-' : str)
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function roleClass(role) {
    var r = String(role || '').toLowerCase();
    if (r === 'pemilik') return 'al-role-pemilik';
    if (r === 'admin' || r === 'admintkb') return 'al-role-admin';
    if (r === 'produksi') return 'al-role-produksi';
    if (r === 'stockist') return 'al-role-stockist';
    return 'al-role-other';
  }

  function sevClass(sev) {
    if (sev === 'critical') return 'al-sev-critical';
    if (sev === 'warning') return 'al-sev-warning';
    return 'al-sev-info';
  }

  var columns = [
    { data: 'created_at', orderable: false, render: function (d) { return '<span style="white-space:nowrap; font-size:12px; color:var(--al-muted);">' + esc(d) + '</span>'; } },
    { data: 'user_name', orderable: false, render: function (d, t, row) {
      return '<div class="fw-semibold">' + esc(d) + '</div>' +
             '<span class="al-badge mt-1 ' + roleClass(row.user_role) + '" style="font-size:10.5px;">' + esc(row.user_role) + '</span>';
    }},
    { data: 'module', orderable: false, render: function (d) {
      return '<span class="al-badge al-role-other" style="text-transform:uppercase; font-size:10.5px;">' + esc(d) + '</span>';
    }},
    { data: 'action', orderable: false, render: function (d, t, row) {
      return '<span class="al-badge ' + sevClass(row.severity) + '">' + esc(d).replace(/_/g, ' ') + '</span>';
    }},
    { data: 'description', orderable: false, render: function (d, t, row) {
      var target = row.subject_label && row.subject_label !== '-' ? '<div class="fw-semibold" style="font-size:12.5px;">' + esc(row.subject_label) + '</div>' : '';
      return target + '<div style="font-size:12.5px; color:var(--al-muted);">' + esc(d) + '</div>';
    }}
  ];

  if (isOwner) {
    columns.push({ data: 'ip_address', orderable: false, render: function (d) {
      return '<span style="font-family:JetBrains Mono,monospace; font-size:11.5px; color:var(--al-muted);">' + esc(d) + '</span>';
    }});
  }

  columns.push({ data: 'id', orderable: false, className: 'text-center', render: function (id, t, row) {
    return '<button type="button" class="al-btn btn-al-detail" data-id="' + id + '" style="height:32px; padding:0 10px; font-size:12px;"><i class="las la-eye"></i> Detail</button>';
  }});

  var table = $('#activityLogTable').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    searching: false,
    ordering: false,
    pageLength: 25,
    ajax: {
      url: '{{ route("activity-logs.data") }}',
      data: function (d) {
        d.q = $('#filterSearch').val();
        d.role = $('#filterRole').val() || '';
        d.module = $('#filterModule').val() || '';
        d.severity = $('#filterSeverity').val() || '';
        d.date_from = $('#filterDateFrom').val() || '';
        d.date_to = $('#filterDateTo').val() || '';
      }
    },
    columns: columns,
    language: {
      processing: '<div class="al-loader-box"><div class="al-spinner-ring"></div><div class="al-loader-text">Memuat Log Activity...</div><div class="al-loader-sub">Menyinkronkan data audit</div></div>',
      emptyTable: 'Belum ada aktivitas yang tercatat.',
      info: 'Menampilkan _START_ - _END_ dari _TOTAL_ aktivitas',
      infoEmpty: '0 aktivitas',
      paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
    }
  });

  function updateExportUrl() {
    if (!isOwner) return;
    var params = $.param({
      role: $('#filterRole').val() || '',
      module: $('#filterModule').val() || '',
      severity: $('#filterSeverity').val() || '',
      date_from: $('#filterDateFrom').val() || '',
      date_to: $('#filterDateTo').val() || ''
    });
    $('#btnExportCsv').attr('href', '{{ route("activity-logs.export") }}' + (params ? '?' + params : ''));
  }

  function syncThemeBtn() {
    var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
    var icon = document.getElementById('theme-toggle-icon');
    var text = document.getElementById('theme-toggle-text');
    if (icon) icon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
    if (text) text.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
  }
  syncThemeBtn();
  $('#btn-theme-toggle').on('click', function () {
    setTimeout(syncThemeBtn, 30);
  });

  var searchTimer = null;
  $('#filterSearch').on('input', function () {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function () { table.ajax.reload(); }, 300);
  });
  $('#filterRole, #filterModule, #filterSeverity, #filterDateFrom, #filterDateTo').on('change', function () {
    updateExportUrl();
    table.ajax.reload();
  });
  $('#btnResetFilter').on('click', function () {
    $('#filterSearch, #filterRole, #filterModule, #filterSeverity, #filterDateFrom, #filterDateTo').val('');
    updateExportUrl();
    table.ajax.reload();
  });

  $(document).on('click', '.btn-al-detail', function () {
    var id = $(this).data('id');
    $('#activityDetailBody').html('<p class="text-muted mb-0">Memuat detail...</p>');
    var modal = new bootstrap.Modal(document.getElementById('activityDetailModal'));
    modal.show();

    $.get('{{ url("/activity-logs") }}/' + id)
      .done(function (res) {
        var html = '<div class="row g-2 mb-3">' +
          '<div class="col-md-6"><div class="p-2 rounded" style="background:var(--al-surface-soft); border:1px solid var(--al-border);"><div class="small text-muted">Pengguna &amp; Role</div><div class="fw-bold">' + esc(res.user_name) + ' (' + esc(res.user_role) + ')</div></div></div>' +
          '<div class="col-md-6"><div class="p-2 rounded" style="background:var(--al-surface-soft); border:1px solid var(--al-border);"><div class="small text-muted">Waktu</div><div class="fw-bold">' + esc(res.created_at) + '</div></div></div>' +
          '<div class="col-12"><div class="p-2 rounded" style="background:var(--al-surface-soft); border:1px solid var(--al-border);"><div class="small text-muted">Deskripsi</div><div class="fw-semibold">' + esc(res.description) + '</div></div></div>' +
        '</div>';

        var oldVals = res.old_values || {};
        var newVals = res.new_values || {};
        var keys = Array.from(new Set([...Object.keys(oldVals), ...Object.keys(newVals)]));

        if (keys.length > 0) {
          html += '<div class="fw-bold small text-uppercase text-muted mb-2">Perubahan Data (Before &rarr; After)</div>';
          html += '<div class="table-responsive"><table class="al-diff-table"><thead><tr><th style="width:26%;">Field</th><th style="width:37%;">Sebelum (Before)</th><th style="width:37%;">Sesudah (After)</th></tr></thead><tbody>';
          keys.forEach(function (k) {
            var ov = oldVals[k] !== undefined && oldVals[k] !== null ? (typeof oldVals[k] === 'object' ? JSON.stringify(oldVals[k]) : oldVals[k]) : '—';
            var nv = newVals[k] !== undefined && newVals[k] !== null ? (typeof newVals[k] === 'object' ? JSON.stringify(newVals[k]) : newVals[k]) : '—';
            html += '<tr><td class="fw-semibold">' + esc(k) + '</td><td><span class="al-old-val">' + esc(ov) + '</span></td><td><span class="al-new-val">' + esc(nv) + '</span></td></tr>';
          });
          html += '</tbody></table></div>';
        } else {
          html += '<div class="p-3 rounded text-center small text-muted" style="background:var(--al-surface-soft); border:1px solid var(--al-border);">Tidak ada rincian perubahan field untuk aksi ini.</div>';
        }

        if (res.can_see_technical) {
          html += '<div class="mt-3 p-2 rounded small" style="background:var(--al-surface-soft); border:1px solid var(--al-border); color:var(--al-muted);">' +
            '<div><strong>IP Address:</strong> ' + esc(res.ip_address) + '</div>' +
            '<div><strong>URL:</strong> ' + esc(res.url) + '</div>' +
            '<div><strong>Perangkat:</strong> ' + esc(res.user_agent) + '</div>' +
          '</div>';
        }

        $('#activityDetailBody').html(html);
      })
      .fail(function (xhr) {
        $('#activityDetailBody').html('<div class="alert alert-danger mb-0">' + (xhr.responseJSON && xhr.responseJSON.message ? esc(xhr.responseJSON.message) : 'Gagal memuat detail log.') + '</div>');
      });
  });
});
</script>
@endsection
