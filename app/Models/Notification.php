<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('body', 'user_id','title','url_type','url_value','image');
    protected $casts = ['body'=>'json','title'=>'json'];
}
