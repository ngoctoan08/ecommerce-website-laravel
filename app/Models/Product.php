<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    // protected $fillable = ['name','category_id', 'slug', 'name_image', 'path_image', 'status'];
    protected $guarded = []; //tat ca cac field dc phep insert
    
    public function images()
    {
        return $this->hasMany(ImageProduct::class, 'product_id');
    }
}
