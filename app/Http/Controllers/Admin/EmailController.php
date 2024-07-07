<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function mail()
    {
        $user = User::where('name', 'INDXR')->first();
        $color = '';
        if ($user->role == true) {
            $color = '#009550';
        } else {
            $color = 'red';
        }

        $data = [
            'user_name' => $user->name,
            'email' => $user->email,
            'color' => $color,
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
        //    return new EmailTemplate($data);
        Mail::to($user->email)->send(new EmailTemplate($data));

        dd("Email is Sent.");
    }
}
