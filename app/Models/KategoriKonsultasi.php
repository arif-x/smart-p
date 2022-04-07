<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKonsultasi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'kategori_konsultasi';
    protected $guarded = [];
    protected $primaryKey = 'id_kategori_konsultasi';
}
