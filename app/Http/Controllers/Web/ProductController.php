<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
     * Display a listing of the resource in web page
     *
     * @return \Illuminate\Http\Response
     */
    public function index($title)
    {
        $menus = $this->menu->where('parent_id', 0)->where('page_id', 1)->get();
        $categories = DB::table('categories')
        ->select('categories.name as category_name', 'categories.slug as category_slug', DB::raw('COUNT(products.id) as category_qty'))
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('product_size_stores')
                ->whereRaw('product_size_stores.product_id = products.id')
                ->where('product_size_stores.quantity', '>', 0);
        })
        ->groupBy('categories.name', 'categories.slug')
        ->get();
        
        $products = $this->product->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.name_image', 'products.path_image', 'products.retail_price', 'products.slug', 'products.description')->where('categories.slug', 'like', $title)->get();
        // dd($products);
        return view('web.pages.products')->with([
            'products' => $products,
            'menus' => $menus,
            'categories' => $categories,
            'title' => $title,
            'slug' => Str::slug($title, '-')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        dd($slug);
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