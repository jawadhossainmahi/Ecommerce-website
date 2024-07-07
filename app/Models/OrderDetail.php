<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        
    ];
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            popularProductPoint($model->id, 'purchase');
        });
    }
   
    public function getproduct()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    
    public function getorder(){
        return $this->belongsTo(Orders::class, 'order_id','id');
    }
}
