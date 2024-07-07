<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Auth;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $category = Category::take(3)->get();
        $category1 = Category::skip(3)->take(3)->get();
        $discount_products = Product::where('discount_price','>',0)->pluck('category_id');
        $category2 = Category::whereIn('id',$discount_products)->take(3)->get();
        $category3 = Category::whereIn('id',$discount_products)->skip(3)->take(3)->get();
        
        
        View::share('category', $category);
        View::share('category1', $category1);
        View::share('category2', $category2);
        View::share('category3', $category3);
    }
}
