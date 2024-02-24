<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FavouriteItem;
use App\Models\Item;
use App\Models\UsedCoupon;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showAllItems($category_id)
    {
        if (is_numeric($category_id)) {
            $category = Category::findOrFail($category_id);

            $items = Item::whereCategoryId($category->id)->orderByDesc('id')->paginate(20);
            $category = $category->name[\App::getLocale()];
        } else if ($category_id == 'all') {
            $category = \Lang::get('data.All');
            $items = Item::orderByDesc('id')->paginate(20);
        } else {
            $category = \Lang::get('data.bestDeals');
            $items = Item::orderByDesc('id')->where('offer', 'true')->paginate(20);
        }

        return view('site.allItems', compact('category', 'items'));
    }

    public function userCoupon(Request $request)
    {
        if (\Auth::check()) {
            UsedCoupon::create([
                'user_id' => auth()->id(),
                'item_id' => $request['item_id']
            ]);
        }
    }

    public function favItem($item_id)
    {
        if (\Auth::check()) {
            $item = Item::findOrFail($item_id);

            $favCheck = FavouriteItem::where([
                'item_id' => $item->id,
                'user_id' => \Auth::user()->id,
            ])->first();

            if ($favCheck) {
                $favCheck->delete();
                toast(\Lang::get('data.removeFav'), 'success');

            } else {
                FavouriteItem::create([
                    'item_id' => $item->id,
                    'user_id' => \Auth::user()->id,
                ]);
                toast(\Lang::get('data.addFav'), 'success');
            }

            return back();
        }
    }

    public function searchCoupons(Request $request)
    {


        $items = Item::whereRaw('LOWER(`title`) like ?', ['%' . strtolower($request['search']) . '%'])->where('offer', 'false')->orderByDesc('id')->paginate(20);
        if (count($items) == 0) {
            $items = Item::where('title->ar', 'LIKE', "%{$request->search}%")->where('offer', 'false')->orderByDesc('id')->paginate(20);
        }


        $category = \Lang::get('data.searchResults') . $request['search'];
        return view('site.allItems', compact('category', 'items'));
    }

    public function couponFilter(Request $request)
    {
        $rows = Item::where('offer', 'false');
        $category = \Lang::get('data.searchFilterResults');
        if ($request['filter']) {
            if ($request['filter'] == 'high_discount') {
                $category = \Lang::get('data.highDiscount');
                $rows->orderByDesc('discount_percent');
            }
            if ($request['filter'] == 'alpha_asc') {
                $category = \Lang::get('data.orderAZ');
                $rows->orderBy('title->' . \App::getLocale(), 'asc');
            }
            if ($request['filter'] == 'alpha_desc') {
                $category = \Lang::get('data.orderZA');

                $rows->orderBy('title->' . \App::getLocale(), 'desc');
            }
        }


        $items = $rows->paginate(20);
        return view('site.allItems', compact('category', 'items'));


    }

    public function favourites()
    {

        $items = \Auth::user()->favourite_items()->paginate(20);
        $category = \Lang::get('data.favourites');

        return view('site.allItems', compact('category', 'items'));
    }

    public function usedCoupons()
    {

        $items = \Auth::user()->used_coupons()->paginate(20);
        $category = \Lang::get('data.usedCoupons');

        return view('site.allItems', compact('category', 'items'));
    }

    public function removeUsedCoupon($item_id)
    {
        UsedCoupon::whereUserId(auth()->id())->whereItemId($item_id)->delete();
        toast(\Lang::get('data.removedUsed'), 'success');
        return back();
    }
}
