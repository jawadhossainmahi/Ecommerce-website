<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FaqsCategory extends Model
{
    use HasFactory;
    
    protected $table='faqs_category';
    protected $primaryKey='cat_id';
    
     protected $fillable = ['name_category'];
    public function faqs(){
        return $this->hasMany(FAQs::class, 'cat_id', 'cat_id');
    }
    //  public function faqs(){
    //     return $this->belongsTo(FAQs::class,'cat_id','id');
    // }
    
    
}
