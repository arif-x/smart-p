<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parenting extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'parenting';
    protected $guarded = [];
    protected $primaryKey = 'id_parenting';
}
