<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    public function index()
    {
        $user = User::where('role', "1")->latest()->orderByDesc('created_at')->get();
        return view('backend.admin.player.index', get_defined_vars());
    }
    public function create()
    {
        return view('backend.admin.player.create');
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('backend.admin.player.edit', get_defined_vars());
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $data = User::where('id', $id)->first();
        $data->status = $request->status;
        $data->name = $request->name;
        $data->l_name = $request->l_name;
        $data->save();
        return redirect()->route('player.index')->with('message', "Account For User Has Been Created");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
        ]);
        $data = $request->all();
        $check = $this->add($data);
        return redirect()->route('player.index')->with('message', "Account For User Has Been Created");
    }
    public function add(array $data)
    {
        return User::create([
            'name'  => $data['name'],
            'l_name'  => $data['l_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('player.index')->with('warning', "Account For User Has Been Deleted");
    }
}
