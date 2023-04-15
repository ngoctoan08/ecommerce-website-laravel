<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Product;
use App\Models\Feedback;
use Illuminate\Support\Str;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    use StoreImageTrait;
    private $menu;
    private $category;
    private $product;
    private $feedback;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, Category $categoryModel, Product $productModel, Feedback $feedbackModel)
    {
        $this->menu = $menuModel;
        $this->category = $categoryModel;
        $this->product = $productModel;
        $this->product = $productModel;
        $this->feedback = $feedbackModel;
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
        $feedbacks = $this->product->showListFeedback($id);
        
        // show list images feedback
        
        // return view product-detail
        return view('web.pages.detail_product')->with([
            'product' => $product,
            'feedbacks' => $feedbacks,
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
     * Handle save feedback of product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFeedback(Request $request)
    {
        
        // Check isBuyed;
        
        $dataFeedback = [
            'content' => $request->comment,
            'rate' => $request->rate,
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id
        ];
        try {
            // dd($request);

            DB::beginTransaction();
            $feedbackId = $this->feedback->create($dataFeedback)->id;
            $dataFeedback = $this->StoreImageTraitUpload($request, 'img_feedback', 'feedback');

            if(!empty($dataFeedback)) {
                $length = sizeof($dataFeedback);
                for ($i = 0; $i < $length; $i++) {
                    DB::table('feedback_images')->insert([
                        'feedback_id'=> $feedbackId,
                        'name_image'=> $dataFeedback[$i]['name'],
                        'path_image' => $dataFeedback[$i]['path'] 
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Đánh giá sản phẩm thành công!');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            // return redirect()->back()->with('error', 'Đánh giá sản phẩm thất bại!');
            //throw $th;
        }
        
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