<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriParentingAssessment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'kategori_parenting_assessment';
    protected $guarded = [];
    protected $primaryKey = 'id_kategori_parenting_assessment';
}
