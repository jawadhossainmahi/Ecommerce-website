<?php

namespace App\Http\Controllers;

use App\Mail\EmailEditRequest;
use App\Mail\PhoneEditRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;

class EditController extends Controller
{
    public function changePhone($phone)
    {
        $data = [
            'phone' => $phone,
        ];
        Mail::to(Auth::user()->email)->send(new PhoneEditRequest($data));
        return redirect()->route('profile')->with(['phone-edit'=> 'Kontrollera din e-post för att ändra ditt nummer.']);
    }

    public function updatePhone(Request $request, $id)
    {
        // if ($request->request_time != date('hd')) {
        //     return redirect()->route('profile')->with(['phone-edit'=> 'Försök igen Din session tog slut.']);
        // }
        $user = User::findOrFail($id);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('profile')->with(['phone-edit'=> 'Numret har uppdaterats.']);
    }

    public function changeEmail($email)
    {
        $data = [
            'email' => $email,
        ];
        Mail::to(Auth::user()->email)->send(new EmailEditRequest($data));
        return redirect()->route('profile')->with(['email-edit'=> 'Kontrollera din e-post för att ändra ditt epost.']);
    }

    public function updateEmail(Request $request, $id)
    {
        if ($request->request_time != date('hd')) {
            return redirect()->route('profile')->with(['email-edit-error'=> 'Försök igen Din session tog slut.']);
        }
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profile')->with(['email-edit'=> 'Numret har uppdaterats.']);
    }
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $value = $request->old_password;
        $hashedValue = $user->password;
        if (!Hash::check($value, $hashedValue)) {
            return redirect()->route('profile')->with(['password_error'=> 'Felaktigt lösenord.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('profile')->with(['success'=> 'Lösenordet har uppdaterats.']);
    }
}
