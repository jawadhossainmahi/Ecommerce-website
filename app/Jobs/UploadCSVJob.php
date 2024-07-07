<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOrigin;
use App\Models\SubCategory;
use App\Models\SubSubCat;
use App\Models\Tag;
use Exception;
use finfo;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadCSVJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200;
    /**
     * Create a new job instance.
     */
    public function __construct(private array $rows)
    {
        // public
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->batch()->cancelled()) {
            // Determine if the batch has been cancelled...

            return;
        }

        DB::beginTransaction();

        try {
            // Your existing code here...

            foreach ($this->rows as $row) {
                list($productId, $imagePath, $name, $categoryName, $tagName, $productInformation, $originName, $ingredients, $nutritionalContent, $storage, $otherInformation, $buyTwoGet, $price, $pricePerItem, $comparePrice, $pant, $status, $weight, $discountPrice, $subcategoryName, $subsubcategoryName, $veckans_extrapriser, $veckans_qty, $tax, $popularity  ) = $row;

                // Handle category, subcategory, and sub-subcategory
                $category = $categoryName ? Category::firstOrCreate(['name' => $categoryName]) : null;
                $subcategory = $subcategoryName ? SubCategory::firstOrCreate(['name' => $subcategoryName]) : null;
                $subsubcategory = $subsubcategoryName ? SubSubCat::firstOrCreate(['name' => $subsubcategoryName]) : null;

                // Handle tag and origin
                $tag = $tagName ? Tag::firstOrCreate(['name' => $tagName]) : null;
                $origin = $originName ? ProductOrigin::firstOrCreate(['name' => $originName]) : null;

                try {
                    $productData = [
                        'name' => $name,
                        'price' => $price,
                        'status' => $status,
                        'weight' => $weight,
                        'category_id' => optional($category)->id,
                        'product_information' => $productInformation,
                        'ingredients' => $ingredients,
                        'tag_id' => optional($tag)->id,
                        'origin_id' => optional($origin)->id,
                        'pant' => $pant,
                        'sub_cat_id' => optional($subcategory)->id,
                        'subsub_cat_id' => optional($subsubcategory)->id,
                        'other_information' => $otherInformation,
                        'buy_two_get' => $buyTwoGet ? 1 : 0,
                        'price_per_item' => $pricePerItem,
                        'compare_price' => $comparePrice,
                        'nutritional_content' => $nutritionalContent,
                        'storage' => $storage,
                        'discount_price' => $discountPrice,
                        'veckans_extrapriser' => $veckans_extrapriser,
                        'veckans_qty' => $veckans_qty,
                        'tax' => $tax,
                        'popularity' => $popularity
                    ];

                    // $product = Product::updateOrCreate(['id' => $productId], $productData);
                    $product = Product::where('id', $productId)->first();
                    if ($product) {
                        $product->update($productData);
                    } else {
                        $product = Product::create($productData);
                    }

                    $imagePath = trim($imagePath);

                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        // Handle URL-based image paths
                        $image_path = substr(parse_url($imagePath, PHP_URL_PATH), 1);
                        $existingImage = ProductImage::where('path', $image_path)->first();

                        if ($existingImage) {
                            // ProductImage::updateOrCreate(['product_id', $productId], [
                            //     'path' => $existingImage->path,
                            // ]);

                            $this->saveImages($product->id, $existingImage->path);
                            // $productImage->path = $existingImage->path;
                            // $productImage->save();
                        } else {

                            $fileContents = @file_get_contents($imagePath);

                            if ($fileContents !== false) {
                                $finfo = new finfo(FILEINFO_MIME_TYPE);
                                $mimeType = $finfo->buffer($fileContents);
                                $extension = $this->mimeToExtension($mimeType);
                                $fileName = $this->generateUniqueFileName($extension);
                                $localFilePath = public_path("assets/images/product_image/{$fileName}");

                                if (file_put_contents($localFilePath, $fileContents) !== false) {
                                    $this->updateOrCreateProductImage($product->id, $fileName);
                                } else {
                                    throw new Exception("Det gick inte att spara filen till lokal lagring.");
                                }
                            } else {
                                throw new Exception("Det gick inte att hämta filinnehållet från URL:en");
                            }
                        }
                    } else {

                        $localFilePath = public_path("images/{$imagePath}");

                        if (!file_exists($localFilePath)) {
                            throw new Exception("Image Not Found");
                        }



                        $fileName = basename($localFilePath);

                        $this->updateOrCreateProductImage($product->id, $fileName);
                    }
                } catch (\Illuminate\Database\QueryException $e) {
                    DB::rollBack();
                    Log::error('Database error: ' . $e->getMessage());
                    throw $e;
                    return ['warning' => $e->getMessage()];
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function generateUniqueFileName($extension)
    {
        return "product_image_" . uniqid() . time() . "." . $extension;
    }

    private function updateOrCreateProductImage($productId, $fileName)
    {
        $sourcePath1 = public_path('images/' . $fileName);
        // $sourcePath2 = public_path('assets/images/product_image/' . $fileName);
        Log::info('product_id', ['product_id' => $productId]);

        if (File::exists($sourcePath1)) {
            $randomHash = Str::random(10);

            $extension = pathinfo($fileName, PATHINFO_EXTENSION);

            $newFileName = $randomHash . '_' . $fileName;

            $destinationDirectory = public_path('assets/images/product_image');

            $destinationPath = $destinationDirectory . '/' . $newFileName;

            File::ensureDirectoryExists($destinationDirectory);

            File::move($sourcePath1, $destinationPath);

            File::delete($sourcePath1);

            // ProductImage::updateOrCreate(['product_id', $productId], [
            //     'path' => "assets/images/product_image/" . $newFileName,
            // ]);

            // $productImage = ProductImage::where('product_id', $productId)->first();

            // $productImage->path = "assets/images/product_image/" . $newFileName;
            // $productImage->save();

            $this->saveImages($productId, "assets/images/product_image/" . $newFileName);
        } else {
            // ProductImage::updateOrCreate(['product_id', $productId], [
            //     'path' => "assets/images/product_image/" . $fileName,
            // ]);
            $this->saveImages($productId, "assets/images/product_image/" . $fileName);
            // $productImage = ProductImage::where('product_id', $productId)->first();
            // $productImage->path = "assets/images/product_image/" . $fileName;
            // $productImage->save();
        }
    }


    private function mimeToExtension($mimeType)
    {
        $mimeToExtensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/bmp' => 'bmp',
            'image/tiff' => 'tiff',
            'image/svg+xml' => 'svg',
            'image/x-icon' => 'ico',
        ];
        return $mimeToExtensionMap[$mimeType] ?? 'jpg';
    }

    private function saveImages($productId, $path)
    {
        $productImage = ProductImage::where('product_id', $productId)->first();
        if ($productImage) {
            $productImage->path = $path;
            $productImage->save();
        } else {
            $productImage = new ProductImage();
            $productImage->product_id = $productId;
            $productImage->path = $path;
            $productImage->save();
        }
    }
}
