<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use SoftDeletes;
    // protected $fillable = ['name','category_id', 'slug', 'name_image', 'path_image', 'status'];
    protected $guarded = []; //tat ca cac field dc phep insert
    
    public function categories () 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users () 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function images()
    {
        return $this->hasMany(ImageProduct::class, 'product_id');
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSizeStore::class, 'product_id');
    }

    public function showProductDetail($id)
    {
        $product = DB::table('products')
        ->join('product_size_stores', 'products.id', '=', 'product_size_stores.product_id')
        ->select('products.id','products.name', 'products.slug', 'products.name_image', 'products.path_image', 'products.description', 'products.conversion_unit', 'products.retail_price', DB::raw('SUM(product_size_stores.quantity) as quantity'))->where('products.id', '=', $id)
        ->whereNull('products.deleted_at')
        ->groupBy('products.id','products.name', 'products.slug', 'products.name_image', 'products.path_image', 'products.description', 'products.conversion_unit', 'products.retail_price')
        ->first();
        return $product;
    }

    // show list size by product's id
    public function showSizeProduct($id)
    {
        return DB::table('products')
        ->join('product_size_stores', 'products.id', '=', 'product_size_stores.product_id')
        ->join('sizes', 'sizes.size_name', '=', 'product_size_stores.size_name')
        ->select('sizes.size_name', 'product_size_stores.product_id')
        ->where('products.id', '=', $id)
        ->whereNull('products.deleted_at')
        ->groupBy('sizes.size_name','product_size_stores.product_id')
        ->get();
    }

    //$id is id of product
    public function showListImagesProduct($id)
    {
        return DB::table('products')
        ->join('image_products', 'products.id', '=', 'image_products.product_id')
        ->select('products.id', 'image_products.id as img_id', 'image_products.name_sub_image', 'image_products.path_sub_image')
        ->where('products.id', '=', $id)
        ->whereNull('products.deleted_at')
        // ->groupBy('products.id', 'image_products.name_sub_image', 'image_products.path_sub_image')
        ->get();
    }

    


    // Admin 
    // Show list product in admin page
    public function showInfoProducts()
    {
        return DB::table('products')
        ->select('products.id', 'products.name', 'products.slug', 'categories.name as category_name', 'products.status','products.name_image', 'products.path_image', 'products.description', 'products.conversion_unit', 'products.entry_price', 'products.wholesale_price', 'products.retail_price' , DB::raw('SUM(COALESCE(product_size_stores.quantity, 0)) as quantity'))
        ->latest('products.created_at')
        ->groupBy('products.id', 'products.name', 'products.slug', 'categories.name', 'products.status', 'products.name_image', 'products.path_image', 'products.description', 'products.conversion_unit', 'products.entry_price', 'products.wholesale_price', 'products.retail_price')
        ->leftJoin('product_size_stores', 'products.id', '=', 'product_size_stores.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->whereNull('products.deleted_at')
        ->get();
        // ->paginate(5);
        // nếu sử dụng phân trang thì thay bằng get
    }

    public function sumOfRateProduct($id)
    {
        return DB::table('feedback')
        ->join('products', 'products.id', '=', 'feedback.product_id')
        // ->select(DB::raw('SUM(feedback.rate) as quantity'))
        ->where('products.id', '=', $id)
        ->avg('feedback.rate');
        // ->get();
    }

    // tìm kiếm những sản phẩm đang còn hàng
    public function searchByNameProduct($name)
    {
        return DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.id', 'products.name', 'products.name_image', 'products.path_image', 'products.retail_price', 'products.slug', 'products.description', 'categories.slug')
        ->where('products.name', 'like', '%'.$name.'%')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('product_size_stores')
                ->whereRaw('product_size_stores.product_id = products.id')
                ->where('product_size_stores.quantity', '>', 0);
        })
        ->get();
    }
}