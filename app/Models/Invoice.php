<?php

namespace App\Models;


use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use LogsActivity;

    public function activityLogModule(): string
    {
        return 'kategori';
    }

    use HasFactory;
    protected $table = "invoice";
    protected $guarded = [];
    protected $fillable = [
        'nama_invoice',
        'kode_invoice',
        'perusahaan_id',
        'tipe_harga',
    ];
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'penjualan_id');
    }
    public function penjualanByInvoice()
    {
        return $this->hasMany(Penjualan::class, 'invoice');
    }

    public function kategori()
    {
        return $this->belongsTo(Perusahaan::class, 'id');
    }

    public static function findByNama($nama)
    {
        return self::where('nama_perusahaan', $nama)->first();
    }  
    public function invoice() {
        return $this->belongsTo(Perusahaan::class, 'id');
    }
}
