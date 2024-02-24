<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuggestCoupon;
use Illuminate\Http\Request;

class SuggestedCouponsController extends Controller
{
    public function index()
    {
        $rows = SuggestCoupon::latest()->get();
        return view('admin.suggested_coupons.index', compact('rows'));
    }

    public function destroy($id)
    {
        $slider = SuggestCoupon::find($id);
        $slider->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }
}
