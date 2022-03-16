<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionTracker extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'nutrition_tracker';
    protected $guarded = [];
    protected $primaryKey = 'id_nutrition_tracker';
}
