@section('head')
<style>
  /* ==========================================================================
     DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
     Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
     ========================================================================== */

  .num, .price, .numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  /* Page Header Title & Breadcrumb (§16.2) */
  .page-title-box h4 {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: #F8FAFC !important;
  }
  .breadcrumb .breadcrumb-item a {
    color: #94A3B8 !important;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.15s ease;
  }
  .breadcrumb .breadcrumb-item a:hover {
    color: #60A5FA !important;
  }
  .breadcrumb .breadcrumb-item.active {
    color: #E2E8F0 !important;
    font-weight: 600;
  }

  /* Form Container Cards (§12.1) */
  .tokabe-form-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25) !important;
    margin-bottom: 24px;
    overflow: hidden;
  }
  .tokabe-form-header {
    background: #1A2436 !important;
    border-bottom: 1.5px solid #28354A !important;
    padding: 18px 24px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .tokabe-form-title {
    font-size: 15.5px;
    font-weight: 700;
    color: #F8FAFC !important;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Form Labels & Controls (§10.1) - High Contrast & Visible Borders */
  .form-label-modern {
    font-size: 13.5px;
    font-weight: 600;
    color: #F1F5F9 !important;
    margin-bottom: 0;
    display: flex;
    align-items: center;
  }
  .form-label-modern .required-star {
    color: #EF4444 !important;
    font-weight: bold;
    margin-left: 4px;
  }
  .form-control-modern,
  .form-select-modern {
    background-color: #0B1120 !important;
    border: 1.5px solid #3B4B66 !important;
    color: #F8FAFC !important;
    border-radius: 8px !important;
    height: 42px !important;
    font-size: 14px !important;
    padding: 8px 14px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
  }
  .form-control-modern::placeholder {
    color: #94A3B8 !important;
    opacity: 1;
  }
  .form-control-modern:hover:not(:disabled),
  .form-select-modern:hover:not(:disabled) {
    border-color: #64748B !important;
  }
  .form-control-modern:focus,
  .form-select-modern:focus {
    border-color: #6366F1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.35) !important;
    outline: none !important;
    background-color: #0B1120 !important;
  }
  .form-control-modern:disabled,
  .form-control-modern[readonly] {
    background-color: #1A2436 !important;
    color: #E2E8F0 !important;
    border-color: #28354A !important;
    font-weight: 500;
    cursor: default;
  }

  /* Buttons */
  .btn-add-item {
    background: #059669 !important;
    border: 1.5px solid #10B981 !important;
    color: #FFFFFF !important;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13.5px;
    padding: 7px 16px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s ease;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(5, 150, 105, 0.35);
  }
  .btn-add-item:hover {
    background: #10B981 !important;
    border-color: #34D399 !important;
    color: #FFFFFF !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.45);
  }
  .btn-add-item:focus-visible {
    outline: 2px solid #6EE7B7 !important;
    outline-offset: 2px;
  }
  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #E2E8F0 !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    padding: 9px 22px !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
    border-color: #475569 !important;
  }
  .btn-form-cancel:focus-visible {
    outline: 2px solid #94A3B8 !important;
    outline-offset: 2px;
  }
  .btn-form-submit {
    background-color: #4F46E5 !important;
    border: 1.5px solid #6366F1 !important;
    color: #FFFFFF !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    padding: 9px 26px !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.35);
  }
  .btn-form-submit:hover {
    background-color: #4338CA !important;
    border-color: #818CF8 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.45);
  }
  .btn-form-submit:focus-visible {
    outline: 2px solid #A5B4FC !important;
    outline-offset: 2px;
  }

  /* Table Rincian Barang - High Readability */
  .tokabe-items-table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
    margin-bottom: 0 !important;
  }
  .tokabe-items-table thead th {
    background-color: #101726 !important;
    color: #CBD5E1 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-top: none !important;
    border-bottom: 2px solid #28354A !important;
    padding: 13px 14px !important;
    vertical-align: middle;
  }
  .tokabe-items-table tbody td {
    border-bottom: 1px solid #222D3F !important;
    padding: 10px 12px !important;
    vertical-align: middle;
    background-color: #151D2A !important;
  }
  .tokabe-items-table .form-control-modern,
  .tokabe-items-table .form-select-modern {
    height: 40px !important;
    font-size: 13.5px !important;
    padding: 6px 12px !important;
  }
  .tokabe-items-table .jumlah-harga {
    background-color: #162032 !important;
    border: 1.5px solid #28354A !important;
    color: #38BDF8 !important;
    font-weight: 700 !important;
  }
  .btn-row-delete {
    width: 38px;
    height: 38px;
    background: rgba(239, 68, 68, 0.15);
    border: 1.5px solid rgba(239, 68, 68, 0.4);
    color: #FCA5A5;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    cursor: pointer;
  }
  .btn-row-delete:hover:not(:disabled) {
    background: #EF4444;
    border-color: #EF4444;
    color: #FFFFFF;
  }
  .btn-row-delete:focus-visible {
    outline: 2px solid #F87171;
    outline-offset: 2px;
  }
  .btn-row-delete:disabled {
    opacity: 0.35;
    cursor: not-allowed;
    border-color: #28354A;
  }

  /* Summary Table */
  .summary-card {
    background: #101726 !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3) !important;
  }
  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 18px;
    border-bottom: 1px solid #222D3F;
    font-size: 13.5px;
  }
  .summary-row:last-child {
    border-bottom: none;
  }
  .input-group-addon-modern {
    background-color: #1E293B !important;
    border: 1.5px solid #3B4B66 !important;
    border-right: none !important;
    color: #CBD5E1 !important;
    font-size: 13.5px !important;
    font-weight: 700 !important;
    padding: 0 14px !important;
    display: flex;
    align-items: center;
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
  }
  .input-group .form-control-modern {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
  }
