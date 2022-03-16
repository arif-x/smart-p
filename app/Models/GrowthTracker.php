<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthTracker extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'growth_tracker';
    protected $guarded = [];
    protected $primaryKey = 'id_growth_tracker';
}
