@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  /* ==========================================================================
     DESIGN SYSTEM TOKENS (DESIGN.md)
     Dark Slate Palette (#020617, #0F172A, #161B22, #1E293B, #334155)
     ========================================================================== */

  .page-title-box h4 {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: #F1F5F9;
  }
  .breadcrumb .breadcrumb-item a {
    color: #94A3B8;
    text-decoration: none;
    transition: color 0.15s ease;
  }
  .breadcrumb .breadcrumb-item a:hover {
    color: #F1F5F9;
  }
  .breadcrumb .breadcrumb-item.active {
    color: #64748B;
  }

  .tokabe-form-card {
    background: #161B22 !important;
    border: 1px solid #1E293B !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    margin-bottom: 24px;
    overflow: hidden;
  }
  .tokabe-form-header {
    background: transparent !important;
    border-bottom: 1px solid #1E293B !important;
    padding: 20px 24px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .tokabe-form-title {
    font-size: 16px;
    font-weight: 600;
    color: #F1F5F9;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .tokabe-form-subtitle {
    font-size: 13px;
    color: #94A3B8;
    margin-top: 4px;
    margin-bottom: 0;
  }

  .form-label-modern {
    font-size: 13px;
    font-weight: 500;
    color: #CBD5E1;
    margin-bottom: 6px;
    display: block;
  }
  .form-label-modern .required-star {
    color: #EF4444;
    margin-left: 2px;
  }
  .form-control-modern {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 8px !important;
    height: 42px !important;
    font-size: 13.5px !important;
    padding: 8px 14px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .form-control-modern::placeholder {
    color: #64748B !important;
  }
  .form-control-modern:hover:not(:disabled) {
    border-color: #475569 !important;
  }
  .form-control-modern:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    outline: none !important;
    background-color: #0F172A !important;
  }
  .form-help-text {
    font-size: 11.5px;
    color: #64748B;
    margin-top: 4px;
    margin-bottom: 0;
  }

  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 9px 20px !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s ease;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #F1F5F9 !important;
    border-color: #475569 !important;
  }
  .btn-form-submit {
    background-color: #D97706 !important;
    border: 1px solid #D97706 !important;
    color: #FFFFFF !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 9px 24px !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  }
  .btn-form-submit:hover {
    background-color: #B45309 !important;
    border-color: #B45309 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(217, 119, 6, 0.35);
  }
  .btn-form-submit:active {
    transform: scale(0.98);
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
            <h4 class="mb-sm-0 text-white fw-bold">Edit Vendor</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Vendor</a></li>
              <li class="breadcrumb-item"><a href="{{ route('vendor.list') }}">Daftar Vendor</a></li>
              <li class="breadcrumb-item active">Edit Vendor</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Container Card (§12.1 & §10) -->
    <div class="row justify-content-center">
      <div class="col-xxl-8 col-xl-9">
        <div class="tokabe-form-card">
          <div class="tokabe-form-header">
            <div>
              <h5 class="tokabe-form-title">
                <i class="ri-edit-line fs-20 text-warning"></i>
                <span>Edit Identitas Vendor</span>
              </h5>
              <p class="tokabe-form-subtitle">
                Perbarui nama atau identitas resmi vendor / supplier.
              </p>
            </div>
            <a href="{{ route('vendor.list') }}" class="btn-form-cancel">
              <i class="las la-arrow-left"></i>
              <span>Kembali</span>
            </a>
          </div>

          <form action="{{ route('vendor.update', ['id' => $vendor->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-4">
              <div class="mb-3">
                <label class="form-label-modern" for="vendor">
                  Nama Vendor / Supplier <span class="required-star">*</span>
                </label>
                <input type="text" 
                       id="vendor" 
                       name="vendor" 
                       class="form-control form-control-modern" 
                       value="{{ $vendor->nama_vendor }}"
                       placeholder="Nama Vendor" 
                       required 
                       autofocus>
                <p class="form-help-text">Perubahan nama akan otomatis tersinkron ke seluruh transaksi pembelian</p>
                @error('vendor')
                  <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="px-4 py-3 border-top border-dark d-flex justify-content-between align-items-center" style="background-color: rgba(15, 23, 42, 0.4); border-color: #1E293B !important;">
              <a href="{{ route('vendor.list') }}" class="btn-form-cancel">
                <i class="las la-times"></i>
                <span>Batal</span>
              </a>
              <button type="submit" class="btn btn-form-submit">
                <i class="las la-save fs-16"></i>
                <span>Simpan Perubahan</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection