<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'bahasa';
    protected $guarded = [];
    protected $primaryKey = 'id_bahasa';
}
