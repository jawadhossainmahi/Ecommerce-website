<?php

use App\Http\Controllers\EditController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/login', fn () => redirect('/'))->name('login')->middleware('guest');

Route::get('/testCancelMail', [App\Http\Controllers\Admin\OrderController::class, 'testCancelMail']);

//Frontend Routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('index');
Route::get('product/category', [App\Http\Controllers\Frontend\CategoryController::class, 'index'])->name('pro_cat');
Route::get('product/sub_category', [App\Http\Controllers\Frontend\CategoryController::class, 'sub_cat'])->name('frontend.sub_category');
Route::get('product/sub_cat/{sub_category}', [App\Http\Controllers\Frontend\SubCategoryController::class, 'index'])->name('frontend.sub_cat');
Route::get('product/subsub_cat/{sub_sub_category}', [App\Http\Controllers\Frontend\SubSubCategoryController::class, 'index'])->name('frontend.subsub_cat');
Route::any('/product/search', [App\Http\Controllers\Frontend\HomeController::class, 'showproduct'])->name('product.search');
Route::get('/product/show', [App\Http\Controllers\Frontend\HomeController::class, 'display_product'])->name('product.display');

Route::get('/Kontakta-oss', [App\Http\Controllers\Frontend\KontaktaOssController::class, 'index'])->name('Kontakta-oss');
Route::get('/handla-pa-livsham', [App\Http\Controllers\Frontend\HandlaPaController::class, 'index'])->name('handla-pa-livsham');


Route::post('/shopping/store', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'store'])->name('shopping.store');
Route::post('/shopping-list/show', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'show'])->name('shopping.show');
Route::get('/shopping/view/{id}/{mainId}', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'indexs'])->name('shopping.view');
Route::post('/shopping/details', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'shoppingListDetails']);
Route::get('/shopping/delete/{id}', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'shoppingListDelete'])->name('shopping.delete');

Route::post('/deliverytime', [App\Http\Controllers\Frontend\DeliveryTimeController::class, 'store'])->name('frontend.deliverytime');
Route::get('/deliverytime', [App\Http\Controllers\Frontend\DeliveryTimeController::class, 'show'])->name('frontend.deliverytimeview');

Route::get('/destroy/delivery/{id}', [App\Http\Controllers\Frontend\Api\DeliveryAddressController::class, 'deleteAddress'])->name('destroy.delivery');

Route::post('/postcode', [App\Http\Controllers\Frontend\HomeController::class, 'set_post_code_session'])->name('postcode');
Route::get('/postcode', [App\Http\Controllers\Frontend\HomeController::class, 'get_post_code_session']);
Route::get('/postcode/{userId}', [App\Http\Controllers\Frontend\HomeController::class, 'get_user_postcode_session']);


Route::get('/varor', [App\Http\Controllers\Frontend\VarorController::class, 'index'])->name('varor');



Route::get('/test',  [App\Http\Controllers\Frontend\TestController::class, 'index'])->name('test');


Route::get('/confirmation/{order_id}',  [App\Http\Controllers\Frontend\ConfirmationController::class, 'index'])->name('confirmation');


Route::get('/vanliga-fragor/{categoryId?}', [App\Http\Controllers\Frontend\FAQsController::class, 'index'])->name('faqs');
Route::get('/faqs-details/{cat_id}', [App\Http\Controllers\Frontend\FaqsCategoryController::class, 'faqs'])->name('faqs.details');


Route::get('/om-livesham', [App\Http\Controllers\Frontend\AboutUsController::class, 'index'])->name('aboutus');
Route::get('/kopvillkor', [App\Http\Controllers\Frontend\PurchaseTermsController::class, 'index'])->name('purchaseterms');
Route::get('/gdpr', [App\Http\Controllers\Frontend\GDPRController::class, 'index'])->name('gdpr');
Route::get('/Integritetspolicy', [App\Http\Controllers\Frontend\PrivacyPolicyController::class, 'index'])->name('privacypolicy');
Route::get('/cookiepolicy', [App\Http\Controllers\Frontend\CookiePolicyController::class, 'index'])->name('cookiepolicy');

Route::get('/extrapriser', [App\Http\Controllers\Frontend\ExtrapriserController::class, 'index'])->name('extrapriser');

Route::post('/validate_coupon', [App\Http\Controllers\Frontend\OrdersController::class, 'coupon'])->name('validate_coupon');

Route::get('/veckans-extrapriser', [App\Http\Controllers\Frontend\VeckansController::class, 'index'])->name('veckans-extrapriser');

