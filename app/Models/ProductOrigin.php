<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrigin extends Model
{
    use HasFactory;
    protected $table = 'product_origin';
    protected $fillable = [
        'name',
    ];
    
    
}
