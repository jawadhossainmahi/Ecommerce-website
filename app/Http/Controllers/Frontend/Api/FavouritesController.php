<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourites;

class FavouritesController extends Controller
{
    public function index(Request $request)
    {
        // return response()->json($request->mainId);
        $user = User::where('id', $request->mainId)->first();
        if ($user) {

            $favourite_products = $user->favourite_products()->where('status', 'In Stock')->orderBy('name', 'asc')->take(18)->get();
            // dd($favourite_products);
            $formated_data = api_data_format($favourite_products, $request->mainId);
        } else {
            return redirect()->route('login');
        }
        return response()->json($formated_data);
    }

    public function store(Request $request)
    {
        // dd($request);
        $product_id = $request->id;
        $user_id = $request->user()->id;
        // return $user_id;
        $favourites = new Favourites;
        $favourites->user_id = $user_id;
        $favourites->product_id = $product_id;
        $favourites->save();
        return response()->json(200);
    }
    public function destroy(Request $request)
    {
        $product_id = $request->id;
        $user_id = $request->user()->id;
        Favourites::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return response()->json(200);
    }

    public function favouriteLoadMore(Request $request)
    {
        // return response()->json($request->offset);
        $user = User::where('id', $request->mainId)->first();
        if ($user) {

            $favourite_products = $user->favourite_products()->where('status', 'In Stock')->orderBy('name', 'asc')->skip($request->offset)->take(24)->get();
            // dd($favourite_products);
            $formated_data = api_data_format($favourite_products, $request->mainId);
        } else {
            return redirect()->route('login');
        }
        return response()->json($formated_data);
    }
}
