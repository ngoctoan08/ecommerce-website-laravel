<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Components\Recursive;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Models\ImageProduct;
use Illuminate\Support\Str;
use App\Traits\StoreImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    use StoreImageTrait;
    private $product; //model product
    private $category;
    private $optionCategory;
    private $unit;
    private $imagesProduct;
    
    //ham khoi tao co tham so truyen vao la product
    public function __construct(Product $productModel, Category $categoryModel, Recursive $recursive, Unit $unitModel, ImageProduct $imageProductModel)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
        $this->unit = $unitModel;
        $this->optionCategory = $recursive;
        $this->imagesProduct = $imageProductModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = $this->optionCategory->makeRecursive($this->category, '');
        $products = $this->product->latest()->paginate(5);
        $units = $this->unit->get();
        // dd($products);
        return view('admin.product.index')->with([
                'option' => $option,
                'products' => $products,
                'units' => $units
        ]); //truyen categories vao view index
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductFormRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $dataProductCreate = $request->validated();
        $codeId = !strcmp($request->code_id, '') ? 'SP'.rand().time() : $request->code_id;
        $dataProductCreate = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'entry_price' => $request->entry_price,
            'wholesale_price' => $request->wholesale_price,
            'retail_price' => $request->retail_price,
            'standard_stock' => $request->standard_stock,
            'conversion_unit' => $request->conversion_unit,
            'code_id' => $codeId,
            'user_id' => $request->user_id,
        ];
        //return 2 value 'name' and 'path' && image has been save in public/storage/product
        // Upload 1 image
        $dataImageUpload = $this->StoreImageTraitUpload($request, 'avatar', 'product'); 
        // Upload multiple image
        $dataSubImageUpload = $this->StoreImageTraitUpload($request, 'sub_avatar', 'product');
        
        if(!empty($dataImageUpload)) {
            $dataProductCreate['name_image'] = $dataImageUpload['name'];
            $dataProductCreate['path_image'] = $dataImageUpload['path'];
        }
        try {
            $lastId = $this->product->create($dataProductCreate)->id;
            // dd($lastId);
            if(!empty($dataSubImageUpload)) {
                $length = sizeof($dataSubImageUpload);
                for ($i = 0; $i < $length; $i++) {
                    $this->imagesProduct->create([
                        'product_id'=> $lastId,
                        'name_sub_image'=> $dataSubImageUpload[$i]['name'],
                        'path_sub_image' => $dataSubImageUpload[$i]['path'] 
                    ]);
                }
            }
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $subImages = $this->imagesProduct->where('product_id', $id)->get()->all();
            // // $subImages = $this->imagesProduct->findOrFail($id);
            // // dd($subImages);
            // foreach($subImages as $subImage) {
                
            //     // dd($subImage->path_image);
            // }
            // return;
            $option = $this->optionCategory->makeRecursive($this->category, '');
            $units = $this->unit->get();
            // dd($subImages[0]->id);
            // foreach($subImages as $subImage) {
            //     dd($subImage->product_id);
            // }
            return view('admin.product.edit')->with([
                'option' => $option,
                'product' => $product,
                'subImages' => $subImages,
                'units' => $units
            ]);
        } catch (ModelNotFoundException $e) {
            throw($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->find($id)->delete();
        // return "success";
        // return redirect()->back(); //tro ve ham index
        return response()->json([
            'status' => 200,
            'message' => 'Data has been deleted'
        ]);
    }

    public function import_export()
    {
        
    }
}