</style>
@endsection

@extends('layout.template')

@section('content')
<div class="page-content">
  <div class="container-fluid">

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Tambah Pembelian &mdash; {{ $vendor->nama_vendor }}</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ route('vendor.list') }}">Vendor</a></li>
              <li class="breadcrumb-item"><a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}">{{ $vendor->nama_vendor }}</a></li>
              <li class="breadcrumb-item active">Tambah Pembelian</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    @if (isset($errors) && $errors->any())
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45); color: #FCA5A5; border-radius: 8px;">
        <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
        <div class="flex-grow-1">
          <strong>Perhatian:</strong>
          <ul class="mb-0 mt-1 ps-3">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    @endif

    <form action="{{ route('pembelian.store') }}" method="POST" id="form-pembelian">
      @csrf
      <input type="hidden" name="token" value="{{ $uniqueToken }}">
      <input type="hidden" name="id_vendor" value="{{ $vendor->id }}">
      <input type="hidden" name="vendor" value="{{ $vendor->id }}">

      {{-- Card 1: Informasi Pembelian (§12.1) --}}
      <div class="tokabe-form-card">
        <div class="tokabe-form-header">
          <h5 class="tokabe-form-title">
            <i class="ri-file-text-line fs-20 text-info" aria-hidden="true"></i>
            <span>Informasi Pembelian</span>
          </h5>
          <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="btn-form-cancel" aria-label="Kembali ke Daftar Pembelian">
            <i class="las la-arrow-left fs-16"></i>
            <span>Kembali</span>
          </a>
        </div>
        <div class="p-4">
          <div class="row g-4">
            {{-- Kolom Kiri --}}
            <div class="col-lg-6">
              <div class="mb-3 row align-items-center">
                <label for="anggaran_select" class="col-lg-4 form-label-modern">Pakai Anggaran <span class="required-star">*</span></label>
                <div class="col-lg-8">
                  <select name="anggaran" id="anggaran_select" class="form-select form-select-modern @error('anggaran') is-invalid @enderror" required aria-required="true">
                    <option value="">-- Pilih Anggaran --</option>
                    @foreach ($budgets as $b)
                      <option value="{{ $b->id }}" {{ old('anggaran') == $b->id ? 'selected' : '' }}>
                        {{ $b->nama_budget }} &mdash; Rp {{ number_format($b->anggaran, 0, ',', '.') }}
                      </option>
                    @endforeach
                  </select>
                  @error('anggaran')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label for="nama_vendor_input" class="col-lg-4 form-label-modern">Nama Vendor</label>
                <div class="col-lg-8">
                  <input type="text" id="nama_vendor_input" class="form-control form-control-modern" value="{{ $vendor->nama_vendor }}" readonly>
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label for="nomor_inv_input" class="col-lg-4 form-label-modern">Nomor Invoice <span class="required-star">*</span></label>
                <div class="col-lg-8">
                  <input type="text" name="nomor_inv" id="nomor_inv_input"
                         class="form-control form-control-modern @error('nomor_inv') is-invalid @enderror"
                         placeholder="Contoh: INV-2026-001" value="{{ old('nomor_inv') }}" required aria-required="true">
                  @error('nomor_inv')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                </div>
              </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-lg-6">
              <div class="mb-3 row align-items-center">
                <label for="tanggal_input" class="col-lg-4 form-label-modern">Tanggal Pembelian <span class="required-star">*</span></label>
                <div class="col-lg-8">
                  <input type="date" name="tanggal" id="tanggal_input"
                         class="form-control form-control-modern @error('tanggal') is-invalid @enderror"
                         value="{{ old('tanggal', date('Y-m-d')) }}" required aria-required="true">
                  @error('tanggal')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label for="tanggal_jto_input" class="col-lg-4 form-label-modern">Tanggal Jatuh Tempo</label>
                <div class="col-lg-8">
                  <input type="date" name="tanggal_jto" id="tanggal_jto_input"
                         class="form-control form-control-modern @error('tanggal_jto') is-invalid @enderror"
                         value="{{ old('tanggal_jto') }}">
                  @error('tanggal_jto')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                </div>
              </div>

              <div class="mb-3 row align-items-center">
                <label for="status_pembelian" class="col-lg-4 form-label-modern">Status Pembelian <span class="required-star">*</span></label>
                <div class="col-lg-8">
                  <select name="status" id="status_pembelian" class="form-select form-select-modern @error('status') is-invalid @enderror" required onchange="handleStatusChange()" aria-required="true">
                    <option value="Belum Lunas" {{ old('status', 'Belum Lunas') === 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="Lunas" {{ old('status') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                  </select>
                  @error('status')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Card 2: Rincian Barang / Jasa (§12.1 & §13) --}}
      <div class="tokabe-form-card">
        <div class="tokabe-form-header">
          <h5 class="tokabe-form-title">
            <i class="ri-shopping-cart-2-line fs-20 text-warning" aria-hidden="true"></i>
            <span>Rincian Barang / Jasa</span>
          </h5>
          <button type="button" class="btn-add-item" onclick="tambahItem()" aria-label="Tambah Baris Barang">
            <i class="las la-plus fs-16" aria-hidden="true"></i>
            <span>Tambah Barang</span>
          </button>
        </div>
        <div class="p-4">
          <div class="table-responsive">
            <table class="table tokabe-items-table" id="item-table" aria-label="Tabel Rincian Item Barang">
              <thead>
                <tr>
                  <th scope="col" style="min-width: 250px;">Keterangan / Deskripsi Barang <span class="required-star">*</span></th>
                  <th scope="col" style="width: 180px;" class="text-end">Harga Satuan (Rp) <span class="required-star">*</span></th>
                  <th scope="col" style="width: 110px;" class="text-center">Qty <span class="required-star">*</span></th>
                  <th scope="col" style="width: 125px;">Satuan</th>
                  <th scope="col" style="width: 180px;" class="text-end">Jumlah Harga (Rp)</th>
                  <th scope="col" style="width: 70px;" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody id="item-body">
                <tr class="item-row">
                  <td>
                    <input type="text" name="items[0][deskripsi]" class="form-control form-control-modern" placeholder="Deskripsi item barang" required aria-label="Deskripsi item barang">
                  </td>
                  <td>
                    <input type="text" inputmode="numeric" name="items[0][harga_barang]" class="form-control form-control-modern harga text-end num" placeholder="0" value="0" oninput="formatInputRibuan(this); hitungBaris(this)" required aria-label="Harga satuan barang">
                  </td>
                  <td>
                    <input type="number" name="items[0][qty]" class="form-control form-control-modern qty text-center num" placeholder="1" min="1" step="1" value="1" oninput="hitungBaris(this)" required aria-label="Kuantitas barang">
                  </td>
                  <td>
                    <select name="items[0][satuan]" class="form-select form-select-modern" aria-label="Pilih satuan">
                      <option value="Pcs">Pcs</option>
                      <option value="Set">Set</option>
                      <option value="Und">Und</option>
                      <option value="Blok">Blok</option>
                      <option value="Rim">Rim</option>
                      <option value="Lbr">Lbr</option>
                      <option value="Ktk">Ktk</option>
                      <option value="Unit">Unit</option>
                      <option value="Kg">Kg</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-modern jumlah-harga text-end num" placeholder="0" readonly value="0" aria-label="Jumlah harga subtotal">
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn-row-delete btn-hapus-item" onclick="hapusItem(this)" disabled aria-label="Hapus baris barang" title="Hapus baris">
                      <i class="las la-trash fs-18" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          {{-- Ringkasan Pembayaran di Bawah Kanan --}}
          <div class="row justify-content-end mt-4">
            <div class="col-lg-5 col-md-7">
              <div class="summary-card">
                <div class="summary-row">
                  <span class="fw-medium" style="color: #CBD5E1;">Subtotal</span>
                  <span class="fw-bold text-white num fs-14" id="summary-subtotal">Rp 0</span>
                </div>
                <div class="summary-row">
                  <span class="fw-bold" style="color: #E2E8F0;">Jumlah Total</span>
                  <span class="fw-bold fs-16 num" style="color: #38BDF8;" id="summary-total">Rp 0</span>
                </div>
                <div class="summary-row">
                  <span class="fw-medium" style="color: #CBD5E1;">Terbayar</span>
                  <div class="input-group input-group-sm" style="max-width: 210px;">
                    <span class="input-group-addon-modern">Rp</span>
                    <input type="text" inputmode="numeric" name="terbayar" id="terbayar"
                           class="form-control form-control-modern text-end fw-bold num fs-14"
                           style="color: #34D399;"
                           value="{{ number_format(old('terbayar', 0), 0, ',', '.') }}"
                           placeholder="0"
                           aria-label="Jumlah nominal terbayar"
                           oninput="formatInputRibuan(this); handleTerbayarChange()">
                  </div>
                </div>
                <div class="summary-row" id="summary-sisa-row">
                  <span class="fw-bold" style="color: #FCA5A5;">Sisa Pembayaran</span>
                  <span class="fw-bold fs-16 num" style="color: #FB7185;" id="summary-sisa">Rp 0</span>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex align-items-center gap-3 mt-4 pt-3" style="border-top: 1.5px solid #28354A !important;">
            <button type="submit" class="btn btn-form-submit">
              <i class="las la-save fs-18" aria-hidden="true"></i>
              <span>Simpan Pembelian</span>
            </button>
            <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="btn-form-cancel">
              <i class="las la-times fs-16" aria-hidden="true"></i>
              <span>Batal</span>
            </a>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection

@section('plugins')
<script>
  let itemIndex = 1;
  const satuanOptions = ["Pcs", "Set", "Und", "Blok", "Rim", "Lbr", "Ktk", "Unit", "Kg", "Lainnya"];

  function parseRibuan(val) {
    if (typeof val === 'number') return val;
    if (!val) return 0;
    let clean = val.toString().replace(/\D/g, '');
    return parseFloat(clean) || 0;
  }

  function formatRp(val) {
    let num = Math.round(Number(val) || 0);
    return num.toLocaleString('id-ID');
  }

  function formatInputRibuan(input) {
    let raw = parseRibuan(input.value);
    input.value = raw > 0 ? formatRp(raw) : '0';
  }

  function satuanSelect(name) {
    let opts = satuanOptions.map(s => `<option value="${s}">${s}</option>`).join('');
    return `<select name="${name}" class="form-select form-select-modern" aria-label="Pilih satuan">${opts}</select>`;
  }

  function tambahItem() {
    const tbody = document.getElementById('item-body');
    const i = itemIndex++;
    const tr = document.createElement('tr');
    tr.className = 'item-row';
    tr.innerHTML = [
      '<td><input type="text" name="items[' + i + '][deskripsi]" class="form-control form-control-modern" placeholder="Deskripsi item barang" required aria-label="Deskripsi item barang"></td>',
      '<td><input type="text" inputmode="numeric" name="items[' + i + '][harga_barang]" class="form-control form-control-modern harga text-end num" placeholder="0" value="0" oninput="formatInputRibuan(this); hitungBaris(this)" required aria-label="Harga satuan barang"></td>',
      '<td><input type="number" name="items[' + i + '][qty]" class="form-control form-control-modern qty text-center num" placeholder="1" min="1" step="1" value="1" oninput="hitungBaris(this)" required aria-label="Kuantitas barang"></td>',
      '<td>' + satuanSelect('items[' + i + '][satuan]') + '</td>',
      '<td><input type="text" class="form-control form-control-modern jumlah-harga text-end num" placeholder="0" readonly value="0" aria-label="Jumlah harga subtotal"></td>',
      '<td class="text-center"><button type="button" class="btn-row-delete btn-hapus-item" onclick="hapusItem(this)" aria-label="Hapus baris barang" title="Hapus baris"><i class="las la-trash fs-18" aria-hidden="true"></i></button></td>'
    ].join('');

    tbody.appendChild(tr);
    updateHapusBtn();
    hitungRingkasan();
  }

  function hapusItem(btn) {
    btn.closest('tr').remove();
    updateHapusBtn();
    hitungRingkasan();
  }

  function updateHapusBtn() {
    const rows = document.querySelectorAll('#item-body .item-row');
    rows.forEach(function(row) {
      const button = row.querySelector('.btn-hapus-item');
      if (button) {
        button.disabled = rows.length <= 1;
      }
    });
  }

  function hitungBaris(input) {
    const row = input.closest('tr');
    const harga = parseRibuan(row.querySelector('.harga').value);
    const qty = parseFloat(row.querySelector('.qty').value) || 0;
    const subtotal = Math.round(harga * qty);
    row.querySelector('.jumlah-harga').value = formatRp(subtotal);
    hitungRingkasan();
  }

  function getSubtotalHarga() {
    let subtotal = 0;
    document.querySelectorAll('#item-body .item-row').forEach(function(row) {
      const harga = parseRibuan(row.querySelector('.harga').value);
      const qty = parseFloat(row.querySelector('.qty').value) || 0;
      subtotal += harga * qty;
    });
    return Math.round(subtotal);
  }

  function hitungRingkasan() {
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    // Update status & terbayar
    const statusEl = document.getElementById('status_pembelian');
    const status = statusEl ? statusEl.value : 'Belum Lunas';
    const terbayarInput = document.getElementById('terbayar');

    if (status === 'Lunas') {
      if (terbayarInput) {
        terbayarInput.value = formatRp(total);
        terbayarInput.readOnly = true;
      }
    } else {
      if (terbayarInput) {
        terbayarInput.readOnly = false;
        let curVal = parseRibuan(terbayarInput.value);
        if (curVal > total) {
          terbayarInput.value = formatRp(total);
        }
      }
    }

    const terbayar = terbayarInput ? parseRibuan(terbayarInput.value) : 0;
    const sisa = Math.max(0, total - terbayar);

    // Update ringkasan tabel bawah
    document.getElementById('summary-subtotal').textContent = 'Rp ' + formatRp(subtotal);
    document.getElementById('summary-total').textContent = 'Rp ' + formatRp(total);
    document.getElementById('summary-sisa').textContent = 'Rp ' + formatRp(sisa);
  }

  function handleStatusChange() {
    const statusEl = document.getElementById('status_pembelian');
    const status = statusEl ? statusEl.value : 'Belum Lunas';
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    const terbayarInput = document.getElementById('terbayar');

    if (status === 'Lunas') {
      if (terbayarInput) {
        terbayarInput.value = formatRp(total);
        terbayarInput.readOnly = true;
      }
    } else {
      if (terbayarInput) {
        terbayarInput.readOnly = false;
        terbayarInput.value = '0';
      }
    }
    hitungRingkasan();
  }

  function handleTerbayarChange() {
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    const terbayarInput = document.getElementById('terbayar');
    let terbayar = terbayarInput ? parseRibuan(terbayarInput.value) : 0;

    if (terbayar > total) {
      terbayar = total;
      if (terbayarInput) terbayarInput.value = formatRp(total);
    }

    const sisa = Math.max(0, total - terbayar);
    document.getElementById('summary-sisa').textContent = 'Rp ' + formatRp(sisa);

    const statusEl = document.getElementById('status_pembelian');
    if (statusEl) {
      if (total > 0 && terbayar >= total) {
        statusEl.value = 'Lunas';
      } else {
        statusEl.value = 'Belum Lunas';
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    updateHapusBtn();
    document.querySelectorAll('.harga').forEach(function(input) {
      formatInputRibuan(input);
    });
    const terbayarInput = document.getElementById('terbayar');
    if (terbayarInput) {
      formatInputRibuan(terbayarInput);
    }
    hitungRingkasan();

    // Sebelum form submit, pastikan angka dikirim tanpa titik pemisah
    document.querySelectorAll('form').forEach(function(form) {
      form.addEventListener('submit', function() {
        document.querySelectorAll('.harga').forEach(function(el) {
          el.value = el.value.replace(/\./g, '');
        });
        const tb = document.getElementById('terbayar');
        if (tb) {
          tb.value = tb.value.replace(/\./g, '');
        }
      });
    });
  });
</script>
@endsection