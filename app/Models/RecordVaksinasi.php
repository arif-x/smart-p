<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordVaksinasi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'record_vaksinasi';
    protected $guarded = [];
    protected $primaryKey = 'id_record_vaksinasi';
}
