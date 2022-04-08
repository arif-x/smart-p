<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanDevelopment extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'jawaban_development';
    protected $guarded = [];
    protected $primaryKey = 'id_jawaban_development';
}
