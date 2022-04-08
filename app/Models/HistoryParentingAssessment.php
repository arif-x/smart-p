<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryParentingAssessment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'history_parenting_assessment';
    protected $guarded = [];
    protected $primaryKey = 'id_history_parenting_assessment';
}
