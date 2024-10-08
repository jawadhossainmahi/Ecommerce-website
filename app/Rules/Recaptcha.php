<?php

namespace App\Rules;

use Closure;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class Recaptcha implements ValidationRule {

    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $data = array('secret' => env('GOOGLE_RECAPTCHA_SECRET'),
            'response' => $value);
  
        try {
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, 
                        http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            if($response){

            }else{
                $fail("ReCaptcha verification failed.");
            }
            
        }
        catch (\Exception $e) {
            $fail("ReCaptcha verification failed.");
        }
    }
  
    
}
