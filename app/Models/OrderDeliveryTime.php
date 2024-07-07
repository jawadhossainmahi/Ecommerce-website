<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryTime extends Model
{
    use HasFactory;
    protected $table = 'order_delivery_time';
    
    public function getdeliverytime(){
        return $this->belongsTo(DeliveryTime::class);
    }
}
