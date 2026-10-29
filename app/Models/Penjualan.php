<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Penjualan extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "penjualan";
    protected $guarded = [];
    protected $fillable = [
        'invoice',
        'nomor_invoice',
        'tgl_penjualan',
        'customer',
        'perusahaan',
        'no_telepon',
        'admin',
        'order_by',
        'nama_sales',
        'tgl_selesai',
        'jumlah_item',
        'dp',
        'potongan',
        'jenis_pembayaran',
        'no_rek',
        'total_harga',
        'status',
        'approval',
        'diskon',
        'ppn',
        'total_pembayaran',
        'sisa_pembayaran',
        'alasan_batal',
        'alasan_hapus',
        'tanda_tangan',

    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'admin');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_by');
    }
    public function penjualanBarang()
    {
        return $this->hasMany(PenjualanBarang::class, 'penjualan_id');
    }
    public function InvoiceUpdateLog()
    {
        return $this->hasMany(InvoiceUpdateLog::class, 'invoice_id');
    }

    public function getTandaTanganUrlAttribute()
    {
        // 1. Prioritas utama: snapshot tanda tangan yang tersimpan pada invoice
        if (!empty($this->tanda_tangan)) {
            if (file_exists(public_path('images/signatures/' . $this->tanda_tangan))) {
                return asset('images/signatures/' . $this->tanda_tangan);
            }
            if (file_exists(public_path('images/' . $this->tanda_tangan))) {
                return asset('images/' . $this->tanda_tangan);
            }
        }

        // 2. Hubungkan dengan akun admin pembuat invoice jika snapshot belum ada
        $adminUser = $this->user;
        if (!$adminUser && $this->admin) {
            $adminUser = User::find($this->admin);
        }

        if ($adminUser) {
            return $adminUser->tanda_tangan_url;
        }

        // 3. Fallback historis jika invoice lama tercatat atas nama Namira (id 8)
        if ($this->admin == 8 && file_exists(public_path('images/ttd.png'))) {
            return asset('images/ttd.png');
        }

        return null;
    }

    public function getNorekTextAttribute()
    {
        // If stored no_rek is already a full text string
        if (!empty($this->no_rek) && strlen($this->no_rek) > 10 && strpos($this->no_rek, '|') !== false) {
            return $this->no_rek;
        }

        // Historical resolution based on tgl_penjualan
        $tgl = $this->tgl_penjualan ? \Carbon\Carbon::parse($this->tgl_penjualan)->toDateString() : null;

        if ($tgl && $tgl < '2025-07-11') {
            return "BNI | A/N : Yusni Kurniasih | No. Rek : 8331119999";
        } elseif ($tgl && $tgl < '2026-05-02') {
            return "Mandiri | A/N : Yusni Kurniasih | No. Rek : 1050000329999";
        } elseif ($tgl && $tgl < '2026-07-23') {
            return "BSI | A/N : Yusni Kurniasih | No. Rek : 2845999999";
        } elseif (($tgl && $tgl < '2026-08-04') || ($this->id && $this->id <= 2464)) {
            return "BNI | A/N : Oky Irawan | No. Rek : 816029999";
        } else {
            return "BSI | A/N : Yusni Kurniasih | No. Rek : 2845999999";
        }
    }
}

