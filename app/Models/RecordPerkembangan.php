<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordPerkembangan extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'record_perkembangan';
    protected $guarded = [];
    protected $primaryKey = 'id_record_perkembangan';
}
