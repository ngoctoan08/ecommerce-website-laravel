<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductSizeStore extends Model
{
    use HasFactory;
    protected $guarded = []; //tat ca cac field dc phep insert

    // show list size by product's id
    public function showSizeProduct($id)
    {
        return DB::table('products')
        ->join('product_size_stores', 'products.id', '=', 'product_size_stores.product_id')
        ->select('product_size_stores.id', 'product_size_stores.size_name', 'product_size_stores.product_id')
        ->where('products.id', '=', $id)
        ->whereNull('products.deleted_at')
        ->get();
        
    }
}