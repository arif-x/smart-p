<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'artikel';
    protected $guarded = [];
    protected $primaryKey = 'id_artikel';
}
