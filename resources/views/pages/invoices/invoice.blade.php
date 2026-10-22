@section('head')
<!-- dropzone css -->
<link rel="stylesheet" href="{{asset('libs/dropzone/dropzone.css')}}" type="text/css" />
<!-- Sweet Alert css-->
<link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<!-- flatpickr css -->
<link rel="stylesheet" href="{{asset('libs/flatpickr/flatpickr.min.css')}}" type="text/css" />

<style>
/* ==========================================================================
   UI/UX PRO MAX - TOKABE/IBEKAMI INVOICE FORM (High Visibility & Accessibility)
   WCAG AA/AAA compliant contrast ratios (7:1+), pristine alignment, zero clutter
   ========================================================================== */

/* Flatpickr Calendar - Solid Opaque Dark Theme & High Elevation */
.flatpickr-calendar {
    background: #1c222d !important;
    border: 1px solid rgba(255, 255, 255, 0.18) !important;
    border-radius: 12px !important;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
    z-index: 999999 !important;
    font-family: inherit !important;
    overflow: hidden !important;
}
.flatpickr-calendar::before,
.flatpickr-calendar::after {
    border-bottom-color: #151a23 !important;
}
.flatpickr-months {
    background: #151a23 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 6px 0 !important;
}
.flatpickr-months .flatpickr-month {
    color: #ffffff !important;
    fill: #ffffff !important;
    height: 38px !important;
}
.flatpickr-current-month {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    padding-top: 4px !important;
}
.flatpickr-current-month .cur-month {
    color: #ffffff !important;
    font-weight: 700 !important;
}
.flatpickr-current-month input.cur-year {
    color: #ffffff !important;
    font-weight: 700 !important;
}
.flatpickr-months .flatpickr-prev-month,
.flatpickr-months .flatpickr-next-month {
    color: #ffffff !important;
    fill: #ffffff !important;
    padding: 6px 10px !important;
}
.flatpickr-months .flatpickr-prev-month:hover svg,
.flatpickr-months .flatpickr-next-month:hover svg {
    fill: #38bdf8 !important;
}
span.flatpickr-weekday {
    background: #151a23 !important;
    color: #94a3b8 !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}
.flatpickr-weekdays {
    background: #151a23 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    height: 32px !important;
}
.flatpickr-days {
    background: #1c222d !important;
    width: 100% !important;
}
.dayContainer {
    background: #1c222d !important;
    padding: 6px 4px !important;
    min-width: 100% !important;
    max-width: 100% !important;
}
.flatpickr-day {
    color: #f1f5f9 !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    font-size: 13.5px !important;
    border: 1px solid transparent !important;
    transition: all 0.15s ease !important;
    margin: 1px 0 !important;
}
.flatpickr-day:hover {
    background: rgba(80, 81, 249, 0.25) !important;
    border-color: rgba(80, 81, 249, 0.4) !important;
    color: #ffffff !important;
}
.flatpickr-day.selected,
.flatpickr-day.selected:hover {
    background: #5051F9 !important;
    border-color: #5051F9 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    box-shadow: 0 2px 8px rgba(80, 81, 249, 0.5) !important;
}
.flatpickr-day.today {
    border-color: #38bdf8 !important;
    color: #38bdf8 !important;
    font-weight: 700 !important;
}
.flatpickr-day.today:hover {
    background: rgba(56, 189, 248, 0.2) !important;
    color: #ffffff !important;
}
.flatpickr-day.prevMonthDay,
.flatpickr-day.nextMonthDay {
    color: #475569 !important;
}
.flatpickr-day.prevMonthDay:hover,
.flatpickr-day.nextMonthDay:hover {
    background: rgba(255, 255, 255, 0.05) !important;
    color: #94a3b8 !important;
}
.flatpickr-day.flatpickr-disabled,
.flatpickr-day.flatpickr-disabled:hover {
    color: #334155 !important;
}
.flatpickr-calendar .numInputWrapper span.arrowUp:after {
    border-bottom-color: #f1f5f9 !important;
}
.flatpickr-calendar .numInputWrapper span.arrowDown:after {
    border-top-color: #f1f5f9 !important;
}
.flatpickr-calendar .numInputWrapper:hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

/* Main Card Container */
.inv-main-card {
    background-color: #161b22 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 14px !important;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4) !important;
    overflow: hidden;
}

/* Form Labels - High Contrast & Visibility (WCAG AAA Compliant) */
.inv-form-label {
    color: #e6edf3 !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    margin-bottom: 6px;
    letter-spacing: 0.2px;
}
.col-form-label.inv-form-label {
    margin-bottom: 0;
    padding-top: 8px;
    padding-bottom: 8px;
}
.inv-required-mark {
    color: #f87171 !important;
    font-weight: 700 !important;
    margin-left: 2px;
}

/* Interactive Controls (Editable Inputs, Selects, Textareas) */
.inv-dark-control {
    background-color: #1e2530 !important;
    border: 1px solid rgba(255, 255, 255, 0.16) !important;
    color: #ffffff !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    height: 40px !important;
    transition: all 0.15s ease-in-out !important;
}
.inv-dark-control:hover {
    border-color: rgba(255, 255, 255, 0.3) !important;
}
.inv-dark-control:focus {
    background-color: #1e2530 !important;
    border-color: #5051F9 !important;
    box-shadow: 0 0 0 3px rgba(80, 81, 249, 0.35) !important;
    color: #ffffff !important;
    outline: none !important;
}
.inv-dark-control.is-invalid {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25) !important;
}
.inv-dark-control::placeholder {
    color: #94a3b8 !important;
    opacity: 1 !important;
}
textarea.inv-dark-control {
    height: auto !important;
    min-height: 56px !important;
}

/* Select Dropdown & Options Accessibility */
select.inv-dark-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 0.75rem center !important;
    background-size: 14px 10px !important;
    padding-right: 2rem !important;
    cursor: pointer;
}
select.inv-dark-control option {
    background-color: #1e2530 !important;
    color: #ffffff !important;
    padding: 10px 14px !important;
    font-size: 13.5px !important;
}
select.inv-dark-control option:hover,
select.inv-dark-control option:focus,
select.inv-dark-control option:checked {
    background-color: #5051F9 !important;
    color: #ffffff !important;
}

/* Readonly Inputs - Clear, Legible, Distinguishable */
.inv-dark-control:disabled,
.inv-dark-control[readonly],
.inv-readonly {
    background-color: #131822 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #e2e8f0 !important;
    font-weight: 500 !important;
    cursor: default !important;
    user-select: all;
}
.inv-readonly.font-mono {
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace !important;
}
.inv-readonly-highlight {
    background-color: #131822 !important;
    border: 1px solid rgba(56, 189, 248, 0.35) !important;
    color: #38bdf8 !important;
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace !important;
    font-weight: 700 !important;
}

/* Addon % for PPN & PPh */
.inv-dark-addon {
    background-color: #283141 !important;
    border: 1px solid rgba(255, 255, 255, 0.16) !important;
    border-left: none !important;
    color: #cbd5e1 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    padding: 0 14px !important;
}

