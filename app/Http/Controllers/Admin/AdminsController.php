<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewAccountsPassword;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Admin::orderByDesc('id')->get();
        return view('admin.admin.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:6',
        ]);
        $admin = new Admin();
        $admin['email'] = $request['email'];
        $admin['name'] = $request['name'];
        $admin['password'] = bcrypt($request['password']);
        $admin->save();
        toast('تمت العملية بنجاح', 'success', 'left');

        return redirect()->route('admins.index');

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
        $row = Admin::find($id);
        return view('admin.admin.edit', compact('row'));
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
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'password' => 'nullable|min:6'
        ]);
        $admin = Admin::find($id);
        $admin['email'] = $request['email'];
        $admin['name'] = $request['name'];
        if ($request['password']) $admin['password'] = bcrypt($request['password']);

        $admin->update();
        toast('تمت العملية بنجاح', 'success', 'left');

        return redirect()->route('admins.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        toast('تمت العملية بنجاح', 'success', 'left');

        return redirect()->back();
    }
}
