<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'nutrition';
    protected $guarded = [];
    protected $primaryKey = 'id_nutrition';
}
