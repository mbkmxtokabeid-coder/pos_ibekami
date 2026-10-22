<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $invName = $this->input('inv');
        $invoice = !empty($invName) ? \App\Models\Invoice::where('nama_invoice', $invName)->first() : null;
        $isTanpaHarga = ($invoice && $invoice->tipe_harga === 'tanpa_harga');

        $rules = [
            'inv' => 'required',
            'kode' => 'required',
            'tgl_jual' => 'required',
            'pelanggan' => 'required|min:2',
            'perusahaan' => 'nullable',
            'tlp' => 'required|min:3',
            'adm' => 'required',
            'order' => 'required',
            'tgl_selesai' => 'required',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required',
            'deskripsi_item.*' => 'required',
            'satuan.*' => 'required',
            'qty.*' => 'required',
        ];

        if ($isTanpaHarga) {
            $rules['jns_pem'] = 'nullable';
            $rules['hrg.*'] = 'nullable';
        } else {
            $rules['jns_pem'] = 'required';
            $rules['hrg.*'] = 'required';
        }

        if ($this->input('order') === 'Sales') {
            $rules['sales'] = 'required';
        }

        return $rules;
    }
    
    public function messages()
    {
        return [
            'inv.required' => 'Jenis invoice wajib dipilih.',
            'kode.required' => 'Kode invoice harus diisi.',
            'tgl_jual.required' => 'Tanggal penjualan harus diisi.',
            'pelanggan.required' => 'Nama customer wajib diisi.',
            'pelanggan.min' => 'Nama customer minimal terdiri dari 2 karakter.',
            'tlp.required' => 'Nomor telepon wajib diisi.',
            'tlp.min' => 'Nomor telepon minimal terdiri dari 3 karakter.',
            'adm.required' => 'Nama admin wajib dipilih.',
            'order.required' => 'Order dari wajib dipilih.',
            'sales.required' => 'Nama sales wajib diisi ketika Order Dari dipilih Sales.',
            'tgl_selesai.required' => 'Target penyelesaian wajib diisi.',
            'jns_pem.required' => 'Jenis pembayaran (Payment Method) wajib dipilih.',
            'barang_id.required' => 'Minimal 1 item barang harus dimasukkan.',
            'barang_id.*.required' => 'Silakan pilih item barang pada setiap baris.',
            'deskripsi_item.*.required' => 'Deskripsi item pada setiap baris wajib diisi.',
            'satuan.*.required' => 'Satuan barang wajib dipilih.',
            'hrg.*.required' => 'Harga barang wajib diisi.',
            'qty.*.required' => 'Kuantitas barang wajib diisi.',
        ];
    }
}
