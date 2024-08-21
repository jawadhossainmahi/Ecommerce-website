<?php

namespace App\Http\Controllers\Admin;

use App\DataTableHelper;
use App\Models\Product;
use Exception;
use App\Models\SearchKeyword;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function popular_products()
    {
        $list = Product::select('id', 'name', 'popularity')->orderBy('popularity', 'desc')->get();
        return view('backend.admin.reports.popular_products', get_defined_vars());
    }

    /**
     * @throws Exception
     */
    public function searched_keywords()
    {
        if (request()->ajax()) {
            $query = SearchKeyword::query()->latest();

            // Apply date filtering if provided
            if (!empty(request()->minDate)) {
                $query->whereDate('created_at', '>=', request()->minDate);
            }
            if (!empty(request()->maxDate)) {
                $query->whereDate('created_at', '<=', request()->maxDate);
            }

            $dataTable = DataTableHelper::create($query)
                ->columns(fn ($row) => [
                    'id' => $row->id,
                    'keyword' => $row->keyword,
                    'updated_at' => $row->updated_at->format('Y M d - H:i A'), // Format created_at
                ]);

            return $dataTable->json();
        }
        return view('backend.admin.reports.searched_keywords');
    }

    public function purchased_products()
    {
        $list = Product::select('id', 'name')->with(['orderDetails' => function ($q) {
            $q->sum('qty');
        }])->get();
        return view('backend.admin.reports.purchased_products', get_defined_vars());
    }
}
