<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoPage;
use Illuminate\Http\Request;

class SeoPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = SeoPage::with('model')->get();
        return view('admin.seo-pages.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seo-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'uri'=>'required|unique:seo_pages',
            'ar_title'=>'required',
            'en_title'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
            'en_h1_header'=>'required',
            'ar_h1_header'=>'required',
            'en_editor_section'=>'nullable',
            'ar_editor_section'=>'nullable',
            // 'banner'=>'required|mimes:png,jpeg,jpg,webp'
        ]);

        SeoPage::create([
            'uri' => $request->uri,
            'model_type' => $request->model_type,
            'model_id' => $request->model_id,
            'title' => ['ar'=>$request->ar_title,'en'=>$request->en_title],
            'description' => ['ar'=>$request->ar_description,'en'=>$request->en_description],
            'h1_header' => ['ar'=>$request->ar_h1_header,'en'=>$request->en_h1_header],
            'editor_section' => ['ar'=>$request->ar_editor_section,'en'=>$request->en_editor_section],
            'banner'=> $request->banner
        ]);

        toast('تمت العملية بنجاح', 'success', 'left');

        return redirect()->route('seo-pages.index');
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
        $row = SeoPage::find($id);
        return view('admin.seo-pages.edit', compact('row'));
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
        $request->validate([
            'uri'=>'required|unique:seo_pages,uri,'.$id,
            'ar_title'=>'required',
            'en_title'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
            'en_h1_header'=>'required',
            'ar_h1_header'=>'required',
            'en_editor_section'=>'nullable',
            'ar_editor_section'=>'nullable',
            'banner'=>'nullable|mimes:png,jpeg,jpg,webp'
        ]);

        $row = SeoPage::findOrFail($id);

        $row->update([
            'uri' => $request->uri,
            // 'model_type' => $request->model_type,
            // 'model_id' => $request->model_id,
            'title' => ['ar'=>$request->ar_title,'en'=>$request->en_title],
            'description' => ['ar'=>$request->ar_description,'en'=>$request->en_description],
            'h1_header' => ['ar'=>$request->ar_h1_header,'en'=>$request->en_h1_header],
            'editor_section' => ['ar'=>$request->ar_editor_section,'en'=>$request->en_editor_section],
            'banner'=> $request->banner
        ]);

        toast('تمت العملية بنجاح', 'success', 'left');

        return redirect()->route('seo-pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = SeoPage::find($id);
        $slider->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }
}
