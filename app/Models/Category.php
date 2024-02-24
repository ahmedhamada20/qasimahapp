<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name','sort_order');
    protected $casts = ['name'=>'json'];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

}
