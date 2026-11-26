<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Pengantar Barang (SPB) - {{ $spb->customer ?? '' }}</title>
  <link rel="shortcut icon" href="{{ asset('images/Ibekami.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    @page {
      size: 148mm 105mm;
      margin: 4mm;
    }
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 20px;
      background: #F1F5F9;
      color: #1C1917;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 12px;
      line-height: 1.45;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    .no-print-bar {
      max-width: 1060px;
      margin: 0 auto 12px auto;
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      align-items: center;
    }
    .size-pill {
      display: inline-flex;
      align-items: center;
      padding: 6px 12px;
      border-radius: 8px;
      background: #FFFFFF;
      border: 1px solid #CBD5E1;
      color: #475569;
      font-size: 12px;
      font-weight: 600;
    }
    .btn-print {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 8px;
      border: 1px solid #EA580C;
      background: #F97316;
      color: #FFFFFF;
      font-family: inherit;
      font-size: 12.5px;
      font-weight: 600;
      cursor: pointer;
    }
    .btn-print:hover {
      background: #EA580C;
    }

    .spb-sheet {
      position: relative;
      max-width: 1060px;
      margin: 0 auto;
      background: #FFFFFF;
      border-radius: 6px;
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      min-height: 620px;
    }

    /* HEADER */
    .spb-header {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: stretch;
      min-height: 84px;
    }
    .spb-brand-box {
      width: 195px;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 12px 18px 8px 24px;
      background: #FFFFFF;
    }
    .spb-brand-logo {
      height: 48px;
      width: auto;
      object-fit: contain;
    }
    .spb-brand-text {
      margin-top: 3px;
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 0.04em;
      color: #111827;
    }
    .spb-orange-banner {
      position: relative;
      flex: 1;
      background: #F5821F;
      border-bottom-left-radius: 44px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 14px 40px 16px 44px;
      overflow: hidden;
    }
    .spb-orange-banner h1 {
      margin: 0;
      font-size: 28px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: -0.02em;
      position: relative;
      z-index: 2;
      line-height: 1.15;
    }
    .spb-banner-sub {
      position: relative;
      z-index: 2;
      font-size: 12px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.9);
      margin-top: 2px;
    }
    .banner-orb-1 {
      position: absolute;
      right: 12px;
      top: -28px;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.16);
    }
    .banner-orb-2 {
      position: absolute;
      right: 14px;
      bottom: -34px;
      width: 68px;
      height: 68px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.72);
    }
    .banner-orb-3 {
      position: absolute;
      right: 108px;
      bottom: 16px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.88);
    }

    /* BODY */
    .spb-body {
      position: relative;
      z-index: 2;
      padding: 20px 38px 22px 38px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .spb-meta-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 24px;
      margin-bottom: 18px;
    }
    .ship-to-wrap {
      display: flex;
      align-items: flex-start;
      gap: 18px;
      max-width: 60%;
    }
    .ship-to-label {
      font-size: 12px;
      font-weight: 700;
      color: #A16207;
      padding-top: 3px;
      white-space: nowrap;
    }
    .ship-to-name {
      font-size: 18px;
      font-weight: 800;
      color: #111827;
      line-height: 1.2;
      margin-bottom: 6px;
    }
    .ship-to-line {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      font-size: 12px;
      color: #374151;
      margin-bottom: 3px;
    }
    .ship-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #F5821F;
      flex-shrink: 0;
      margin-top: 5px;
    }
    .spb-info-grid {
      display: grid;
      grid-template-columns: auto auto;
      gap: 5px 14px;
      font-size: 12px;
      padding-top: 3px;
    }
    .spb-info-label {
      color: #6B7280;
      white-space: nowrap;
    }
    .spb-info-val {
      font-weight: 700;
      color: #111827;
      white-space: nowrap;
    }

    /* TABLE */
    .spb-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 18px;
    }
    .spb-table thead tr {
      background: #FDF1E6;
    }
    .spb-table thead th {
      padding: 10px 12px;
      font-size: 12px;
      font-weight: 700;
      color: #1C1917;
      text-align: left;
      white-space: nowrap;
    }
    .spb-table thead th:first-child {
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      width: 44px;
      text-align: center;
    }
    .spb-table thead th:last-child {
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }
    .spb-table tbody td {
      padding: 11px 12px;
      border-bottom: 1px solid #F1F5F9;
      font-size: 12px;
      color: #1F2937;
      vertical-align: middle;
    }
    .spb-table tbody td:first-child {
      text-align: center;
      color: #6B7280;
    }
    .spb-item-title {
      font-weight: 700;
      color: #111827;
    }
    .spb-col-center {
      text-align: center;
      white-space: nowrap;
    }

    /* BOTTOM */
    .spb-bottom-grid {
      margin-top: auto;
      display: grid;
      grid-template-columns: 300px 1fr;
      gap: 28px;
      align-items: end;
      padding-top: 10px;
    }
    .spb-note-card {
      background: #FDF5EC;
      border-radius: 0 14px 14px 0;
      padding: 14px 18px 14px 38px;
      margin-left: -38px;
    }
    .spb-note-title {
      font-size: 11px;
      font-weight: 700;
      color: #A16207;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      margin-bottom: 4px;
    }
    .spb-note-text {
      font-size: 12px;
      color: #44403C;
      line-height: 1.45;
    }

    .sig-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 32px;
      align-items: end;
      padding: 0 12px 2px 12px;
    }
    .sig-box {
      text-align: center;
    }
    .sig-space {
      height: 58px;
    }
    .sig-line {
      border-top: 1px solid #1C1917;
      margin: 0 auto 7px auto;
      width: 100%;
      max-width: 180px;
    }
    .sig-name {
      font-size: 12.5px;
      font-weight: 700;
      color: #111827;
    }
    .sig-role {
      font-size: 11px;
      color: #6B7280;
      margin-top: 1px;
    }

    /* FOOTER */
    .spb-footer {
      position: relative;
      z-index: 2;
      background: #F5821F;
      color: #FFFFFF;
      padding: 14px 46px 15px 120px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 24px;
      overflow: hidden;
    }
    .footer-left {
      position: relative;
      z-index: 2;
      font-size: 11.5px;
      line-height: 1.5;
    }
    .footer-wa {
      font-weight: 700;
      margin-top: 2px;
    }
    .footer-right {
      position: relative;
      z-index: 2;
      text-align: right;
      font-size: 11.5px;
      line-height: 1.5;
      padding-right: 40px;
    }
    .foot-orb-l1 {
      position: absolute;
      left: -18px;
      bottom: -36px;
      width: 78px;
      height: 78px;
      border-radius: 50%;
      background: rgba(180, 83, 9, 0.35);
    }
    .foot-orb-l2 {
      position: absolute;
      left: 62px;
      top: 14px;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.55);
    }
    .foot-orb-r1 {
      position: absolute;
      right: 14px;
      top: 10px;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.78);
    }
    .foot-orb-r2 {
      position: absolute;
      right: -12px;
      bottom: -14px;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.25);
    }

    @media print {
      html, body {
        width: 140mm;
        height: 97mm;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: #FFFFFF;
        font-size: 7pt;
        line-height: 1.3;
      }
      .no-print-bar {
        display: none !important;
      }
      .spb-sheet {
        width: 140mm;
        max-width: 140mm;
        height: 95mm;
        min-height: 0;
        margin: 0 auto;
        box-shadow: none;
        border-radius: 0;
        overflow: hidden;
      }
      .spb-header {
        min-height: 13mm;
      }
      .spb-brand-box {
        width: 30mm;
        padding: 2mm 3mm 1.5mm 5mm;
      }
      .spb-brand-logo {
        height: 8.5mm;
      }
      .spb-brand-text {
        margin-top: 1px;
        font-size: 6pt;
      }
      .spb-orange-banner {
        border-bottom-left-radius: 18px;
        padding: 2mm 8mm 2mm 9mm;
      }
      .spb-orange-banner h1 {
        font-size: 13pt;
      }
      .spb-banner-sub {
        font-size: 6pt;
      }
      .banner-orb-1 { width: 28px; height: 28px; right: 4px; top: -12px; }
      .banner-orb-2 { width: 26px; height: 26px; right: 6px; bottom: -14px; }
      .banner-orb-3 { width: 8px; height: 8px; right: 42px; bottom: 6px; }

      .spb-body {
        padding: 2.5mm 5mm 2.5mm 5mm;
      }
      .spb-meta-row {
        gap: 4mm;
        margin-bottom: 3mm;
      }
      .ship-to-wrap {
        gap: 3mm;
      }
      .ship-to-label {
        font-size: 6.5pt;
        padding-top: 1px;
      }
      .ship-to-name {
        font-size: 9.5pt;
        margin-bottom: 2px;
      }
      .ship-to-line {
        font-size: 6.5pt;
        gap: 4px;
        margin-bottom: 1px;
      }
      .ship-dot {
        width: 4px;
        height: 4px;
        margin-top: 3px;
      }
      .spb-info-grid {
        gap: 2px 6px;
        font-size: 6.5pt;
        padding-top: 1px;
      }

      .spb-table {
        margin-bottom: 3mm;
      }
      .spb-table thead th {
        padding: 4px 5px;
        font-size: 6.5pt;
      }
      .spb-table thead th:first-child {
        width: 18px;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .spb-table thead th:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
      }
      .spb-table tbody td {
        padding: 4px 5px;
        font-size: 6.5pt;
      }
      .spb-table tr {
        page-break-inside: avoid;
      }

      .spb-bottom-grid {
        grid-template-columns: 44mm 1fr;
        gap: 4mm;
        padding-top: 1mm;
      }
      .spb-note-card {
        margin-left: -5mm;
        padding: 2mm 3mm 2mm 5mm;
        border-radius: 0 8px 8px 0;
      }
      .spb-note-title {
        font-size: 5.5pt;
        margin-bottom: 1.5px;
      }
      .spb-note-text {
        font-size: 6pt;
        line-height: 1.35;
      }
      .sig-grid {
        gap: 6mm;
        padding: 0 2px;
      }
      .sig-space {
        height: 11mm;
      }
      .sig-line {
        margin-bottom: 2.5px;
      }
      .sig-name {
        font-size: 6.5pt;
      }
      .sig-role {
        font-size: 5.5pt;
      }

      .spb-footer {
        padding: 2mm 5mm 2mm 11mm;
        gap: 4mm;
      }
      .footer-left,
      .footer-right {
        font-size: 6pt;
        line-height: 1.35;
      }
      .footer-right {
        padding-right: 8mm;
      }
      .foot-orb-l1 { left: -8px; bottom: -16px; width: 32px; height: 32px; }
      .foot-orb-l2 { left: 24px; top: 6px; width: 10px; height: 10px; }
      .foot-orb-r1 { right: 6px; top: 4px; width: 13px; height: 13px; }
      .foot-orb-r2 { right: -5px; bottom: -6px; width: 15px; height: 15px; }
    }
  </style>
