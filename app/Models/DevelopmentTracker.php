<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentTracker extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'development_tracker';
    protected $guarded = [];
    protected $primaryKey = 'id_development_tracker';
}
