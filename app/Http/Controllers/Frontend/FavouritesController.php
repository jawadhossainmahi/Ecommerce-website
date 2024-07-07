<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FavouritesController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $favourite_products = Product::select('products.*')
            ->join('favourites', 'favourites.product_id', '=', 'products.id')
            ->join('users', 'users.id', '=', 'favourites.user_id')
            ->where('users.id', Auth()->user()->id)
            ->get();

        return view('frontend.favourites', get_defined_vars());
    }
}
