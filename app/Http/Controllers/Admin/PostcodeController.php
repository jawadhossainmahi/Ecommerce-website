<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ApprovePostRequest;
use Illuminate\Http\Request;
use App\Models\Postcode;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\PostNumber;
use App\Mail\PostCodeEmail;

class PostcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Postcode::orderByDesc('created_at')->get();
        //  $list = Postcode::get();
        return view('backend.admin.postcode.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.postcode.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'postcode'        => 'required|regex:/(^[0-9]{5}$)/u',
        ]);
        // customer request 
        $postcoderequest = PostNumber::where('postcode', $request->postcode)->get();
        if ($postcoderequest != "") {
            foreach ($postcoderequest as $users) {


                $postcode = new Postcode();
                $postcode->postcode = $users->postcode;
                $postcode->save();
                $postrequest = PostNumber::where('postcode', $request->postcode)->delete();
                Mail::to($users->email)->send(new ApprovePostRequest($request, $postcode));
            }
            return redirect()->route('admin.postcode.index')->with('message', "Data Added Successfully!");
        }
        // new create 
        $postcode = new Postcode();
        $postcode->postcode = $request->postcode;
        $postcode->save();


        return redirect()->route('admin.postcode.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function show(Postcode $postcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function edit(Postcode $postcode)
    {
        $postcode = Postcode::where('id', $postcode->id)->get();
        return view('backend.admin.postcode.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postcode $postcode)
    {
        $request->validate([
            'postcode'        => 'required|regex:/(^[0-9]{5}$)/u',
        ]);
        $postcode = Postcode::where('id', $postcode->id)->get();
        $postcode[0]->postcode = $request->postcode;
        $postcode[0]->save();
        return redirect()->route('admin.postcode.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postcode  $postcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postcode $postcode)
    {
        $postcode->delete();
        return redirect()->route('admin.postcode.index')->with('warning', "Data Deleted Successfully!");
    }

    // all post delete data in database
    public function bulks(Request $request)
    {
        $id = $request->id;

        $data = PostCode::whereIn('id', $id)->delete();

        // return redirect()->with('success','PostNumber Delete Successfull');
    }
    public function bulk_upload(Request $request)
    {

        if ($request->hasFile('postcode_file_upload')) {
            $allowed_extension = ['xls', 'csv', 'xlsx'];
            $file = $request->postcode_file_upload;
            // return redirect()->back()->with('message', $file);
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            if (in_array($file->getClientOriginalExtension(), $allowed_extension)) {
                $file->move(public_path('uploads'), $file_name);
                $file_type = IOFactory::identify(public_path('uploads/' . $file_name));
                $reader = IOFactory::createReader($file_type);
                $spreadsheet = $reader->load(public_path('uploads/' . $file_name));
                unlink(public_path('uploads/' . $file_name));
                $data = $spreadsheet->getActiveSheet()->toArray();

                foreach ($data as $row) {
                    try {
                        PostCode::create([
                            'postcode' => $row[0],

                        ]);
                    } catch (\Illuminate\Database\QueryException $e) {
                        return redirect()->back()->with('warning', "Cannot add Duplicate values");
                    }
                }
                return redirect()->back()->with('message', 'Data Imported Successfully');
            } else {
                return redirect()->back()->with('warning', 'Only .xls .csv or .xlsx file allowed');
            }

            return redirect()->back()->with('warning', 'Please Select File');
        }
    }

    public function find_postcode($postcode){
        $data_postcode = Postcode::where("postcode",$postcode)->get();
        return response()->json($data_postcode);
    }
}
