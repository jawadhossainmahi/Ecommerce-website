<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; 
    protected $table="categories";
    protected $pramiryKey="id";
   

    protected $fillable = [
        'name',
    ];
    public function getsubcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function subsubCategory()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
}
