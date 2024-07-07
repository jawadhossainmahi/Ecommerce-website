<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQs;
use App\Models\FaqsCategory;

class FaqsCategoryController extends Controller
{
    //
    //
    public function select()
    {
        $cat = faqscategory::orderByDesc('created_at')->get();
        $catdata = compact('cat');
        return view("backend.admin.FAQs.index")->with($catdata);
    }
    // category select single id 

    public function edit($id)
    {
        $edit = faqscategory::where('cat_id', $id)->first();
        $catdata = compact('edit');

        return view('backend.admin.FAQs.catedit')->with($catdata, 'success', 'Updated');
    }
    // update category 
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $udate = faqscategory::where('cat_id', $id)
            ->update([
                'name_category' => $request['name']
            ]);

        return redirect()->back()->with('success', 'Updated Successfly');
    }
    // delete faqs category 
    public function delete($id)
    {
        $allfaqs = FAQs::where('cat_id', $id)->delete();
        $faqdelete = faqscategory::where('cat_id', $id)->delete();

        return redirect()->back()->with('success', 'Deleted Successfuly');
    }

    // insert category 

    public function insert(Request $request)
    {

        $validate = $request->validate([
            'catname' => 'required|max:255'
        ]);

        $insert = new faqscategory();
        $insert->name_category = $validate['catname'];
        $insert->save();
        return redirect()->back()->with('success', 'Data inserted successfull');
    }
}
