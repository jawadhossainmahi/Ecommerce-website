<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqsCategory;
use App\Models\FAQs;
use App\Models\Category;

class FaqsCategoryController extends Controller
{
    //

    public function faqs(Request $request, $id = null)
    {
        //  
        $categories = Category::get();
        $faq_categories = FaqsCategory::get();
        $data = Faqs::where('id', $id)->get();
        $faq_categories = FaqsCategory::where('cat_id', $data[0]->cat_id)->get();

        if ($id) {
            // $same = Faqs::where('cat_id',$request->cat_id)->get();
            $faqs = Faqs::where('cat_id', $id)->with('category')->get();
        }
        return view('frontend.faqs-detail', get_defined_vars(), compact('data', 'faq_categories', 'id'));
    }
}
