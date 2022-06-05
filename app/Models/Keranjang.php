<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table="keranjang";
    protected $fillable = [
        'id_user',
        'quantity',
        'nwo',
        'aj',
        'ar',
        'gp',
        'toi',
        'k',
        'tjawa',
        'rbs',
    ];
}
