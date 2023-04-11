<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductSizeStore;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    private $menu;
    private $category;
    private $product;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, Category $categoryModel, Product $productModel)
    {
        $this->menu = $menuModel;
        $this->category = $categoryModel;
        $this->product = $productModel;
    }

    
    /**
     * Display a listing of the resource in web page by slug of category
     *
     * @return \Illuminate\Http\Response
     */
    public function index($title)
    {
        $menus = $this->menu->showMenusHeader();
        // Show thông tin danh mục và số lượng mặt hàng của từng danh mục
        $categories = $this->category->showQtyProductWithCategory();
        
        // Show list product by slug category
        $products = $this->product->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.name_image', 'products.path_image', 'products.retail_price', 'products.slug', 'products.description')->where('categories.slug', 'like', $title)->get();
        
        return view('web.pages.products')->with([
            'products' => $products,
            'menus' => $menus,
            'categories' => $categories,
            'title' => $title,
            'slug' => Str::slug($title, '-')
        ]);
    }

    /**
     * Display detail product by product's id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title, $id, $slug)
    {
        // Show menus of header
        $menus = $this->menu->showMenusHeader();

        // Query show info of product detail
        $product = $this->product->showProductDetail($id);
        
        // Query to show list images of product
        $images = $this->product->showListImagesProduct($id);
        
        // Query to show list sizes of product
        $sizes = $this->product->showSizeProduct($id);
        
        // Query to show list feedback by product's id
 
        // return view product-detail
        return view('web.pages.detail_product')->with([
            'product' => $product,
            'menus' => $menus,
            'images' => $images,
            'sizes' => $sizes,
            'title' => $title,
            'slug' => $slug
        ]); 
    }


    
    /**
     * Show list feedback by product's id
     *
     * @return \Illuminate\Http\Response
     */
    public function listFeedback($id)
    {
        //
    }

    /**
     * Handle feedback of product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFeedback(Request $request)
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