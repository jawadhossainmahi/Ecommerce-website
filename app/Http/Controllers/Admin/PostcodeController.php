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
     */
    public function index()
    {
        return view('backend.admin.postcode.index', [
            'pageTitle' => "Privat postnummer",
            'list' => Postcode::where('type', 'private')->latest('id')->get(),
        ]);
    }

    public function business()
    {
        return view('backend.admin.postcode.index', [
            'pageTitle' => "Företags postnummer",
            'list' => Postcode::where('type', 'business')->latest('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.postcode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'postcode' => 'required|regex:/(^[0-9]{5}$)/u',
        ]);
        // customer request
        $postcodeCheck = Postcode::where(['postcode' => $request->postcode, 'type' => $request->type])->count() > 0;
        if ($postcodeCheck) {
            return redirect()->route('admin.postcode.create')->with('warning', "Postcode already exists!");
        }

        $postcode = new Postcode();
        $postcode->postcode = $request->postcode;
        $postcode->type = $request->type;
        $postcode->save();

        $postcodeRequest = PostNumber::where('postcode', $request->postcode)->get();
        if ($postcodeRequest->count() > 0) {
            foreach ($postcodeRequest as $users) {
                PostNumber::where('postcode', $request->postcode)->delete();
                Mail::to($users->email)->send(new ApprovePostRequest($request, $postcode));
            }
            return redirect()->route('admin.postcode.index')->with('message', "Data Added Successfully!");
        }

        return redirect()->route('admin.postcode.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Postcode $postcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postcode $postcode)
    {
        return view('backend.admin.postcode.edit', [
            'postcode' => Postcode::where('id', $postcode->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
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

    public function find_postcode($postcode)
    {
        $data_postcode = Postcode::where("postcode", $postcode)->get();
        return response()->json($data_postcode);
    }
}
