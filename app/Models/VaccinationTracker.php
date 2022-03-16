<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationTracker extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'vaccination_tracker';
    protected $guarded = [];
    protected $primaryKey = 'id_vaccination_tracker';
}
