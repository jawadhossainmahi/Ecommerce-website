<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.admin.profile.index', get_defined_vars());
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'fileInput' => 'image',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->l_name = $request->l_name;
        if ($request->has('fileInput')) {
            $fileInput             = $request->file('fileInput');
            $ext               = time() . "." . $fileInput->getClientOriginalExtension();
            $name              = $fileInput->getClientOriginalName();
            $destinationPath   = public_path('app-assets/images/profile/user-uploads');
            $fileInput->move($destinationPath, $ext);
            $user->image   =  "app-assets/images/profile/user-uploads/" . $ext;
        }
        $user->save();
        return redirect()->route('dashboard')->with('message', "Profile Updated !");
    }
}
