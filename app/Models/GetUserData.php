<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetUserData extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'profile';
    protected $guarded = [];
}
