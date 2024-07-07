<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Orders;

class PDFController extends Controller
{
    public function generatePDF($orders)
    {
        $user = User::where("id", $orders)->first();
        $list = Orders::where('user_id', $orders)->with(['getorder' => function ($query) {
            $query->with('getproduct');
        }])->get();

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('d M , Y'),
            'list' => $list,
            'user' => $user,
        ];

        $pdf = PDF::loadView('backend.pdf', $data);

        return $pdf->download('invoice.pdf');
    }
}
