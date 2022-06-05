<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    
    protected $table = 'produksi';

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
    public function inventori(){
        return $this->belongsTo(Inventori::class);
    }
    public function produksi ()
{
    return $this->hasMany(Produksi::class);
}
}
