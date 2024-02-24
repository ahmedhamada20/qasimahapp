<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferSlider;
use Illuminate\Http\Request;

class OffersSlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = OfferSlider::all();
        return view('admin.offers_sliders.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers_sliders.create');
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
            'discount_code' => 'required',
            'image' => 'image|required',
        ]);
        $offer_slider = new OfferSlider();
        $offer_slider['discount_code'] = $request['discount_code'];
        if ($request->hasFile('image')) $offer_slider->setImageAttribute();
        $offer_slider->save();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('offers_sliders.index');
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
        $row = OfferSlider::find($id);
        return view('admin.offers_sliders.edit', compact('row'));
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
            'discount_code' => 'required',
            'image' => 'nullable|image'
        ]);
        $offer_slider = OfferSlider::find($id);
        $offer_slider['discount_code'] = $request['discount_code'];
        if ($request->hasFile('image')) $offer_slider->setImageAttribute();

        $offer_slider->update();
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('offers_sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OfferSlider::destroy($id);
        toast('تمت العملية بنجاح', 'success', 'left');
        return redirect()->route('offers_sliders.index');
    }
}


