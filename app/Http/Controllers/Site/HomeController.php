<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\SeoPage;
use App\Models\Slider;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function change_language_web($lang)
    {

        if ($lang == 'en' || $lang == 'ar') {
            if (!\Session::has('language')) {
                \Session::put('language', $lang);
            } else {
                \Session::put('language', $lang);
            }

            //  to get ar or en from url of change lang
            $lang = substr(\Request::path(), 9);
            // if ar replace en and put previous url
            if ($lang == "ar") {
                return redirect()->to(str_replace(url('/en'), '', url()->previous()));
            } else {
                return redirect()->to($lang . str_replace(url('/'), '', url()->previous()));
            }

        } else {
            return redirect('/');
        }
    }

   public function home_one()
    {
        return view('site_v2.home');
    }



    public function index(Request $request)
    {

        $sliders = Slider::all();

        // $categories = Category::orderByDesc('id')->get();
        // $items = Item::orderByDesc('id')->whereOffer('false')->take(9)->get();

         $categories = Category::orderBy('sort_order', 'ASC')->get();
        $items = Item::orderBy('sort_order', 'ASC')->with('brand.seoPage')->whereOffer('false')->get();


        $offersCoupon = Item::orderByDesc('id')->whereOffer('true')->take(9)->get();

        // return view('site.index', get_defined_vars());
        return view('site_v2.coupons', get_defined_vars());
    }

    function privacy() {
        return view('site_v2.privacy');
    }

    function brands() {
        // $sliders = Slider::all();

        $brands = Brand::all();

        return view('site.brands', get_defined_vars());
    }

    public function singleBrand($slug)
    {
        $sliders = Slider::all();

        $seoPage = SeoPage::where('uri','LIKE',"%$slug%")->first();

        if(!$seoPage){
            toast(\Lang::get('data.notFound'), 'error');
            return redirect('/coupons');
        }

        $coupons = Item::orderBy('sort_order', 'ASC')->where('brand_id',$seoPage->model_id)->whereOffer('false')->take(9)->get();

        // return view('site.singleBrand', get_defined_vars());
        return view('site_v2.singleBrand', get_defined_vars());
    }


    function singleCoupon($slug) {

        $seoPage = SeoPage::where('uri','LIKE',"%$slug%")->first();

        $item = $seoPage->model;

        if(!$item){
            toast(\Lang::get('data.notFound'), 'error');
            return back();
        }

        return view('site.singleCoupon', compact('item'));
    }

    public function authentication(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (\Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

            toast(\Lang::get('data.welcomeSite'), 'success');
            return back();

        } else {
            Alert::error(\Lang::get('data.dataLoginError'));
            return back();
        }
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|min:6|max:191|unique:users,email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user['name'] = $request['name'];
            $user['email'] = $request['email'];
            $user['password'] = bcrypt($request['password']);
            $user->save();

            \Auth::login($user);

            toast(\Lang::get('data.welcomeSite'), 'success');
            return back();

        } else {
            Alert::error("  {$validator->errors()->first()} ");
            return redirect()->back();
        }
    }

    public function firstForgetPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:users,email|email'
        ]);
        if ($validator->passes()) {
            $user = User::whereEmail($request['email'])->first();
            $code = rand(1111, 9999);
            $user->code = $code;
            $user->update();
            \Mail::to($request['email'])->send(new ForgetPassword($code));

            session()->put('user', $user);
            return response()->json(['value' => true, 'data' => \Lang::get('data.verificationSent')]);


        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }

    public function checkOtp(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->passes()) {

            $user = session()->get('user');
            if ($user->code == $request['code']) {

                $user->code = null;
                $user->update();
                return response()->json(['value' => true, 'data' => \Lang::get('data.codeCorrect')]);
            } else {
                return response()->json(['value' => false, 'msg' =>\Lang::get('data.codeWrong')]);
            }


        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }

    public function changeNewPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'new_password' => 'required|min:6|max:191|confirmed',
            'new_password_confirmation' => 'required|min:6|max:191',
        ]);
        if ($validator->passes()) {
            $user = session()->get('user');
            $user->password = bcrypt($request['new_password']);
            $user->update();
            return response()->json(['value' => true, 'data' => \Lang::get('data.Password Changed')]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);

        }
    }

    public function userLogout()
    {
        \Auth::logout();
        toast(\Lang::get('data.loggedOut'), 'success');
        return redirect()->route('home');
    }
}
