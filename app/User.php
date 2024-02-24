<?php

namespace App;

use App\Models\Item;
use App\Models\Token;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $fillable = array('name', 'email', 'password', 'social_token','code','google_id');

    public function favourite_items()
    {
        return $this->belongsToMany(Item::class, 'favourite_items', 'user_id', 'item_id');
    }

    public function used_coupons()
    {
        return $this->belongsToMany(Item::class, 'used_coupons', 'user_id', 'item_id');
    }
    public function tokens()
    {
        return $this->hasMany(Token::class, 'user_id');
    }

    function notifications() {
        return $this->hasMany('App\Models\Notification', 'user_id');
    }
}
