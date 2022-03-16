<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'tips';
    protected $guarded = [];
    protected $primaryKey = 'id_tips';
}
