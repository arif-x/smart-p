<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunciJawabanParentingAssessment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'kunci_jawaban_parenting_assessment';
    protected $guarded = [];
    protected $primaryKey = 'id_kunci_jawaban_parenting_assessment';
}
