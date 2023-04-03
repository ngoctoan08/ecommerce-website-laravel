<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}