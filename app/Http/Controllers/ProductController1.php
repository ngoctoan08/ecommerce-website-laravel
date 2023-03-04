<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use StoreImageTrait;
    //
    //
    private $product; //model product
    private $category;
    //ham khoi tao co tham so truyen vao la product
    public function __construct(Product $productModel, Category $categoryModel)
    {
        $this->product = $productModel;
        $this->category = $categoryModel;
    }

    public function add() {
        // $categories = $this->category->
        // $optionCategories = $this->category->makeRecursive($this->category, '');
        $categories = $this->category->latest()->paginate(5);
        // dd($categories);
        // echo '<pre>';
        // print_r($categories);
        // echo '</pre>';
        // die();
        return view('admin.product.add', compact('categories'));
    }

    public function index() {
        $products = $this->product->latest()->paginate(5); //ngay mooi nhat, phan trang 5 ban ghi
        // return view('product.index')->with([
        //     'categories' => $categories,
        // ]); //truyen categories vao view index

        //cach 1
        return view('admin.product.index', compact('products')); 
        // return view('product.index', $categories);
    }


    //noi nhan cac request gui len ex: post
    public function store(Request $request) {
        dd($request);
        // $dataProductCreate = [
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'category_id' => $request->category_id,
        //     'price' => $request->price,
        //     'description' => $request->description,
        // ];
        // $dataImageUpload = $this->StoreImageTraitUpload($request, 'avatar', 'product'); //return 2 value 'name' and 'path'
        // if(!empty($dataImageUpload)) {
        //     $dataProductCreate['name_image'] = $dataImageUpload['name'];
        //     $dataProductCreate['path_image'] = $dataImageUpload['path'];
        // }
        // $addProduct = $this->product->create($dataProductCreate);
    }

    public function edit($id) {
        $product = $this->product->find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update($id, Request $request) {
        $product = $this->product->find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect(route('product.index')); //tro ve ham index product
    }

    public function delete($id) {
        $this->product->find($id)->delete();
        return redirect(route('product.index')); //tro ve ham index product
    }
}
