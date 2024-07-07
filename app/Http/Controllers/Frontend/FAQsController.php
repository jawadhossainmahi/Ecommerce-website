<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FaqsCategory;
use App\Models\FAQs;

class FAQsController extends Controller
{
    public function index($categoryId = null)
    {
        $categories = Category::get();
        $faq_categories = FaqsCategory::get();
        $faqs = Faqs::with('category')->get();

        if ($categoryId) {
            $faqs = Faqs::where('cat_id', $categoryId)->with('category')->get();
        }

        // return view('frontend.faq',compact());

        return view('frontend.faq', get_defined_vars(), compact('faq_categories', 'faqs', 'categoryId'));
    }
}
