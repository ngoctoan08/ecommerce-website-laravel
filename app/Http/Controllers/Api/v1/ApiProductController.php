<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\StoreImageTrait;


class ApiProductController extends Controller
{
    use StoreImageTrait;
    protected $category; //model category
    protected $product; //model product
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ham khoi tao co tham so truyen vao la category
    public function __construct(Product $productModel, Category $categoryModel)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all(); //ngay mooi nhat, phan trang 5 ban ghi
        return response()->json([
            'data' => $products,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        // return response()->json($request);
        // return $request;
        // dd($request);
        // $dataProductCreate = $request->validated();
        // $dataProductCreate = [
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'category_id' => $request->category_id,
        //     'price' => $request->price,
        //     'description' => $request->description,
        // ];
        // //return 2 value 'name' and 'path' && image has been save in public/storage/product
        // $dataImageUpload = $this->StoreImageTraitUpload($request, 'avatar', 'product'); 
        // if(!empty($dataImageUpload)) {
        //     $dataProductCreate['name_image'] = $dataImageUpload['name'];
        //     $dataProductCreate['path_image'] = $dataImageUpload['path'];
        // }
        // $this->product->create($dataProductCreate);
        return response()->json([
            'status' => 201,
            'message' => 'Data has been saved'
        ]);
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
        //
    }
}