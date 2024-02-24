<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Help;
use Illuminate\Http\Request;

class HelpsController extends Controller
{
    public function index()
    {
        $rows = Help::latest()->get();
        return view('admin.helps.index', compact('rows'));
    }

    public function destroy($id)
    {
        $slider = Help::find($id);
        $slider->delete();
        toast('تمت العملية بنجاح', 'success', 'left');
        return back();
    }
}
