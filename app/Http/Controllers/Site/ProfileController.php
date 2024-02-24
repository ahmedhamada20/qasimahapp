<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('site.user.profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        User::whereId(auth()->id())->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
        toast(\Lang::get('data.updatedSuccess'), 'success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        ]);
        if ($validator->passes()) {
            $user = \Auth::user();
            if (\Hash::check($request['old_password'], $user->password)) {
                $user->password = bcrypt($request['new_password']);
                $user->update();
                toast(\Lang::get('data.updatedSuccess'), 'success');
            } else {

                Alert::error(\Lang::get('data.password_not_match'));
            }
        } else {
            Alert::error($validator->errors()->first());
        }
        return redirect()->back();

    }
}
