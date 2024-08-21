<?php

namespace App\Http\Controllers\Admin;

use App\DataTableHelper;
use finfo;
use Illuminate\Support\Facades\Blade;
use Throwable;
use App\Models\Tag;
use App\Models\Origin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Postcode;
use App\Models\SubSubCat;
use Illuminate\Bus\Batch;
use App\Jobs\UploadCSVJob;
use App\Models\ProductDiet;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductOrigin;
use App\Exports\ProductsExport;
use App\Services\ProductImport;
use App\Models\ProductTrademark;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

use function PHPUnit\Framework\fileExists;
use Illuminate\Http\UploadedFile; // Import the UploadedFile class

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list = Product::with(['image', 'getcategory', 'gettag', 'getsubcategory.getsubsubcategory'])
                ->orderByDesc('created_at');

            return DataTableHelper::create($list)
                ->addAutoIndex()
                ->ignoreInQuery(['image', 'category_name', 'tag_name'])
                ->columns(function ($row) {
                    $image_html = <<<'HTML'
                        <div style="position: relative;">
                            {{-- <a href="{{ route('image.delete',['proimage'=>$image->id]) }}">
                                <i class="fa fa-times" aria-hidden="true" style="position: absolute; left: 41px; "></i>
                            </a> --}}
                            <img loading="lazy" src="{{ asset($row->image ? $row->image->path : 'frontend/images/no-item.png') }}" width="50px" height="40px" alt="">
                        </div>
HTML;
                    $status_color = match ($row->status) {
                        'Out Of Stock' => 'danger',
                        'In Stock' => 'success',
                        default => 'warning',
                    };
                    $action_html = <<<'HTML'
                        <a href="{{ route('admin.product.edit', ['product' => $row->id]) }}">
                            <i class="bx bx-edit-alt" style="color: green;"></i>
                        </a>
                        <a href="{{ route('admin.product.destroy', ['product' => $row->id]) }}"
                                            onclick="return confirm('Are You Sure To Delete This  ?')">
                            <i class="bx bx-trash-alt" style="color: green;"></i>
                        </a>
HTML;

                    return [
                        "checkbox" => Blade::render('<input type="checkbox" name="ids" class="checkeds" value="{{ $id }}">', $row->only('id')),
                        "id" => $row->id,
                        "name" => $row->name,
                        "image" => Blade::render($image_html, compact('row')),
                        "category_name" => $row->getcategory?->name,
                        "tag_name" => $row->gettag?->name,
                        "weight" => $row->weight,
                        "price" => $row->price ?? '-',
                        "discount_price" => $row->discount_price ?? '-',
                        "created_at" => $row->created_at?->toDateTimeString(),
                        "status" => sprintf('<span class="badge badge-%s">%s</span>', $status_color, $row->status),
                        "handle" => Blade::render($action_html, compact('row'))
                    ];
                })
                ->filter(function ($builder, $keyword) {
                    return [
                        'category_name' => $builder->whereRelation('getcategory', 'name', 'like', "%$keyword%"),
                        'tag_name' => $builder->whereRelation('gettag', 'name', 'like', "%$keyword%"),
                    ];
                })
                ->json();
            // return $product_category = SubCategory::where('category_id', $request->id)->orderByDesc('created_at')->get();
            // return $product_sub_category = SubSubCat::where('sub_cat_id', $request->id)->orderByDesc('created_at')->get();
        }

        $product_origin = ProductOrigin::orderByDesc('created_at')->get();

        return view('backend.admin.product.index', get_defined_vars());
    }

    public function category(Request $request)
    {
        return $product_category = SubCategory::where('category_id', $request->id)->orderByDesc('created_at')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function sub_category(Request $request)
    {
        return $product_sub_category = SubSubCat::where('sub_cat_id', $request->id)->orderByDesc('created_at')->get();
    }
    public function create()
    {
        $category_list = Category::get();
        $sub_categories = SubCategory::get();
        $subsub_categories = SubSubCat::get();
        $tag_list = Tag::get();
        $product_origin = ProductOrigin::get();
        return view('backend.admin.product.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // return $request;

        $request->validate(
            [
                'name'                 => 'required',
                'category_id'          => 'required',
                'sub_cat_id'          => 'required',
                'subsub_cat_id'          => 'required',
                'tag_id'               => 'required',
                'origin_id'               => 'required',
                'price'                => 'required',
                'compare_price'        => 'nullable',
                'weight'               => 'required',
                'discount_price'       => 'nullable',
            ],
            [
                'sub_cat_id.required' => 'SubCategory is Emplty please Add the Subcategory for this Category',
                'subsub_cat_id.required' => 'Sub-Sub-Category is Emplty please Add the Sub-Sub-category '
            ]
        );


        // dd($request->pant);
        // $pro = $product->create($request->all());
        $product->name = $request->name;
        $product->status = $request->status;
        $product->price_per_item = $request->price_per_item;
        $product->pant = $request->pant ?? null;
        $product->category_id = $request->category_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->subsub_cat_id = $request->subsub_cat_id;
        $product->tag_id = $request->tag_id;
        $product->origin_id = $request->origin_id;
        $product->buy_two_get = ($request->buy_two_get == 0) ? null : 1;
        $product->price = $request->price;
        $product->price_amt = str_replace(',', '.', $request->price);
        $product->compare_price = $request->compare_price;
        $product->weight = $request->weight;
        $product->product_information = $request->product_information;
        $product->ingredients = $request->ingredients;
        $product->storage = $request->storage;
        $product->other_information = $request->other_information;
        $product->nutritional_content = $request->nutritional_content;
        $product->discount_price = $request->discount_price;
        $product->veckans_extrapriser = $request->veckans_extrapriser;
        $product->veckans_qty = $request->veckans_qty;
        $product->tax = $request->tax;
        $product->save();

        if ($request->file('image')) {
            $fileInput             = $request->file('image');
            $ext               = rand(0, 99999) . "." . $fileInput->getClientOriginalExtension();
            $name              = $fileInput->getClientOriginalName();
            $destinationPath   = public_path('assets/images/product_image');

            $fileInput->move($destinationPath, $ext);
            $product_image = new ProductImage();
            $product_image->path = 'assets/images/product_image/' . $ext;
            $product_image->product_id = $product->id;
            $product_image->save();
        }
        // if($request->product_trademark)
        // {

        //     for($i=0;$i<count($request->product_trademark);$i++)
        //     {
        //         $product_trademark = new ProductTrademark();
        //         $product_trademark->product_id = $product->id;
        //         $product_trademark->trademark_id = $request->product_trademark[$i];
        //         $product_trademark->save();

        //     }
        // }
        if ($request->product_diet) {
            for ($i = 0; $i < count($request->product_diet); $i++) {
                $product_diet = new ProductDiet();
                $product_diet->product_id = $product->id;
                $product_diet->diet_id = $request->product_diet[$i];
                $product_diet->save();
            }
        }

        return redirect()->route('admin.product.index')->with('message', "Data Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category_list = Category::get();
        $tag_list = Tag::get();
        $product_origin = ProductOrigin::get();
        return view('backend.admin.product.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'price'                => 'required',
            'discount_price'               => 'nullable',
        ]);
        $product->name = $request->name;
        $product->status = $request->status;
        $product->price_per_item = $request->price_per_item;
        $product->pant = $request->pant ?? null;
        $product->category_id = $request->category_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->subsub_cat_id = $request->subsub_cat_id;
        $product->tag_id = $request->tag_id;
        $product->origin_id = $request->origin_id;
        $product->buy_two_get = ($request->buy_two_get == 0) ? null : 1;
        $product->price = $request->price;
        $product->price_amt = str_replace(',', '.', $request->price);
        $product->compare_price = $request->compare_price;
        $product->weight = $request->weight;
        $product->product_information = $request->product_information;
        $product->ingredients = $request->ingredients;
        $product->storage = $request->storage;
        $product->other_information = $request->other_information;
        $product->nutritional_content = $request->nutritional_content;
        $product->discount_price = $request->discount_price;
        $product->veckans_extrapriser = $request->veckans_extrapriser;
        $product->veckans_qty = $request->veckans_qty;
        $product->tax = $request->tax;
        $product->save();
        if ($request->product_trademark) {
            // $old_product_trademark = ProductTrademark::where('product_id',$product->id)->delete();
            // for($i=0;$i<count($request->product_trademark);$i++)
            // {
            //     $new_product_trademark = new ProductTrademark();
            //     $new_product_trademark->product_id = $product->id;
            //     $new_product_trademark->trademark_id = $request->product_trademark[$i];
            //     $new_product_trademark->save();

            // }
            // // dd($request->product_trademark);
            // if($product_trademark){

            //     $product_trademark->trademark_id = $request->product_trademark;
            //     $product_trademark->save();
            // }
        }
        if ($request->product_diet) {

            $old_product_diet = ProductDiet::where('product_id', $product->id)->delete();
            for ($i = 0; $i < count($request->product_diet); $i++) {
                $old_product_diet = new ProductDiet();
                $old_product_diet->product_id = $product->id;
                $old_product_diet->diet_id = $request->product_diet[$i];
                $old_product_diet->save();
            }
            // if($product_diet){

            //     $product_diet->diet_id = $request->product_diet;
            //     $product_diet->save();
            // }
        }
        if ($request->file('image')) {
            $fileInput             = $request->file('image');
            $ext               = rand(0, 99999) . "." . $fileInput->getClientOriginalExtension();
            $name              = $fileInput->getClientOriginalName();
            $destinationPath   = public_path('assets/images/product_image');

            $fileInput->move($destinationPath, $ext);

            if (isset($ext) && ProductImage::where('product_id', $product->id)->first()) {
                ProductImage::where('product_id', $product->id)
                    ->update([
                        'path' => 'assets/images/product_image/' . $ext,
                    ]);
            } else {
                $product_image = new ProductImage();
                $product_image->path = 'assets/images/product_image/' . $ext;
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }
        return redirect()->route('admin.product.index')->with('message', "Data Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('warning', "Data Deleted Successfully!");
    }
    public function image_delete(ProductImage $proimage)
    {
        //    return $carimage;
        $proimage->delete();
        return redirect()->route('admin.product.index')->with('Success', 'Product image Deleted Successfully');
    }

    // all post delete data in database
    public function bulks(Request $request)
    {
        $id = $request->id;

        $data = Postcode::whereIn('id', $id)->delete();

        // return redirect()->with('success','PostNumber Delete Successfull');
    }

    public function import(Request $request)
    {
        $request->validate([
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size as per your requirements.
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $fileName); // Save the image in the 'public/storage/images' directory.
                // dd(public_path("images/{$fileName}"), File::exists(public_path("images/{$fileName}")));
            }
        }


        if ($request->hasFile('file')) {
            $allowedExtensions = ['xls', 'csv', 'xlsx', 'txt', 'XML', 'XLSM', 'XLSB'];
            $file = $request->file('file');
            $fileExtension = strtolower($file->getClientOriginalExtension());


            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('warning', 'Only .xls, .csv, txt, XML, XLSM, XLSB or .xlsx files are allowed.');
            }

            try {
                $fileUniqueName = time() . '.' . $fileExtension;
                $file->move(public_path('uploads'), $fileUniqueName);

                $fileType = IOFactory::identify(public_path('uploads/' . $fileUniqueName));
                $reader = IOFactory::createReader($fileType);
                // $reader->setInputEncoding('UTF-8');
                $spreadsheet = $reader->load(public_path('uploads/' . $fileUniqueName));
                // $spreadsheet->setInputEncoding("UTF-8");
                unlink(public_path('uploads/' . $fileUniqueName));

                $data = $spreadsheet->getActiveSheet()->toArray();
                // dd($data);
                // $image_path = substr(parse_url($data[1][1], PHP_URL_PATH), 1);

                // $existingImage = ProductImage::where('path', $image_path)->first();
                // dd($existingImage);
                // if ($existingImage) {

                // }
                // list($productId, $imagePath, $name, $categoryName, $tagName, $productInformation, $originName, $ingredients, $nutritionalContent, $storage, $otherInformation, $buyTwoGet, $price, $pricePerItem, $comparePrice, $pant, $status, $weight, $discountPrice, $subcategoryName, $subsubcategoryName) = $data[1];
                // dd($pant);
                $header = array_shift($data);
                $chunks = array_chunk($data, 10);
                // dd($chunks);
                $batch  = Bus::batch([])->dispatch();
                $products = [];
                foreach ($chunks as $chunk) {
                    // $chunk_data = array_map('str_getcsv', $chunk);
                    (new ProductImport())->import($chunk);

                    // $batch->add(new UploadCSVJob($chunk));
                }

                // dd(Product::upsert($products, ['id']));
                return redirect()->back()->with('batch', $batch->id);
            } catch (\Throwable $e) {
                // Log the error for debugging purposes
                Log::error($e->getMessage());
                // dd($e->getMessage());
                return redirect()->back()->header('Content-Type', 'text/html; charset=utf-8')->with('danger', 'Ett fel uppstod under dataimporten. ' . $e->getMessage());
            }
        } else {

            return redirect()->back()->with('warning', 'Välj en fil att importera.');
        }
    }

    public function import2(Request $request)
    {
        $request->validate([
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size as per your requirements.
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->storeAs('public/images', $fileName); // Save the image in the 'public/storage/images' directory.
            }
        }

        if ($request->hasFile('file')) {
            $allowedExtensions = ['xls', 'csv', 'xlsx'];
            $file = $request->file('file');
            $fileExtension = strtolower($file->getClientOriginalExtension());

            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('warning', 'Only .xls, .csv, or .xlsx files are allowed.');
            }

            try {
                $fileUniqueName = time() . '.' . $fileExtension;
                $file->move(public_path('uploads'), $fileUniqueName);

                $fileType = IOFactory::identify(public_path('uploads/' . $fileUniqueName));
                $reader = IOFactory::createReader($fileType);
                $spreadsheet = $reader->load(public_path('uploads/' . $fileUniqueName));
                unlink(public_path('uploads/' . $fileUniqueName));

                $data = $spreadsheet->getActiveSheet()->toArray();
                $header = array_shift($data);
                // dd($data);
                $chunk = [];
                $rows = [];
                $count = 0;
                foreach ($data as $key => $row) {
                    // Find or create the Category
                    $rows[] = new UploadCSVJob($row);
                    if ($count == 10) {
                        $count = 0;
                        $chunk[] = $rows;
                        $rows = [];
                    }
                    $count++;
                    // dispatch();
                }
                // dd($chunk);

                $batch = Bus::batch($chunk)->then(function (Batch $batch) {
                    $successfulJobIds = $batch->processedJobs();
                })->catch(function (Batch $batch, Throwable $e) {
                    $failedJobIds = $batch->failedJobs;
                    Log::error('Batch failed. Jobs failed: ' . ($failedJobIds));
                    Log::error('Error message: ' . $e->getMessage());
                })->finally(function (Batch $batch) {
                    // Get the overall status of the batch:
                    $overallStatus = $batch->finished() ? 'completed' : 'failed';
                })->dispatch();
                // $progress = $batch->progress();
                // dd();
                return redirect()->back()->with('batch', $batch->id);
            } catch (\Throwable $e) {
                // Log the error for debugging purposes
                Log::error($e->getMessage());
                // dd($e->getMessage());
                return redirect()->back()->with('danger', 'Ett fel uppstod under dataimporten. ' . $e->getMessage());
            }
        } else {

            return redirect()->back()->with('warning', 'Välj en fil att importera.');
        }
    }


    // export
    public function export(Request $request)
    {
        $ids = $request->ids;

        // return $ids;
        // $products = Product::whereIn('id', $ids)->with('category','subcategory','subsubcategory','tag')->get();
        // dd($products);
        // // Trigger the export and download the CSV file
        return Excel::download(new ProductsExport($ids), time() . '_products.csv');
    }
}
