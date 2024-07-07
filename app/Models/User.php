<?php

namespace App\Models;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Favourites;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $dates = ['deleted_at'];
    
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); 
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'l_name',
        'email',
        'role',
        'status',
        'image',
        'password',
        'customer_type',
        'organization'
        
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeCustomersInterval($query, $interval){
        if(strtolower($interval) == "day"){
            $interval = "date";
        }
        
        $main_query = $query->selectRaw($interval.'(created_at) as '.$interval)
                     ->selectRaw('COUNT(*) as total_customers')
                     ->where("role", "1");
        if(strtolower($interval) == "month"){
            $main_query = $main_query->selectRaw('YEAR(created_at) as year');
            $main_query = $main_query->groupBy('year');
        }
        $main_query = $main_query->groupBy($interval);
        return $main_query;
    }
   
    public function getorders()
    {
        return $this->hasMany(Orders::class, 'user_id','id');
    }

    public function order_count()
    {
        return Orders::where('user_id', $this->id)->count();
    }
    
    public function user_coupons(){
        return $this->hasMany(CouponUser::class, 'user_id', 'id');
    }
    
    public function favourite_products()
    {
        return $this->belongsToMany(Product::class, 'favourites', 'user_id', 'product_id');
    }
    public function is_favourite($id){
        return Favourites::where('user_id', $this->id)->where('product_id', $id)->count() > 0 ? 1 : 0; 
    }
    
    public function delivery_address(){
        return $this->belongsToMany(DeliveryAddress::class, 'user_delivery', 'user_id', 'delivery_address_id');
    }

    public function billing_address(){
        return $this->belongsToMany(DeliveryAddress::class, 'user_billings', 'user_id', 'delivery_address_id');
    }
}
