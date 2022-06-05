<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi_Detail extends Model
{
    use HasFactory;

    protected $table = 'produksi_detail';

    public function inventori(){
        return $this->belongsTo(Inventori::class);
    }
    public function produksi(){
        return $this->belongsTo(Produksi::class);
    }
}
