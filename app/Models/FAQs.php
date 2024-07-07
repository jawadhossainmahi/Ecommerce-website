<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FaqsCategory;

class FAQs extends Model
{
    use HasFactory;
    protected $table="faqs";
    protected $primaryKey="id";
    
     protected $fillable = ['cat_id', 'question', 'answer'];

    
    public function category(){
        return $this->belongsTo(FaqsCategory::class);
    }
    
    
}
