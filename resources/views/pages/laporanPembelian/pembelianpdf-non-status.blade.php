<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Pembelian {{ $namaVendor }} {{ $periode }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @page { size: landscape; margin: 12mm; }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 28px 34px;
      background: #FFFFFF;
      color: #0F172A;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 12px;
      line-height: 1.45;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    .report-wrap {
      max-width: 1280px;
      margin: 0 auto;
    }
    .no-print-bar {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 14px;
    }
    .btn-print {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      border-radius: 8px;
      border: 1px solid #CBD5E1;
      background: #F8FAFC;
      color: #1E293B;
      font-family: inherit;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
    }
    .btn-print:hover { background: #F1F5F9; }
    .report-brand {
      font-size: 12.5px;
      font-weight: 500;
      color: #64748B;
      margin-bottom: 2px;
    }
    .report-title {
      font-size: 24px;
      font-weight: 700;
      color: #0F172A;
      letter-spacing: -0.02em;
      margin: 0;
    }
    .report-meta {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      gap: 16px;
      margin-top: 4px;
    }
    .report-subtitle {
      font-size: 12px;
      color: #64748B;
    }
    .report-date {
      font-size: 11.5px;
      color: #64748B;
      white-space: nowrap;
    }
    .report-divider {
      border: none;
      border-top: 2px solid #0F172A;
      margin: 12px 0 18px 0;
    }
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 14px;
      margin-bottom: 20px;
    }
    .kpi-card {
      background: #F8FAFC;
      border-left: 3px solid #1E293B;
      padding: 12px 16px;
    }
    .kpi-card.is-success { border-left-color: #16A34A; }
    .kpi-card.is-warning { border-left-color: #D97706; }
    .kpi-label {
      font-size: 11px;
      font-weight: 500;
      color: #64748B;
      margin-bottom: 4px;
    }
    .kpi-value {
      font-size: 19px;
      font-weight: 700;
      color: #0F172A;
      letter-spacing: -0.01em;
    }
    .report-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11.5px;
    }
    .report-table thead th {
      background: #1E293B;
      color: #FFFFFF;
      font-weight: 600;
      font-size: 11.5px;
      text-align: left;
      padding: 10px 12px;
      white-space: nowrap;
    }
    .report-table thead th.text-right,
    .report-table tbody td.text-right,
    .report-table tfoot td.text-right {
      text-align: right;
    }
    .report-table thead th.text-center,
    .report-table tbody td.text-center {
      text-align: center;
    }
    .report-table tbody td {
      padding: 10px 12px;
      border-bottom: 1px solid #E2E8F0;
      vertical-align: middle;
      color: #1E293B;
    }
    .col-no {
      width: 42px;
      text-align: center;
      color: #64748B !important;
    }
    .inv-no {
      font-weight: 500;
      color: #0F172A;
      white-space: nowrap;
    }
    .status-pill {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 999px;
      font-size: 10.5px;
      font-weight: 600;
      white-space: nowrap;
    }
    .status-lunas { background: #DCFCE7; color: #15803D; }
    .status-belum { background: #FEF3C7; color: #B45309; }
    .status-batal { background: #FEE2E2; color: #B91C1C; }
    .report-table tfoot td {
      background: #F1F5F9;
      padding: 11px 12px;
      font-weight: 700;
      color: #0F172A;
      border-top: 1px solid #CBD5E1;
      border-bottom: 1px solid #E2E8F0;
    }
    .report-footer-note {
      margin-top: 14px;
      text-align: right;
      font-size: 10.5px;
      color: #94A3B8;
    }
    @media print {
      body { padding: 0; }
      .no-print-bar { display: none !important; }
      .report-table tr { page-break-inside: avoid; }
    }
  </style>
</head>
<body>
@php
  $sumTransaksi = $pembelians->sum('jumlah_harga');
  $sumTerbayar = $pembelians->sum('terbayar');
  $sumSisa = $pembelians->sum('sisa');
  $brandLabel = !empty($namaPerusahaan) ? $namaPerusahaan : 'Ibeka';
  $vendorLabel = !empty($namaVendor) ? $namaVendor : 'Semua vendor';
  $periodeLabel = !empty($periode) ? $periode : 'seluruh status';
  $printedDate = !empty($tanggal) ? $tanggal : \Carbon\Carbon::now()->translatedFormat('d F Y');
@endphp
<div class="report-wrap">
  <div class="no-print-bar">
    <button type="button" class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>
  </div>

  <div class="report-brand">{{ $brandLabel }}</div>
  <h1 class="report-title">Laporan pembelian</h1>
  <div class="report-meta">
    <div class="report-subtitle">{{ $vendorLabel }}, {{ $periodeLabel }}</div>
    <div class="report-date">Dicetak {{ $printedDate }}</div>
  </div>
  <hr class="report-divider">

  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-label">Jumlah transaksi</div>
      <div class="kpi-value">{{ $pembelians->count() }}</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label">Total transaksi</div>
      <div class="kpi-value">Rp {{ number_format($sumTransaksi, 0, ',', '.') }}</div>
    </div>
    <div class="kpi-card is-success">
      <div class="kpi-label">Terbayar</div>
      <div class="kpi-value">Rp {{ number_format($sumTerbayar, 0, ',', '.') }}</div>
    </div>
    <div class="kpi-card is-warning">
      <div class="kpi-label">Sisa</div>
      <div class="kpi-value">Rp {{ number_format($sumSisa, 0, ',', '.') }}</div>
    </div>
  </div>

  <table class="report-table">
    <thead>
      <tr>
        <th class="col-no">No</th>
        <th>No invoice</th>
        <th>Tanggal pembelian</th>
        <th>Nama vendor</th>
        <th class="text-right">Total transaksi</th>
        <th class="text-right">Terbayar</th>
        <th class="text-right">Sisa</th>
        <th class="text-center">Status</th>
        <th class="text-right">Jatuh tempo</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($pembelians as $beli)
      <tr>
        <td class="col-no">{{ $loop->iteration }}</td>
        <td class="inv-no">{{ $beli->nomor_inv }}</td>
        <td style="white-space: nowrap;">{{ $beli->formatted_tgl_pembelian }}</td>
        <td>{{ $beli->vendor->nama_vendor ?? 'Tidak Diketahui' }}</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($beli->jumlah_harga ?? 0, 0, ',', '.') }}</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($beli->terbayar ?? 0, 0, ',', '.') }}</td>
        <td class="text-right" style="white-space: nowrap; color:#64748B;">Rp {{ number_format($beli->sisa ?? 0, 0, ',', '.') }}</td>
        <td class="text-center">
          @if(strtolower(trim($beli->status ?? '')) === 'lunas')
            <span class="status-pill status-lunas">Lunas</span>
          @elseif(strtolower(trim($beli->status ?? '')) === 'batal')
            <span class="status-pill status-batal">Batal</span>
          @else
            <span class="status-pill status-belum">{{ ucfirst(strtolower($beli->status ?? 'Belum lunas')) }}</span>
          @endif
        </td>
        <td class="text-right" style="white-space: nowrap;">{{ $beli->formatted_tgl_jto }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="9" class="text-center" style="padding: 28px; color: #64748B;">Tidak ada data pembelian.</td>
      </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" class="text-right">Total</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($sumTransaksi, 0, ',', '.') }}</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($sumTerbayar, 0, ',', '.') }}</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($sumSisa, 0, ',', '.') }}</td>
        <td colspan="2"></td>
      </tr>
    </tfoot>
  </table>

  <div class="report-footer-note">Laporan pembelian &middot; {{ $brandLabel }}</div>
</div>
</body>
</html>
