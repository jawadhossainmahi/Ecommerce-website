<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\AdminMessageEmail;
use Illuminate\Http\Request;
use App\Models\PostNumber;
use App\Mail\PostCodeEmail;
use App\Mail\PostRequestAdminEmail;
use App\Mail\PostRequestEmail;
use App\Models\Postcode;

class PostNumberController extends Controller
{

    public function index()
    {
        $posts = PostNumber::all();

        return view('backend.admin.new_zip_request.index', compact('posts'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'email' =>  'email',
        ]);
        // dd($request);
        $email = $request->email;

        // Remove the element with "name" equal to "_token" from the data array
        $data = array_filter($request->formdata, function ($item) {
            return $item['name'] !== '_token';
        });
        $values = [];
        foreach ($data as $item) {

            array_push($values, intval($item['value']));
        }

        $dat = json_encode($values);
        $cleanDataString = str_replace(['[', ']'], '', $dat);
        $dataArray = explode(', ', $cleanDataString);
        $dataString = str_replace(',', '', $dataArray);

        $postcode =  "";

        foreach ($dataString as $dates) {

            $store = new PostNumber();
            $store->email = $email;
            $store->postcode = $dates;
            $store->save();
            $postcode = $dates;
        }


        Mail::to(env("MAIL_FROM_ADDRESS"))->send(new PostRequestAdminEmail($request, $postcode));
        Mail::to($email)->send(new PostRequestEmail($request));
        return response('success');
    }


    public function update()
    {
    }

    public function destroy($id)
    {
        $destroy = PostNumber::find($id)->delete();

        return redirect()->route('admin.postnumber.index')->with('message', 'Deleted successfuly');
    }


    // all post delete data in database
    public function alldestroy(Request $request)
    {
        $id = $request->id;

        $data = Postcode::whereIn('id', $id)->delete();

        return response('success');
    }
}
