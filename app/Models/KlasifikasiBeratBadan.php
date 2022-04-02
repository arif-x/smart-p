<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiBeratBadan extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'klasifikasi_berat_badan';
    protected $guarded = [];
    protected $primaryKey = 'id_klasifikasi_berat_badan';
}
