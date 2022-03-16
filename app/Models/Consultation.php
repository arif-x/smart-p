<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'consultation';
    protected $guarded = [];
    protected $primaryKey = 'id_consultation';
}
