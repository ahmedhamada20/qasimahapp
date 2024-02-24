<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteItem extends Model 
{

    protected $table = 'favourite_items';
    public $timestamps = true;
    protected $fillable = array('user_id', 'item_id');

}