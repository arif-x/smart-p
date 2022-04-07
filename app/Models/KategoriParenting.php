<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriParenting extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'kategori_parenting';
    protected $guarded = [];
    protected $primaryKey = 'id_kategori_parenting';
}
