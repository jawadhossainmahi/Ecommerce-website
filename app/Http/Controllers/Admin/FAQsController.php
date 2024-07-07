<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQs;
use App\Models\FaqsCategory;

class FAQsController extends Controller
{
    //
    public function index()
    {
        $faqsdata = faqs::with('faqscategory')->get();
        // print_r($faqs);
        $data = compact('faqsdata');
        return view("backend.admin.FAQs.index")->with($data);
    }

    // category select with id  data
    public function singleid($id)
    {
        //  return view("backend.admin.FAQs.categoryindex")->with($id);
        $faq = faqs::where('cat_id', $id)->get();
        $resp = compact('faq');

        return view("backend.admin.FAQs.categoryindex")->with($resp);
    }
    // insert Faqs form data
    public function insert(Request $request)
    {
        $text1 = $request->text1;
        $text2 = $request->text2;
        $id = $request->id;
        print_r($text2);

        $request->validate([
            'text1' => 'required',
            'text2' => 'required',

        ]);


        $datas = new Faqs();
        // print_r($datas);
        $datas->question = $request['text1'];
        $datas->answer = $request['text2'];
        $datas->cat_id = $request['id'];
        $datas->save();

        return redirect()->back();
    }

    // select single FAQs
    public function edit($id)
    {
        $edit = faqs::where('id', $id)->first();
        $dat = compact('edit');

        return view('backend.admin.FAQs.edit')->with($dat);
    }

    // update faqs
    public function update(Request $request, $id)
    {
        $update = faqs::where('id', $id)
            ->update([
                'question' => $request->question,
                'answer' => $request->answer
            ]);
        return redirect()->back();
    }

    // delete faqs 
    public function delete($id)
    {
        $delete = faqs::where('id', $id)->delete();
        return redirect()->back();
    }
}
