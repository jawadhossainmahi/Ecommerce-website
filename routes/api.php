<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/get-minimum_delivery-days", [App\Http\Controllers\Admin\DeliverySettingController::class, "get_minimum_delivery_days"])->name("api.admin.minimum_delivery_days");

Route::get('/products/{id?}', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'index'])->name("api.admin.products");
Route::get("/get-products-for-checkout",[App\Http\Controllers\Frontend\Api\ProductsController::class, 'get_products_for_checkout'])->name("api.admin.products");
Route::get('/admin/products', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'admin_add_product_filters'])->name("api.admin.admin_add_product_filters");
Route::get('/search/{search}', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'search']);
Route::get('/load-more-search/{offset}', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'loadmore']);

Route::get('/cart', [App\Http\Controllers\Frontend\Api\CartController::class, 'index']);

Route::get('/cart/session', [App\Http\Controllers\Frontend\Api\CartController::class, 'GetSession']);

Route::delete('/cart/destroy', [App\Http\Controllers\Frontend\Api\CartController::class, 'destroy']);

Route::post('/cart/{id}/{qty}', [App\Http\Controllers\Frontend\Api\CartController::class, 'store']);

Route::get('/cart/total', [App\Http\Controllers\Frontend\Api\CartController::class, 'GetTotal'])->name('cart-total');

Route::get('/cart/{id}', [App\Http\Controllers\Frontend\Api\CartController::class, 'GetQuantity']);

Route::post('cart/insert', [App\Http\Controllers\Frontend\Api\CartController::class, 'insert']);

Route::post('cart/update', [App\Http\Controllers\Frontend\Api\CartController::class, 'getCartData']);

Route::get('/favourites', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'index']);

Route::get('/favourites/{id}', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'store']);

Route::get('/favourites/{id}', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'destroy']);

Route::get('/load-favourites', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'favouriteLoadMore']);

Route::get('/veckans-extrapriser', [App\Http\Controllers\Frontend\Api\VeckansController::class, 'index'])->name('api.veckans_extrapriser');

Route::get('/load-veckans-extrapriser', [App\Http\Controllers\Frontend\Api\VeckansController::class, 'loadVeckansExtrapriser'])->name('api.load_veckans_extrapriser');

Route::post('/businessOrderConfirmation', [App\Http\Controllers\Frontend\ConfirmationController::class, 'businessOrderConfirmation'])->name('businessOrderConfirmation');

// Delivery Time
Route::get('/admin/deliverytime', [App\Http\Controllers\Admin\Api\DeliveryTimeController::class, 'index'])->name('api.deliverytime.index');

Route::get('/admin/deliverytime/{date}', [App\Http\Controllers\Admin\Api\DeliveryTimeController::class, 'show'])->name('api.deliverytime.show');

Route::get('/admin/deliverytime/alldeliverytimes', [App\Http\Controllers\Admin\Api\DeliveryTimeController::class, 'alldeliverytimes'])->name('api.deliverytime.alldeliverytimes');



Route::post('/products/filter', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'filter'])->name('api.products.filter');

