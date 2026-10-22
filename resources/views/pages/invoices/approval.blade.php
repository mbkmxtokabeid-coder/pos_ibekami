@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" /> --}}

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    /* Atur SweetAlert menjadi lebih besar dan muncul di tengah */
    .swal2-popup {
        width: 500px;
        background-color: rgba(0, 0, 0, 0.7); /* Atur latar belakang gelap dengan alpha (transparansi) 0.7 */
        color: white;
            /* position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); */
    }
</style>
@endsection
@extends('layout.template')
@section('content')

<div class="page-content">
  <div class="container-fluid">

<div class="container mx-auto px-4 py-6 max-w-lg">
    <div class="bg-primary shadow-md rounded-xl p-5">
        <h1 class="text-xl font-semibold mb-4 text-center text-gray-800">
            Konfirmasi Approval Invoice
        </h1>

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Nomor Invoice:</p>
            <p class="text-lg font-bold text-blue-600">{{ $invoice->nomor_invoice }}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Nama Pelanggan:</p>
            <p class="text-base text-gray-800">{{$invoice->customer. ' / '. $invoice->perusahaan}}</p>
        </div>
        
        @foreach ($penjualan_barang as $index => $jual)
            @foreach ($barang[$index] as $item)

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Nama Barang:</p>
            <p class="text-base text-gray-800">{{$item->jenis_barang}}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Deskripsi Barang:</p>
            <p class="text-base text-gray-800">{{$jual->deskripsi_item}}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Jumlah:</p>
            <p class="text-base text-gray-800">{{$jual->qty}}</p>
        </div>


        @endforeach
        @endforeach

        <div class="mb-4">
            <p class="text-sm text-gray-700 mb-1">Total Tagihan:</p>
            <p class="text-base text-green-600 font-semibold">Rp.{{$invoice->formatted_total_pembayaran}}</p>
        </div>

        <div class="mt-4 d-flex flex-column gap-2">
            <form action="{{ url('invoice/ubah-status-unlock/' . $invoice->id) }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-100 btn btn-success fw-bold py-2 px-4 rounded-lg transition" style="font-size: 14px;">
                    <i class="las la-lock-open me-1"></i> Setujui & Buka Kunci Invoice
                </button>
            </form>

            <button type="button" class="w-100 btn btn-danger fw-bold py-2 px-4 rounded-lg transition" style="font-size: 14px;" onclick="confirmHapusApproval('{{ $invoice->id }}', '{{ addslashes(e($invoice->nomor_invoice)) }}')">
                <i class="las la-trash me-1"></i> Hapus Invoice Ini
            </button>

            @if($invoice->status !== 'Batal')
            <button type="button" class="w-100 btn btn-warning fw-bold py-2 px-4 rounded-lg transition text-dark" style="font-size: 14px;" onclick="confirmBatalApproval('{{ $invoice->id }}', '{{ addslashes(e($invoice->nomor_invoice)) }}')">
                <i class="las la-times-circle me-1"></i> Batalkan Invoice
            </button>
            @endif
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

        <div class="mt-4 text-center">
            <a href="/list-invoice" class="text-sm text-gray-600 underline hover:text-blue-500">Kembali ke Daftar Invoice</a>
        </div>
    </div>
</div>
@endsection

@section('plugins')
{{-- Datatable --}}

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
{{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}
<script>
    const loggedInUser = "{{ auth()->user()->nama }}";
</script>

<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.init.js')}}"></script>
<script src="{{asset('js/halaman/daftar-invoice.js')}}"></script>

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
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Alasan penghapusan invoice wajib diisi!';
            }
        },
        customClass: {
            popup: 'swal2-popup'
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
        confirmButtonColor: '#f59e0b',
        cancelButtonColor: '#64748b',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Alasan pembatalan invoice wajib diisi!';
            }
        },
        customClass: {
            popup: 'swal2-popup'
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
