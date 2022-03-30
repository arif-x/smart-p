<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'vaksinasi';
    protected $guarded = [];
    protected $primaryKey = 'id_vaksinasi';
}
