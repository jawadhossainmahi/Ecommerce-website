<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ShoppingList;
use App\Models\ShoppingCart;
use App\Models\ProductImage;
use App\Models\Product;

class ShoppinglistController extends Controller
{
  public function index()
  {
    $id = auth()->id();
    $categories = Category::get();
    $shoppingList = ShoppingList::where('user_id', $id)->latest()->get();
    return view('frontend.shopping-list', get_defined_vars());
  }


  public function indexs(Request $request)
  {

    $categories = Category::get();
    $shopping_list = ShoppingList::where('user_id', $request->mainId)->where("id", $request->id)->first();



    return view('frontend.shoplist', get_defined_vars());
  }

  public function shoppingListDetails(Request $request)
  {
    $shopping_cart = ShoppingCart::select("product_id", "quantity")->where('shopping_id', $request->id)->get();
    $products = Product::whereIn("id", $shopping_cart->pluck('product_id')->toArray())->where('status', 'In Stock')->get();
    // dd($shopping_cart->pluck('product_id'), $shopping_cart->pluck('quantity'), $shopping_cart->toArray());
    $productQuantities = [];
    foreach ($shopping_cart as $item) {
      $productQuantities[$item['product_id']] = $item['quantity'];
    }
    $formated_data = api_data_format($products, $request->mainId);
    // Merge product data with quantities
    $data = [];
    foreach ($formated_data as $product) {
      $productId = $product["id"];
      $quantity = $productQuantities[$productId];

      // Merge product data with quantity
      $data[] = [
        'product' => $product,
        'quantity' => $quantity,
      ];
    }
    // $data = ['products' => $formated_data, 'product_quantities' => $shopping_cart->pluck('quantity')->toArray()];

    return response()->json($data);
    // return response()->json($products);
  }

  public function store(Request $request)
  {

    $userId = $request->mainId;
    $product = $request->item;
    $insert = new ShoppingList();
    $insert->name = $request->shopname;
    $insert->user_id = $userId;
    $insert->save();
    $id = ShoppingList::where('name', $request->shopname)->first();

    foreach ($request->items as $items) {
      $productID = $items['product_id'];
      $ids = [];
      foreach ($items['product_id'] as $id) {
        array_push($ids, $id);
      }
      foreach ($ids as $product) {
        foreach ($product['products'] as $id) {
          $cart = new ShoppingCart();
          $cart->shopping_id = $insert->id;

          $cart->product_id = $id['item_id'];
          $cart->quantity = $id['quantity'];

          $cart->save();
        }
      }
    }
    return response()->json(['success' => true]);
  }

  public function show(Request $request)
  {

    // $shopping_id=ShoppingList::where('name',$name)->first(); 

    $productname = ShoppingCart::where('shopping_id', $request->id)->get();
    return response()->json($productname);
    // return view('frontend.shopping-list', get_defined_vars());
  }
  public function shoppingListDelete($id)
  {
    $deletecart = ShoppingCart::where('shopping_id', $id)->delete();
    $deletelist = ShoppingList::where("id", $id)->delete();

    return redirect()->back()->with('message', 'Inköpslistan har raderats');
  }
}
