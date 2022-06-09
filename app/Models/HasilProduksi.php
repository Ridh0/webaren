<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    use HasFactory;

    protected $table = "barang_hasil_produksi";

    protected $fillable = [
        'produksi_id',
        'ar25',
        'ar5',
        'ar1',
        'rg25',
        'rg5',
        'rg1',
        'rgk1',

    ];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }
}
