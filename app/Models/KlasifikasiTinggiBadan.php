<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiTinggiBadan extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'klasifikasi_tinggi_badan';
    protected $guarded = [];
    protected $primaryKey = 'id_klasifikasi_tinggi_badan';
}