/* Logo Box matching Tokabe Reference */
.inv-logo-card {
    width: 220px;
    height: 110px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.02);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}
.inv-logo-card img {
    max-height: 85px;
    max-width: 180px;
    object-fit: contain;
}

/* Table Styling */
.inv-dark-table {
    border-color: rgba(255, 255, 255, 0.06) !important;
}
.inv-dark-table thead th {
    background-color: transparent !important;
    color: #cbd5e1 !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 12px 10px !important;
}
.inv-dark-table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
}
.inv-dark-table tbody > tr > td,
.inv-dark-table tbody > tr > th {
    vertical-align: top !important;
    padding: 12px 10px !important;
    color: #f1f5f9;
    border: none !important;
}
.inv-dark-table th.product-id,
.inv-dark-table td.product-id,
.product-id {
    vertical-align: top !important;
    padding-top: 17px !important;
    text-align: center !important;
    width: 48px !important;
    color: #ffffff !important;
}
.product-id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.22);
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Material Sub-Card Box */
.material-box-wrapper {
    background-color: #121720;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-left: 3px solid #38bdf8;
    border-radius: 8px;
    padding: 10px 12px;
    margin-top: 8px;
}
.material-box-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    padding-bottom: 4px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.material-box-title {
    font-size: 11.5px;
    font-weight: 600;
    color: #38bdf8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Bank Account Card Badge */
.bank-account-badge {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 8px;
    padding: 9px 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.badge-dot-green {
    width: 8px;
    height: 8px;
    background-color: #10b981;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

/* Action Buttons */
.btn-hapus-item {
    background-color: rgba(239, 68, 68, 0.12) !important;
    border: 1px solid rgba(239, 68, 68, 0.35) !important;
    color: #f87171 !important;
    border-radius: 6px !important;
    padding: 6px 14px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-hapus-item:hover {
    background-color: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3) !important;
}

.btn-add-item-custom {
    background-color: transparent !important;
    border: 1px solid #38bdf8 !important;
    color: #38bdf8 !important;
    border-radius: 6px !important;
    padding: 6px 16px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    transition: all 0.15s ease !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
}
.btn-add-item-custom:hover {
    background-color: #38bdf8 !important;
    color: #0d1117 !important;
    box-shadow: 0 4px 14px rgba(56, 189, 248, 0.3) !important;
}

.btn-save-custom {
    background-color: #5051F9 !important;
    border: 1px solid #5051F9 !important;
    color: #ffffff !important;
    border-radius: 8px !important;
    padding: 8px 24px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    box-shadow: 0 2px 10px rgba(80, 81, 249, 0.35) !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-save-custom:hover {
    background-color: #4041e2 !important;
    border-color: #4041e2 !important;
    box-shadow: 0 4px 14px rgba(80, 81, 249, 0.5) !important;
}

.btn-reset-draft-custom {
    background-color: rgba(239, 68, 68, 0.1) !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    color: #f87171 !important;
    border-radius: 8px !important;
    padding: 8px 18px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-reset-draft-custom:hover {
    background-color: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
}

.btn-batal-custom {
    background-color: #1e2430 !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    color: #cbd5e1 !important;
    border-radius: 8px !important;
    padding: 8px 18px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-batal-custom:hover {
    background-color: #2b3342 !important;
    color: #ffffff !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
}

/* Tanpa Harga State Class */
.table-tanpa-harga .col-header-harga,
.table-tanpa-harga .col-header-jumlah-harga,
.table-tanpa-harga .col-item-harga,
.table-tanpa-harga .col-item-jumlah-harga {
    display: none !important;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function toggleTipeHarga(tipeHarga) {
      var isTanpaHarga = (tipeHarga === 'tanpa_harga');
      var $invoiceTable = $('.invoice-table');
      var $paymentSection = $('#section-detail-pembayaran');
      var $alertTanpaHarga = $('#alert-tanpa-harga');
      var $jnsPem = $('#choices-payment-type');

      if (isTanpaHarga) {
          $invoiceTable.addClass('table-tanpa-harga');
          $paymentSection.hide();
          $alertTanpaHarga.show();

          $('input[name^="hrg"]').removeAttr('required').each(function() {
              if (!$(this).val() || $(this).val() === '') $(this).val('0');
          });
          $('input[name^="jlh_hrg"]').each(function() {
              if (!$(this).val() || $(this).val() === '') $(this).val('0');
          });
          $jnsPem.removeAttr('required');
          if (!$jnsPem.val()) {
              $jnsPem.val('Cash Lunas');
          }
          $('#total-harga').val('0');
          $('#total-pembelian').val('0');
          $('#sisa-pembayaran').val('0');

          if (window.jQuery && $.validator) {
              $('input[name^="hrg"]').each(function() {
                  try { $(this).rules('remove', 'required'); } catch(e){}
              });
              try { $jnsPem.rules('remove', 'required'); } catch(e){}
          }
      } else {
          $invoiceTable.removeClass('table-tanpa-harga');
          $paymentSection.show();
          $alertTanpaHarga.hide();

          $('input[name^="hrg"]').attr('required', 'required');
          $jnsPem.attr('required', 'required');

          if (window.jQuery && $.validator) {
              $('input[name^="hrg"]').each(function() {
                  try { $(this).rules('add', { required: true }); } catch(e){}
              });
              try { $jnsPem.rules('add', { required: true }); } catch(e){}
          }
      }
  }

  // Mapping is_material_required untuk mendeteksi barang Non-Material vs Material
    const isMaterialRequiredMap = {};
    @if(isset($jenisBarang))
        @foreach ($jenisBarang as $jns)
            isMaterialRequiredMap["{{$jns->id}}"] = "{{$jns->is_material_required ?? 0}}";
        @endforeach
    @endif

    function updateMaterialVisibility($select) {
        var selectedBarangId = $select.val();
        var td = $select.closest('td');
        var materialContainers = td.find('.materials-container');
        var tambahBtn = td.find('.btn-tambah-material, .add-material');
        var isNonMaterial = (isMaterialRequiredMap[selectedBarangId] == "1");

        if (isNonMaterial) {
            materialContainers.slideUp(150);
            tambahBtn.slideUp(150);
            materialContainers.find('select.material-select').val('').removeClass('is-invalid');
            materialContainers.find('input.material-panjang, input.material-lebar, input.material-qty').val('').removeClass('is-invalid');
        } else {
            materialContainers.slideDown(150);
            tambahBtn.slideDown(150);
        }
    }

    $(document).on('change', 'select[name^="barang_id"]', function() {
        updateMaterialVisibility($(this));
    });

    $(document).ready(function () {
    $('#loading-overlay').hide();
    $("#loading-spinner").hide();

    // Material Dropdown Change
    $(document).on('change', '.material-select', function() {
        var selectedOption = $(this).find(':selected');
        var satuan = selectedOption.data('satuan');
        var stok = selectedOption.data('stok'); 
        
        var row = $(this).closest('.material-row'); 
        row.find('.material-satuan').val(satuan);
        row.find('.material-qty').attr('max', stok);
        row.find('.material-panjang').val('');
        row.find('.material-lebar').val('');
        row.find('.material-qty').val('');

        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
    });

    $(document).on('input change', '.material-panjang, .material-lebar', function() {
        if (parseFloat($(this).val()) > 0) {
            $(this).removeClass('is-invalid');
        }
    });

    function calcMaterialQty(row) {
        var p = parseFloat(row.find('.material-panjang').val()) || 0;
        var l = parseFloat(row.find('.material-lebar').val()) || 0;

        var productRow = row.closest('tr.product');
        if (!productRow.length) {
            productRow = row.closest('tr');
        }
        var itemQty = parseFloat(productRow.find('input[name="qty[]"], [id^="product-qty-"]').val()) || 1;

        var hasil = 0;
        if (p > 0 && l > 0) {
            hasil = (p * l) * itemQty;
        } else if (p > 0 && l === 0) {
            hasil = p * itemQty;
        } else if (p === 0 && l > 0) {
            hasil = l * itemQty;
        } else {
            hasil = 1 * itemQty;
        }

        var selectedOption = row.find('.material-select option:selected');
        var stok = parseFloat(selectedOption.data('stok')) || 0;

        if (hasil > stok && selectedOption.val() !== "") {
            row.find('.material-qty').addClass('is-invalid');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Mencukupi!',
                    text: 'Kebutuhan material (' + hasil + ') melebihi stok yang tersedia (' + stok + ').',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        } else {
            row.find('.material-qty').removeClass('is-invalid');
        }

        row.find('.material-qty').val(parseFloat(hasil.toFixed(4)));
    }

    $(document).on('input change', '.material-panjang, .material-lebar', function() {
        var row = $(this).closest('.material-row');
        calcMaterialQty(row);
    });

    $(document).on('input change', 'input[name="qty[]"], [id^="product-qty-"]', function() {
        var productRow = $(this).closest('tr.product');
        productRow.find('.material-row').each(function() {
            calcMaterialQty($(this));
        });
        if (typeof autoCalc === 'function') autoCalc(this);
    });

    $(document).on('click', '.add-material, .btn-tambah-material', function() {
        var container = $(this).closest('td').find('.materials-container');
        var rowIndex = container.data('row-index') || 0;
        
        var materialOptionsDOM = document.getElementById('template-options-material');
        var materialOptions = materialOptionsDOM ? materialOptionsDOM.innerHTML : '<option value="">-- Pilih Material --</option>';

        var newMaterialRow = `
            <div class="row g-2 align-items-center material-row mt-2 pt-2 border-top border-secondary border-opacity-25">
                <div class="col-xl-4 col-lg-12">
                    <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[${rowIndex}][]" style="height: 32px !important; font-size: 12px !important;">
                        ${materialOptions}
                    </select>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="d-flex align-items-center gap-1">
                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[${rowIndex}][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                        <span class="text-muted fw-bold px-1">×</span>
                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[${rowIndex}][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-5">
                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[${rowIndex}][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                </div>
                <div class="col-xl-2 col-lg-2 col-4">
                    <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[${rowIndex}][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                </div>
                <div class="col-xl-1 col-lg-1 col-3 text-end">
                    <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            </div>
        `;
        container.append(newMaterialRow);
    });

    $(document).on('click', '.remove-material', function() {
        var container = $(this).closest('.materials-container');
        if (container.find('.material-row').length > 1) {
            $(this).closest('.material-row').remove();
        } else {
            var row = $(this).closest('.material-row');
            row.find('select').val('');
            row.find('input').val('');
        }
    });

    // Invoice selection change
    $('#choices-invoice').on('change', function () {
        var selectedOption = $(this).find('option:selected');
        var tipeHarga = selectedOption.data('tipe-harga') || 'dengan_harga';
        var namaInvoice = selectedOption.val();

        toggleTipeHarga(tipeHarga);

        if (namaInvoice) {
            $.ajax({
                url: '/invoices/' + encodeURIComponent(namaInvoice),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data && data.kode_invoice) {
                        $('#invoicenoInput').val(data.kode_invoice);
                    }
                }
            });
        }
    });

    // Trigger on page load
    var initialOpt = $('#choices-invoice').find('option:selected');
    if (initialOpt.length && initialOpt.val()) {
        var initTipeHarga = initialOpt.data('tipe-harga') || 'dengan_harga';
        toggleTipeHarga(initTipeHarga);
    }

    // Toggle Order By Sales Input
    $('#choices-orderBy').on('change', function () {
        var selected = $(this).val();
        if (selected === 'Sales') {
            $('#divSales').show();
        } else {
            $('#divSales').hide();
        }
    });

    // Toggle Bank Rekening display
    $('#choices-payment-type').on('change', function () {
        var val = $(this).val();
        if (val && val.indexOf('Transfer') !== -1) {
            $('#alamatPembayaran').show();
        } else {
            $('#alamatPembayaran').hide();
        }
        if (typeof dP === 'function') dP();
        calcTotals();
    });

    // Form Submit AJAX dengan Validasi Lengkap (Semua Input Wajib Diisi)
    $('#invoice_form').on('submit', function (e) {
        e.preventDefault();

        // 1. Validasi Jenis Invoice
        var invType = $('#choices-invoice').val();
        if (!invType) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Silakan pilih Jenis Invoice!',
                confirmButtonColor: '#5051F9'
            });
            $('#choices-invoice').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-invoice').removeClass('is-invalid');
        }

        // 2. Validasi Nama Customer
        var customerVal = $.trim($('#customer').val());
        if (!customerVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nama Customer wajib diisi!',
                confirmButtonColor: '#5051F9'
            });
            $('#customer').addClass('is-invalid').focus();
            return false;
        } else {
            $('#customer').removeClass('is-invalid');
        }

        // 3. Validasi Nomor Telepon
        var phoneVal = $.trim($('#phone-number').val());
        if (!phoneVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nomor Telepon wajib diisi!',
                confirmButtonColor: '#5051F9'
            });
            $('#phone-number').addClass('is-invalid').focus();
            return false;
        } else {
            $('#phone-number').removeClass('is-invalid');
        }

        // 4. Validasi Nama Admin
        var adminVal = $('#choices-admin').val();
        if (!adminVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nama Admin wajib dipilih!',
                confirmButtonColor: '#5051F9'
            });
            $('#choices-admin').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-admin').removeClass('is-invalid');
        }

        // 5. Validasi Order Dari
        var orderVal = $('#choices-orderBy').val();
        if (!orderVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Order Dari wajib dipilih!',
                confirmButtonColor: '#5051F9'
            });
            $('#choices-orderBy').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-orderBy').removeClass('is-invalid');
        }

        // 6. Validasi Sales jika Order Dari == Sales
        if (orderVal === 'Sales') {
            var salesVal = $.trim($('#colFormLabelNamaSales').val());
            if (!salesVal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Nama Sales wajib diisi ketika Order Dari adalah Sales!',
                    confirmButtonColor: '#5051F9'
                });
                $('#colFormLabelNamaSales').addClass('is-invalid').focus();
                return false;
            } else {
                $('#colFormLabelNamaSales').removeClass('is-invalid');
            }
        }

        // 7. Validasi Target Penyelesaian
        var tglSelesaiVal = $.trim($('#dateInput').val());
        if (!tglSelesaiVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Target Penyelesaian wajib diisi!',
                confirmButtonColor: '#5051F9'
            });
            $('#dateInput').addClass('is-invalid').focus();
            return false;
        } else {
            $('#dateInput').removeClass('is-invalid');
        }

        // 8. Validasi Baris Barang / Item
        var productRows = $('tr.product');
        if (productRows.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Item Kosong',
                text: 'Minimal harus ada 1 item barang dalam invoice!',
                confirmButtonColor: '#5051F9'
            });
            return false;
        }

        var selectedInvoiceOpt = $('#choices-invoice').find('option:selected');
        var isTanpaHarga = (selectedInvoiceOpt.data('tipe-harga') === 'tanpa_harga');

        var itemValid = true;
        var itemErrorMsg = '';
        var firstInvalidEl = null;

        productRows.each(function(idx) {
            var row = $(this);
            var itemNum = idx + 1;
            var barangSelect = row.find('select[name^="barang_id"]');
            var barangId = barangSelect.val();
            var descTextarea = row.find('textarea[name^="deskripsi_item"]');
            var descVal = $.trim(descTextarea.val());
            var hrgInput = row.find('input[name^="hrg"]');
            var hrgVal = parseFloat(hrgInput.val() ? hrgInput.val().toString().replace(/[.,]/g, '') : 0) || 0;
            var qtyInput = row.find('input[name^="qty"]');
            var qtyVal = parseFloat(qtyInput.val()) || 0;

            if (!barangId || barangId === "" || barangId === "Pilih Item") {
                itemValid = false;
                itemErrorMsg = 'Silakan pilih Item barang pada baris #' + itemNum + '!';
                barangSelect.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = barangSelect;
                return false;
            } else {
                barangSelect.removeClass('is-invalid');
            }

            if (!descVal) {
                itemValid = false;
                itemErrorMsg = 'Deskripsi item pada baris #' + itemNum + ' wajib diisi!';
                descTextarea.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = descTextarea;
                return false;
            } else {
                descTextarea.removeClass('is-invalid');
            }

            if (!isTanpaHarga && hrgVal <= 0) {
                itemValid = false;
                itemErrorMsg = 'Harga pada baris #' + itemNum + ' wajib diisi lebih dari Rp 0!';
                hrgInput.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = hrgInput;
                return false;
            } else {
                hrgInput.removeClass('is-invalid');
            }

            if (qtyVal <= 0) {
                itemValid = false;
                itemErrorMsg = 'Quantity pada baris #' + itemNum + ' wajib lebih dari 0!';
                qtyInput.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = qtyInput;
                return false;
            } else {
                qtyInput.removeClass('is-invalid');
            }

            // Validasi Spesifikasi Material jika barang memerlukan material
            var isNonMat = (typeof isMaterialRequiredMap !== 'undefined' && isMaterialRequiredMap[barangId] == "1");
            if (!isNonMat) {
                var matContainer = row.find('.materials-container');
                var matRows = matContainer.find('.material-row');

                if (matRows.length === 0) {
                    itemValid = false;
                    itemErrorMsg = 'Spesifikasi Material untuk item #' + itemNum + ' wajib diisi!';
                    firstInvalidEl = row.find('.btn-tambah-material');
                    return false;
                }

                matRows.each(function() {
                    var mRow = $(this);
                    var mSelect = mRow.find('.material-select');
                    var mP = mRow.find('.material-panjang');
                    var mL = mRow.find('.material-lebar');

                    var valMat = mSelect.val();
                    var valP = parseFloat(mP.val()) || 0;
                    var valL = parseFloat(mL.val()) || 0;

                    if (!valMat || valMat === "") {
                        itemValid = false;
                        itemErrorMsg = 'Silakan pilih material pada Spesifikasi Material item #' + itemNum + '!';
                        mSelect.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mSelect;
                        return false;
                    } else {
                        mSelect.removeClass('is-invalid');
                    }

                    if (valP <= 0) {
                        itemValid = false;
                        itemErrorMsg = 'Panjang (P) pada Spesifikasi Material item #' + itemNum + ' wajib diisi lebih dari 0!';
                        mP.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mP;
                        return false;
                    } else {
                        mP.removeClass('is-invalid');
                    }

                    if (valL <= 0) {
                        itemValid = false;
                        itemErrorMsg = 'Lebar (L) pada Spesifikasi Material item #' + itemNum + ' wajib diisi lebih dari 0!';
                        mL.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mL;
                        return false;
                    } else {
                        mL.removeClass('is-invalid');
                    }
                });

                if (!itemValid) return false;
            }
        });

        if (!itemValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Item Belum Lengkap',
                text: itemErrorMsg,
                confirmButtonColor: '#5051F9'
            });
            if (firstInvalidEl && firstInvalidEl.length) {
                firstInvalidEl.focus();
                $('html, body').animate({
                    scrollTop: firstInvalidEl.offset().top - 120
                }, 300);
            }
            return false;
        }

        // 9. Validasi Jenis Pembayaran & DP
        if (!isTanpaHarga) {
            var jnsPem = $('#choices-payment-type').val();
            if (!jnsPem) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Silakan pilih Jenis Pembayaran (Payment Method)!',
                    confirmButtonColor: '#5051F9'
                });
                $('#choices-payment-type').addClass('is-invalid').focus();
                return false;
            } else {
                $('#choices-payment-type').removeClass('is-invalid');
            }

            if (jnsPem === 'Transfer DP' || $('#div-dp-row').is(':visible')) {
                var dpInput = $('#input-dp');
                var dpVal = parseFloat(dpInput.val() ? dpInput.val().toString().replace(/[.,]/g, '') : 0) || 0;
                if (dpVal <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Belum Lengkap',
                        text: 'Nominal DP wajib diisi lebih dari Rp 0 untuk metode pembayaran DP!',
                        confirmButtonColor: '#5051F9'
                    });
                    dpInput.addClass('is-invalid').focus();
                    return false;
                } else {
                    dpInput.removeClass('is-invalid');
                }
            }
        }

        var formData = new FormData(this);

        $("#loading-spinner").show();
        $('#loading-overlay').show();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#loading-spinner").hide();
                $('#loading-overlay').hide();

                if (typeof clearInvoiceDraft === 'function') {
                    clearInvoiceDraft();
                }

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Invoice baru berhasil disimpan.",
                    timer: 1500,
                    showConfirmButton: false
                }).then(function () {
                    window.location.href = "{{ route('daftar_invoice') }}";
                });
            },
            error: function (xhr) {
                $("#loading-spinner").hide();
                $('#loading-overlay').hide();

                var msg = "Terjadi kesalahan! Data belum lengkap atau stok tidak mencukupi.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: "error",
                    title: "Gagal Menyimpan",
                    text: msg
                });
            }
        });
    });

    // Row deletion
    $(document).on('click', '.btn-hapus-item, .product-removal button, .product-removal a', function() {
        var $tr = $(this).closest('tr.product');
        if ($('#newlink tr.product').length > 1) {
            $tr.remove();
            if (typeof window.resetRowNumbers === 'function') {
                window.resetRowNumbers();
            }
            if (typeof getTotal === 'function') getTotal();
            calcTotals();
        } else {
            $tr.find('input').val('');
            $tr.find('select').prop('selectedIndex', 0);
            $tr.find('textarea').val('');
            $tr.find('.product-line-price').val('0');
            if (typeof window.resetRowNumbers === 'function') {
                window.resetRowNumbers();
            }
            if (typeof getTotal === 'function') getTotal();
            calcTotals();
        }
    });

    // Tax & Totals Calculation
    window.calcTotals = function() {
        var totalHarga = parseFloat($('#total-harga').val() ? $('#total-harga').val().toString().replace(/[.,]/g, '') : 0) || 0;
        var ppnVal = parseFloat($('#input-ppn').val()) || 0;
        var pphVal = parseFloat($('#input-pph').val()) || 0;

        var ppnNominal = (ppnVal * totalHarga) / 100;
        var pphNominal = (pphVal * totalHarga) / 100;

        var totalAkhir = Math.round(totalHarga + ppnNominal - pphNominal);
        $('#total-pembelian').val(totalAkhir.toLocaleString('id-ID'));

        var dpVal = parseFloat($('#input-dp').val() ? $('#input-dp').val().toString().replace(/[.,]/g, '') : 0) || 0;
        var sisaVal = Math.max(0, Math.round(totalAkhir - dpVal));
        $('#sisa-pembayaran').val(sisaVal.toLocaleString('id-ID'));
    };

    $(document).on('input change', '#input-ppn, #input-pph, #input-dp, #total-harga', function() {
        calcTotals();
    });
  });
