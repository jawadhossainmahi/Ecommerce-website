<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'type',
        'code',
    ];
    
    public function coupon_users(){
        return $this->hasMany(CouponUser::class, 'coupon_id', 'id');
    }
}
