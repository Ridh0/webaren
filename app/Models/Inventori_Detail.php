<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventori_Detail extends Model
{
    use HasFactory;

    protected $table = 'inventori_keluar_masuk';

    protected $fillable = [
     
        'jmlhasil',
        'jmlbahan',
        'keterangan',
        'aj',
        'ar',
        'gp',
        'toi',
        'k',
        'tjawa',
        'cr',
        'gsm',
        'ar25',
        'ar5',
        'ar1',
        'rg25',
        'rg5',
        'rg1',
        'rgk1',
        'bs',
    ];
}
