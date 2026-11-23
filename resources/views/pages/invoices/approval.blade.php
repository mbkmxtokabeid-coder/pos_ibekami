@section('head')
<style>
  /* Warm Stone Dual-Theme — Konfirmasi Approval Invoice */
  :root {
    --appr-bg: #0C0A09;
    --appr-surface: #161311;
    --appr-surface-soft: #1E1A17;
    --appr-border: #2C2622;
    --appr-text: #F5F5F4;
    --appr-muted: #A8A29E;
    --appr-accent: #EA580C;
    --appr-accent-soft: rgba(234, 88, 12, 0.14);
  }
  body.theme-light {
    --appr-bg: #F7F6F2;
    --appr-surface: #FFFFFF;
    --appr-surface-soft: #FAF9F6;
    --appr-border: #E7E5E0;
    --appr-text: #1C1917;
    --appr-muted: #78716C;
    --appr-accent: #EA580C;
    --appr-accent-soft: #FFF7ED;
  }

  .appr-wrap {
    max-width: 740px;
    margin: 0 auto;
    padding: 8px 0 32px;
  }

  .appr-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 18px;
    flex-wrap: wrap;
  }
  .appr-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: var(--appr-muted);
    text-decoration: none;
    transition: color 0.15s ease;
  }
  .appr-back-link:hover {
    color: var(--appr-accent);
  }
  .appr-breadcrumb {
    font-size: 12.5px;
    color: var(--appr-muted);
  }
  .appr-breadcrumb strong {
    color: var(--appr-text);
    font-weight: 600;
  }

  .appr-card {
    background: var(--appr-surface);
    border: 1px solid var(--appr-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
  }

  .appr-card-header {
    padding: 22px 26px;
    border-bottom: 1px solid var(--appr-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }
  .appr-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .appr-icon-box {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }
  .appr-icon-unlock { background: rgba(234, 88, 12, 0.14); color: #EA580C; }
  .appr-icon-delete { background: rgba(239, 68, 68, 0.14); color: #EF4444; }
  .appr-icon-batal  { background: rgba(245, 158, 11, 0.16); color: #D97706; }
  .appr-icon-all    { background: var(--appr-accent-soft); color: var(--appr-accent); }

  .appr-title {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--appr-text);
    letter-spacing: -0.01em;
  }
  .appr-subtitle {
    margin: 3px 0 0;
    font-size: 12.5px;
    color: var(--appr-muted);
  }

  .appr-req-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
  }
  .appr-req-unlock { background: rgba(234, 88, 12, 0.14); color: #EA580C; border: 1px solid rgba(234, 88, 12, 0.28); }
  .appr-req-delete { background: rgba(239, 68, 68, 0.14); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.28); }
  .appr-req-batal  { background: rgba(245, 158, 11, 0.16); color: #D97706; border: 1px solid rgba(245, 158, 11, 0.30); }
  .appr-req-all    { background: var(--appr-surface-soft); color: var(--appr-muted); border: 1px solid var(--appr-border); }

  .appr-card-body {
    padding: 24px 26px;
  }

  .appr-meta-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 22px;
  }
  @media (max-width: 576px) {
    .appr-meta-grid { grid-template-columns: 1fr; }
  }
  .appr-meta-box {
    background: var(--appr-surface-soft);
    border: 1px solid var(--appr-border);
    border-radius: 12px;
    padding: 13px 16px;
  }
  .appr-meta-label {
    font-size: 11.5px;
    font-weight: 600;
    color: var(--appr-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 4px;
  }
  .appr-meta-value {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--appr-text);
    word-break: break-word;
  }
  .appr-meta-value.is-accent {
    color: var(--appr-accent);
    font-family: 'JetBrains Mono', monospace;
  }
  .appr-meta-value.is-total {
    font-size: 17px;
    color: #16A34A;
  }
  .appr-meta-sub {
    font-size: 12px;
    color: var(--appr-muted);
    margin-top: 2px;
  }

  .appr-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
  }
  .appr-status-lunas { background: rgba(16, 185, 129, 0.14); color: #10B981; }
  .appr-status-belum { background: rgba(245, 158, 11, 0.16); color: #D97706; }
  .appr-status-batal { background: rgba(239, 68, 68, 0.14); color: #EF4444; }

  .appr-section-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--appr-muted);
    margin-bottom: 10px;
  }

  .appr-items-wrap {
    border: 1px solid var(--appr-border);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 24px;
  }
  .appr-items-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
  }
  .appr-items-table thead th {
    background: var(--appr-surface-soft);
    color: var(--appr-muted);
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 10px 14px;
    text-align: left;
    border-bottom: 1px solid var(--appr-border);
  }
  .appr-items-table tbody td {
    padding: 12px 14px;
    color: var(--appr-text);
    border-bottom: 1px solid var(--appr-border);
    vertical-align: top;
  }
  .appr-items-table tbody tr:last-child td {
    border-bottom: none;
  }
  .appr-item-name {
    font-weight: 700;
    color: var(--appr-text);
  }
  .appr-item-desc {
    font-size: 12px;
    color: var(--appr-muted);
    margin-top: 2px;
  }

  .appr-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .appr-btn {
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: transform 0.12s ease, opacity 0.15s ease, box-shadow 0.15s ease;
    text-decoration: none;
  }
  .appr-btn:hover {
    opacity: 0.94;
    transform: translateY(-1px);
  }
  .appr-btn-unlock {
    background: #EA580C;
    color: #FFFFFF;
    box-shadow: 0 6px 18px rgba(234, 88, 12, 0.25);
  }
  .appr-btn-delete {
    background: #DC2626;
    color: #FFFFFF;
    box-shadow: 0 6px 18px rgba(220, 38, 38, 0.22);
  }
  .appr-btn-batal {
    background: #D97706;
    color: #FFFFFF;
    box-shadow: 0 6px 18px rgba(217, 119, 6, 0.22);
  }
  .appr-btn-secondary {
    background: var(--appr-surface-soft);
    color: var(--appr-text);
    border: 1px solid var(--appr-border);
    font-weight: 600;
    font-size: 13px;
    padding: 10px 16px;
  }
  .appr-btn-secondary:hover {
    color: var(--appr-accent);
    border-color: var(--appr-accent);
  }

  .appr-notice {
    padding: 12px 16px;
    border-radius: 10px;
    background: var(--appr-surface-soft);
    border: 1px solid var(--appr-border);
    color: var(--appr-muted);
    font-size: 13px;
    text-align: center;
  }

  .appr-item-mobile-meta {
    display: none;
  }

  @media (max-width: 576px) {
    .appr-wrap {
      padding: 4px 0 24px;
    }
    .appr-topbar {
      gap: 6px;
      margin-bottom: 12px;
    }
    .appr-card {
      border-radius: 14px;
    }
    .appr-card-header {
      padding: 16px;
      gap: 12px;
    }
    .appr-header-left {
      align-items: flex-start;
      gap: 12px;
    }
    .appr-icon-box {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      font-size: 19px;
    }
    .appr-title {
      font-size: 16px;
      line-height: 1.3;
    }
    .appr-subtitle {
      font-size: 12px;
      line-height: 1.45;
    }
    .appr-card-body {
      padding: 16px;
    }
    .appr-meta-grid {
      gap: 10px;
      margin-bottom: 18px;
    }
    .appr-meta-box {
      padding: 11px 13px;
    }
    .appr-meta-value {
      font-size: 14px;
    }
    .appr-meta-value.is-total {
      font-size: 16px;
    }

    /* Ubah tabel Rincian Item menjadi kartu bertumpuk rapi di mobile */
    .appr-items-wrap {
      margin-bottom: 18px;
      background: var(--appr-surface-soft);
    }
    .appr-items-table,
    .appr-items-table tbody,
    .appr-items-table tr,
    .appr-items-table td {
      display: block;
      width: 100%;
    }
    .appr-items-table thead {
      display: none;
    }
    .appr-items-table tbody tr {
      padding: 12px 14px;
      border-bottom: 1px solid var(--appr-border);
    }
    .appr-items-table tbody tr:last-child {
      border-bottom: none;
    }
    .appr-items-table tbody td {
      padding: 0;
      border-bottom: none;
    }
    .appr-items-table tbody td.appr-col-qty,
    .appr-items-table tbody td.appr-col-total {
      display: none;
    }
    .appr-item-mobile-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin-top: 8px;
      padding-top: 8px;
      border-top: 1px dashed var(--appr-border);
      font-size: 12.5px;
    }
    .appr-item-mobile-qty {
      color: var(--appr-muted);
      font-weight: 600;
    }
    .appr-item-mobile-total {
      color: var(--appr-text);
      font-weight: 700;
      white-space: nowrap;
    }

    .appr-btn {
      font-size: 13.5px;
      padding: 11px 14px;
      white-space: normal;
      text-align: center;
    }
  }
</style>
@endsection
@extends('layout.template')
@section('content')
@php
  $action = $requestedAction ?? 'all';
  $metaByAction = [
    'unlock' => [
      'title' => 'Permintaan Buka Kunci Invoice',
      'subtitle' => 'Admin meminta persetujuan untuk membuka akses edit invoice ini',
      'pill' => 'Request: Unlock',
      'pillClass' => 'appr-req-unlock',
      'iconClass' => 'appr-icon-unlock',
      'icon' => 'las la-lock-open',
    ],
    'delete' => [
      'title' => 'Permintaan Hapus Invoice',
      'subtitle' => 'Admin meminta persetujuan untuk menghapus invoice & mengembalikan stok',
      'pill' => 'Request: Hapus',
      'pillClass' => 'appr-req-delete',
      'iconClass' => 'appr-icon-delete',
      'icon' => 'las la-trash-alt',
    ],
    'batal' => [
      'title' => 'Permintaan Batalkan Invoice',
      'subtitle' => 'Admin meminta persetujuan untuk membatalkan invoice ini',
      'pill' => 'Request: Batal',
      'pillClass' => 'appr-req-batal',
      'iconClass' => 'appr-icon-batal',
      'icon' => 'las la-ban',
    ],
    'all' => [
      'title' => 'Konfirmasi Approval Invoice',
      'subtitle' => 'Tinjau detail invoice sebelum menyetujui tindakan',
      'pill' => 'Approval Pemilik',
      'pillClass' => 'appr-req-all',
      'iconClass' => 'appr-icon-all',
      'icon' => 'las la-shield-alt',
    ],
  ];
  $meta = $metaByAction[$action] ?? $metaByAction['all'];
  $statusLower = strtolower(trim($invoice->status ?? 'Belum Lunas'));
  $statusClass = $statusLower === 'lunas' ? 'appr-status-lunas' : ($statusLower === 'batal' ? 'appr-status-batal' : 'appr-status-belum');
@endphp

<div class="page-content">
  <div class="container-fluid">
    <div class="appr-wrap">

      <div class="appr-topbar">
        <a href="{{ url('/list-invoice') }}" class="appr-back-link">
          <i class="las la-arrow-left"></i> Kembali ke Daftar Invoice
        </a>
        <div class="appr-breadcrumb">
          Invoice &rsaquo; <strong>Konfirmasi Approval</strong>
        </div>
      </div>

      <div class="appr-card">
        <div class="appr-card-header">
          <div class="appr-header-left">
            <div class="appr-icon-box {{ $meta['iconClass'] }}">
              <i class="{{ $meta['icon'] }}"></i>
            </div>
            <div>
              <h1 class="appr-title">{{ $meta['title'] }}</h1>
              <p class="appr-subtitle">{{ $meta['subtitle'] }}</p>
            </div>
          </div>
          <span class="appr-req-pill {{ $meta['pillClass'] }}">
            <i class="{{ $meta['icon'] }}"></i> {{ $meta['pill'] }}
          </span>
        </div>

        <div class="appr-card-body">
          <div class="appr-meta-grid">
            <div class="appr-meta-box">
              <div class="appr-meta-label">Nomor Invoice</div>
              <div class="appr-meta-value is-accent">#{{ $invoice->nomor_invoice }}</div>
              <div class="appr-meta-sub">Akses saat ini: <strong>{{ $invoice->approval ?? 'Lock' }}</strong></div>
            </div>

            <div class="appr-meta-box">
              <div class="appr-meta-label">Status Pembayaran</div>
              <div>
                <span class="appr-status-badge {{ $statusClass }}">
                  &bull; {{ $invoice->status ?? 'Belum Lunas' }}
                </span>
              </div>
              <div class="appr-meta-sub">{{ $invoice->jenis_pembayaran ?? '-' }}</div>
            </div>

            <div class="appr-meta-box">
              <div class="appr-meta-label">Pelanggan</div>
              <div class="appr-meta-value">{{ $invoice->customer ?: '-' }}</div>
              @if(!empty($invoice->perusahaan) && $invoice->perusahaan !== '-')
                <div class="appr-meta-sub">{{ $invoice->perusahaan }}</div>
              @endif
            </div>

            <div class="appr-meta-box">
              <div class="appr-meta-label">Total Tagihan</div>
              <div class="appr-meta-value is-total">Rp {{ $invoice->formatted_total_pembayaran }}</div>
              <div class="appr-meta-sub">{{ count($penjualan_barang) }} item tercatat</div>
            </div>
          </div>

          <div class="appr-section-title">Rincian Item</div>
          <div class="appr-items-wrap">
            <table class="appr-items-table">
              <thead>
                <tr>
                  <th>Item &amp; Deskripsi</th>
                  <th style="width: 90px; text-align: center;">Qty</th>
                  <th style="width: 140px; text-align: right;">Jumlah</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($penjualan_barang as $index => $jual)
                  @php
                    $itemObj = isset($barang[$index]) ? collect($barang[$index])->first() : null;
                  @endphp
                  <tr>
                    <td>
                      <div class="appr-item-name">{{ $itemObj->jenis_barang ?? '-' }}</div>
                      @if(!empty($jual->deskripsi_item))
                        <div class="appr-item-desc">{{ $jual->deskripsi_item }}</div>
                      @endif
                      <div class="appr-item-mobile-meta">
                        <span class="appr-item-mobile-qty">Qty: {{ $jual->qty }} {{ $jual->satuan ?? '' }}</span>
                        <span class="appr-item-mobile-total">Rp {{ $jumlahHarga[$index] ?? '0' }}</span>
                      </div>
                    </td>
                    <td class="appr-col-qty" style="text-align: center; white-space: nowrap;">{{ $jual->qty }} {{ $jual->satuan ?? '' }}</td>
                    <td class="appr-col-total" style="text-align: right; font-weight: 700; white-space: nowrap;">Rp {{ $jumlahHarga[$index] ?? '0' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="appr-actions">
            @if ($action === 'unlock' || $action === 'all')
              <form action="{{ url('invoice/ubah-status-unlock/' . $invoice->id) }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="appr-btn appr-btn-unlock">
                  <i class="las la-lock-open"></i> Setujui &amp; Buka Kunci Invoice
                </button>
              </form>
            @endif

            @if ($action === 'delete' || $action === 'all')
              <button type="button" class="appr-btn appr-btn-delete" onclick="confirmHapusApproval('{{ $invoice->id }}', '{{ addslashes(e($invoice->nomor_invoice)) }}')">
                <i class="las la-trash-alt"></i> Hapus Invoice Ini
              </button>
            @endif

            @if ($action === 'batal' || $action === 'all')
              @if ($invoice->status !== 'Batal')
                <button type="button" class="appr-btn appr-btn-batal" onclick="confirmBatalApproval('{{ $invoice->id }}', '{{ addslashes(e($invoice->nomor_invoice)) }}')">
                  <i class="las la-ban"></i> Batalkan Invoice
                </button>
              @elseif ($action === 'batal')
                <div class="appr-notice">
                  <i class="las la-info-circle me-1"></i> Invoice ini sudah berstatus <strong>Batal</strong>.
                </div>
              @endif
            @endif

            <a href="{{ url('/list-invoice') }}" class="appr-btn appr-btn-secondary">
              Kembali ke Daftar Invoice
            </a>
          </div>

          <form id="approvalHapusForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="alasan_hapus" id="approvalInputAlasanHapus">
          </form>

          <form id="approvalBatalForm" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="alasan_batal" id="approvalInputAlasanBatal">
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('plugins')
<script>
function confirmHapusApproval(id, nomorInvoice) {
    Swal.fire({
        title: 'Hapus Invoice',
        html: `Apakah Anda yakin ingin menghapus invoice <strong>#${nomorInvoice}</strong>?<br><span class="text-danger small">Tindakan ini akan mengembalikan stok barang/material dan menghapus SPK terkait.</span>`,
        input: 'textarea',
        inputValue: 'Dihapus oleh Pemilik atas permintaan Admin',
        inputPlaceholder: 'Tulis alasan penghapusan invoice di sini...',
        inputAttributes: {
            'aria-label': 'Tulis alasan hapus di sini'
        },
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Invoice',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#DC2626',
        cancelButtonColor: '#64748B',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Alasan penghapusan invoice wajib diisi!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById('approvalHapusForm');
            form.action = "{{ url('delete-invoice') }}/" + id;
            var inputHapus = document.getElementById('approvalInputAlasanHapus');
            if (inputHapus) {
                inputHapus.value = result.value.trim();
            }
            form.submit();
        }
    });
}

function confirmBatalApproval(id, nomorInvoice) {
    Swal.fire({
        title: 'Batalkan Invoice',
        html: `Apakah Anda yakin ingin membatalkan invoice <strong>#${nomorInvoice}</strong>?<br><span class="text-warning small">Stok barang/material akan dikembalikan.</span>`,
        input: 'textarea',
        inputValue: 'Dibatalkan oleh Pemilik atas permintaan Admin',
        inputPlaceholder: 'Tulis alasan pembatalan invoice di sini...',
        inputAttributes: {
            'aria-label': 'Tulis alasan batal di sini'
        },
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan Invoice',
        cancelButtonText: 'Kembali',
        confirmButtonColor: '#D97706',
        cancelButtonColor: '#64748B',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Alasan pembatalan invoice wajib diisi!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById('approvalBatalForm');
            form.action = "{{ url('ubah-status-batal') }}/" + id;
            var inputBatal = document.getElementById('approvalInputAlasanBatal');
            if (inputBatal) {
                inputBatal.value = result.value.trim();
            }
            form.submit();
        }
    });
}
</script>
@endsection
