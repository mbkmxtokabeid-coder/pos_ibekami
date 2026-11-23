<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $namaInv ?? 'Invoice' }} - {{ $penjualan->nomor_invoice ?? '' }} - {{ $penjualan->customer ?? '' }}</title>
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
    .invoice-sheet {
      position: relative;
      max-width: 1060px;
      margin: 0 auto;
      background: #FFFFFF;
      border-radius: 6px;
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      min-height: 640px;
    }
    .watermark-bg {
      position: absolute;
      top: 46%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-24deg);
      font-size: 110px;
      font-weight: 800;
      color: rgba(15, 23, 42, 0.045);
      text-transform: uppercase;
      letter-spacing: 14px;
      pointer-events: none;
      z-index: 1;
      white-space: nowrap;
      user-select: none;
    }

    /* TOP HEADER */
    .inv-header {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: stretch;
      min-height: 86px;
    }
    .inv-brand-box {
      width: 195px;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 12px 18px 8px 24px;
      background: #FFFFFF;
    }
    .inv-brand-logo {
      height: 50px;
      width: auto;
      object-fit: contain;
    }
    .inv-brand-text {
      margin-top: 3px;
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 0.04em;
      color: #111827;
    }
    .inv-orange-banner {
      position: relative;
      flex: 1;
      background: #F5821F;
      border-bottom-left-radius: 44px;
      display: flex;
      align-items: center;
      padding: 16px 40px 18px 44px;
      overflow: hidden;
    }
    .inv-orange-banner h1 {
      margin: 0;
      font-size: 36px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: -0.02em;
      position: relative;
      z-index: 2;
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
      bottom: 18px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.88);
    }

    /* BODY */
    .inv-body {
      position: relative;
      z-index: 2;
      padding: 20px 38px 24px 38px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* META ROW */
    .inv-meta-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 24px;
      margin-bottom: 20px;
    }
    .bill-to-wrap {
      display: flex;
      align-items: flex-start;
      gap: 20px;
    }
    .bill-to-label {
      font-size: 12px;
      font-weight: 700;
      color: #A16207;
      padding-top: 4px;
      white-space: nowrap;
    }
    .bill-to-name {
      font-size: 18px;
      font-weight: 800;
      color: #111827;
      line-height: 1.2;
      margin-bottom: 6px;
    }
    .bill-to-line {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      color: #374151;
      margin-bottom: 3px;
    }
    .bill-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #F5821F;
      flex-shrink: 0;
    }
    .inv-info-grid {
      display: grid;
      grid-template-columns: auto auto;
      gap: 5px 14px;
      font-size: 12px;
      padding-top: 3px;
      align-items: center;
    }
    .inv-info-label {
      color: #6B7280;
      white-space: nowrap;
    }
    .inv-info-val {
      font-weight: 700;
      color: #111827;
      white-space: nowrap;
    }
    .pay-status-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 2px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 700;
      line-height: 1.4;
      white-space: nowrap;
    }
    .pay-status-badge .dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
    }
    .pay-status-lunas {
      background: #DCFCE7;
      color: #15803D;
    }
    .pay-status-lunas .dot { background: #16A34A; }
    .pay-status-belum {
      background: #FEF3C7;
      color: #B45309;
    }
    .pay-status-belum .dot { background: #D97706; }
    .pay-status-batal {
      background: #FEE2E2;
      color: #B91C1C;
    }
    .pay-status-batal .dot { background: #DC2626; }

    /* TABLE */
    .inv-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 24px;
    }
    .inv-table thead tr {
      background: #FDF1E6;
    }
    .inv-table thead th {
      padding: 10px 12px;
      font-size: 12px;
      font-weight: 700;
      color: #1C1917;
      text-align: left;
      white-space: nowrap;
    }
    .inv-table thead th:first-child {
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      width: 44px;
      text-align: center;
    }
    .inv-table thead th:last-child {
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }
    .inv-table tbody td {
      padding: 11px 12px;
      border-bottom: 1px solid #F1F5F9;
      font-size: 12px;
      color: #1F2937;
      vertical-align: middle;
    }
    .inv-table tbody td:first-child {
      text-align: center;
      color: #6B7280;
    }
    .inv-table .col-item {
      font-weight: 700;
      color: #111827;
      white-space: nowrap;
    }
    .inv-table .col-num {
      text-align: right;
      white-space: nowrap;
    }
    .inv-table .col-total {
      text-align: right;
      font-weight: 700;
      color: #111827;
      white-space: nowrap;
    }
    .inv-table .col-center {
      text-align: center;
      white-space: nowrap;
    }

    /* BOTTOM 3-COL SECTION */
    .inv-bottom-grid {
      margin-top: auto;
      display: grid;
      grid-template-columns: 270px 1fr 290px;
      gap: 24px;
      align-items: end;
      padding-top: 8px;
    }

    /* BANK CARD */
    .bank-card {
      background: #FDF5EC;
      border-radius: 14px;
      padding: 16px 20px;
      margin-left: -38px;
      padding-left: 38px;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }
    .bank-label {
      font-size: 11px;
      color: #78716C;
      margin-bottom: 5px;
    }
    .bank-name {
      font-size: 13.5px;
      font-weight: 800;
      color: #1C1917;
      margin-bottom: 2px;
    }
    .bank-holder {
      font-size: 12px;
      color: #44403C;
      margin-bottom: 6px;
    }
    .bank-number {
      font-size: 18px;
      font-weight: 800;
      color: #B45309;
      letter-spacing: 0.02em;
    }

    /* SIGNATURES */
    .sig-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      align-items: end;
      padding: 0 8px 4px 8px;
    }
    .sig-box {
      text-align: center;
    }
    .sig-space {
      position: relative;
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .sig-stamp {
      position: absolute;
      height: 62px;
      left: 50%;
      transform: translateX(-72%);
      opacity: 0.85;
      z-index: 1;
    }
    .sig-ttd {
      position: absolute;
      height: 64px;
      left: 50%;
      transform: translateX(-28%);
      z-index: 2;
    }
    .sig-line {
      border-top: 1px solid #1C1917;
      margin: 0 auto 7px auto;
      width: 100%;
      max-width: 165px;
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

    /* TOTALS */
    .totals-box {
      width: 100%;
    }
    .total-line {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      padding: 5px 0;
      font-size: 12.5px;
      color: #1F2937;
    }
    .total-line-val {
      font-weight: 600;
      color: #111827;
      white-space: nowrap;
    }
    .total-divider {
      border: none;
      border-top: 2px solid #D97706;
      margin: 8px 0 10px 0;
    }
    .grand-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
    }
    .grand-label {
      font-size: 13.5px;
      font-weight: 800;
      color: #111827;
    }
    .grand-status {
      font-size: 11px;
      font-weight: 600;
      margin-top: 1px;
    }
    .grand-status.is-lunas {
      color: #15803D;
    }
    .grand-status.is-belum {
      color: #B45309;
    }
    .grand-status.is-batal {
      color: #DC2626;
    }
    .grand-amount {
      font-size: 24px;
      font-weight: 800;
      color: #B45309;
      letter-spacing: -0.02em;
      white-space: nowrap;
    }
    .grand-amount.is-lunas {
      color: #15803D;
    }
    .grand-amount.is-batal {
      color: #DC2626;
    }

    /* FOOTER BANNER */
    .inv-footer {
      position: relative;
      z-index: 2;
      background: #F5821F;
      color: #FFFFFF;
      padding: 15px 46px 16px 140px;
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
      padding-right: 48px;
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
      left: 72px;
      top: 16px;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.55);
    }
    .foot-orb-r1 {
      position: absolute;
      right: 14px;
      top: 12px;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.78);
    }
    .foot-orb-r2 {
      position: absolute;
      right: -12px;
      bottom: -14px;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.25);
    }
    .foot-orb-r3 {
      position: absolute;
      right: 4px;
      bottom: 8px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.92);
    }

    /* COPY MODE: OTOMATIS HITAM PUTIH (LAYAR & CETAK) */
    .invoice-sheet.is-copy {
      filter: grayscale(100%);
      -webkit-filter: grayscale(100%);
    }
    .invoice-sheet.is-copy .inv-orange-banner,
    .invoice-sheet.is-copy .inv-footer {
      background: #262626 !important;
      color: #FFFFFF !important;
    }
    .invoice-sheet.is-copy .foot-orb-l1 {
      background: rgba(255, 255, 255, 0.16) !important;
    }
    .invoice-sheet.is-copy .inv-table thead tr,
    .invoice-sheet.is-copy .bank-card {
      background: #F3F4F6 !important;
    }
    .invoice-sheet.is-copy .bill-to-label,
    .invoice-sheet.is-copy .bank-number,
    .invoice-sheet.is-copy .grand-amount,
    .invoice-sheet.is-copy .grand-amount.is-lunas,
    .invoice-sheet.is-copy .grand-amount.is-batal,
    .invoice-sheet.is-copy .grand-status,
    .invoice-sheet.is-copy .grand-status.is-lunas,
    .invoice-sheet.is-copy .grand-status.is-belum,
    .invoice-sheet.is-copy .grand-status.is-batal {
      color: #111827 !important;
    }
    .invoice-sheet.is-copy .bill-dot {
      background: #374151 !important;
    }
    .invoice-sheet.is-copy .total-divider {
      border-top-color: #1F2937 !important;
    }
    .invoice-sheet.is-copy .pay-status-badge {
      background: #F3F4F6 !important;
      color: #111827 !important;
      border: 1px solid #D1D5DB !important;
    }
    .invoice-sheet.is-copy .pay-status-badge .dot {
      background: #111827 !important;
    }
    .invoice-sheet.is-copy .inv-brand-logo,
    .invoice-sheet.is-copy .sig-stamp,
    .invoice-sheet.is-copy .sig-ttd {
      filter: grayscale(100%) contrast(1.1) !important;
      -webkit-filter: grayscale(100%) contrast(1.1) !important;
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
      .invoice-sheet {
        width: 140mm;
        max-width: 140mm;
        height: 95mm;
        min-height: 0;
        margin: 0 auto;
        box-shadow: none;
        border-radius: 0;
        overflow: hidden;
      }
      .watermark-bg {
        font-size: 48pt;
        letter-spacing: 8px;
      }

      /* A6 Header */
      .inv-header {
        min-height: 13mm;
      }
      .inv-brand-box {
        width: 30mm;
        padding: 2mm 3mm 1.5mm 6mm;
      }
      .inv-brand-logo {
        height: 8.5mm;
      }
      .inv-brand-text {
        margin-top: 1px;
        font-size: 6pt;
      }
      .inv-orange-banner {
        border-bottom-left-radius: 18px;
        padding: 2mm 8mm 2.5mm 9mm;
      }
      .inv-orange-banner h1 {
        font-size: 16pt;
      }
      .banner-orb-1 {
        right: 4px;
        top: -12px;
        width: 30px;
        height: 30px;
      }
      .banner-orb-2 {
        right: 6px;
        bottom: -14px;
        width: 28px;
        height: 28px;
      }
      .banner-orb-3 {
        right: 42px;
        bottom: 7px;
        width: 8px;
        height: 8px;
      }

      /* A6 Body & Meta */
      .inv-body {
        padding: 2.5mm 5mm 2.5mm 5mm;
      }
      .inv-meta-row {
        gap: 4mm;
        margin-bottom: 3mm;
      }
      .bill-to-wrap {
        gap: 3mm;
      }
      .bill-to-label {
        font-size: 6.5pt;
        padding-top: 1px;
      }
      .bill-to-name {
        font-size: 9.5pt;
        margin-bottom: 2px;
      }
      .bill-to-line {
        font-size: 6.5pt;
        gap: 4px;
        margin-bottom: 1px;
      }
      .bill-dot {
        width: 4px;
        height: 4px;
      }
      .inv-info-grid {
        gap: 2px 6px;
        font-size: 6.5pt;
        padding-top: 1px;
      }
      .pay-status-badge {
        padding: 1px 6px;
        font-size: 6pt;
        gap: 3px;
      }
      .pay-status-badge .dot {
        width: 4px;
        height: 4px;
      }

      /* A6 Table */
      .inv-table {
        margin-bottom: 3mm;
      }
      .inv-table thead th {
        padding: 4px 5px;
        font-size: 6.5pt;
      }
      .inv-table thead th:first-child {
        width: 18px;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .inv-table thead th:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
      }
      .inv-table tbody td {
        padding: 4px 5px;
        font-size: 6.5pt;
      }
      .inv-table tr {
        page-break-inside: avoid;
      }

      /* A6 Bottom 3-Col */
      .inv-bottom-grid {
        grid-template-columns: 38mm 1fr 44mm;
        gap: 3mm;
        padding-top: 1mm;
      }
      .bank-card {
        margin-left: -5mm;
        padding: 2mm 3mm 2mm 5mm;
        border-radius: 0 8px 8px 0;
      }
      .bank-label {
        font-size: 5.5pt;
        margin-bottom: 1.5px;
      }
      .bank-name {
        font-size: 7pt;
        margin-bottom: 1px;
      }
      .bank-holder {
        font-size: 6pt;
        margin-bottom: 2px;
      }
      .bank-number {
        font-size: 9pt;
      }
      .sig-grid {
        gap: 4mm;
        padding: 0 2px;
      }
      .sig-space {
        height: 11mm;
      }
      .sig-stamp {
        height: 10mm;
      }
      .sig-ttd {
        height: 10.5mm;
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
      .total-line {
        padding: 1.5px 0;
        font-size: 6.5pt;
      }
      .total-divider {
        margin: 2.5px 0 3px 0;
        border-top-width: 1.5px;
      }
      .grand-row {
        gap: 4px;
      }
      .grand-label {
        font-size: 7pt;
      }
      .grand-status {
        font-size: 5.5pt;
      }
      .grand-amount {
        font-size: 11.5pt;
      }

      /* A6 Footer */
      .inv-footer {
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
      .foot-orb-l1 {
        left: -8px;
        bottom: -16px;
        width: 32px;
        height: 32px;
      }
      .foot-orb-l2 {
        left: 26px;
        top: 6px;
        width: 10px;
        height: 10px;
      }
      .foot-orb-r1 {
        right: 6px;
        top: 4px;
        width: 13px;
        height: 13px;
      }
      .foot-orb-r2 {
        right: -5px;
        bottom: -6px;
        width: 15px;
        height: 15px;
      }
      .foot-orb-r3 {
        right: 2px;
        bottom: 3px;
        width: 7px;
        height: 7px;
      }
    }
  </style>
</head>
<body>
@php
  $isCopy = strtolower(trim($type ?? 'asli')) === 'copy';
  $norekRaw = $penjualan->norek_text ?? ($norek ?? 'BSI | A/N : Yusni Kurniasih | No. Rek : 2845999999');
  $norekParts = array_map('trim', explode('|', $norekRaw));
  $bankName = $norekParts[0] ?? 'BSI';
  if (stripos($bankName, 'bank') === false) {
      $bankName = 'Bank ' . $bankName;
  }
  $accountHolder = isset($norekParts[1]) ? trim(preg_replace('/^a\/n\s*:?\s*/i', '', $norekParts[1])) : 'Yusni Kurniasih';
  $accountNumber = isset($norekParts[2]) ? trim(preg_replace('/^no\.?\s*rek\.?\s*:?\s*/i', '', $norekParts[2])) : '';
  if ($accountNumber === '' && preg_match('/\d{6,}/', $norekRaw, $mAcc)) {
      $accountNumber = $mAcc[0];
  }

  $isCash = stripos($penjualan->jenis_pembayaran ?? '', 'Cash') !== false;
  $statusRaw = trim($penjualan->status ?? 'Belum Lunas');
  $statusLower = strtolower($statusRaw);
  $isLunas = $statusLower === 'lunas';
  $isBatal = $statusLower === 'batal' || !empty($penjualan->deleted_at);
  $statusBadgeClass = $isBatal ? 'pay-status-batal' : ($isLunas ? 'pay-status-lunas' : 'pay-status-belum');
  $statusDisplayText = !empty($penjualan->deleted_at) ? 'Dihapus' : ($isBatal ? 'Batal' : ($isLunas ? 'Lunas' : 'Belum Lunas'));
  $grandStatusClass = $isBatal ? 'is-batal' : ($isLunas ? 'is-lunas' : 'is-belum');

  // Selaraskan label metode pembayaran agar tidak bertentangan saat invoice sudah dilunasi
  $rawMetode = trim($penjualan->jenis_pembayaran ?? '');
  $metodeDisplay = $rawMetode;
  if ($isLunas && $rawMetode !== '') {
      if (stripos($rawMetode, 'Transfer') !== false) {
          $metodeDisplay = 'Transfer Lunas';
      } elseif (stripos($rawMetode, 'Cash') !== false) {
          $metodeDisplay = 'Cash Lunas';
      } elseif (strtoupper($rawMetode) === 'PO') {
          $metodeDisplay = 'PO (Lunas)';
      }
  }

  $totalHargaNum = (float) ($penjualan->total_harga ?? 0);
  $totalPemNum = (float) ($penjualan->total_pembayaran ?? $totalHargaNum);
  $dpNum = (float) ($penjualan->dp ?? 0);
  $sisaNum = $isLunas ? 0 : (float) ($penjualan->sisa_pembayaran ?? max(0, $totalPemNum - $dpNum));

  // Preload Material records referenced by penjualan_barang.material_id (1 query)
  $decodeMatField = function ($raw) {
      if (is_array($raw)) return array_values($raw);
      if (is_string($raw) && trim($raw) !== '') {
          $decoded = json_decode($raw, true);
          if (is_array($decoded)) return array_values($decoded);
          return [trim($raw)];
      }
      if (is_numeric($raw)) return [$raw];
      return [];
  };

  $allMatIds = [];
  foreach ($penjualan_barang as $pb) {
      foreach ($decodeMatField($pb->material_id ?? null) as $mid) {
          if (is_numeric($mid) && (int)$mid > 0) {
              $allMatIds[] = (int)$mid;
          }
      }
  }
  $materialsMap = !empty($allMatIds)
      ? \App\Models\Material::whereIn('id', array_unique($allMatIds))->get()->keyBy('id')
      : collect();

  // Consistent resolver for Bahan, Ukuran, and Deskripsi (uses Material DB first, then deskripsi_item fallback)
  $resolveItemDetails = function ($jual) use ($decodeMatField, $materialsMap) {
      $text = trim((string) ($jual->deskripsi_item ?? ''));
      $ukuran = '—';
      $bahan = '—';

      // 1) Extract Ukuran from deskripsi_item (e.g. "Uk 15 x 7 cm", "Ukuran 1,2x2,36 M", "Uk 7cm")
      if ($text !== '' && preg_match('/(?:uk(?:uran)?\.?\s*[:=-]?\s*)?(\d+(?:[.,]\d+)?\s*[x×]\s*\d+(?:[.,]\d+)?(?:\s*(?:cm|mm|m|meter|inch|in|px))?)/iu', $text, $mUk)) {
          $ukuran = trim(preg_replace('/\s+/', ' ', $mUk[1]));
          $text = str_replace($mUk[0], '', $text);
      } elseif ($text !== '' && preg_match('/(?:uk(?:uran)?\.?\s*[:=-]?\s*)(\d+(?:[.,]\d+)?\s*(?:cm|mm|m|meter|inch|in))/iu', $text, $mUkSingle)) {
          $ukuran = trim(preg_replace('/\s+/', ' ', $mUkSingle[1]));
          $text = str_replace($mUkSingle[0], '', $text);
      }

      // 2) Extract Bahan from deskripsi_item (e.g. "Bahan Art Paper", "Bahan: Korea Matte")
      $bahanFromDesc = '';
      if ($text !== '' && preg_match('/bahan\s*[:=-]?\s*([^,\n;|]+)/iu', $text, $mBah)) {
          $bahanFromDesc = trim($mBah[1]);
          $text = str_replace($mBah[0], '', $text);
      }

      // 3) Check linked Material records from DB (primary source of truth for Bahan & fallback for Ukuran)
      $matIds = $decodeMatField($jual->material_id ?? null);
      $matPanjangs = $decodeMatField($jual->material_panjang ?? null);
      $matLebars = $decodeMatField($jual->material_lebar ?? null);
      $dbMatNames = [];
      $dbUkuranParts = [];

      foreach ($matIds as $idx => $mid) {
          $matObj = $materialsMap->get((int)$mid);
          if ($matObj && !empty($matObj->jenis_material)) {
              $dbMatNames[] = trim($matObj->jenis_material);
          }
          $p = $matPanjangs[$idx] ?? null;
          $l = $matLebars[$idx] ?? null;
          if ($p !== null && $p !== '' && $l !== null && $l !== '') {
              $unitRaw = strtolower(trim($matObj->satuan ?? ''));
              $unitLen = '';
              if (str_contains($unitRaw, 'cm')) $unitLen = ' cm';
              elseif (str_contains($unitRaw, 'mm')) $unitLen = ' mm';
              elseif ($unitRaw === 'm' || str_contains($unitRaw, 'm²') || str_contains($unitRaw, 'm2')) $unitLen = ' m';
              $dbUkuranParts[] = rtrim(rtrim((string)$p, '0'), '.') . ' x ' . rtrim(rtrim((string)$l, '0'), '.') . $unitLen;
          }
      }

      $bahanList = [];
      if (!empty($dbMatNames)) {
          $bahanList = array_values(array_unique($dbMatNames));
      } elseif ($bahanFromDesc !== '') {
          $bahanList = [$bahanFromDesc];
      }

      $ukuranList = [];
      if ($ukuran !== '—') {
          $ukuranList = [$ukuran];
      } elseif (!empty($dbUkuranParts)) {
          $ukuranList = array_values(array_unique($dbUkuranParts));
      }

      // 4) Clean leftover punctuation from deskripsi
      $descClean = preg_replace('/\s*,\s*,\s*/', ', ', $text);
      $descClean = trim($descClean, " \t\n\r\0\x0B,-;|");
      $descClean = preg_replace('/\s{2,}/', ' ', $descClean);
      if ($descClean === '') {
          $descClean = '—';
      }

      return [
          'desc' => $descClean,
          'bahanList' => !empty($bahanList) ? $bahanList : ['—'],
          'ukuranList' => !empty($ukuranList) ? $ukuranList : ['—'],
      ];
  };
@endphp

<div class="no-print-bar">
  <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:8px;background:#FFFFFF;border:1px solid #CBD5E1;color:#475569;font-size:12px;font-weight:600;">Ukuran Cetak: A6 Landscape (148 &times; 105 mm)</span>
  <button type="button" class="btn-print" onclick="window.print()">Cetak / Simpan PDF (A6)</button>
</div>

<div class="invoice-sheet {{ $isCopy ? 'is-copy' : '' }}">
  <div class="watermark-bg">{{ strtoupper($type ?? 'ASLI') }}</div>

  <!-- HEADER -->
  <div class="inv-header">
    <div class="inv-brand-box">
      <img src="{{ asset('images/Ibekami.png') }}" alt="Ibekami" class="inv-brand-logo" onerror="this.src='{{ asset('images/Logo IBEKAMI.png') }}'">
      <div class="inv-brand-text">IBEKAMI.ID</div>
    </div>
    <div class="inv-orange-banner">
      <h1>Invoice</h1>
      <div class="banner-orb-1"></div>
      <div class="banner-orb-2"></div>
      <div class="banner-orb-3"></div>
    </div>
  </div>

  <!-- BODY -->
  <div class="inv-body">
    <div class="inv-meta-row">
      <div class="bill-to-wrap">
        <div class="bill-to-label">Ditagihkan kepada</div>
        <div>
          <div class="bill-to-name">{{ $penjualan->customer ?: '-' }}</div>
          @if(!empty($penjualan->perusahaan) && $penjualan->perusahaan !== '-')
            <div class="bill-to-line"><span class="bill-dot"></span><span>Perusahaan: {{ $penjualan->perusahaan }}</span></div>
          @endif
          <div class="bill-to-line"><span class="bill-dot"></span><span>{{ $penjualan->no_telepon ?: '-' }}</span></div>
        </div>
      </div>

      <div class="inv-info-grid">
        <div class="inv-info-label">Nomor invoice :</div>
        <div class="inv-info-val">{{ $penjualan->nomor_invoice }}</div>
        <div class="inv-info-label">Tanggal :</div>
        <div class="inv-info-val">Medan, {{ $formatTanggal }}</div>
        <div class="inv-info-label">Status :</div>
        <div>
          <span class="pay-status-badge {{ $statusBadgeClass }}">
            <span class="dot"></span>{{ $statusDisplayText }}
          </span>
        </div>
        @if(!empty($metodeDisplay))
          <div class="inv-info-label">Pembayaran :</div>
          <div class="inv-info-val">{{ $metodeDisplay }}</div>
        @endif
      </div>
    </div>

    <!-- TABLE -->
    <table class="inv-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Item</th>
          <th>Deskripsi</th>
          <th>Bahan</th>
          <th>Ukuran</th>
          <th class="col-center">Qty</th>
          <th class="col-num">Harga</th>
          <th class="col-num">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($penjualan_barang as $index => $jual)
          @php
            $itemObj = isset($barang[$index]) ? collect($barang[$index])->first() : null;
            $itemName = $itemObj->jenis_barang ?? '-';
            $parsed = $resolveItemDetails($jual);
            $hargaNum = (float) ($jual->hargaBarang ?? 0);
            $jumlahNum = (float) ($jual->jumlah_harga ?? ($hargaNum * (float) ($jual->qty ?? 0)));
          @endphp
          <tr>
            <td>{{ $index + 1 }}</td>
            <td class="col-item">{{ $itemName }}</td>
            <td>{{ $parsed['desc'] }}</td>
            <td>
              @foreach($parsed['bahanList'] as $bItem)
                <div style="{{ !$loop->last ? 'margin-bottom: 3px;' : '' }}">{{ $bItem }}</div>
              @endforeach
            </td>
            <td style="white-space: nowrap;">
              @foreach($parsed['ukuranList'] as $uItem)
                <div style="{{ !$loop->last ? 'margin-bottom: 3px;' : '' }}">{{ $uItem }}</div>
              @endforeach
            </td>
            <td class="col-center">{{ $jual->qty }} {{ $jual->satuan ?? '' }}</td>
            <td class="col-num">Rp {{ number_format($hargaNum, 0, ',', '.') }}</td>
            <td class="col-total">Rp {{ number_format($jumlahNum, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- BOTTOM 3-COL -->
    <div class="inv-bottom-grid">
      <div>
        @if (!$isCash)
          <div class="bank-card">
            <div class="bank-label">Pembayaran via transfer</div>
            <div class="bank-name">{{ $bankName }}</div>
            <div class="bank-holder">a.n. {{ $accountHolder }}</div>
            <div class="bank-number">{{ $accountNumber }}</div>
          </div>
        @endif
      </div>

      <div class="sig-grid">
        <div class="sig-box">
          <div class="sig-space"></div>
          <div class="sig-line"></div>
          <div class="sig-name">{{ $penjualan->customer ?: '-' }}</div>
          <div class="sig-role">Diterima oleh</div>
        </div>

        <div class="sig-box">
          <div class="sig-space">
            @if($isLunas)
              <img src="{{ asset('images/Logo IBEKAMI.png') }}" class="sig-stamp" alt="Stempel Lunas">
              @php $signatureUrl = $penjualan->tanda_tangan_url ?? null; @endphp
              @if($signatureUrl)
                <img src="{{ $signatureUrl }}" class="sig-ttd" onerror="this.style.display='none'" alt="TTD {{ $admin }}">
              @endif
            @endif
          </div>
          <div class="sig-line"></div>
          <div class="sig-name">{{ $admin ?: 'Admin' }}</div>
          <div class="sig-role">Hormat kami</div>
        </div>
      </div>

      <div class="totals-box">
        <div class="total-line">
          <span>Total</span>
          <span class="total-line-val">Rp {{ number_format($totalHargaNum, 0, ',', '.') }}</span>
        </div>

        @if (!empty($penjualan->diskon) && (float)$penjualan->diskon > 0)
          <div class="total-line">
            <span>Diskon ({{ $penjualan->diskon }}%)</span>
            <span class="total-line-val">- {{ $biayaLain ?? '' }}</span>
          </div>
        @elseif (!empty($penjualan->potongan) && (float)$penjualan->potongan > 0)
          <div class="total-line">
            <span>Potongan</span>
            <span class="total-line-val">- Rp {{ number_format((float)$penjualan->potongan, 0, ',', '.') }}</span>
          </div>
        @elseif (!empty($penjualan->ppn) && (float)$penjualan->ppn > 0)
          <div class="total-line">
            <span>PPN ({{ $penjualan->ppn }}%)</span>
            <span class="total-line-val">+ {{ $biayaLain ?? '' }}</span>
          </div>
        @endif

        @if ($dpNum > 0 || !$isLunas)
          <div class="total-line">
            <span>DP</span>
            <span class="total-line-val">Rp {{ number_format($dpNum, 0, ',', '.') }}</span>
          </div>
        @endif

        <hr class="total-divider">

        <div class="grand-row">
          <div>
            <div class="grand-label">{{ $isLunas ? 'Total bayar' : ($isBatal ? 'Total tagihan' : 'Sisa bayar') }}</div>
            <div class="grand-status {{ $grandStatusClass }}">
              {{ $statusDisplayText }}
            </div>
          </div>
          <div class="grand-amount {{ $grandStatusClass }}">
            Rp {{ number_format($isLunas || $isBatal ? $totalPemNum : $sisaNum, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="inv-footer">
    <div class="foot-orb-l1"></div>
    <div class="foot-orb-l2"></div>
    <div class="foot-orb-r1"></div>
    <div class="foot-orb-r2"></div>
    <div class="foot-orb-r3"></div>

    <div class="footer-left">
      <div>Jl. Setia Budi Komp. Setia Budi Point No. D-10, Kota Medan 20132</div>
      <div class="footer-wa">WhatsApp 0811 2272 727</div>
    </div>
    <div class="footer-right">
      <div>Terima kasih telah mendukung UMKM kami.</div>
      <div>Dengan senang hati melayani.</div>
    </div>
  </div>
</div>

@if(!empty($autoPrint))
<script>
  window.addEventListener('load', function () {
    setTimeout(function () {
      window.print();
    }, 250);
  });
</script>
@endif
</body>
</html>
