<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'status'];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
