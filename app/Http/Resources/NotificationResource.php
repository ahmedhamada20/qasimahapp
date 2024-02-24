<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = \App::getLocale();
        return [
            'id' => $this->id,
            'body' => $this->body[$lang],
            'title' => $this->title[$lang],
            'date' => Carbon::parse($this->created_at)->diffForHumans(),
            'image' => $this->image,
            'url_type' => $this->url_type,
            'url_value' => $this->url_value,
        ];
    }
}
