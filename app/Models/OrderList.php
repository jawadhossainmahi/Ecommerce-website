<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $table = 'order_lists';
    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        
    ];
   
    public function getproduct()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
