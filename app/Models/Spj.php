<?php

namespace App\Models;


use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    use LogsActivity;

    public function activityLogModule(): string
    {
        return 'spj';
    }

    protected $table = 'spj';
    protected $fillable = [
       'nomor_spj',
       'perusahaan',
       'nama_pemberi_tugas',
       'nama_kurir',
       'tanggal_tugas',
       'waktu_berangkat',
       'tujuan',
    ];
    use HasFactory;
}
