# Script to update tambah-spb.blade.php and edit-spb.blade.php to Tokabe Warm Stone Design System

tambah_spb_content = '''@extends('layout.template')

@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ==========================================================================
       TOKABE TAMBAH SPB — DUAL THEME WARM STONE SYSTEM
       ========================================================================== */

    :root {
      --ibk-bg: #0C0A09;
      --ibk-surface: #14110F;
      --ibk-surface-hover: #1A1613;
      --ibk-card-bg: #14110F;
      --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
      --ibk-border: rgba(255, 255, 255, 0.08);
      --ibk-border-subtle: rgba(255, 255, 255, 0.04);
      --ibk-text: #FAFAFA;
      --ibk-text-muted: #A1A1AA;
      --ibk-text-dim: #71717A;

      --ibk-brand: #F59E0B;
      --ibk-brand-deep: #EA580C;
      --ibk-brand-soft: rgba(245, 158, 11, 0.12);
      --ibk-brand-border: rgba(245, 158, 11, 0.24);
      --ibk-brand-text: #FBBF24;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.14);
      --ibk-success-border: rgba(16, 185, 129, 0.28);
      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.14);
      --ibk-danger-border: rgba(239, 68, 68, 0.28);

      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #FAFAFA;
      --ibk-input-placeholder: #71717A;
      --ibk-popover-bg: #181412;

      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.06);
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      --ibk-bg: #F8FAFC;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FFF7ED;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
      --ibk-border: #E2E8F0;
      --ibk-border-subtle: #F1F5F9;
      --ibk-text: #0F172A;
      --ibk-text-muted: #64748B;
      --ibk-text-dim: #94A3B8;

      --ibk-brand: #EA580C;
      --ibk-brand-deep: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #EA580C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-input-placeholder: #94A3B8;
      --ibk-popover-bg: #FFFFFF;

      --ibk-th-bg: #F8FAFC;
      --ibk-th-text: #64748B;
      --ibk-td-border: #E2E8F0;
    }

    .num, .price, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    .form-page-wrapper {
      position: relative;
      width: 100%;
      min-height: calc(100vh - 120px);
      padding-bottom: 85px !important;
      margin-bottom: 24px !important;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      color: var(--ibk-text);
    }

    /* Header Section */
    .ibk-page-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 24px;
    }
    .ibk-page-title h1 {
      font-size: 20px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      letter-spacing: -0.015em;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .ibk-page-title h1 i {
      color: var(--ibk-brand);
      font-size: 22px;
    }
    .ibk-page-subtitle {
      font-size: 13px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
    }

    /* Buttons */
    .ibk-btn-primary {
      background: #EA580C !important;
      border: 1px solid #EA580C !important;
      color: #FFFFFF !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      padding: 8px 20px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      cursor: pointer !important;
      transition: background-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
      text-decoration: none !important;
    }
    .ibk-btn-primary:hover {
      background: #C2410C !important;
      border-color: #C2410C !important;
      color: #FFFFFF !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35) !important;
    }

    .ibk-btn-back {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      padding: 0 14px !important;
      height: 38px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      text-decoration: none !important;
      transition: all 150ms ease !important;
    }
    .ibk-btn-back:hover {
      background: var(--ibk-surface-hover) !important;
      border-color: var(--ibk-brand-border) !important;
      color: var(--ibk-text) !important;
    }

    .ibk-btn-cancel {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      font-weight: 500 !important;
      padding: 8px 18px !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      text-decoration: none !important;
      transition: all 150ms ease;
    }
    .ibk-btn-cancel:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }

    .ref-theme-toggle {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 0 16px;
      height: 38px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      background: var(--ibk-input-bg);
      border: 1px solid var(--ibk-border);
      color: var(--ibk-text);
      transition: all 180ms ease;
      white-space: nowrap;
    }
    .ref-theme-toggle:hover {
      background: var(--ibk-surface-hover);
      border-color: var(--ibk-brand-border);
      transform: translateY(-1px);
      color: var(--ibk-brand);
    }

    /* Form Container Cards */
    .ibk-form-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      margin-bottom: 24px;
      overflow: hidden;
    }
    .ibk-form-header {
      background: transparent;
      border-bottom: 1px solid var(--ibk-border);
      padding: 16px 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }
    .ibk-form-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 9px;
    }
    .ibk-form-title i {
      font-size: 18px;
      color: var(--ibk-brand);
    }

    /* Form Controls */
    .form-label-modern,
    .form-label-custom {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--ibk-text);
      margin-bottom: 0;
      display: flex;
      align-items: center;
    }
    .required-star {
      color: var(--ibk-danger) !important;
      font-weight: bold;
      margin-left: 4px;
    }
    .form-control-modern,
    .form-select-modern,
    .tokabe-input,
    .tokabe-select,
    .invoice-table .form-control,
    .invoice-table .form-select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      padding: 8px 14px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-modern,
    .form-select-modern,
    .tokabe-input,
    .tokabe-select {
      height: 40px !important;
    }
    textarea.form-control-modern {
      height: auto !important;
      min-height: 60px;
    }
    .form-control-modern::placeholder,
    .invoice-table textarea::placeholder,
    .invoice-table input::placeholder {
      color: var(--ibk-input-placeholder) !important;
    }
    .form-control-modern:focus,
    .form-select-modern:focus,
    .invoice-table .form-control:focus,
    .invoice-table .form-select:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }

    /* Logo Preview Box */
    .logo-preview-card {
      background: var(--ibk-surface-hover);
      border: 1px dashed var(--ibk-border);
      border-radius: 10px;
      padding: 16px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 100%;
      min-height: 140px;
    }

    /* Table Rincian Item SPB */
    .invoice-table {
      border-collapse: separate !important;
      border-spacing: 0 !important;
      width: 100% !important;
      margin-bottom: 0 !important;
      background: transparent !important;
    }
    .invoice-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text) !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      border-top: none !important;
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 12px 14px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .invoice-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 10px 14px !important;
      vertical-align: middle;
      background-color: transparent !important;
      color: var(--ibk-text) !important;
    }
    .invoice-table tbody tr:hover td {
      background-color: var(--ibk-surface-hover) !important;
    }

    .btn-row-delete,
    .product-removal .btn {
      width: 34px !important;
      height: 34px !important;
      background: transparent !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-danger) !important;
      border-radius: 6px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 0.15s ease !important;
      cursor: pointer !important;
      padding: 0 !important;
    }
    .btn-row-delete:hover,
    .product-removal .btn:hover {
      background: var(--ibk-danger-soft) !important;
      border-color: var(--ibk-danger-border) !important;
      color: var(--ibk-danger) !important;
    }
  </style>
@endsection

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="form-page-wrapper">

        <!-- Header Section -->
        <div class="ibk-page-header">
          <div class="ibk-page-title">
            <h1>
              <i class="ri-truck-line"></i>
              <span>Buat SPB (Surat Pengantar Barang)</span>
            </h1>
            <div class="ibk-page-subtitle">Form pembuatan surat pengantar pengiriman barang dan rincian item barang</div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <a href="{{ url('daftar-spb') }}" class="ibk-btn-back" title="Kembali ke Daftar SPB">
              <i class="ri-arrow-left-line"></i>
              <span>Daftar SPB</span>
            </a>
            <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
              <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
              <span id="theme-toggle-text">Mode Terang</span>
            </button>
          </div>
        </div>

        @if(Session::has('error'))
          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border); color: var(--ibk-danger); border-radius: 8px;">
            <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
            <div class="flex-grow-1 fs-13">SPB Gagal ditambahkan. Silakan periksa kembali input Anda.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border); color: var(--ibk-danger); border-radius: 8px;">
            <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
            <div class="flex-grow-1 fs-13">
              <strong>Validasi Gagal:</strong>
              <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        @endif

        <form method="POST" action="{{ url('store-spb') }}" class="needs-validation" id="spb_form">
          @csrf

          {{-- Card 1: Informasi Pengantar & Customer --}}
          <div class="ibk-form-card">
            <div class="ibk-form-header">
              <h5 class="ibk-form-title">
                <i class="ri-file-text-line"></i>
                <span>Informasi Surat Pengantar Barang</span>
              </h5>
            </div>
            <div class="p-4">
              <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                  <div class="row g-3">
                    {{-- Input Perusahaan SPB --}}
                    <div class="row col-12 align-items-center mb-2">
                      <label for="namaSpb" class="col-lg-4 form-label-modern">Perusahaan SPB <span class="required-star">*</span></label>
                      <div class="col-lg-8">
                        <select class="form-select form-select-modern @error('namaSpb') is-invalid @enderror" name="namaSpb" id="namaSpb" required aria-required="true">
                          @foreach($namaPerusahaan as $usaha)
                            <option value="{{ $usaha->id }}" {{ (old('namaSpb', $usaha->id) == $usaha->id) ? 'selected' : '' }}>
                              {{ $usaha->nama_perusahaan }}
                            </option>
                          @endforeach
                        </select>
                        @error('namaSpb')
                          <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Input Nama Customer --}}
                    <div class="row col-12 align-items-center mb-2">
                      <label for="customer" class="col-lg-4 form-label-modern">Nama Customer <span class="required-star">*</span></label>
                      <div class="col-lg-8">
                        <input class="form-control form-control-modern @error('customer') is-invalid @enderror" type="text" name="customer" id="customer" list="pelanggan"
                          placeholder="Nama pelanggan / penerima" value="{{ old('customer') }}" required aria-required="true">
                        <datalist id="pelanggan">
                          @foreach ($customer as $cust)
                            <option value="{{ $cust }}">
                          @endforeach
                        </datalist>
                        @error('customer')
                          <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Input Nama Perusahaan --}}
                    <div class="row col-12 align-items-center mb-2">
                      <label for="usaha" class="col-lg-4 form-label-modern">Nama Perusahaan <span class="required-star">*</span></label>
                      <div class="col-lg-8">
                        <input class="form-control form-control-modern @error('perusahaan') is-invalid @enderror" type="text" name="perusahaan" id="usaha" list="usaha_list"
                          placeholder="Nama instansi / perusahaan customer" value="{{ old('perusahaan') }}" required aria-required="true">
                        <datalist id="usaha_list">
                          @foreach ($perusahaan as $usaha_item)
                            <option value="{{ $usaha_item }}">
                          @endforeach
                        </datalist>
                        @error('perusahaan')
                          <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Input Nomor Telepon --}}
                    <div class="row col-12 align-items-center mb-2">
                      <label for="phone-number" class="col-lg-4 form-label-modern">Nomor Telepon <span class="required-star">*</span></label>
                      <div class="col-lg-8">
                        <input type="text" value="{{ old('no_telp') }}" name="no_telp" class="form-control form-control-modern num @error('no_telp') is-invalid @enderror"
                          placeholder="08xx xxxx xxxx" id="phone-number" required aria-required="true">
                        @error('no_telp')
                          <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Input Nama Penandatangan --}}
                    <div class="row col-12 align-items-center mb-2">
                      <label for="nama_penandatangan" class="col-lg-4 form-label-modern">Nama Penandatangan</label>
                      <div class="col-lg-8">
                        <input type="text" value="{{ old('nama_penandatangan') }}" name="nama_penandatangan" id="nama_penandatangan" class="form-control form-control-modern"
                          placeholder="Nama di bawah tanda tangan (Contoh: Oky Irawan)">
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Kolom Kanan: Preview Logo Perusahaan --}}
                <div class="col-lg-4">
                  <div class="logo-preview-card">
                    <div class="mb-2" style="max-height: 80px; display: flex; align-items: center; justify-content: center;">
                      <img src="{{ asset('storage/images/perusahaan/698c05828c9a6.png') }}" onerror="this.onerror=null;this.src='{{ asset('images/perusahaan/698c05828c9a6.png') }}';" class="img-fluid" alt="Logo Perusahaan SPB" style="max-height: 70px; object-fit: contain;">
                    </div>
                    <span class="fs-12 fw-medium" style="color: var(--ibk-text-muted);">Preview Kop SPB Resmi</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Card 2: Rincian Barang yang Diantar --}}
          <div class="ibk-form-card">
            <div class="ibk-form-header">
              <h5 class="ibk-form-title">
                <i class="ri-truck-line"></i>
                <span>Rincian Barang yang Diantar</span>
              </h5>
              <button type="button" class="ibk-btn-primary" onclick="new_link()" aria-label="Tambah Item Barang">
                <i class="ri-add-line fs-16" aria-hidden="true"></i>
                <span>Tambah Item</span>
              </button>
            </div>
            <div class="p-4">
              <div class="table-responsive">
                <table class="table invoice-table" aria-label="Tabel Rincian Item SPB">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;" class="text-center">#</th>
                      <th scope="col" style="min-width: 260px;">Item & Deskripsi <span class="required-star">*</span></th>
                      <th scope="col" style="width: 140px;">Satuan <span class="required-star">*</span></th>
                      <th scope="col" style="width: 110px;" class="text-center">Quantity <span class="required-star">*</span></th>
                      <th scope="col" style="min-width: 200px;">Keterangan</th>
                      <th scope="col" style="width: 70px;" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="newlink">
                    <tr id="1" class="product">
                      <th scope="row" class="product-id text-center num fw-medium" style="color: var(--ibk-text-muted);">1</th>
                      <td class="text-start">
                        <div class="mb-2">
                          <select class="form-select form-select-modern @error('barang_id.0') is-invalid @enderror" name="barang_id[]" required aria-label="Pilih Item Kategori">
                            <option value="" selected disabled>-- Pilih Item Barang --</option>
                            @foreach ($barang as $item)
                              <option value="{{ $item->id }}" {{ old('barang_id.0') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <textarea class="form-control form-control-modern @error('deskripsi_item.0') is-invalid @enderror"
                          name="deskripsi_item[]" rows="2" placeholder="Tuliskan spesifikasi / deskripsi item..." required aria-label="Deskripsi item barang">{{ old('deskripsi_item.0') }}</textarea>
                      </td>
                      <td>
                        <select class="form-select form-select-modern @error('satuan.0') is-invalid @enderror" name="satuan[]" required aria-label="Pilih Satuan">
                          <option value="" disabled selected>Pilih</option>
                          <option value="Set" {{ old('satuan.0') == 'Set' ? 'selected' : '' }}>Set</option>
                          <option value="Pcs" {{ old('satuan.0', 'Pcs') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                          <option value="Kotak" {{ old('satuan.0') == 'Kotak' ? 'selected' : '' }}>Kotak</option>
                          <option value="Blok" {{ old('satuan.0') == 'Blok' ? 'selected' : '' }}>Blok</option>
                          <option value="Lbr" {{ old('satuan.0') == 'Lbr' ? 'selected' : '' }}>Lbr</option>
                        </select>
                      </td>
                      <td>
                        <div class="input-step">
                          <input type="number" class="form-control form-control-modern text-center num @error('qty.0') is-invalid @enderror"
                            name="qty[]" value="{{ old('qty.0', 1) }}" min="1" step="1" required aria-label="Kuantitas barang">
                        </div>
                      </td>
                      <td>
                        <textarea class="form-control form-control-modern @error('keterangan.0') is-invalid @enderror"
                          name="keterangan[]" rows="2" placeholder="Catatan / keterangan tambahan...">{{ old('keterangan.0') }}</textarea>
                      </td>
                      <td class="product-removal text-center">
                        <button type="button" class="btn-row-delete" aria-label="Hapus baris item" title="Hapus baris">
                          <i class="ri-delete-bin-line fs-16" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="d-flex align-items-center gap-3 mt-4 pt-3" style="border-top: 1px solid var(--ibk-border) !important;">
                <button type="submit" id="simpan" class="ibk-btn-primary">
                  <i class="ri-save-line fs-16" aria-hidden="true"></i>
                  <span>Simpan SPB</span>
                </button>
                <a href="{{ url('daftar-spb') }}" class="ibk-btn-cancel">
                  <i class="ri-close-line fs-16" aria-hidden="true"></i>
                  <span>Batal</span>
                </a>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection

@section('plugins')
  <script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
  <script src="{{ asset('js/halaman/spb.js') }}"></script>
  <script>
    function initPageTheme() {
      var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
      var icon = document.getElementById('theme-toggle-icon');
      var text = document.getElementById('theme-toggle-text');
      if (icon) {
        icon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
      }
      if (text) {
        text.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
      }
    }

    $(document).ready(function() {
      initPageTheme();
    });
  </script>
@endsection
'''

with open('resources/views/pages/SPB/tambah-spb.blade.php', 'w', encoding='utf-8') as f:
    f.write(tambah_spb_content)
print("Updated resources/views/pages/SPB/tambah-spb.blade.php")

