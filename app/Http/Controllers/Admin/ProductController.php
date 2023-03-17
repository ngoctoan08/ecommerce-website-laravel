<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Components\Recursive;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Str;
use App\Traits\StoreImageTrait;

class ProductController extends Controller
{
    use StoreImageTrait;
    private $product; //model product
    private $category;
    private $optionCategory;
    private $unit;
    
    //ham khoi tao co tham so truyen vao la product
    public function __construct(Product $productModel, Category $categoryModel, Recursive $recursive, Unit $unitModel)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
        $this->unit = $unitModel;
        $this->optionCategory = $recursive;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = $this->optionCategory->makeRecursive($this->category, '');
        $products = $this->product->get();
        $units = $this->unit->get();
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
        $dataImageUpload = $this->StoreImageTraitUpload($request, 'avatar', 'product'); 
        if(!empty($dataImageUpload)) {
            $dataProductCreate['name_image'] = $dataImageUpload['name'];
            $dataProductCreate['path_image'] = $dataImageUpload['path'];
        }
        try {
            $this->product->create($dataProductCreate);
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            throw $th;
        }
        // return response()->json([
        //     'status' => 201,
        //     'message' => 'Data has been saved'
        // ]);
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
        //
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
        return "success";
        // return redirect()->back(); //tro ve ham index
        // return response()->json([
        //     'status' => 200,
        //     'message' => 'Data has been deleted'
        // ]);
    }
}