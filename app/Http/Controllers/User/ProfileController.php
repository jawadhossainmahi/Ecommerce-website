<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('backend.user.profile.index',get_defined_vars());
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'fileInput' => 'image',
        ]);
        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('fileInput')) {
            $fileInput             = $request->file('fileInput');
            $ext               = time().".". $fileInput->getClientOriginalExtension();
            $name              = $fileInput->getClientOriginalName();
            $destinationPath   = public_path('app-assets/images/profile/user-uploads');
            $fileInput->move($destinationPath, $ext);
            $user->image   =  "app-assets/images/profile/user-uploads/".$ext;
        }
        $user->save();
        return redirect()->route('dashboard')->with('message',"Profile Updated !");
    }
    public function password(){
        return view("auth.changePassword");
    }
    public function change_password(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'min:6|required_with:new_confirm_password|same:new_confirm_password',
        ]);


        #Match The Old Password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("warning", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('dashboard')->with("message", "Password changed successfully!");
    }
}
