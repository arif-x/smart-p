<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'profil';
    protected $guarded = [];
    protected $primaryKey = 'id_profil';
}
