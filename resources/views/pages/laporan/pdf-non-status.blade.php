<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Invoice {{ $namaInvoice }} {{ $periode }}</title>
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
    .kpi-card.is-warning { border-left-color: #D97706; }
    .kpi-card.is-success { border-left-color: #16A34A; }
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
      padding: 11px 12px;
      border-bottom: 1px solid #E2E8F0;
      vertical-align: top;
      color: #1E293B;
    }
    .col-no {
      width: 42px;
      text-align: center;
      color: #64748B !important;
    }
    .inv-no {
      font-weight: 600;
      color: #0F172A;
      white-space: nowrap;
    }
    .cust-name {
      font-weight: 600;
      color: #0F172A;
    }
    .cust-sub {
      font-size: 10.5px;
      color: #64748B;
      margin-top: 1px;
    }
    .item-list {
      display: flex;
      flex-direction: column;
    }
    .item-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 16px;
      padding: 6px 0;
    }
    .item-row:first-child { padding-top: 0; }
    .item-row:last-child { padding-bottom: 0; }
    .item-row + .item-row {
      border-top: 1px dashed #E2E8F0;
    }
    .item-name {
      font-weight: 600;
      color: #0F172A;
    }
    .item-desc {
      font-size: 10.5px;
      color: #64748B;
      margin-top: 1px;
    }
    .item-qty {
      font-weight: 500;
      color: #334155;
      white-space: nowrap;
      flex-shrink: 0;
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
    .status-note {
      display: block;
      font-size: 10px;
      color: #64748B;
      margin-top: 2px;
    }
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
  $activePenjualans = $penjualans->filter(fn($p) => empty($p->deleted_at) && ($p->status ?? '') !== 'Batal');
  $sumTagihan = $activePenjualans->sum('total_pembayaran');
  $sumLunas = $activePenjualans->filter(fn($p) => strtolower(trim($p->status ?? '')) === 'lunas')->sum('total_pembayaran');
  $sumBelum = $activePenjualans->filter(fn($p) => strtolower(trim($p->status ?? '')) !== 'lunas')->sum('total_pembayaran');
  $brandLabel = !empty($namaPerusahaan) ? $namaPerusahaan : (!empty($namaInvoice) ? $namaInvoice : 'Ibeka');
  $invLabel = !empty($namaInvoice) ? $namaInvoice : 'Semua invoice';
  $periodeLabel = !empty($periode) ? $periode : 'seluruh status';
  $printedDate = !empty($tanggal) ? $tanggal : \Carbon\Carbon::now()->translatedFormat('d F Y');
@endphp
<div class="report-wrap">
  <div class="no-print-bar">
    <button type="button" class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>
  </div>

  <div class="report-brand">{{ $brandLabel }}</div>
  <h1 class="report-title">Laporan invoice</h1>
  <div class="report-meta">
    <div class="report-subtitle">{{ $invLabel }}, {{ $periodeLabel }}</div>
    <div class="report-date">Dicetak {{ $printedDate }}</div>
  </div>
  <hr class="report-divider">

  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-label">Jumlah invoice</div>
      <div class="kpi-value">{{ $penjualans->count() }}</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-label">Total tagihan</div>
      <div class="kpi-value">Rp {{ number_format($sumTagihan, 0, ',', '.') }}</div>
    </div>
    <div class="kpi-card is-warning">
      <div class="kpi-label">Belum lunas</div>
      <div class="kpi-value">Rp {{ number_format($sumBelum, 0, ',', '.') }}</div>
    </div>
    <div class="kpi-card is-success">
      <div class="kpi-label">Lunas</div>
      <div class="kpi-value">Rp {{ number_format($sumLunas, 0, ',', '.') }}</div>
    </div>
  </div>

  <table class="report-table">
    <thead>
      <tr>
        <th class="col-no">No</th>
        <th>No invoice</th>
        <th>Tanggal</th>
        <th>Customer</th>
        <th>Deskripsi item</th>
        <th class="text-right">Total</th>
        <th class="text-center">Status</th>
        <th class="text-center">Potongan / PPN</th>
        <th class="text-right">Grand total</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($penjualans as $jual)
      <tr>
        <td class="col-no">{{ $loop->iteration }}</td>
        <td class="inv-no">{{ $jual->nomor_invoice }}</td>
        <td style="white-space: nowrap;">{{ $jual->formatted_tgl_penjualan }}</td>
        <td>
          <div class="cust-name">{{ $jual->customer ?: '-' }}</div>
          @if(!empty($jual->perusahaan) && $jual->perusahaan !== '-')
            <div class="cust-sub">{{ $jual->perusahaan }}</div>
          @endif
          <div class="cust-sub">{{ $jual->no_telepon ?? '-' }}</div>
        </td>
        <td>
          <div class="item-list">
            @forelse($jual->items ?? [] as $item)
              <div class="item-row">
                <div>
                  <div class="item-name">{{ $item->jenis_barang ?? '-' }}</div>
                  @if(!empty($item->deskripsi_item))
                    <div class="item-desc">{{ $item->deskripsi_item }}</div>
                  @endif
                </div>
                <div class="item-qty">{{ $item->qty ?? '' }} {{ $item->satuan ?? '' }}</div>
              </div>
            @empty
              <span style="color:#94A3B8;">—</span>
            @endforelse
          </div>
        </td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($jual->total_harga ?? 0, 0, ',', '.') }}</td>
        <td class="text-center">
          @if(!empty($jual->deleted_at))
            <span class="status-pill status-batal">Dihapus</span>
            @if(!empty($jual->alasan_hapus))
              <span class="status-note">({{ $jual->alasan_hapus }})</span>
            @endif
          @elseif(($jual->status ?? '') == 'Batal')
            <span class="status-pill status-batal">Batal</span>
            @if(!empty($jual->alasan_batal))
              <span class="status-note">({{ $jual->alasan_batal }})</span>
            @endif
          @elseif(strtolower(trim($jual->status ?? '')) === 'lunas')
            <span class="status-pill status-lunas">Lunas</span>
          @else
            <span class="status-pill status-belum">{{ ucfirst(strtolower($jual->status ?? 'Belum lunas')) }}</span>
          @endif
        </td>
        <td class="text-center" style="color:#64748B;">{{ !empty($jual->lain) && $jual->lain !== '-' ? $jual->lain : '—' }}</td>
        <td class="text-right" style="white-space: nowrap; font-weight: 600;">Rp {{ number_format($jual->total_pembayaran ?? 0, 0, ',', '.') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="9" class="text-center" style="padding: 28px; color: #64748B;">Tidak ada data invoice.</td>
      </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td colspan="8" class="text-right">Total keseluruhan</td>
        <td class="text-right" style="white-space: nowrap;">Rp {{ number_format($penjualans->sum('total_pembayaran'), 0, ',', '.') }}</td>
      </tr>
    </tfoot>
  </table>

  <div class="report-footer-note">Laporan invoice &middot; {{ $brandLabel }}</div>
</div>
</body>
</html>
