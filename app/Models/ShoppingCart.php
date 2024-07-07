<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
      protected $table="shoppingcart";
      protected $primaryKey="id";
      
      public function getproduct()
      {
          return $this->belongsTo(Product::class, 'product_id','id');
      }
}
