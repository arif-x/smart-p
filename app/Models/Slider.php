<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'slider';
    protected $guarded = [];
    protected $primaryKey = 'id_slider';
}