</script>
@endsection

@extends('layout.template')
@section('content')
@include('layout.loading-overlay')

<div class="page-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                    <h4 class="mb-sm-0 text-white fw-bold text-uppercase" style="letter-spacing: 0.5px;">TAMBAH INVOICE IBEKAMI</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('daftar_invoice') }}" class="text-muted">Invoice</a></li>
                            <li class="breadcrumb-item active text-muted">Tambah Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card Container (Matching Tokabe Layout) -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card inv-main-card p-3 p-md-4">
                    <form method="POST" action="{{ route('store.invoice') }}" validate id="invoice_form" enctype="multipart/form-data">
                        @csrf

                        <!-- Top Section: 2 Columns Grid -->
                        <div class="row g-4 mb-4">
                            <!-- Left Column: Invoice Metadata -->
                            <div class="col-lg-5 col-md-6 col-12">
                                <!-- Invoice Name / Type -->
                                <div class="mb-3">
                                    <label for="choices-invoice" class="form-label inv-form-label">
                                        Invoice <span class="inv-required-mark">*</span>
                                    </label>
                                    <select class="form-select inv-dark-control @error('inv') is-invalid @enderror" id="choices-invoice" name="inv" required>
                                        <option value="">-- Pilih Jenis Invoice --</option>
                                        @foreach ($invoice as $inv)
                                            <option value="{{$inv->nama_invoice}}" data-tipe-harga="{{$inv->tipe_harga ?? 'dengan_harga'}}" {{ (old('inv') == $inv->nama_invoice || $loop->first) ? 'selected' : '' }}>
                                                {{$inv->nama_invoice}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('inv')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Invoice No -->
                                <div class="mb-3">
                                    <label class="form-label inv-form-label">Invoice No</label>
                                    <div class="d-flex gap-2">
                                        <div style="width: 100px;">
                                            <input type="text" class="form-control inv-dark-control inv-readonly text-center fw-bold" id="invoicenoInput" placeholder="Kode" name="kode" value="{{ old('kode', 'IBK') }}" readonly>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control inv-dark-control inv-readonly fw-semibold font-mono" id="noInvoice" placeholder="Nomor Invoice" name="kodeUnik" value="{{$no_invoice}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Penjualan -->
                                <div class="mb-3">
                                    <label class="form-label inv-form-label">Tanggal Penjualan</label>
                                    <div class="d-flex gap-2">
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control inv-dark-control inv-readonly flatpickr-input" id="date-field" name="tgl_jual" data-provider="flatpickr" value="{{$hariIni}}" readonly="readonly">
                                        </div>
                                        <div style="width: 110px;">
                                            <input type="text" class="form-control inv-dark-control inv-readonly text-center" placeholder="H:i" name="jam" value="{{$formatJam}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Brand Logo & Customer Details -->
                            <div class="col-lg-7 col-md-6 col-12">
                                <!-- Top Right Logo Box -->
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="inv-logo-card">
                                        <img src="{{ asset('storage/images/perusahaan/698c05828c9a6.png') }}" 
                                             alt="Ibekami Logo" 
                                             onerror="this.onerror=null;this.src='{{ asset('images/perusahaan/698c05828c9a6.png') }}';">
                                    </div>
                                </div>

                                <!-- Customer Form Fields -->
                                <div class="customer-fields-container">
                                    <!-- Nama Customer -->
                                    <div class="row align-items-center mb-3">
                                        <label for="customer" class="col-sm-4 col-form-label inv-form-label">
                                            Nama Customer <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control @error('pelanggan') is-invalid @enderror" name="pelanggan" id="customer" placeholder="Nama Customer" value="{{ old('pelanggan') }}" list="customerList" autocomplete="off" required>
                                            <datalist id="customerList">
                                                @foreach ($kontak as $data)
                                                    <option value="{{ $data->customer }}" data-company="{{ $data->perusahaan }}" data-phone="{{ $data->no_telepon }}">{{ $data->customer }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pelanggan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Hidden Input Perusahaan for Autocomplete Compatibility -->
                                    <input type="hidden" id="usaha" name="perusahaan" value="{{ old('perusahaan') }}">

                                    <!-- Nomor Telepon -->
                                    <div class="row align-items-center mb-3">
                                        <label for="phone-number" class="col-sm-4 col-form-label inv-form-label">
                                            Nomor Telepon <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control @error('tlp') is-invalid @enderror" id="phone-number" name="tlp" placeholder="08xxxxxxxxx" value="{{ old('tlp') }}" required>
                                            @error('tlp')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nama Admin -->
                                    <div class="row align-items-center mb-3">
                                        <label for="choices-admin" class="col-sm-4 col-form-label inv-form-label">
                                            Nama Admin <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('adm') is-invalid @enderror" id="choices-admin" name="adm" required>
                                                <option value="">Pilih Admin</option>
                                                @foreach ($admin as $adm)
                                                    <option value="{{ $adm->id }}" {{ (old('adm') == $adm->id || old('adm') == $adm->nama) ? 'selected' : '' }}>{{ $adm->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('adm')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Order Dari -->
                                    <div class="row align-items-center mb-3">
                                        <label for="choices-orderBy" class="col-sm-4 col-form-label inv-form-label">
                                            Order Dari <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('order') is-invalid @enderror" id="choices-orderBy" name="order" required>
                                                <option value="">Order By</option>
                                                @foreach ($order as $ord)
                                                    <option value="{{$ord->order_by}}" {{old('order') == $ord->order_by ? 'selected' : ''}}>{{$ord->order_by}}</option>
                                                @endforeach
                                            </select>
                                            @error('order')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sales Row (Conditional via JS) -->
                                    <div id="divSales" style="display: none;">
                                        <div class="row align-items-center mb-3">
                                            <label for="colFormLabelNamaSales" class="col-sm-4 col-form-label inv-form-label">
                                                Nama Sales <span class="inv-required-mark">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inv-dark-control @error('sales') is-invalid @enderror" id="colFormLabelNamaSales" placeholder="Nama Sales" name="sales" value="{{ old('sales') }}">
                                                @error('sales')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Target Penyelesaian -->
                                    <div class="row align-items-center mb-3">
                                        <label for="dateInput" class="col-sm-4 col-form-label inv-form-label">
                                            Target Penyelesaian <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="position-relative">
                                                <input type="text" class="form-control inv-dark-control flatpickr-input @error('tgl_selesai') is-invalid @enderror" data-provider="flatpickr" data-date-format="Y-m-d" name="tgl_selesai" id="dateInput" placeholder="YYYY-MM-DD" value="{{ old('tgl_selesai') }}" readonly="readonly" style="cursor: pointer; padding-right: 38px;" required>
                                                <i class="ri-calendar-2-line position-absolute text-muted" style="right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 16px;"></i>
                                            </div>
                                            @error('tgl_selesai')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Options Templates for JS Cloner -->
                        <div id="template-options-material" style="display: none;">
                            <option value="">-- Pilih Material --</option>
                            @if(isset($materials))
                                @foreach ($materials as $mat)
                                    <option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">
                                        {{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok: {{ $mat->stok }})
                                    </option>
                                @endforeach
                            @endif
                        </div>
                        <div id="template-options-barang" style="display: none;">
                            <option selected disabled>Pilih Item</option>
                            @foreach ($jenisBarang as $jns)
                                <option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}">{{$jns->jenis_barang}}</option>
                            @endforeach
                        </div>

                        <!-- Table Section (Image 2) -->
                        <div class="table-responsive mt-4">
                            <table class="table invoice-table align-middle inv-dark-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 45px;" class="text-center">#</th>
                                        <th style="min-width: 420px;">ITEM <span class="inv-required-mark">*</span></th>
                                        <th style="width: 120px;">SATUAN <span class="inv-required-mark">*</span></th>
                                        <th style="width: 150px;" class="col-header-harga">HARGA (Rp) <span class="inv-required-mark">*</span></th>
                                        <th style="width: 110px;" class="text-center">QUANTITY <span class="inv-required-mark">*</span></th>
                                        <th style="width: 160px;" class="col-header-jumlah-harga text-end">JUMLAH HARGA</th>
                                        <th style="width: 90px;" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="newlink">
                                    <tr id="1" class="product">
                                        <th scope="row" class="product-id text-center fw-bold"><span class="product-id-badge">1</span></th>
                                        <td class="text-start">
                                            <!-- Product Item Select -->
                                            <div class="mb-2">
                                                <select class="form-select inv-dark-control @error('barang_id.0') is-invalid @enderror" data-choices data-choices-sorting="true" id="productName-1" name="barang_id[0]" required>
                                                    <option value="" selected disabled>Pilih Item</option>
                                                    @foreach ($jenisBarang as $jns)
                                                        <option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}" {{old('barang_id.0') == $jns->id ? 'selected' : ''}}>{{$jns->jenis_barang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('barang_id.0')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Description Textarea -->
                                            <textarea class="form-control inv-dark-control mb-2 @error('deskripsi_item.0') is-invalid @enderror" id="productDetails-1" name="deskripsi_item[0]" rows="2" placeholder="Deskripsi Item (Wajib Diisi)" required></textarea>
                                            @error('deskripsi_item.0')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <!-- Multi-Material Sub-Component Box -->
                                            <div class="materials-container material-container-0" data-row-index="0">
                                                <div class="material-box-wrapper">
                                                    <div class="material-box-header">
                                                        <span class="material-box-title">Spesifikasi Material <span class="text-danger fw-bold" title="Wajib Diisi">*</span></span>
                                                        <span class="text-muted fs-11">P × L × Qty</span>
                                                    </div>

                                                    <div class="material-row pt-1">
                                                        <div class="row g-2 align-items-center">
                                                            <div class="col-xl-4 col-lg-12">
                                                                <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[0][]" style="height: 32px !important; font-size: 12px !important;">
                                                                    <option value="">-- Pilih Material --</option>
                                                                    @if(isset($materials))
                                                                        @foreach ($materials as $mat)
                                                                            <option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">
                                                                                {{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok: {{ $mat->stok }})
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-3 col-lg-6 col-12">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[0][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                                                                    <span class="text-muted fw-bold px-1">×</span>
                                                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[0][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-5">
                                                                <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[0][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                                                            </div>
                                                            <div class="col-xl-2 col-lg-2 col-4">
                                                                <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[0][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                                                            </div>
                                                            <div class="col-xl-1 col-lg-1 col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-link text-info text-decoration-none p-0 mt-2 add-material btn-tambah-material fs-12 fw-semibold">
                                                <i class="ri-add-circle-line me-1"></i> Tambah Material Lainnya
                                            </button>
                                        </td>

                                        <td>
                                            <select class="form-select inv-dark-control @error('satuan.0') is-invalid @enderror" style="min-width: 95px;" id="satuan-1" name="satuan[0]" required>
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

                                        <td class="col-item-harga">
                                            <input type="text" class="form-control inv-dark-control product-price numeric" id="productRate-1" name="hrg[0]" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' placeholder="Rp. 0.000" onchange="autoCalc(this)" required />
                                        </td>

                                        <td>
                                            <input type="number" class="form-control inv-dark-control text-center fw-bold" id="product-qty-1" value="1" min="1" step="any" name="qty[0]" onchange="autoCalc(this)" required>
                                        </td>

                                        <td class="col-item-jumlah-harga text-end">
                                            <input type="text" class="form-control inv-dark-control inv-readonly product-line-price numeric text-end font-mono" id="productPrice-1" name="jlh_hrg[0]" placeholder="Rp.0.000" onchange="autoCalc(this)" readonly />
                                        </td>

                                        <td class="product-removal text-center">
                                            <button type="button" class="btn btn-hapus-item" title="Hapus Baris Item">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add Item Button -->
                        <div class="mt-3">
                            <button type="button" class="btn btn-add-item-custom" id="add-item" onclick="new_link()">
                                <i class="ri-add-line fs-14"></i> Add Item
                            </button>
                        </div>

                        <!-- Payment & Financial Summary (Image 2 Bottom) -->
                        <div id="section-detail-pembayaran" class="mt-4 pt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-9 col-12">
                                    <!-- Jenis Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label for="choices-payment-type" class="col-sm-4 col-form-label inv-form-label">
                                            Jenis Pembayaran <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('jns_pem') is-invalid @enderror" id="choices-payment-type" name="jns_pem" required>
                                                <option disabled selected value="">Payment Method</option>
                                                <option value="Cash Lunas">Cash Lunas</option>
                                                <option value="Cash Belum Lunas">Cash Belum Lunas</option>
                                                <option value="Transfer DP">Transfer DP</option>
                                                <option value="Transfer Lunas">Transfer Lunas</option>
                                                <option value="PO">PO</option>
                                            </select>
                                            @error('jns_pem')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rekening Info Card -->
                                    <div id="alamatPembayaran" class="row mb-3" style="display: none;">
                                        <div class="col-sm-8 offset-sm-4">
                                            <div class="bank-account-badge">
                                                <span class="badge-dot-green"></span>
                                                <input class="d-none" type="radio" name="norek" id="flexRadioDefault1" value="BNI" checked>
                                                <span class="text-white fs-12 fw-semibold">
                                                    BSI &nbsp;|&nbsp; A/N : Yusni Kurniasih &nbsp;|&nbsp; No. Rek : 2845999999
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DP Input (Conditional) -->
                                    <div class="row align-items-center mb-2" id="div-dp-row" style="display: none;">
                                        <div class="col-sm-4" id="div-label">
                                            <label for="input-dp" class="col-form-label text-warning fs-13 fw-semibold mb-0">
                                                DP <span class="inv-required-mark">*</span>
                                            </label>
                                        </div>
                                        <div class="col-sm-8" id="dp">
                                            <input id="input-dp" name="dp" type="text" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' class="form-control inv-dark-control numeric text-warning fw-bold" placeholder="0" value="{{ old('dp') }}">
                                        </div>
                                    </div>

                                    <!-- Jumlah Harga -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Jumlah Harga</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly numeric fw-semibold" id="total-harga" name="tot_harga" value="{{ old('tot_harga', '0') }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Hidden PPN & PPh -->
                                    <input type="hidden" id="input-ppn" name="ppn" value="0">
                                    <input type="hidden" id="input-pph" name="pph" value="0">

                                    <!-- Hidden Compatibility Elements -->
                                    <select class="d-none" name="select-potongan" id="choices-potongan">
                                        <option value="-">-</option>
                                        <option value="Diskon">Diskon</option>
                                        <option value="Potongan">Potongan</option>
                                        <option value="PPN">PPN</option>
                                        <option value="PPH">PPH</option>
                                    </select>
                                    <input type="hidden" id="input-potongan" name="ptg" value="0">

                                    <!-- Total Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Total Pembayaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly-highlight numeric" id="total-pembelian" name="tot_pem" value="{{ old('tot_pem', '0') }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Sisa Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Sisa Pembayaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly numeric fw-semibold text-warning" id="sisa-pembayaran" name="sisa_pem" value="{{ old('sisa_pem', '0') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Tanpa Harga -->
                        <div id="alert-tanpa-harga" class="alert alert-info border-0 shadow-sm mt-3" style="display: none; background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3);">
                            <div class="d-flex align-items-center">
                                <i class="ri-information-line fs-20 me-2 text-info"></i>
                                <div>
                                    <h6 class="alert-heading mb-1 text-info fw-bold">Jenis Invoice Tanpa Harga</h6>
                                    <p class="mb-0 text-muted fs-13">Kolom harga dan detail pembayaran dinonaktifkan. Anda dapat langsung menyimpan invoice ini tanpa nominal.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons (Bottom Left, Image 2) -->
                        <div class="d-flex align-items-center gap-2 mt-4 pt-3 border-top border-secondary border-opacity-25 d-print-none">
                            <button type="submit" id="simpan" class="btn btn-save-custom btn-load">
                                <span class="d-flex align-items-center">
                                    <span id="loading-spinner" class="spinner-border spinner-border-sm flex-shrink-0 me-2" role="status" style="display: none;"></span>
                                    <i class="ri-save-line me-1 fs-15"></i> Simpan
                                </span>
                            </button>
                            <button type="button" id="btn-reset-draft" class="btn btn-reset-draft-custom">
                                <i class="ri-delete-bin-line me-1"></i> Reset Draf
                            </button>
                            <a href="{{ route('daftar_invoice') }}" class="btn btn-batal-custom">
                                <i class="ri-close-line me-1"></i> Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('customer').addEventListener('change', function() {
        var selectedOption = this.value;
        var dataList = document.getElementById('customerList').getElementsByTagName('option');
        for (var i = 0; i < dataList.length; i++) {
            var option = dataList[i];
            if (option.value === selectedOption) {
                var usahaEl = document.getElementById('usaha');
                if (usahaEl) usahaEl.value = option.getAttribute('data-company');
                var phoneEl = document.getElementById('phone-number');
                if (phoneEl) phoneEl.value = option.getAttribute('data-phone');
                break;
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        let dateField = document.getElementById("date-field");
        let dateInput = document.getElementById("dateInput");
        let invoiceInput = document.getElementById("noInvoice");

        if (typeof flatpickr !== 'undefined') {
            if (dateField) {
                flatpickr(dateField, {
                    dateFormat: "Y-m-d",
                    defaultDate: "{{ $hariIni }}",
                    onChange: function (selectedDates, dateStr) {
                        fetch(`/invoice/get-invoice-number?tanggal=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                if (invoiceInput && data.no_invoice) {
                                    invoiceInput.value = data.no_invoice;
                                }
                            })
                            .catch(error => console.error('Error fetching invoice number:', error));
                    }
                });
            }

            if (dateInput) {
                flatpickr(dateInput, {
                    dateFormat: "Y-m-d",
                    @if(old('tgl_selesai'))
                    defaultDate: "{{ old('tgl_selesai') }}",
                    @endif
                });
            }
        }
    });
</script>
{!! JsValidator::formRequest('App\Http\Requests\InvoiceRequest') !!}
@endsection

@section('plugins')
<!-- dropzone min -->
<script src="{{asset('libs/dropzone/dropzone-min.js')}}"></script>
<!-- cleave.js -->
<script src="{{asset('libs/cleave.js/cleave.min.js')}}"></script>
<!-- Sweet Alerts js -->
<script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- choices.js & flatpickr -->
<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('libs/flatpickr/flatpickr.min.js')}}"></script>

<script src="{{asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{asset('js/halaman/tabel-item.js')}}"></script>
<script src="{{asset('js/halaman/invoice.js')}}"></script>
<script src="{{asset('js/halaman/draft-invoice-ibekami.js')}}"></script>

<script>
    window.resetRowNumbers = function() {
        $('#newlink tr.product').each(function(idx) {
            var num = idx + 1;
            $(this).attr('id', num);
            $(this).find('.product-id').html(`<span class="product-id-badge">${num}</span>`);

            // Re-index all child IDs for accurate autoCalc & Cleave targeting
            $(this).find('[id^="productName-"]').attr('id', 'productName-' + num);
            $(this).find('[id^="productDetails-"]').attr('id', 'productDetails-' + num);
            $(this).find('[id^="satuan-"]').attr('id', 'satuan-' + num);
            $(this).find('[id^="productRate-"]').attr('id', 'productRate-' + num);
            $(this).find('[id^="product-qty-"]').attr('id', 'product-qty-' + num);
            $(this).find('[id^="productPrice-"]').attr('id', 'productPrice-' + num);

            // Re-index form field names for clean sequential backend arrays
            $(this).find('select[name^="barang_id"]').attr('name', `barang_id[${idx}]`);
            $(this).find('textarea[name^="deskripsi_item"]').attr('name', `deskripsi_item[${idx}]`);
            $(this).find('select[name^="satuan"]').attr('name', `satuan[${idx}]`);
            $(this).find('input[name^="hrg"]').attr('name', `hrg[${idx}]`);
            $(this).find('input[name^="qty"]').attr('name', `qty[${idx}]`);
            $(this).find('input[name^="jlh_hrg"]').attr('name', `jlh_hrg[${idx}]`);

            var $matContainer = $(this).find('.materials-container');
            if ($matContainer.length) {
                $matContainer.attr('data-row-index', idx);
                $matContainer.find('.material-select').attr('name', `material_id[${idx}][]`);
                $matContainer.find('.material-panjang').attr('name', `material_panjang[${idx}][]`);
                $matContainer.find('.material-lebar').attr('name', `material_lebar[${idx}][]`);
                $matContainer.find('.material-qty').attr('name', `material_qty[${idx}][]`);
                $matContainer.find('.material-satuan').attr('name', `material_satuan[${idx}][]`);
            }
        });
    };

    window.new_link = function() {
        var currentRows = document.querySelectorAll('#newlink tr.product');
        var currentIdx = currentRows.length;
        var nextNum = currentIdx + 1;

        var materialOptionsDOM = document.getElementById('template-options-material');
        var materialOptions = materialOptionsDOM ? materialOptionsDOM.innerHTML : '<option value="">-- Pilih Material --</option>';

        var itemOptionsDOM = document.getElementById('template-options-barang');
        var itemOptions = itemOptionsDOM ? itemOptionsDOM.innerHTML : '<option selected disabled>Pilih Item</option>';

        var template = `
            <th scope="row" class="product-id text-center fw-bold">
                <span class="product-id-badge">${nextNum}</span>
            </th>
            <td class="text-start">
                <div class="mb-2">
                    <select class="form-select inv-dark-control" name="barang_id[${currentIdx}]" id="productName-${nextNum}" required>
                        ${itemOptions}
                    </select>
                </div>
                <textarea class="form-control inv-dark-control mb-2" id="productDetails-${nextNum}" name="deskripsi_item[${currentIdx}]" rows="2" placeholder="Deskripsi Item (Wajib Diisi)" required></textarea>
                
                <!-- CONTAINER MATERIAL UNTUK ITEM BARU -->
                <div class="materials-container material-container-${currentIdx}" data-row-index="${currentIdx}">
                    <div class="material-box-wrapper">
                        <div class="material-box-header">
                            <span class="material-box-title">Spesifikasi Material <span class="text-danger fw-bold" title="Wajib Diisi">*</span></span>
                            <span class="text-muted fs-11">P × L × Qty</span>
                        </div>
                        <div class="material-row pt-1">
                            <div class="row g-2 align-items-center">
                                 <div class="col-xl-4 col-lg-12">
                                    <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[${currentIdx}][]" style="height: 32px !important; font-size: 12px !important;">
                                        ${materialOptions}
                                    </select>
                                 </div>
                                 <div class="col-xl-3 col-lg-6 col-12">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[${currentIdx}][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                                        <span class="text-muted fw-bold px-1">×</span>
                                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[${currentIdx}][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                                    </div>
                                 </div>
                                 <div class="col-xl-2 col-lg-3 col-5">
                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[${currentIdx}][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                                 </div>
                                 <div class="col-xl-2 col-lg-2 col-4">
                                    <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[${currentIdx}][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                                 </div>
                                 <div class="col-xl-1 col-lg-1 col-3 text-end">
                                    <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-link text-info text-decoration-none p-0 mt-2 add-material btn-tambah-material fs-12 fw-semibold">
                    <i class="ri-add-circle-line me-1"></i> Tambah Material Lainnya
                </button>
            </td>
            <td>
                <select class="form-select inv-dark-control" style="min-width: 95px;" name="satuan[${currentIdx}]" id="satuan-${nextNum}" required>
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
            <td class="col-item-harga">
                <input type="text" class="form-control inv-dark-control product-price numeric" id="productRate-${nextNum}" name="hrg[${currentIdx}]" placeholder="Rp. 0.000" onchange="autoCalc(this)" required />
            </td>
            <td>
                <input type="number" class="form-control inv-dark-control text-center fw-bold" id="product-qty-${nextNum}" value="1" min="1" step="any" name="qty[${currentIdx}]" onchange="autoCalc(this)" required>
            </td>
            <td class="col-item-jumlah-harga text-end">
                <input type="text" class="form-control inv-dark-control inv-readonly product-line-price numeric text-end font-mono" id="productPrice-${nextNum}" name="jlh_hrg[${currentIdx}]" placeholder="Rp.0.000" readonly />
            </td>
            <td class="product-removal text-center">
                <button type="button" class="btn btn-hapus-item" title="Hapus Baris Item">
                    <i class="ri-delete-bin-line"></i> Hapus
                </button>
            </td>
        `;

        var tr = document.createElement("tr");
        tr.id = nextNum;
        tr.className = "product";
        tr.innerHTML = template;
        document.getElementById("newlink").appendChild(tr);

        var selectInvoice = document.getElementById('choices-invoice');
        var selectedOpt = selectInvoice ? selectInvoice.options[selectInvoice.selectedIndex] : null;
        var tipeHarga = selectedOpt ? selectedOpt.getAttribute('data-tipe-harga') : 'dengan_harga';
        if (tipeHarga === 'tanpa_harga') {
            var rateEl = tr.querySelector(`[name="hrg[${currentIdx}]"]`);
            if (rateEl) {
                rateEl.removeAttribute('required');
                rateEl.value = '0';
            }
            var jlhEl = tr.querySelector(`[name="jlh_hrg[${currentIdx}]"]`);
            if (jlhEl) {
                jlhEl.value = '0';
            }
        }

        if (typeof Cleave !== 'undefined') {
            new Cleave(`#productRate-${nextNum}`, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        }

        window.resetRowNumbers();
    };

    $(document).ready(function() {
        if (typeof window.resetRowNumbers === 'function') {
            window.resetRowNumbers();
        }
    });
</script>
@endsection
