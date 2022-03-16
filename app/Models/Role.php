<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'role';
    protected $guarded = [];
    protected $primaryKey = 'id_role';
}
