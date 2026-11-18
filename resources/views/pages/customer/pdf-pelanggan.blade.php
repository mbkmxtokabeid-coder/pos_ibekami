<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Daftar Data Pelanggan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @page { size: portrait; margin: 12mm; }
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
      max-width: 1120px;
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
    .report-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
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
      width: 44px;
      text-align: center;
      color: #64748B !important;
    }
    .cust-name {
      font-weight: 600;
      color: #0F172A;
    }
    .muted-dash {
      color: #94A3B8;
    }
    .kat-pill {
      display: inline-block;
      padding: 3px 12px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
      background: #EEF2FF;
      color: #4338CA;
    }
    .kat-pill.kat-plakat {
      background: #FEF3C7;
      color: #B45309;
    }
    .kat-pill.kat-stempel {
      background: #DCFCE7;
      color: #15803D;
    }
    .kat-pill.kat-souvenir {
      background: #FCE7F3;
      color: #BE185D;
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
  $brandLabel = ($invoices && !empty($invoices->perusahaan)) ? $invoices->perusahaan : 'Ibeka';
  $subtitleLabel = $invoices ? 'Kategori ' . $invoices->nama_invoice . ' · Urut abjad berdasarkan nama' : 'Urut abjad berdasarkan nama';
  $printedDate = !empty($tanggal) ? $tanggal : \Carbon\Carbon::now()->translatedFormat('d F Y');
@endphp
<div class="report-wrap">
  <div class="no-print-bar">
    <button type="button" class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>
  </div>

  <div class="report-brand">{{ $brandLabel }}</div>
  <h1 class="report-title">Daftar data pelanggan</h1>
  <div class="report-meta">
    <div class="report-subtitle">{{ $subtitleLabel }}</div>
    <div class="report-date">Dicetak {{ $printedDate }}</div>
  </div>
  <hr class="report-divider">

  <table class="report-table">
    <thead>
      <tr>
        <th class="col-no">No</th>
        <th>Nama</th>
        <th>Perusahaan</th>
        <th>No telepon</th>
        <th class="text-center">Kategori</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($customers as $cust)
      @php
        $katName = '-';
        if ($invoices) {
          $katName = $invoices->nama_invoice;
        } elseif (isset($allInvoices)) {
          $katName = optional($allInvoices->where('id', $cust->invoice)->first())->nama_invoice ?? '-';
        }
        $katLower = strtolower($katName);
        $katClass = '';
        if (str_contains($katLower, 'plakat')) {
          $katClass = 'kat-plakat';
        } elseif (str_contains($katLower, 'stempel')) {
          $katClass = 'kat-stempel';
        } elseif (str_contains($katLower, 'souvenir')) {
          $katClass = 'kat-souvenir';
        }
      @endphp
      <tr>
        <td class="col-no">{{ $loop->iteration }}</td>
        <td class="cust-name">{{ $cust->customer ?: '-' }}</td>
        <td>
          @if(!empty($cust->perusahaan) && $cust->perusahaan !== '-')
            {{ $cust->perusahaan }}
          @else
            <span class="muted-dash">&mdash;</span>
          @endif
        </td>
        <td style="white-space: nowrap;">
          @if(!empty($cust->no_telepon) && $cust->no_telepon !== '-')
            {{ $cust->no_telepon }}
          @else
            <span class="muted-dash">&mdash;</span>
          @endif
        </td>
        <td class="text-center">
          @if($katName !== '-')
            <span class="kat-pill {{ $katClass }}">{{ $katName }}</span>
          @else
            <span class="muted-dash">&mdash;</span>
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center" style="padding: 28px; color: #64748B;">Tidak ada data pelanggan.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="report-footer-note">Daftar pelanggan &middot; {{ $brandLabel }}</div>
</div>
</body>
</html>
