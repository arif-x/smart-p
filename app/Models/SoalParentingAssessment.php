<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalParentingAssessment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'soal_parenting_assessment';
    protected $guarded = [];
    protected $primaryKey = 'id_soal_parenting_assessment';
}