</head>
<body>
@php
  $signerName = !empty($spb->nama_penandatangan)
      ? $spb->nama_penandatangan
      : ($spb->nama_spb == 1 ? (auth()->user()->nama ?? 'Admin') : 'Oky Irawan');
@endphp

<div class="no-print-bar">
  <span class="size-pill">Ukuran Cetak: A6 Landscape (148 &times; 105 mm)</span>
  <button type="button" class="btn-print" onclick="window.print()">Cetak / Simpan PDF (SPB)</button>
</div>

<div class="spb-sheet">
  <!-- HEADER -->
  <div class="spb-header">
    <div class="spb-brand-box">
      <img src="{{ asset('images/Ibekami.png') }}" alt="Ibekami" class="spb-brand-logo" onerror="this.src='{{ asset('images/Logo IBEKAMI.png') }}'">
      <div class="spb-brand-text">IBEKAMI.COM</div>
    </div>
    <div class="spb-orange-banner">
      <h1>Surat Pengantar Barang</h1>
      <div class="spb-banner-sub">Tanda Terima Pengiriman Barang (SPB)</div>
      <div class="banner-orb-1"></div>
      <div class="banner-orb-2"></div>
      <div class="banner-orb-3"></div>
    </div>
  </div>

  <!-- BODY -->
  <div class="spb-body">
    <div class="spb-meta-row">
      <div class="ship-to-wrap">
        <div class="ship-to-label">Dikirim kepada</div>
        <div>
          <div class="ship-to-name">{{ $spb->customer ?: '-' }}</div>
          @if(!empty($spb->perusahaan) && $spb->perusahaan !== '-')
            <div class="ship-to-line"><span class="ship-dot"></span><span>Perusahaan: {{ $spb->perusahaan }}</span></div>
          @endif
          @if(!empty($spb->alamat) && $spb->alamat !== '-')
            <div class="ship-to-line"><span class="ship-dot"></span><span>{{ $spb->alamat }}</span></div>
          @endif
          <div class="ship-to-line"><span class="ship-dot"></span><span>{{ $spb->nomor_telepon ?: '-' }}</span></div>
        </div>
      </div>

      <div class="spb-info-grid">
        <div class="spb-info-label">Nomor SPB :</div>
        <div class="spb-info-val">SPB-{{ str_pad((string) $spb->id, 4, '0', STR_PAD_LEFT) }}</div>
        <div class="spb-info-label">Tanggal :</div>
        <div class="spb-info-val">Medan, {{ $formatTanggal }}</div>
        <div class="spb-info-label">Pengantar :</div>
        <div class="spb-info-val">{{ $signerName }}</div>
      </div>
    </div>

    <!-- TABLE -->
    <table class="spb-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Deskripsi Barang</th>
          <th class="spb-col-center" style="width: 110px;">Qty</th>
          <th style="width: 220px;">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($brg_spb as $index => $brg)
          @php
            $katObj = isset($barangs[$index]) ? collect($barangs[$index])->first() : null;
            $katName = $katObj->nama_kategori ?? '';
            $ketText = trim((string) ($brg->keterangan ?? ''));
          @endphp
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>
              @if($katName !== '')
                <span class="spb-item-title">{{ $katName }}</span>
                @if(!empty($brg->deskripsi))
                  <span> &mdash; {{ $brg->deskripsi }}</span>
                @endif
              @else
                <span class="spb-item-title">{{ $brg->deskripsi ?: '-' }}</span>
              @endif
            </td>
            <td class="spb-col-center">{{ $brg->qty }} {{ $brg->satuan ?? '' }}</td>
            <td>{{ ($ketText !== '' && !preg_match('/^-+$/', $ketText)) ? $ketText : '—' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- BOTTOM -->
    <div class="spb-bottom-grid">
      <div class="spb-note-card">
        <div class="spb-note-title">Tanda Terima Barang</div>
        <div class="spb-note-text">
          Dokumen-dokumen / barang-barang tersebut di atas telah diterima dalam kondisi baik dan lengkap.
        </div>
      </div>

      <div class="sig-grid">
        <div class="sig-box">
          <div class="sig-space"></div>
          <div class="sig-line"></div>
          <div class="sig-name">{{ $spb->customer ?: '( .......................... )' }}</div>
          <div class="sig-role">Diterima oleh (Tanda Tangan &amp; Nama)</div>
        </div>

        <div class="sig-box">
          <div class="sig-space"></div>
          <div class="sig-line"></div>
          <div class="sig-name">{{ $signerName }}</div>
          <div class="sig-role">Hormat kami &middot; Medan, {{ $formatTanggal }}</div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="spb-footer">
    <div class="foot-orb-l1"></div>
    <div class="foot-orb-l2"></div>
    <div class="foot-orb-r1"></div>
    <div class="foot-orb-r2"></div>

    <div class="footer-left">
      <div>Jl. Setia Budi Komp. Setia Budi Point No. D-10, Kota Medan 20132</div>
      <div class="footer-wa">WhatsApp 0817 0769 999</div>
    </div>
    <div class="footer-right">
      @if($spb->nama_spb == 1)
        <div>Kunjungi website kami: <strong>ibekami.com</strong></div>
        <div>Ikhtiar Berkah, member of KADIN SUMUT</div>
      @else
        <div>Terima kasih telah mendukung UMKM kami.</div>
        <div>Dengan senang hati melayani.</div>
      @endif
    </div>
  </div>
</div>

<script>
  window.addEventListener('load', function () {
    setTimeout(function () {
      window.print();
    }, 250);
  });
</script>
</body>
</html>
