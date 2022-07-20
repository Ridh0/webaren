<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = 
    [
        'user_id',
        'id_user',
        'tanggal',
        'nama',
        'nofaktur',
        'notagudang',
        'harga',
        'status',
        'kode',
        'gulabatok',
        'ar25',
        'ar5',
        'ar1',
        'rg25',
        'rg5',
        'rg1',
        'rgk1',
        'gsm',
        'cr',
        'aj',
        'k',
        'toi',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
