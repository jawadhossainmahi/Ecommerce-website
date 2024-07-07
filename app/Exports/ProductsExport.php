<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
class ProductsExport implements FromCollection,WithHeadings,WithMapping
{
    protected $selectedIds;
    public function __construct(array $selectedIds = null)
    {
        $this->selectedIds = $selectedIds;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->selectedIds == null)
        {
            return Product::with('category', 'subcategory', 'subsubcategory', 'tag')->get();
        }
        return Product::whereIn('id', $this->selectedIds)
            ->with('category', 'subcategory', 'subsubcategory', 'tag')
            ->get();
    }
    public function map($product): array
    {
        return [
            $product->id,
            $product->image ? env("BASE_URL").$product->image->path : env("BASE_URL")."frontend/images/no-item.png",
            $product->name,
            $this->getCategoryName($product),
             // Assuming the category name is stored in the 'name' attribute
            $this->getTagName($product),
            // $this->getDietName($product),
            $product->product_information,
            $product->getorigin ? $product->getorigin->name: null,
            $product->ingredients,
            $product->nutritional_content,
            $product->storage,
            $product->other_information,
            $product->buy_two_get,
            $product->price,
            $product->price_per_item,
            $product->compare_price,
            $product->pant,
            $product->status,
            $product->weight,
            $product->discount_price,
            $this->getSubCategoryName($product),
            $this->getSubSubCategoryName($product),
            $product->veckans_extrapriser,
            $product->veckans_qty,
            $product->tax,
            $product->popularity
        ];
    }
    

    private function getCategoryName($product): ?string
    {
        return $product->category->name ?? null;
    }
    private function getSubCategoryName($product): ?string
    {
        return $product->subcategory->name ?? null;
    }
    private function getSubSubCategoryName($product): ?string
    {
        return $product->subsubcategory->name ?? null;
    }
    private function getTagName($product): ?string
    {
        return $product->tag->name ?? null;
    }
    private function getTradmarkName($product): ?string
    {
        return $product->tradmark->name ?? null;
    }
    private function getDietName($product): ?string
    {
        return $product->diet->name ?? null;
    }
   
   
       
    public function headings(): array
    {
        return [
            'id',
            'Image',
            'Product Name',
            'Category',
            'Tag',
            'Product Information',
            'Origin',
            'Ingredients',
            'Nutritional Content',
            'Storage',
            'Other Information',
            'Buy Two Get',
            'Price',
            'Price Per Item',
            'Compare Price',
            'Pant',
            'Status',
            'Weight',
            'Discount Price',
            'Subcategory',
            'Sub-subcategory',
            'Veckans Extrapriser',
            'Veckans Kvantitet',
            'Beskatta',
            'Popularitet'
        ];
    }
}
