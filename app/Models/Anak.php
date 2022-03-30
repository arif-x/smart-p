<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'anak';
    protected $guarded = [];
    protected $primaryKey = 'id_anak';
}
