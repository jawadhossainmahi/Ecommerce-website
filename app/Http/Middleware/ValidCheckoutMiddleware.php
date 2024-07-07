<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidCheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
        if(isset($_SESSION['cart'])){
            
            if(count($_SESSION['cart'])<=0){
                // return redirect()->route('index')->with('error','Vänligen ange varor i kundvagnen innan du går vidare till kassan');
            }
            
        }else{
            // return redirect()->route('index')->with('error','Vänligen ange varor i kundvagnen innan du går vidare till kassan');
        }
        if(isset($_SESSION['postcode'])){
            if(strlen($_SESSION['postcode'])<=0){
                return redirect()->route('index')->with('error','Ange postnummer innan du går vidare till kassan');
            }
        }else{
            return redirect()->route('index')->with('error','Ange postnummer innan du går vidare till kassan');
        }
        if(isset($_SESSION['delivery_datetime'])){
            if(count($_SESSION['delivery_datetime'])<=0){
                return redirect()->route('index')->with('error','Ange leveranstid innan du går vidare till kassan');
            }
        }else{
            return redirect()->route('index')->with('error','Ange leveranstid innan du går vidare till kassan');
        }
        
        return $next($request);
    }
}
