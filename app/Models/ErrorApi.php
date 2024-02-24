<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorApi extends Model
{
    protected $table = 'error_apis';
    public $timestamps = true;
    protected $casts = ['notes'=>'json'];

    protected $fillable = [
        'name',
        'notes',
    ];
}
