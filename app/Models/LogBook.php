<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'log_book';
    protected $guarded = [];
    protected $primaryKey = 'id_log_book';
}
