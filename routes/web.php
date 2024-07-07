<?php

use Illuminate\Support\Facades\Auth;
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




Auth::routes();
Route::get('/login', function () {
  return redirect('/');
  // return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/testCancelMail', [App\Http\Controllers\Admin\OrderController::class, 'testCancelMail']);


//Frontend Routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('index');
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


Route::post('/postcode', [App\Http\Controllers\Frontend\HomeController::class, 'set_post_code_session'])->name('postcode');
Route::get('/postcode', [App\Http\Controllers\Frontend\HomeController::class, 'get_post_code_session']);
Route::get('/postcode/{userId}', [App\Http\Controllers\Frontend\HomeController::class, 'get_user_postcode_session']);


// create new postnumber
Route::post("/admin/postnumber/store", [App\Http\Controllers\Admin\PostNumberController::class, 'store'])->name('postnumber.store');


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


  // //   User

  //   Route::get('/user/dashboard', [App\Http\Controllers\User\ProfileController::class, 'index']);


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

Route::get('/email/verify', function () {
  return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('/admin/message/store', [App\Http\Controllers\Frontend\MessageController::class, 'store'])->name('admin.message.store');

//Backend Routes

Route::middleware(['auth', 'verified'])->group(function () {

  // Route::get('/emailtest', [App\Http\Controllers\Frontend\ConfirmationController::class, 'emailtest'])->name('emailtest');


  Route::group(['middleware' => 'is_admin'], function () {

    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Category Links 
    Route::get('/admin/category/index', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/update/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/admin/category/destroy/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');

    //Ajax Links
    Route::get('/ajax/category', [App\Http\Controllers\Admin\ProductController::class, 'category'])->name('ajax.category');
    Route::get('/ajax/subcategory', [App\Http\Controllers\Admin\ProductController::class, 'sub_category'])->name('ajax.subcategory');
    //Sub-Category
    Route::get('/admin/subcategory/index', [App\Http\Controllers\Admin\SubCategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('/admin/subcategory/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('/admin/subcategory/store', [App\Http\Controllers\Admin\SubCategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/admin/subcategory/edit/{subCategory}', [App\Http\Controllers\Admin\SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('/admin/subcategory/update/{subCategory}', [App\Http\Controllers\Admin\SubCategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::get('/admin/subcategory/destroy/{subCategory}', [App\Http\Controllers\Admin\SubCategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    // 
    // FAQs Route

    Route::get('/admin/FAQs/index', [App\Http\Controllers\Admin\FAQsController::class, 'index'])->name('admin.faqs.index');
    // Route::get('/admin/FAQs/select',[App\Http\Controllers\Admin\FaqsCategoryController::class,'select'])->name('admin.faqs.select');
    //  Route::post('/admin/FAQs/insert',[App\Http\Controllers\Admin\FaqsCategoryController::class,'select'])->name('admin.faqs.insert');
    //  Fqas categorys
    Route::get('admin/FAQs/category/{id}', [App\Http\Controllers\Admin\FAQsController::class, 'singleid'])->name('admin.faqs.category');
    Route::get('/admin/FAQs/catselect', [App\Http\Controllers\Admin\FaqsCategoryController::class, 'select'])->name('admin.faqs.catselect');
    Route::POST('/addmin/FQAs/insert', [App\Http\Controllers\Admin\FAQsController::class, 'insert'])->name('admin.faqs.insert');
    Route::get('admin/FAQs/edit/{id}', [App\Http\Controllers\Admin\FAQsController::class, 'edit'])->name('admin.faqs.edit');
    Route::get('/admin/FAQs/delete/{id}', [App\Http\Controllers\Admin\FAQsController::class, 'delete'])->name('admin.faqs.delete');
    Route::post('admin/FAQs/update/{id}', [App\Http\Controllers\Admin\FAQsController::class, 'update'])->name('admin.faqs.update');
    //   category route
    Route::get('admin/FAQs/catedit/{id}', [App\Http\Controllers\Admin\FaqsCategoryController::class, 'edit'])->name('admin.faqs.catedit');
    Route::get('/admin/FAQs/catdelete/{id}', [App\Http\Controllers\Admin\FaqsCategoryController::class, 'delete'])->name('admin.faqs.catdelete');
    Route::post('admin/FAQs/catupdate/{id}', [App\Http\Controllers\Admin\FaqsCategoryController::class, 'update'])->name('admin.faqs.catupdate');
    Route::post('admin/FAQs/insert', [App\Http\Controllers\Admin\FaqsCategoryController::class, 'insert'])->name('admin.faqs.insert');



    // Post Code 
    // all delete
    Route::DELETE("/admin/postnummer/alldelete", [App\Http\Controllers\Admin\PostcodeController::class, 'bulks']);
    Route::POST("/admin/postnummer/upload", [App\Http\Controllers\Admin\PostcodeController::class, 'bulk_upload'])->name('upload.postcode');

    Route::get("/admin/postnumber/index", [App\Http\Controllers\Admin\PostNumberController::class, 'index'])->name('admin.postnumber.index');
    Route::get("/admin/postnumber/destroy/{id}", [App\Http\Controllers\Admin\PostNumberController::class, 'destroy'])->name('admin.postnumber.destroy');
    Route::DELETE("/admin/postnummer/delete", [App\Http\Controllers\Admin\PostNumberController::class, 'alldestroy']);


    Route::get('/admin/postnummer/index', [App\Http\Controllers\Admin\PostcodeController::class, 'index'])->name('admin.postcode.index');
    Route::get('/admin/postnummer/create', [App\Http\Controllers\Admin\PostcodeController::class, 'create'])->name('admin.postcode.create');
    Route::post('/admin/postnummer/store', [App\Http\Controllers\Admin\PostcodeController::class, 'store'])->name('admin.postcode.store');
    Route::get('/admin/postnummer/edit/{postcode}', [App\Http\Controllers\Admin\PostcodeController::class, 'edit'])->name('admin.postcode.edit');
    Route::post('/admin/postnummer/update/{postcode}', [App\Http\Controllers\Admin\PostcodeController::class, 'update'])->name('admin.postcode.update');
    Route::get('/admin/postnummer/destroy/{postcode}', [App\Http\Controllers\Admin\PostcodeController::class, 'destroy'])->name('admin.postcode.destroy');

    //Sub-Sub-Category
    Route::get('/admin/subsubcategory/index', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'index'])->name('admin.subsubcat.index');
    Route::get('/admin/subsubcategory/create', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'create'])->name('admin.subsubcat.create');
    Route::post('/admin/subsubcategory/store', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'store'])->name('admin.subsubcat.store');
    Route::get('/admin/subsubcategory/edit/{subsubcat}', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'edit'])->name('admin.subsubcat.edit');
    Route::post('/admin/subsubcategory/update/{subsubcat}', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'update'])->name('admin.subsubcat.update');
    Route::get('/admin/subsubcategory/destroy/{subsubcat}', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'destroy'])->name('admin.subsubcat.destroy');


    // Tag Links
    Route::get('/admin/tag/index', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tag.index');
    Route::get('/admin/tag/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tag.create');
    Route::post('/admin/tag/store', [App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tag.store');
    Route::get('/admin/tag/edit/{tag}', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tag.edit');
    Route::post('/admin/tag/update/{tag}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tag.update');
    Route::get('/admin/tag/destroy/{tag}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])->name('admin.tag.destroy');

    // Messages
    Route::get('/admin/message', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.message');
    Route::delete('/admin/message/destroy/{message}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('admin.message.destroy');


    Route::get('/admin/productorigin/index', [App\Http\Controllers\Admin\ProductOriginController::class, 'index'])->name('admin.productorigin.index');
    Route::get('/admin/productorigin/create', [App\Http\Controllers\Admin\ProductOriginController::class, 'create'])->name('admin.productorigin.create');
    Route::post('/admin/productorigin/store', [App\Http\Controllers\Admin\ProductOriginController::class, 'store'])->name('admin.productorigin.store');
    Route::get('/admin/productorigin/edit/{productorigin}', [App\Http\Controllers\Admin\ProductOriginController::class, 'edit'])->name('admin.productorigin.edit');
    Route::post('/admin/productorigin/update/{productorigin}', [App\Http\Controllers\Admin\ProductOriginController::class, 'update'])->name('admin.productorigin.update');
    Route::get('/admin/productorigin/destroy/{productorigin}', [App\Http\Controllers\Admin\ProductOriginController::class, 'destroy'])->name('admin.productorigin.destroy');

    // disable button route
    Route::post("/admin/deliverytime/disable{id}", [App\Http\Controllers\Admin\DeliveryTimeController::class, 'disables'])->name("admin.deliverytime.disable.deliveryTime");
    // enable button
    Route::post("/admin/deliverytime/enable{id}", [App\Http\Controllers\Admin\DeliveryTimeController::class, 'enables'])->name("admin.deliverytime.enable.deliveryTime");


    Route::get('/admin/deliverytime', [App\Http\Controllers\Admin\DeliveryTimeController::class, 'index'])->name('admin.deliverytime.index');
    Route::post('/admin/deliverytime/store', [App\Http\Controllers\Admin\DeliveryTimeController::class, 'store'])->name('admin.deliverytime.store');
    Route::get('/admin/deliverytime/{date}', [App\Http\Controllers\Admin\DeliveryTimeController::class, 'show'])->name('admin.deliverytime.show');


    Route::get('/admin/trademarks/index', [App\Http\Controllers\Admin\TrademarksController::class, 'index'])->name('admin.trademark.index');
    Route::get('/admin/trademarks/create', [App\Http\Controllers\Admin\TrademarksController::class, 'create'])->name('admin.trademark.create');
    Route::post('/admin/trademarks/store', [App\Http\Controllers\Admin\TrademarksController::class, 'store'])->name('admin.trademark.store');
    Route::get('/admin/trademarks/edit/{trademark}', [App\Http\Controllers\Admin\TrademarksController::class, 'edit'])->name('admin.trademark.edit');
    Route::post('/admin/trademarks/update/{trademark}', [App\Http\Controllers\Admin\TrademarksController::class, 'update'])->name('admin.trademark.update');
    Route::get('/admin/trademarks/destroy/{trademark}', [App\Http\Controllers\Admin\TrademarksController::class, 'destroy'])->name('admin.trademark.destroy');


    Route::get('/admin/diets/index', [App\Http\Controllers\Admin\DietsController::class, 'index'])->name('admin.diet.index');
    Route::get('/admin/diets/create', [App\Http\Controllers\Admin\DietsController::class, 'create'])->name('admin.diet.create');
    Route::post('/admin/diets/store', [App\Http\Controllers\Admin\DietsController::class, 'store'])->name('admin.diet.store');
    Route::get('/admin/diets/edit/{diet}', [App\Http\Controllers\Admin\DietsController::class, 'edit'])->name('admin.diet.edit');
    Route::post('/admin/diets/update/{diet}', [App\Http\Controllers\Admin\DietsController::class, 'update'])->name('admin.diet.update');
    Route::get('/admin/diets/destroy/{diet}', [App\Http\Controllers\Admin\DietsController::class, 'destroy'])->name('admin.diet.destroy');

    // Review Links
    Route::get('/admin/review/index', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.review.index');
    Route::get('/admin/review/destroy/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.review.destroy');

    // Tag Links
    Route::get('/admin/product/index', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/product/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{product}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/admin/product/update/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/admin/product/destroy/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::post('/admin/product/import', [App\Http\Controllers\Admin\ProductController::class, 'import'])->name('admin.product.import');
    Route::post('/admin/product/export', [App\Http\Controllers\Admin\ProductController::class, 'export'])->name('admin.product.export');


    // Coupons Links
    Route::get('/admin/coupon/index', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/admin/coupon/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/admin/coupon/store', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/admin/coupon/edit/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/admin/coupon/update/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('admin.coupons.update');
    Route::get('/admin/coupon/destroy/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('admin.coupons.destroy');



    // Orders Links
    Route::get('/admin/order/index', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('admin.order.create');
    Route::post('/admin/order/store', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/admin/order/edit/{orders}', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.order.edit');
    Route::get('/admin/order/copy/{orders}', [App\Http\Controllers\Admin\OrderController::class, 'showCopyOrder'])->name('admin.order.showCopyOrder');
    Route::post('/admin/order/update/{orders}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');
    Route::get('/admin/order/destroy/{orders}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('/admin/order/deliveredorder', [App\Http\Controllers\Admin\OrderController::class, 'deliveredorder'])->name('admin.order.deliveredorder');
    Route::get('/admin/order/deliveredopen', [App\Http\Controllers\Admin\OrderController::class, 'deliveredopen'])->name('admin.order.deliveredopen');
    Route::post('/admin/order/filterorder', [App\Http\Controllers\Admin\OrderController::class, 'filterorder'])->name('admin.order.filterorder');
    Route::get('/admin/order/filterorder', [App\Http\Controllers\Admin\OrderController::class, 'total'])->name('admin.order.total');

    //Coustomer links
    Route::get('/admin/customer/index', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.cust.index');
    // //   select customer data with id
    Route::get('/admin/customer/edit/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'selectedit'])->name('admin.cust.selectedit');
    // update single customer data
    Route::POST('/admin/customer/update/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('admin.cust.updata');
    // update user data
    Route::get('/admin/customer/delete/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'deleted'])->name('admin.cust.delete');
    Route::post('/admin/customer/filter', [App\Http\Controllers\Admin\CustomerController::class, 'filter'])->name('admin.cust.filter');

    //   //Order History
    Route::get('/admin/order-history/{user_id}', [App\Http\Controllers\Admin\CustomerController::class, 'order_history'])->name('admin.order_his.index');
    // Profile Update Links 
    Route::get('admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('send-mail', [App\Http\Controllers\Admin\EmailController::class, 'mail']);
    Route::get('generate-pdf/{orders}', [App\Http\Controllers\Admin\PDFController::class, 'generatePDF'])->name('pdf');
    Route::post('admin/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    //product image Delete
    Route::get('image/{proimage}', [App\Http\Controllers\Admin\ProductController::class, 'image_delete'])->name('image.delete');

    // Reports
    Route::get('/admin/reports/popular-products', [App\Http\Controllers\Admin\ReportsController::class, 'popular_products'])->name('admin.reports.popular_products');
    Route::get('/admin/reports/searched-keywords', [App\Http\Controllers\Admin\ReportsController::class, 'searched_keywords'])->name('admin.reports.searched_keywords');
    Route::get('/admin/reports/purchased-products', [App\Http\Controllers\Admin\ReportsController::class, 'purchased_products'])->name('admin.reports.purchased_products');
    Route::resource("admin/delivery-settings",App\Http\Controllers\Admin\DeliverySettingController::class)->names("admin.delivery_settings");
    Route::resource('admin/settings', App\Http\Controllers\Admin\SettingsController::class);
  });
});

Route::get("/get-logged-in-user-data", function () {
  return response()->json(auth()->user());
});