<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCat extends Model
{
    use HasFactory;
    protected $table = 'subsubcategories';
    protected $fillable = [
        'name',
        'sub_cat_id',
    ];
    public function getsubcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id','id');
    }

   
}
