<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentingApi extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'parentings';
    protected $guarded = [];
    protected $primaryKey = 'id_parentings';
}
