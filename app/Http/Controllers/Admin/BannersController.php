<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Item;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Banner::latest()->get();
        return view('admin.banners.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ads = \DB::table('items')->where('show',1)->select([
            'id',
            'title',
        ])->get();
        return view('admin.banners.create',compact('ads'));
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
            'image' => 'required|image',
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $slider = new Banner();
        if ($request->hasFile('image')) {
            $slider->setImageAttribute();
        }
        $slider['name->ar'] = $request['name_ar'] ?? null;
        $slider['name->en'] = $request['name_en'] ?? null;
        $slider['notes->ar'] = $request['notes_ar'] ?? null;
        $slider['notes->en'] = $request['notes_en'] ?? null;
        $slider['url'] = $request['url'] ?? null;
        $slider['item_id'] = $request['item_id'] ?? null;
        $slider['status'] = 'active';
        $slider->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('banners.index');
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
        $row = Banner::find($id);
        $ads = \DB::table('items')->where('show',1)->select([
            'id',
            'title',
        ])->get();
        return view('admin.banners.edit', compact('row','ads'));
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


            'image' => 'nullable|image'
        ]);
        $slider = Banner::find($id);
        if ($request->hasFile('image')) {
            $slider->setImageAttribute();
        }
        $slider['name->ar'] = $request['name_ar'] ?? null;
        $slider['name->en'] = $request['name_en'] ?? null;
        $slider['notes->ar'] = $request['notes_ar'] ?? null;
        $slider['notes->en'] = $request['notes_en'] ?? null;
        $slider['url'] = $request['url'] ?? null;
        $slider['item_id'] = $request['item_id'] ?? null;
        $slider->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Banner::find($id);
        $slider->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }

    public function status_banner(Request $request)
    {

        $status = $request->input('status');
        $yourModel = Banner::find($request->id);
        $yourModel->status = $status;
        $yourModel->save();
        return response()->json(['message' => 'تم تحديث الحالة بنجاح']);
    }
}
