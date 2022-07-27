<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeKonsultasi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'like_konsultasi';
    protected $guarded = [];
    protected $primaryKey = 'id_like_konsultasi';
}
