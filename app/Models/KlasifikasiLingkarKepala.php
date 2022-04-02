<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiLingkarKepala extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'klasifikasi_lingkar_kepala';
    protected $guarded = [];
    protected $primaryKey = 'id_klasifikasi_lingkar_kepala';
}
