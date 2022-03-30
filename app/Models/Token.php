<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'personal_access_tokens';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
