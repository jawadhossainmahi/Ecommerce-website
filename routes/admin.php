<?php

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
    // create new postnumber
    Route::post("/admin/postnumber/store", [App\Http\Controllers\Admin\PostNumberController::class, 'store'])->name('postnumber.store');

    Route::get("/admin/postnumber/index", [App\Http\Controllers\Admin\PostNumberController::class, 'index'])->name('admin.postnumber.index');
    Route::get("/admin/postnumber/destroy/{id}", [App\Http\Controllers\Admin\PostNumberController::class, 'destroy'])->name('admin.postnumber.destroy');
    Route::DELETE("/admin/postnummer/delete", [App\Http\Controllers\Admin\PostNumberController::class, 'alldestroy']);


    Route::get('/admin/postnummer/index', [App\Http\Controllers\Admin\PostcodeController::class, 'index'])->name('admin.postcode.index');
    Route::get('/admin/postnummer/business', [App\Http\Controllers\Admin\PostcodeController::class, 'business'])->name('admin.postcode.business');
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
    Route::get('/admin/order/edit/order/{orders}', [App\Http\Controllers\Admin\OrderController::class, 'editOrder'])->name('admin.order.edit.order');
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
    Route::resource("admin/delivery-settings", App\Http\Controllers\Admin\DeliverySettingController::class)->names("admin.delivery_settings");
    Route::resource('admin/settings', App\Http\Controllers\Admin\SettingsController::class);

});
