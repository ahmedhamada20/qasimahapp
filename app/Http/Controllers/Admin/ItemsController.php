<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemThumb;
use App\Models\SubItems;
use DB;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $rows = Item::orderBy('id', 'DESC')->where('offer', 'false')->latest()->get();
        $rows = Item::where('items.offer', 'false')
            ->orderBy('items.sort_order', 'ASC')
            ->when($request->show != null, function ($q) use ($request) {
                $q->where('items.show', $request->show);
            })
            ->get();

        return view('admin.items.index', compact('rows'));
    }


    function changeShow(Request $request, $id)
    {

        $item = Item::find($id);

        $item->show = $request->show;
        $item->update();
        SubItems::where('item_id',$id)->update([
            'show' => $request->show
        ]);
        return response()->json(['status' => true]);
    }

    function changeShowSub(Request $request, $id)
    {

        $item = SubItems::find($id);
        $item->show = $request->show;
        $item->update();
        return response()->json(['status' => true]);
    }
    public function changeShowPost(Request $request)
    {

        if (isset($request->SubItems)) {
            $rows = Item::whereHas('subItems')->where('show',$request->show)->get();
            return view('admin.items.index', compact('rows'));
        }


        $rows = Item::where('show', $request->show)->get();
        return view('admin.items.index', compact('rows'));
    }

    public function index2(Request $request)
    {

        $data = DB::select('select items.id from `items` inner join `item_thumbs` on `item_thumbs`.`item_id` = `items`.`id` where `items`.`offer` = "false" and exists (select * from `item_thumbs` where `items`.`id` = `item_thumbs`.`item_id`) group by `items`.`id` order by COUNT(item_thumbs.down);');

        $data = collect($data)->pluck('id');

        $rows = Item::where('items.offer', 'false')->with(['thumbs.user'])
            ->whereHas('thumbs', fn($q) => $q->where('down', 1))
            ->whereIn('items.id', $data)->get();

        $rows = $rows->sortByDesc(fn($q) => $q->thumbs->max('created_at'));

        return view('admin.items.index2', compact('rows'));
    }

    function singleItemWithThumb($id)
    {
        $item = Item::with('thumbs')->find($id);

        return [
            'id' => $item->id,
            'discount_code' => $item->discount_code,
            'thumbs' => $item->thumbs->load('user')->where('down', 1)->map(function ($q) {
                $q['date'] = \Carbon\Carbon::parse($q['created_at'])->format('Y-m-d h:i A');
                return $q;
            })->values()->toArray(),
        ];
    }

    function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        ItemThumb::whereIn('item_id', $ids)->delete();

        return response()->json(['status' => true]);
    }

    function deleteThumb($id, $all = null)
    {
        if ($all == NULL) {

            $thumb = ItemThumb::findOrFail($id);

            $data = $thumb->item;

        } else {

            $thumb = ItemThumb::whereItemId($id);
            $data = Item::find($id);
        }

        $thumb->delete();

        $data['thumbs'] = $data->thumbs()->where('down', 1)->get()->map(function ($q) {
            $q['date'] = \Carbon\Carbon::parse($q['created_at'])->format('Y-m-d h:i A');
            return $q;
        });

        return response()->json($data);
    }


    public function changeShowPostSub(Request $request)
    {

        $data = Item::findorfail($request->id);

        $rows = SubItems::where('item_id',$request->id)->where('show', $request->show)->get();

        return view('admin.items.allSub', compact('data','rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.items.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'discount_code' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'url' => 'required',
            'discount_percent' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'sort_order' => 'integer',
//            'store_affiliate'=>'required'

        ]);
        $item = new Item();
        if ($request->hasFile('image')) {
            $item->setImageAttribute();
        }
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['discount_code'] = $request['discount_code'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];
        $item['url'] = $request['url'];
        $item['discount_percent'] = $request['discount_percent'];
        $item['store_affiliate'] = $request['store_affiliate'] ?? null;
        $item['offer'] = 'false';
        $item['title->ar'] = $request['title_ar'];
        $item['title->en'] = $request['title_en'];
        $item['sort_order'] = $request['sort_order'];
        $item['alert->ar'] = $request['alert_ar'];
        $item['alert->en'] = $request['alert_en'];
        $item['advice->ar'] = $request['advice_ar'];
        $item['advice->en'] = $request['advice_en'];

        $item['high_light->ar'] = $request['high_light_ar'];
        $item['high_light->en'] = $request['high_light_en'];
        $item->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Item::findorfail($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.items.subItems', compact('row', 'brands', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $row = Item::find($id);
        return view('admin.items.edit', compact('row', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $is_oreder_changed = false;
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'discount_code' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'url' => 'required',
            'discount_percent' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'sort_order' => 'integer',
//            'store_affiliate'=>'required',
        ]);
        $item = Item::find($id);
        if ($request->hasFile('image')) {
            $item->setImageAttribute();
        }
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['discount_code'] = $request['discount_code'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];
        $item['title->ar'] = $request['title_ar'];
        $item['title->en'] = $request['title_en'];
        $item['store_affiliate'] = $request['store_affiliate'] ?? null;
        $item['url'] = $request['url'];
        $item['discount_percent'] = $request['discount_percent'];
        $item['alert->ar'] = $request['alert_ar'];
        $item['alert->en'] = $request['alert_en'];
        $item['advice->ar'] = $request['advice_ar'];
        $item['advice->en'] = $request['advice_en'];
        $item['high_light->ar'] = $request['high_light_ar'];
        $item['high_light->en'] = $request['high_light_en'];
        if ($item['sort_order'] != $request['sort_order']) {
            $is_oreder_changed = true;
        }

        $item['sort_order'] = $request['sort_order'];


        $item->update();


        if ($is_oreder_changed) {
            $this->updateSortOrder($id, $request['sort_order'], Item::all());
        }

        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('items.index');
    }

    public function updateSortOrder(int $idChangedRecord, int $newOrder, $records)
    {
        $isNext = false;

        // Change records with the same order
        $records_has_same_order = $records->where('sort_order', $newOrder);
        $records_has_same_order->each(function ($record) use ($idChangedRecord) {
            if ($record->id != $idChangedRecord) {
                $record->update(['sort_order' => 999]);
            }
        });

        // Sort and start looping
        $records = $records->sortBy('sort_order');
        foreach ($records as $key => $record) {
            if ($isNext) {
                $record->update(['sort_order' => $newOrder += 1]);
            }

            // Check if we get the wanted element and start ordering
            if ($record->sort_order == $newOrder && $record->id == $idChangedRecord) {
                $isNext = true;
            }
        }
    }






    // public function updateSortOrder(int $idChangedRecord, int $newOrder, $model)
    // {
    //     $isNext = false;
    //     // change who has same order !!
    //     $records_has_same_order = $model->where('sort_order', $newOrder);
    //     $records_has_same_order->map(function ($record) use ($idChangedRecord) {
    //         if ($record->id != $idChangedRecord) {
    //             $record->sort_order = 999;
    //             $record->save();
    //         }
    //     });
    //     //sort and start looping
    //     $records = Item::all()->sortBy('sort_order');
    //     foreach ($records as $key => $record) {
    //         if ($isNext) {
    //             $record->sort_order = $newOrder += 1;
    //             $record->save();
    //         }
    //         //check if we get wanted element and start ordering
    //         if ($record->sort_order == $newOrder && $record->id == $idChangedRecord ) {
    //             $isNext = true;
    //         }
    //     }
    // }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }


    public function createSubItems(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'discount_code' => 'required',
            'url' => 'required',
            'discount_percent' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'sort_order' => 'integer',
//            'store_affiliate'=>'required'
        ]);
        $item = new SubItems();
        $item['item_id'] = $request['item_id'];
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['discount_code'] = $request['discount_code'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];
        $item['url'] = $request['url'];
        $item['discount_percent'] = $request['discount_percent'];
        $item['offer'] = 'false';
        $item['title->ar'] = $request['title_ar'];
        $item['title->en'] = $request['title_en'];
        $item['alert->ar'] = $request['alert_ar'];
        $item['alert->en'] = $request['alert_en'];
        $item['advice->ar'] = $request['advice_ar'];
        $item['advice->en'] = $request['advice_en'];
        $item->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('items.index');
    }


    public function getSubItem($id)
    {
        $rows = SubItems::where('item_id',$id)->orderBy('id', 'DESC')->get();
        $data = Item::findorfail($id);
        return view('admin.items.allSub', compact('rows', 'data'));
    }

    public function editSub($id)
    {
        $row = SubItems::findorfail($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.items.editSub', compact('row', 'brands', 'categories'));
    }

    public function destroySub(Request $request)
    {
        $item = SubItems::find($request->id);
        $item->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }


    public function postEditSubitem(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'discount_code' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'url' => 'required',
            'discount_percent' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
            'sort_order' => 'integer',
//            'store_affiliate'=>'required',
        ]);
        $item = SubItems::find($request->id);

        $item['title->ar'] = $request['title_ar'];
        $item['title->en'] = $request['title_en'];
        $item['discount_code'] = $request['discount_code'];
        $item['show'] = $request['show'];
        $item['discount_percent'] = $request['discount_percent'];
        $item['url'] = $request['url'];
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];

        $item['alert->ar'] = $request['alert_ar'];
        $item['alert->en'] = $request['alert_en'];
        $item['advice->ar'] = $request['advice_ar'];
        $item['advice->en'] = $request['advice_en'];


        $item->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('items.index');
    }
}
