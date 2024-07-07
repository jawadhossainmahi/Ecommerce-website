<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\UserDelivery;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Mail\CustomerRegisterationEmail;
use Illuminate\Support\Facades\Validator;
use App\Mail\AdminCustomerRegisterationEmail;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        
    }
    public function showRegistrationForm()
    {
        $categories = Category::get();
        return view('auth.register', get_defined_vars());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['customer_type'] == 1)
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'city' => ['required', 'string'],
                'postal_code' => ['required', 'int']
            ]);

        }else{
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'city' => ['required', 'string'],
                'postal_code' => ['required', 'int']
            ]);
        }
        
        
    }
    
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {       
        if($data['customer_type'] != 1){
            $data['name'] = $data['first_name'];
        }
        
            $user = new User();
            $user->name = $data['name'];
            $user->l_name = $data['last_name'];
            $user->email = $data['email'];
            $user->city = $data['city'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->postal_code = $data['postal_code'];
            $user->password = Hash::make($data['password']);
            $user->customer_type = $data['customer_type'];
            $user->organization = $data['organization'];
            $user->save();
            
            $delivery_address = new DeliveryAddress();
            
            $delivery_address->fname = $data['name'];
            $delivery_address->lname = $data['last_name'];
            $delivery_address->street_address = $data['address'];
            $delivery_address->postal_code = $data['postal_code'];
            $delivery_address->phone = $data['phone'];
            $delivery_address->city = $data['city'];
            $delivery_address->save();
            
            $user_delivery = new UserDelivery();
            $user_delivery->user_id = $user->id;
            $user_delivery->active = 1;
            $user_delivery->delivery_address_id = $delivery_address->id;
            $user_delivery->save();
            
            
            return $user;

    }
}
