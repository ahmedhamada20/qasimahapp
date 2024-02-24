<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Category::latest()->get();
        //  $rows = Category::orderBy('sort_order', 'ASC')->get();
        return view('admin.categories.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name_ar' => 'required',
            'name_en' => 'required',
             'sort_order' => 'integer',

        ]);
        $category = new Category();
        $category['name->ar'] = $request['name_ar'];
        $category['name->en'] = $request['name_en'];
         $category['sort_order'] = $request['sort_order'];
          if (isset($request->photo)) {
                $imageName = time() . '.' . $request->photo->extension();
                $request->photo->move('dash/category/', $imageName);
                $category->photo = $imageName;
            }
        $category->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('categories.index');
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
        $row = Category::find($id);
        return view('admin.categories.edit', compact('row'));
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
            'name_ar' => 'required',
            'name_en' => 'required',
             'sort_order' => 'integer',
        ]);
        $category = Category::find($id);
        $category['name->ar'] = $request['name_ar'];
        $category['name->en'] = $request['name_en'];
         $category['sort_order'] = $request['sort_order'];
           if (isset($request->photo)) {
                $imageName = time() . '.' . $request->photo->extension();
                $request->photo->move('dash/category/', $imageName);
                $category->photo = $imageName;
            }
        $category->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }

    function deleteImage($id) {
        $category = Category::find($id);
        $category->photo = null;
        $category->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }
}
