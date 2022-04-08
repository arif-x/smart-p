<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanParentingAssessment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'jawaban_parenting_assessment';
    protected $guarded = [];
    protected $primaryKey = 'id_jawaban_parenting_assessment';
}