Route::middleware('auth:sanctum')->get('/auth/home', [App\Http\Controllers\Frontend\Api\HomeController::class, 'authenticated_index'])->name('api.auth.home');
Route::get('/home', [App\Http\Controllers\Frontend\Api\HomeController::class, 'index'])->name('api.home');
Route::get('/home-extrapriser', [App\Http\Controllers\Frontend\Api\HomeController::class, 'homeExtrapriser'])->name('api.home.extrapriser');
Route::get('/load-more-products/{offset}', [App\Http\Controllers\Frontend\Api\HomeController::class, 'loadMoreProducts'])->name('api.home.more');
Route::get("/home/home-category", [App\Http\Controllers\Frontend\Api\HomeController::class, 'load_offer_product_by_discount'])->name("api.home.category");
Route::get("/home/load-more-discount-product/{offset}", [App\Http\Controllers\Frontend\Api\HomeController::class, "load_more_home_product_by_category_and_discount"])->name("api.home.load_more_category_discount_product");
Route::get('/category/{category_id}', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'index'])->name('api.category');
Route::get('/sub_category/{sub_category_id}', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'sub'])->name('api.sub_category');
Route::get('/subsub_category/{subsub_category_id}', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'subsub'])->name('api.subsub_category');
// Route::get('/search', [App\Http\Controllers\Frontend\Api\SearchController::class, 'index'])->name('api.search');
// Route::get('/load-more-search', [App\Http\Controllers\Frontend\Api\SearchController::class, 'loadmore'])->name('api.load.more.search');
Route::get('/offer', [App\Http\Controllers\Frontend\Api\OfferController::class, 'index'])->name('api.offer');
Route::get('/load-more-category', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'LoadMoreCategory'])->name('api.load.more.category');
Route::get('/load-more-sub', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'LoadMoreSub'])->name('api.load.more.sub');
Route::get('/load-more-subsub', [App\Http\Controllers\Frontend\Api\CategoryController::class, 'LoadMoreSubSub'])->name('api.load.more.subsub');
Route::get('/load-home-extrapriser', [App\Http\Controllers\Frontend\Api\OfferController::class, 'loadhomeExtrapriser'])->name('api.load.home.extrapriser');
Route::get("/get_category_by_id", [App\Http\Controllers\Frontend\Api\HomeController::class, "get_category_data"]);

Route::post('/delivery_address/{main_id}/{id}', [App\Http\Controllers\Frontend\Api\DeliveryAddressController::class, 'index'])->name('api.delivery_address');
Route::get('/get_delivery_address/{main_id}/{id}', [App\Http\Controllers\Frontend\Api\DeliveryAddressController::class, 'get_address'])->name('api.get_delivery_address');
Route::get('/get_delivery_address/{main_id}', [App\Http\Controllers\Frontend\Api\DeliveryAddressController::class, 'get_default_address'])->name('api.get_default_delivery_address');

Route::get('/get_billing_address/{main_id}/{id}', [App\Http\Controllers\Frontend\Api\BillingAddressController::class, 'get_address'])->name('api.get_billing_address');
Route::get('/get_billing_address/{main_id}', [App\Http\Controllers\Frontend\Api\BillingAddressController::class, 'get_default_address'])->name('api.get_default_billing_address');
Route::post('/billing_address/{main_id}/{id}', [App\Http\Controllers\Frontend\Api\BillingAddressController::class, 'store'])->name('api.billing_address');
Route::post('/same_billing_address', [App\Http\Controllers\Frontend\Api\BillingAddressController::class, 'same_billing_address'])->name('api.same_billing_address');

Route::post('order/{order_id}', [App\Http\Controllers\Frontend\Api\CartController::class, 'getOrderItemsToCart']);
Route::delete('order/delete/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'cancel']);


Route::post('shoppingcart/{shopping_list_id}', [App\Http\Controllers\Frontend\Api\CartController::class, 'getShoppingListItemsToCart']);

// DashboardController
Route::get('/dashboard/orders/{interval}/{status?}/{get_total?}', [App\Http\Controllers\Admin\Api\DashboardController::class, 'ordersIntervalStatus'])->where(['interval' => '(?i)(year|month|day)'])->where(['status' => '[0-2]|(?i)null'])->where(['get_total' => '(?i)(true|false)']);
Route::get('/dashboard/customers/{interval}', [App\Http\Controllers\Admin\Api\DashboardController::class, 'customersInterval'])->where(['interval' => '(?i)(year|month|day)']);


Route::get('/batch/progress/{batchId}', [App\Http\Controllers\Admin\Api\BatchController::class, 'getBatchProgress'])->name('batch.progress');

Route::post('/popularity/point-add', [App\Http\Controllers\Frontend\Api\ProductsController::class, 'popularity_point_add'])->name('popularity_point_add');
Route::get("/find/postcode/{postcode}", [App\Http\Controllers\Admin\PostcodeController::class, 'find_postcode'])->name("api.find.postcode");
Route::get("/get-session-data/{name}", [App\Http\Controllers\Frontend\Api\HomeController::class, "get_session_data_as_json"])->name("api.get_session_data_by_name");

