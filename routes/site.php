<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\Item;
use App\Models\SeoPage;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('trim',function (){
   $items = Item::all();
   foreach ($items as $item){
       $item->discount_percent = trim($item->discount_percent,'%');
       $item->update();
   }
   dd('noe');

});
$locale = Request::segment(1);

if ($locale == Config::get('app.available_locales')) {
    \App::setLocale($locale);
} else {
    $locale = null;
}


Route::get('/language/{lang}', [HomeController::class, 'change_language_web'])->name('language')->middleware('lang');

Route::group(['prefix' => $locale, 'middleware' => 'lang'], function () {


    Route::group(['namespace' => 'Site'], function () {




        Route::get('/', [HomeController::class, 'home_one'])->name('home');
        Route::get('/brands', [HomeController::class, 'brands'])->name('brands');
        Route::get('/brands/{slug}', [HomeController::class, 'singleBrand'])->name('site.singleBrand');
        Route::get('/coupons', [HomeController::class, 'index'])->name('home_one');

        Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');

        Route::get('/coupons/{slug}', [HomeController::class, 'singleCoupon'])->name('singleCoupon');
        Route::post('authentication', [HomeController::class, 'authentication'])->name('authentication');
        Route::post('register', [HomeController::class, 'register'])->name('register');
        Route::post('firstForgetPassword', [HomeController::class, 'firstForgetPassword'])->name('firstForgetPassword');
        Route::post('checkOtp', [HomeController::class, 'checkOtp'])->name('checkOtp');
        Route::post('changeNewPassword', [HomeController::class, 'changeNewPassword'])->name('changeNewPassword');
        Route::get('showAllItems/{category_id}', [ItemsController::class, 'showAllItems'])->name('showAllItems');
        Route::get('help', [HelpController::class, 'help'])->name('help');
        Route::post('help_post', [HelpController::class, 'help_post'])->name('help_post');
        Route::post('userCoupon', [ItemsController::class, 'userCoupon'])->name('userCoupon');
        Route::get('searchCoupons', [ItemsController::class, 'searchCoupons'])->name('searchCoupons');
        Route::get('couponFilter', [ItemsController::class, 'couponFilter'])->name('couponFilter');
        Route::get('suggestCouponIndex', [SuggestCouponsController::class, 'index'])->name('suggestCouponIndex');
        Route::post('suggestCouponStore', [SuggestCouponsController::class, 'store'])->name('suggestCouponStore');
        Route::group(['middleware' => 'userAuth'], function () {
            Route::get('userLogout', [HomeController::class, 'userLogout'])->name('userLogout');
            Route::get('notifications', [NotificationsController::class, 'notifications'])->name('notifications');
            Route::get('delete_notifications', [NotificationsController::class, 'delete_notifications'])->name('delete_notifications');
            Route::get('favItem/{item_id}', [ItemsController::class, 'favItem'])->name('favItem');
            Route::get('favourites', [ItemsController::class, 'favourites'])->name('favourites');
            Route::get('usedCoupons', [ItemsController::class, 'usedCoupons'])->name('usedCoupons');
            Route::get('removeUsedCoupon/{item_id}', [ItemsController::class, 'removeUsedCoupon'])->name('removeUsedCoupon');

            // USER
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        });
        Route::post('updateProfile',[ProfileController::class,'updateProfile'])->name('updateProfile');
        Route::post('updatePassword',[ProfileController::class,'updatePassword'])->name('updatePassword');
    });

});

Route::get('command',function () {
    $data = [
        [
            'uri' => '/',
            'title'=> [
                'en'=>'Home',
                'ar'=>'الرئيسية'
            ],
            'description'=> [
                'en'=>'Home',
                'ar'=>'الرئيسية'
            ]
        ],[
            'uri' => '/brands',
            'title'=> [
                'en'=>'Brands',
                'ar'=>'التطبيقات'
            ],
            'description'=> [
                'en'=>'Brands',
                'ar'=>'التطبيقات'
            ],
            'h1_header'=> [
                'en'=>'Brands',
                'ar'=>'التطبيقات'
            ]
        ]
    ];

    foreach ($data as $value) {
        SeoPage::create($value);
    }

    Brand::whereDoesntHave('seoPage')->get()->map(function ($q) {
        $slug = $q->id . '--' .\Str::slug($q->name['en']);

        $arTitle = $q->name['ar'];
        $enTitle = $q->name['en'];

        $seoPage = new SeoPage();
        $seoPage->uri = '/brands/' . $slug;
        $seoPage->title = [
            'en' => "كود خصم $enTitle | كوبونات فعالة 100% | تطبيق قسيمة",
            'ar' => "كود خصم $arTitle | كوبونات فعالة 100% | تطبيق قسيمة",
        ];
        $seoPage->description = [
            'en' => "تطبيق قسيمة يوفر لك كود خصم $enTitle لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $enTitle",
            'ar' => "تطبيق قسيمة يوفر لك كود خصم $arTitle لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $arTitle",
        ];

        $seoPage->h1_header = [
            'ar'=> "كود خصم $arTitle",
            'en'=>"كود خصم $enTitle"
        ];
        $seoPage->model_type = Brand::class;
        $seoPage->model_id = $q->id;
        $seoPage->save();
    });

    // $items = Item::whereDoesntHave('seoPage')->get()->map(function ($q) {
    //     $slug = $q->id . '--' .\Str::slug($q->title['en']);

    //     $arTitle = $q->title['ar'];
    //     $enTitle = $q->title['en'];

    //     $seoPage = new SeoPage();
    //     $seoPage->uri = '/coupons/' . $slug;
    //     $seoPage->title = [
    //         'en' => "كود خصم $enTitle | كوبونات فعالة 100% | تطبيق قسيمة",
    //         'ar' => "كود خصم $arTitle | كوبونات فعالة 100% | تطبيق قسيمة",
    //     ];
    //     $seoPage->description = [
    //         'en' => "تطبيق قسيمة يوفر لك كود خصم اسم التطبيق لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $enTitle",
    //         'ar' => "تطبيق قسيمة يوفر لك كود خصم اسم التطبيق لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $arTitle",
    //     ];

    //     $seoPage->h1_header = [
    //         'ar'=> "كود خصم $arTitle",
    //         'en'=>"كود خصم $enTitle"
    //     ];
    //     $seoPage->model_type = Item::class;
    //     $seoPage->model_id = $q->id;
    //     $seoPage->save();
    // });

});
