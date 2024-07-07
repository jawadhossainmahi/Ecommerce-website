<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $fillable = [
        'name',
        'category_id',
    ];
    public function getsubsubcategory()
    {
        return $this->hasMany(SubSubCat::class, 'sub_cat_id','id');
    }
    
    public function getcategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
