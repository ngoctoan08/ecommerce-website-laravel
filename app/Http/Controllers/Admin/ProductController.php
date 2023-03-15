<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Recursive;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $product; //model product
    private $category;
    private $optionCategory;

    //ham khoi tao co tham so truyen vao la product
    public function __construct(Product $productModel, Category $categoryModel, Recursive $recursive)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
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
        return view('admin.product.index')->with([
                'option' => $option,
                'products' => $products,
        ]); //truyen categories vao view index
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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