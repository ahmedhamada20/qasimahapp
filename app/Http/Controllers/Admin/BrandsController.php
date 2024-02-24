<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Mark;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Brand::all();
        return  view('admin.brands.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'image'=>'image|required',
        ]);
        $brand = new Brand();
        $brand['name->ar'] = $request['name_ar'];
        $brand['name->en'] = $request['name_en'];
        if ($request->hasFile('image')) $brand->setImageAttribute();
        $brand->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return  redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Brand::find($id);
        return  view('admin.brands.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'image'=>'nullable|image'
        ]);
        $brand = Brand::find($id);
        $brand['name->ar'] = $request['name_ar'];
        $brand['name->en'] = $request['name_en'];
        if ($request->hasFile('image')) $brand->setImageAttribute();

        $brand->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return  redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        toast('تمت العملية بنجاح', 'success', 'left');
        return  redirect()->route('brands.index');
    }
}
