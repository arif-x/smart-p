<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'konsultasi';
    protected $guarded = [];
    protected $primaryKey = 'id_konsultasi';
}
