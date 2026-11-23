<?php

namespace App\Models;


use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use LogsActivity;

    public function activityLogModule(): string
    {
        return 'barang';
    }

    use HasFactory;
    protected $table = "barang";
    protected $guarded = [];
    protected $fillable = [
        'jenis_barang',
        'kode_barang',
        'kategori_id',
        'stok',
        'harga_modal',
        'harga_jual',
        'tgl_masuk',
        'is_material_required',
    ];
    public function kategori_item()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }
    public function penjualan_barang()
    {
        return $this->hasMany(PenjualanBarang::class, 'barang_id');
    }
}
