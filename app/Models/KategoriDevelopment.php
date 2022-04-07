<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDevelopment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'kategori_development';
    protected $guarded = [];
    protected $primaryKey = 'id_kategori_development';
}
