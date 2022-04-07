<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'development';
    protected $guarded = [];
    protected $primaryKey = 'id_development';
}
