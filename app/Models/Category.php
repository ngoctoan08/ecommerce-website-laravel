<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'status', 'user_id'];

    public function product() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function users() : BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function showQtyProductWithCategory()
    {
        return DB::table('categories')
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
    }
}