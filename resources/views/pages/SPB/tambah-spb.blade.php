@extends('layout.template')

@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    .form-select-modern,
    .invoice-table .form-control,
    .invoice-table .form-select {
      background-color: #0B1120 !important;
      border: 1.5px solid #3B4B66 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      font-size: 14px !important;
      padding: 8px 14px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
    }
    .form-control-modern,
    .form-select-modern {
      height: 42px !important;
    }
    .form-control-modern::placeholder,
    .invoice-table textarea::placeholder,
    .invoice-table input::placeholder {
      color: #94A3B8 !important;
      opacity: 1;
    }
    .form-control-modern:hover:not(:disabled),
    .form-select-modern:hover:not(:disabled),
    .invoice-table .form-control:hover,
    .invoice-table .form-select:hover {
      border-color: #64748B !important;
    }
    .form-control-modern:focus,
    .form-select-modern:focus,
    .invoice-table .form-control:focus,
    .invoice-table .form-select:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.35) !important;
      outline: none !important;
      background-color: #0B1120 !important;
    }

    /* Logo Preview Box */
    .logo-preview-card {
      background: #101726;
      border: 1.5px dashed #3B4B66;
      border-radius: 12px;
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
    }
    .invoice-table thead th {
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
    .invoice-table tbody td {
      border-bottom: 1px solid #222D3F !important;
      padding: 12px 14px !important;
      vertical-align: middle;
      background-color: #151D2A !important;
      color: #E2E8F0 !important;
    }
    .invoice-table tbody tr:hover td {
      background-color: #1A2436 !important;
    }

    /* Action Buttons */
    .btn-add-item {
      background: #059669 !important;
      border: 1.5px solid #10B981 !important;
      color: #FFFFFF !important;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13.5px;
      padding: 7px 18px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(5, 150, 105, 0.35);
      text-decoration: none;
    }
    .btn-add-item:hover {
      background: #10B981 !important;
      border-color: #34D399 !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.45);
    }
    .btn-row-delete,
    .product-removal .btn {
      width: 38px !important;
      height: 38px !important;
      background: rgba(239, 68, 68, 0.15) !important;
      border: 1.5px solid rgba(239, 68, 68, 0.4) !important;
      color: #FCA5A5 !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 0.15s ease !important;
      cursor: pointer !important;
      padding: 0 !important;
    }
    .btn-row-delete:hover,
    .product-removal .btn:hover {
      background: #EF4444 !important;
      border-color: #EF4444 !important;
      color: #FFFFFF !important;
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
  </style>
@endsection

@section('content')
  <div class="page-content">
    <div class="container-fluid">

      <!-- Page Header & Title (§16.2) -->
      <div class="row mb-3">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
            <div>
              <h4 class="mb-sm-0 text-white fw-bold">Buat SPB (Surat Pengantar Barang)</h4>
            </div>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url('daftar-spb') }}">SPB</a></li>
                <li class="breadcrumb-item active">Buat SPB</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45); color: #FCA5A5; border-radius: 8px;">
          <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
          <div class="flex-grow-1">SPB Gagal ditambahkan. Silakan periksa kembali input Anda.</div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45); color: #FCA5A5; border-radius: 8px;">
          <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
          <div class="flex-grow-1">
            <strong>Validasi Gagal:</strong>
            <ul class="mb-0 mt-1 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      <form method="POST" action="{{ url('store-spb') }}" class="needs-validation" id="spb_form">
        @csrf

        {{-- Card 1: Informasi Pengantar & Customer (§12.1) --}}
        <div class="tokabe-form-card">
          <div class="tokabe-form-header">
            <h5 class="tokabe-form-title">
              <i class="ri-file-text-line fs-20 text-info" aria-hidden="true"></i>
              <span>Informasi Surat Pengantar Barang</span>
            </h5>
            <a href="{{ url('daftar-spb') }}" class="btn-form-cancel" aria-label="Kembali ke Daftar SPB">
              <i class="las la-arrow-left fs-16"></i>
              <span>Kembali</span>
            </a>
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
                  <span class="fs-12 fw-medium" style="color: #94A3B8;">Preview Kop SPB Resmi</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Card 2: Rincian Barang yang Diantar (§12.1 & §13) --}}
        <div class="tokabe-form-card">
          <div class="tokabe-form-header">
            <h5 class="tokabe-form-title">
              <i class="ri-truck-line fs-20 text-warning" aria-hidden="true"></i>
              <span>Rincian Barang yang Diantar</span>
            </h5>
            <button type="button" class="btn-add-item" onclick="new_link()" aria-label="Tambah Item Barang">
              <i class="las la-plus fs-16" aria-hidden="true"></i>
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
                    <th scope="row" class="product-id text-center num fw-medium" style="color: #94A3B8;">1</th>
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
                        <i class="las la-trash fs-18" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="d-flex align-items-center gap-3 mt-4 pt-3" style="border-top: 1.5px solid #28354A !important;">
              <button type="submit" id="simpan" class="btn btn-form-submit">
                <i class="las la-save fs-18" aria-hidden="true"></i>
                <span>Simpan SPB</span>
              </button>
              <a href="{{ url('daftar-spb') }}" class="btn-form-cancel">
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
  <script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
  <script src="{{ asset('js/halaman/spb.js') }}"></script>
@endsection