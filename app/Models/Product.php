<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// UPDATE products SET price_amt = REPLACE(price, ',', '.');

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'tag_id',
        'product_information',
        'origin_id',
        'ingredients',
        'nutritional_content',
        'storage',
        'other_information',
        'buy_two_get',
        'price',
        'price_amt',
        'price_per_item',
        'compare_price',
        'pant',
        'status',
        'weight',
        'discount_price',
        'sub_cat_id',
        'subsub_cat_id',
        'veckans_extrapriser',
        'veckans_qty',
        'tax',
        'popularity'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->price_amt = str_replace(',', '.', $model->price);
        });
        static::updating(function ($model) {
            $model->price_amt = str_replace(',', '.', $model->price);
        });
    }

    public function getcategory()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    
    public function getorigin()
    {
        return $this->belongsTo(ProductOrigin::class, 'origin_id','id');
    }
    public function gettrademarks(){
        return $this->belongsToMany(Trademark::class, 'product_trademark');
    }
    public function getdiets(){
        return $this->belongsToMany(Diet::class, 'product_diet');
    }
    
    public function getsubcategory()
    {
        return $this->hasMany(SubCategory::class, 'id','sub_cat_id');
    }
    public function getsubsubcategory()
    {
        return $this->hasMany(SubSubCat::class, 'id','subsub_cat_id');
    }
    public function gettag()
    {
        return $this->belongsTo(Tag::class, 'tag_id','id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function image()
    {
        return $this->hasOne(ProductImage::class ,'product_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_cat_id','id');
    }
    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCat::class,'subsub_cat_id','id');
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class,'tag_id','id');
    }
    public function tradmark()
    {
        return $this->belongsTo(Trademark::class,'product_id','id');
    }
    public function diet()
    {
        return $this->belongsTo(Diet::class,'product_id','id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    //Sort by 
    public function scopeSortBy(Builder $query, string $sortyBy): void
    {
        $query->when($sortyBy == 'alphabetically', function($q){
            return $q->orderBy('name', 'asc');
        })
        ->when($sortyBy == 'popularity', function($q){
            return $q->orderBy('popularity', 'desc');
            // return $q->inRandomOrder();
        })
        ->when($sortyBy == 'price_low_to_high', function($q){
            return $q->orderBy("price_amt", 'asc');
            // return $q->orderBy("CONVERT(`price`,  DECIMAL)", 'asc');
        })
        ->when($sortyBy == 'price_high_to_low', function($q){
            return $q->orderBy("price_amt", 'desc');
            // return $q->orderBy("CONVERT(`price`, DECIMAL)", 'desc');
        });
    }
    // convert(`proc`, decimal)
}
