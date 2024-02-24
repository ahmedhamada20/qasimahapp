<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubitemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $lang = \App::getLocale();

        return [
            'id' => $this->id,
            'image' => $this->brand ? $this->brand->image : "",
            'discount_code' => $this->discount_code,
            'title' => $this->title ? $this->title[$lang] : "",
            'description' => $this->description ? $this->description[$lang] : "",
            'url' => $this->url,
            'show' => $this->show,
            'advice' => $this->advice,
            'alert' => $this->alert,
            'discount_percent' => $this->discount_percent ? (string)$this->discount_percent : '',
        ];
    }
}
