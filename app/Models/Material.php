<?php

namespace App\Models;


use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use LogsActivity;

    public function activityLogModule(): string
    {
        return 'material';
    }

    use HasFactory;
    protected $table = "material";
    protected $guarded = [];
    protected $fillable = [
        'kode_material',
        'jenis_material',
        'stok',
        'satuan',
        'harga_modal',
        'harga_jual',
        
    ];
   
}
