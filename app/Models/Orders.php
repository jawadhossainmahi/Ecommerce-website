<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
    protected $table = 'orders';
    protected $fillable = [
        'status',
        'user_id'
    ];
    
    
    public function scopeByInterval($query, $interval, $status = null, $get_total = false)
    {
        if(strtolower($interval) == "day"){
            $interval = "date";
        }
        $main_query = $query->selectRaw($interval.'(created_at) as '.$interval)
                     ->selectRaw('COUNT(*) as total_orders');
        $get_total = filter_var($get_total, FILTER_VALIDATE_BOOLEAN);
        
        if($get_total){
            $main_query = $main_query->selectRaw('sum(total_price) as total');
        }           
        if(!(($status == null) || ($status == "null"))){
            $main_query = $main_query->where('status', $status);
        }
        if(strtolower($interval) == "month"){
            $main_query = $query->selectRaw('YEAR(created_at) as year');
            $main_query = $query->groupBy('year');
        }
        $main_query =  $main_query->groupBy($interval);
        return $main_query;
    }
    
    public function getorder()
    {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
    
    public function coupon(){
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'order_id', 'coupon_id');
    }
    public function getdeliveryaddress()
    {
        return $this->belongsTo(DeliveryAddress::class, 'delivery_address_id', 'id');
    }
    public function getbillingaddress()
    {
        return $this->belongsTo(DeliveryAddress::class, 'billing_address_id', 'id');
    }
    
    public function getdeliverytime()
    {
        return $this->belongsTo(DeliveryTime::class, 'delivery_time_id','id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
}
