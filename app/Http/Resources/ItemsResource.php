<?php

namespace App\Http\Resources;

use App\Models\CouponReview;
use App\Models\FavouriteItem;
use App\Models\UsedCoupon;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use JWTAuth;

class ItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        if ($request->header('Authorization')) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
            }
            $check = FavouriteItem::where(['user_id' => $user->id, 'item_id' => $this->id])->first();
            if ($check) {
                $fav_status = true;
            } else {
                $fav_status = false;
            }

            $rated_check = CouponReview::where(['user_id' => $user->id, 'item_id' => $this->id])->first();
            if ($rated_check) {
                $rated_status = true;
            } else {
                $rated_status = false;
            }


            $used_check = UsedCoupon::where(['user_id' => $user->id, 'item_id' => $this->id])->first();
            if ($used_check) {
                $used_status = true;
            } else {
                $used_status = false;
            }

        } else {
            $fav_status = false;
            $rated_status = false;
            $used_status = false;

        }


        $lang = \App::getLocale();
        return [
            'id' => $this->id,
            'image' => $this->image ?? "",
            'subItems' => SubitemsResource::collection($this->subItems),
//            'image' => $this->brand ? $this->brand->image : "",
            'discount_code' => $this->discount_code,
            'title' => $this->title ? $this->title[$lang] : "",
            'description' => $this->description ? $this->description[$lang] : "",
            'url' => $this->url,
            'fav_status' => $fav_status,
            'rated_status' => $rated_status,
            'used_status' => $used_status,
            'discount_percent' => $this->discount_percent ? (string)$this->discount_percent : '',
            'used_count' => $this->used_count ? $this->used_count : 0,
            'last_used' => Carbon::parse($this->last_used)->diffForHumans(),
            'advice' => $this->advice ? $this->advice[$lang] : "",
            'alert' => $this->alert ? $this->alert[$lang] : "",
            'high_light' =>  $this->high_light ? $this->high_light[$lang] : "",
        ];
    }
}
