<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    private $menu;
    private $category;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, Category $categoryModel)
    {
        $this->menu = $menuModel;
        $this->category = $categoryModel;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Show menus of header
        $menus = $this->menu->showMenusHeader();
        return view('web.pages.home')->with('menus', $menus);
    }

    // get [danh-muc]
    // SELECT categories.id, count(toan.id) as 'SL đang bán' FROM categories JOIN (select products.id, products.category_id, SUM(product_size_stores.quantity) as 'SL' from products JOIN product_size_stores on products.id = product_size_stores.product_id GROUP BY products.id) as toan  on categories.id = toan.category_id WHERE toan.SL > 0 GROUP BY categories.id
    public function category()
    {
        $title = 'Danh mục';
        // query list category
        //
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
        
        return view('web.pages.category')->with([
            'menus' => $menus,
            'categories' => $categories,
            'title' => $title,
            'slug' => Str::slug($title, '-')
        ]);
    }

    // get 
    public function product()
    {
        
    }

}