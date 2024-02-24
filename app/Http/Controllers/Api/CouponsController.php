<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemsResource;
use App\Http\Resources\OfferSlidersResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\CouponReview;
use App\Models\FavouriteItem;
use App\Models\Help;
use App\Models\Item;
use App\Models\OfferSlider;
use App\Models\SuggestCoupon;
use App\Models\UsedCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
// use function GuzzleHttp\Psr7\uri_for;
use Illuminate\Validation\Rule;

class CouponsController extends Controller
{
    public function home($category_id)
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        if ($category_id == 0) {
            // $rows = Item::orderByDesc('id')->where('offer', 'false')->paginate(10);
            $rows = Item::orderBy('sort_order', 'ASC')->where('show',1)->where('offer', 'false')->paginate(10);
            //  Item::orderBy('sort_order', 'ASC')->where('offer', 'false')->latest()->get();
        } else {
            // $rows = Item::whereCategoryId($category_id)->where('offer', 'false')->orderByDesc('id')->paginate(10);
            $rows = Item::whereCategoryId($category_id)->where('show',1)->where('offer', 'false')->orderBy('sort_order', 'ASC')->paginate(10);
        }

        return ItemsResource::collection($rows)->additional([
            'value' => true
        ]);

    }

    function thumb(Request $request,$type) {

        $request->validate([
            'item_id'=>'required|exists:items,id',
            'user_id'=>[
                Rule::requiredIf($request->ip == null),
                'exists:users,id'
            ],
            'ip'=>[
                Rule::requiredIf($request->user_id == null),
            ]
        ]);

        $inputs = $request->all();

        $inputs[$type] = 1;

        if($type == 'down'){
            $existsBefore = \App\Models\ItemThumb::/*whereItemId($request->item_id)
                ->*/where($type,1)
                ->where(function ($q) {
                    if(request('user_id')){
                        $q->where('user_id',request('user_id'));
                    }else{
                        $q->where('ip',request('ip'));
                    }
                })->where('created_at','>=',now()->subDays(2))
                ->count() >= 2;

            if(!$existsBefore){
                $item = \App\Models\ItemThumb::create($inputs);
            }else{
                return response()->json([
                    'status'=>false,
                    'msg'=>'لقد تجاوزت الحد الاقصى لخانة غير فعّال الرجاء تواصل معنا عن طريق قسم المساعدة ❌'
                ]);
            }
        }else{
            $item = \App\Models\ItemThumb::create($inputs);
        }

        return response()->json(['status'=>true]);
    }

    public function offers_coupons()
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $rows = Item::orderByDesc('id')->where('show',1)->where('offer', 'true')->paginate(10);

        return ItemsResource::collection($rows)->additional([
            'value' => true
        ]);

    }

    public function use_coupon($coupon_id)
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $key = request('type');

        $item = Item::find($coupon_id);
        $item->used_count += 1;
        if($key){
            $item->{$key} += 1;
        }
        $item->last_used = Carbon::now();
        $item->update();

        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            $user = null;
        }

        // if (!$user = JWTAuth::parseToken()->authenticate()) {
        //     return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        // }

        $check = UsedCoupon::where(['user_id' => $user->id ?? NULL, 'item_id' => $coupon_id])->first();
        if (!$check) {
            UsedCoupon::create(['user_id' => $user->id ?? NULL, 'item_id' => $coupon_id]);
        }

        return response()->json(['value' => true, 'data' => \Lang::get('data.success')]);

    }

    public function delete_used_coupon($coupon_id)
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }

        $check = UsedCoupon::where(['user_id' => $user->id, 'item_id' => $coupon_id])->first();
        if ($check) {
            $check->delete();
        }

        return response()->json(['value' => true, 'data' => \Lang::get('data.success')]);

    }

    public function coupon_review(Request $request)
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }

        $validator = \Validator::make($request->all(), [
            'coupon_id' => 'required|exists:items,id',
            'status' => 'required|in:good,bad'
        ]);


        if ($validator->passes()) {

            CouponReview::create([
                'user_id' => $user->id,
                'item_id' => $request['coupon_id'],
                'status' => $request['status']
            ]);


            return response()->json(['value' => true, 'data' => \Lang::get('data.success')]);

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);

        }


    }

    public function favourite_coupon(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'coupon_id' => 'required|exists:items,id'
        ]);
        if ($validator->passes()) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
            }

            $check = FavouriteItem::where(['user_id' => $user->id, 'item_id' => $request['coupon_id']])->first();

            if ($check) {
                $check->delete();
            } else {
                FavouriteItem::create(['user_id' => $user->id, 'item_id' => $request['coupon_id']]);
            }

            return response()->json(['value' => true, 'data' => \Lang::get('data.success')]);

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }

    public function filter(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'categories' => 'nullable',
            'order_by' => 'nullable'
        ]);

       
        if ($validator->passes()) {

            $categories = explode(",", $request['categories']);
            $rows = Item::where('offer', 'false')->where('show',1);

            if($request['category_id'] ?? NULL){
                $explode = explode(',',$request['category_id']);
                $rows->whereIn('category_id',$explode);
            }

            if ($request['order_by']) {
                // if ($request['order_by'] == 'high_discount') {
                //     $rows->orderByDesc('discount_percent');
                if ($request['order_by'] == 'high_discount') {
                    $rows->orderByDesc('used_count')->orderByDesc('last_used')->whereRaw("DATE(last_used) > (NOW() - INTERVAL 7 DAY)");
                } elseif ($request['order_by'] == 'alpha_asc') {

                    $rows->orderBy('title->' . \App::getLocale(), 'asc');
                } elseif ($request['order_by'] == 'alpha_desc') {
                    $rows->orderBy('title->' . \App::getLocale(), 'desc');

                } elseif ($request['order_by'] == 'most_used') {
                    // sort by desc used_count and last_used
                    $rows->orderByDesc('used_count')->orderByDesc('last_used');
                }
            }

            if ($request['categories']) {
                $rows->whereIn('category_id', $categories);
            }
            $rows = $rows->paginate(10);
            return ItemsResource::collection($rows)->additional(['value' => true]);


        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }

    public function search(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'search' => 'required_if:coupon_id,null',
            'coupon_id' => 'required_if:search,null|exists:items,id'
        ]);
        if ($validator->passes()) {

//
//            if (\App::getLocale() == 'ar') {
//                $rows = Item::where('title->' . \App::getLocale(), 'LIKE', "%{$request->search}%")->where('offer', 'false')->orderByDesc('id')->paginate(10);
//
//            } else {
//                $rows = Item::whereRaw('LOWER(`title`) like ?', ['%' . strtolower($request['search']) . '%'])->where('offer', 'false')->orderByDesc('id')->paginate(10);
//            }


            $rows = Item::orderByDesc('id');

            if($request->coupon_id != null){
                $rows = $rows->where('id',$request->coupon_id);
            }


            $replacementVars = [
                [
                    'ة','ه'
                ],
                [
                    'ا','أ','آ','إ','لا','لأ','لآ','لإ'
                ],
                [
                    'ف','ڤ'
                ],
                [
                    'ج','چ'
                ],
                [
                    'ى','ئ'
                ]
            ];

            // return false;

            $rows = $rows->where(function ($q) use($request,$replacementVars) {
                $q->whereRaw('LOWER(`title`) like ?', ['%' . strtolower($request['search']) . '%']);

                foreach ($replacementVars as $keys) {
                    $originalString = $request['search'];
                    foreach ($keys as $key) {
                        if(strpos($originalString,$key) !== false){
                            foreach ($keys as $_key=>$newKey) {
                                $newString = str_replace($key,$newKey,$originalString);

                                $q->orWhereRaw('LOWER(`title`) like ?', ['%' . strtolower($newString) . '%']);

                            }
                        }
                    }
                }

            });


            $rows = $rows->where('offer', 'false')->where('show',1)->paginate(10);

            if (count($rows) == 0) {
                $rows = Item::orderByDesc('id');

                $originalString = $request['search'];

                $rows = $rows->where(function ($q) use($request,$replacementVars,$originalString) {
                    $q->where('title->' . \App::getLocale(), 'LIKE', "%{$request['search']}%");

                    foreach ($replacementVars as $keys) {
                        foreach ($keys as $key) {
                            if(strpos($originalString,$key) !== false){
                                foreach ($keys as $newKey) {
                                    $originalString = str_replace($key,$newKey,$originalString);

                                    $q->orWhere('title->' . \App::getLocale(), 'LIKE', "%$originalString%");
                                }
                            }
                        }
                    }

                });

                // return false;

                // dd($rows->where('offer', 'false')->where('show',1)->toSql());
                $rows = $rows->where('offer', 'false')->where('show',1)->paginate(10);
            }


            return ItemsResource::collection($rows)->additional(['value' => true]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);

        }
    }

    public function offers_sliders(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $rows = OfferSlider::orderByDesc('id')->get();
        return OfferSlidersResource::collection($rows)->additional(['value' => true]);
    }

    public function favourites()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }

        $rows = $user->favourite_items()->paginate(10);
        return ItemsResource::collection($rows)->additional([
            'value' => true
        ]);
    }

    public function used_coupons()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }

        $rows = $user->used_coupons()->paginate(10);
        return ItemsResource::collection($rows)->additional([
            'value' => true
        ]);
    }

    public function suggest_coupon(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'address' => 'required',
            'coupon_code' => 'required',
            'category_id' => 'required|exists:categories,id',
            'discount_percent' => 'required',
            // 'store_affiliate' => 'required',
        ]);
        if ($validator->passes()) {

            SuggestCoupon::create($request->all());
            return response()->json(['value' => true, 'data' => \Lang::get('data.sent_success')]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }

    }

    public function send_help(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'brand' => 'nullable',
            'email' => 'required',
            'address' => 'required',
            'message' => 'required',
            'coupon' => 'required',
        ]);
        if ($validator->passes()) {

            Help::create($request->all());
            return response()->json(['value' => true, 'data' => \Lang::get('data.contact_sent')]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }

    }

    public function complaints(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'email' => 'required',
            'body' => 'required',
            'brand' => 'required',
            'coupon' => 'required',
        ]);
        if ($validator->passes()) {

            Complaint::create($request->all());
            return response()->json(['value' => true, 'data' => \Lang::get('data.contact_sent')]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }
}
