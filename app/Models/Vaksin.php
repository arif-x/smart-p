<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'vaksin';
    protected $guarded = [];
    protected $primaryKey = 'id_vaksin';
}
