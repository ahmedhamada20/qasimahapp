<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JWTAuth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->id);
        $myTTL = 60 * 60 * 365; //minutes
        JWTAuth::factory()->setTTL($myTTL);
        $token = JWTAuth::fromUser($user);
        return [
            'id' => $this->id,
            'name' => $this->name ? $this->name : '',
            'google_id' => $this->google_id ? $this->google_id : '',
            'email' => $this->email ? $this->email : '',
            'social_token' => $this->social_token ? $this->social_token : '',
            'code' => $this->code ? (string)$this->code : "",
            'token' => $token

        ];
    }
}
