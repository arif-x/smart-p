<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisParenting extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'jenis_parenting';
    protected $guarded = [];
    protected $primaryKey = 'id_jenis_parenting';
}
