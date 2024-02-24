<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Item::where('offer', 'true')->latest()->get();
        return view('admin.offers.index', compact('rows'));
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
        return view('admin.offers.create', compact('brands', 'categories'));
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
            'discount_percent' => 'required'

        ]);
        $item = new Item();
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['discount_code'] = $request['discount_code'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];
        $item['url'] = $request['url'];
        $item['discount_percent'] = $request['discount_percent'];
        $item['offer'] = 'true';
        $item->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.offers.edit', compact('row', 'brands', 'categories'));
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
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'discount_code' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'url' => 'required',
            'discount_percent' => 'required'
        ]);
        $item = Item::find($id);
        $item['brand_id'] = $request['brand_id'];
        $item['category_id'] = $request['category_id'];
        $item['discount_code'] = $request['discount_code'];
        $item['description->ar'] = $request['description_ar'];
        $item['description->en'] = $request['description_en'];
        $item['url'] = $request['url'];
        $item['discount_percent'] = $request['discount_percent'];
        $item->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }
}
