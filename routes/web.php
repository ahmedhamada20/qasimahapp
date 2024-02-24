<?php

use App\Http\Controllers\Admin\ItemsController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
     Artisan::call('cache:clear');
    return "asdsad";
});


Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});


Route::get('/changePercent',function (){
foreach (\App\Models\Item::all() as $item)
{
    $item->discount_percent = $item->discount_percent .' %';
    $item->update();
}
    dd('done');
});
Route::group(['namespace' => 'Admin'], function () {

    Route::get('/admin_login', 'HomeController@login')->name('admin_login');
    Route::post('authenticate', 'HomeController@authenticate')->name('authenticate');

    Route::group(['middleware' => 'admin:admin', 'prefix' => 'admin'], function () {
        Route::get('/', 'HomeController@index')->name('admin');
        Route::get('admin_logout', 'HomeController@admin_logout')->name('admin_logout');

        Route::get('coupon-status',[ItemsController::class,'index2']);

        Route::resources([
            'admins' => 'AdminsController',
            'users' => 'UsersController',
            'brands' => 'BrandsController',
            'settings' => 'SettingsController',
            'categories' => 'CategoriesController',
            'offers_sliders' => 'OffersSlidersController',
            'suggested_coupons' => 'SuggestedCouponsController',
            'helps' => 'HelpsController',
            'notifications' => 'NotificationsController',
            'items' => 'ItemsController',
            'offers' => 'OffersController',
            'sliders'=>'SlidersController',
            'banners'=>'BannersController',
            'seo-pages'=> 'SeoPageController',
            'errorApi'=> 'ErrorApiController',

        ]);


        Route::post('destroySub','ItemsController@destroySub')->name('destroySub');
        Route::get('editSub/{id}','ItemsController@editSub')->name('editSub');
        Route::post('status_banner','BannersController@status_banner')->name('status_banner');
        Route::post('change-item-show/{id}','ItemsController@changeShow');
        Route::post('change-item-show-sub/{id}','ItemsController@changeShowSub');
        Route::post('change-show-sub','ItemsController@changeShowPostSub')->name('changeShowPostSub');
        Route::post('change-show','ItemsController@changeShowPost')->name('changeShowPost');
        Route::post('post-edit-sub-item','ItemsController@postEditSubitem')->name('post-edit-sub-item');
        Route::get('items/getSubItem/{id}','ItemsController@getSubItem')->name('getSubItems');
        Route::post('createSubItems','ItemsController@createSubItems')->name('createSubItems');
        Route::get('delete-item-thumb/{id}/{all?}','ItemsController@deleteThumb');
        Route::post('delete-selected','ItemsController@deleteSelected');
        Route::get('get-item/{id}','ItemsController@singleItemWithThumb');

        Route::get('delete-category-image/{id}','CategoriesController@deleteImage');
    });

});

// Route::Get('itemFix',function () {
//     $items = file_get_contents(base_path('items.json'));
//     $items = json_decode($items,true);

//     foreach ($items as $item) {
//         $itemObj = Item::find($item['id']);
//         $itemObj->used_count = $item['used_count'];
//         $itemObj->update();
//     }
// });
