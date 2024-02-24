<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemThumb extends Model
{

    protected $table = 'item_thumbs';
    protected $fillable = array('user_id','item_id','up','down','ip');

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    function user() {
        return $this->belongsTo(\App\User::class,'user_id');
    }

}