Route::post('/check-cart-items', [App\Http\Controllers\Frontend\CartController::class, 'checkCartItems'])->name('check-cart-items');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('product/cart', [App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('index_cart');
    Route::get('product/cart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'store'])->name('cart');
    Route::get('product/cart/delete/{cart}', [App\Http\Controllers\Frontend\CartController::class, 'delete'])->name('delete.cart');
    Route::post('product/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('update.cart');
    Route::get('delete/all', [App\Http\Controllers\Frontend\CartController::class, 'delete_all'])->name('delete_all.cart');
    Route::get('order/email', [App\Http\Controllers\Frontend\CheckoutController::class, 'order_email'])->name('order_email');
    // return Redirect::to(url()->previous());

    Route::get("/checkout", [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->middleware('checkout')->name('checkout');
    Route::get('/klarna-payment', [App\Http\Controllers\Frontend\CheckoutController::class, 'klarna_payment'])->middleware('checkout')->name('klarna-payment');

    Route::get('/favourites', [App\Http\Controllers\Frontend\FavouritesController::class, 'index'])->name('favourites');


    Route::get('/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile');
    Route::post('/add_address', [App\Http\Controllers\Frontend\ProfileController::class, 'add_address'])->name('add_address');
    Route::post('/add_billing_address', [App\Http\Controllers\Frontend\ProfileController::class, 'add_billing_address'])->name('add_billing_address');

    Route::post('/edit_address', [App\Http\Controllers\Frontend\ProfileController::class, 'edit_address'])->name('edit_address');
    Route::get('/shopping-list', [App\Http\Controllers\Frontend\ShoppinglistController::class, 'index'])->name('shopping-list');
    Route::get('/recurring-deliveries', [App\Http\Controllers\Frontend\RecurringDeliveriesController::class, 'index'])->name('recurring-deliveries');
    Route::get('/orders', [App\Http\Controllers\Frontend\OrdersController::class, 'index'])->name('orders');
    Route::get('/orders/{order_id}', [App\Http\Controllers\Frontend\OrdersController::class, 'details'])->name('order-details');
    Route::post('/orders/recurring_delivery', [App\Http\Controllers\Frontend\OrdersController::class, 'recurring_delivery'])->name('orders.recurring_delivery');
    Route::post('/orders/message', [App\Http\Controllers\Frontend\OrdersController::class, 'message'])->name('orders.message');
    Route::post('/orders/leave_outside', [App\Http\Controllers\Frontend\OrdersController::class, 'leave_outside'])->name('orders.leave_outside');
    Route::post('/orders/recurring_delivery/remove', [App\Http\Controllers\Frontend\OrdersController::class, 'remove_recurring_delivery'])->name('orders.recurring_delivery.remove');
    Route::post('/orders/message/remove', [App\Http\Controllers\Frontend\OrdersController::class, 'remove_message'])->name('orders.message.remove');
    Route::post('/orders/leave_outside/remove', [App\Http\Controllers\Frontend\OrdersController::class, 'remove_leave_outside'])->name('orders.leave_outside.remove');

    Route::get('/bonus-and-credits', [App\Http\Controllers\Frontend\BonusAndCreditController::class, 'index'])->name('bonus-and-credits');



    Route::get('api/favourites', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'index']);

    Route::get('api/favourites/store/{id}', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'store']);

    Route::get('api/favourites/delete/{id}', [App\Http\Controllers\Frontend\Api\FavouritesController::class, 'destroy']);


    // User

    // Route::get('/user/dashboard', [App\Http\Controllers\User\ProfileController::class, 'index']);


});

// Route::any('/register', [App\Http\Controllers\HomeController::class, 'index']);

// new route for shoping list

// Route::get('shopinglist',function(){
//   return view('frontend.shopping-list');
// });

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify', fn () => view('auth.verify'))->middleware('auth')->name('verification.notice');

Route::post('/admin/message/store', [App\Http\Controllers\Frontend\MessageController::class, 'store'])->name('admin.message.store');

//Backend Routes

Route::middleware(['auth', 'verified'])->group(function () {

    // Route::get('/emailtest', [App\Http\Controllers\Frontend\ConfirmationController::class, 'emailtest'])->name('emailtest');

    require_once 'admin.php';

    Route::get('/send/reqeust/for/change/phone/{phone}', [EditController::class, 'changePhone'])->name('change.phone.number');
    Route::put('/update/phone/{id}', [EditController::class, 'updatePhone'])->name('update.phone.number');

    Route::get('/send/request/for/change/email/{email}', [EditController::class, 'changeEmail'])->name('change.email');
    Route::put('/update/email/{id}', [EditController::class, 'updateEmail'])->name('update.email');

    Route::put('/update/password/{id}', [EditController::class, 'updatePassword'])->name('update.password');
});

Route::get("/get-logged-in-user-data", function () {
    return response()->json(auth()->user());
});
