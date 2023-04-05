<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'slug', 'page_id'];

    public function menuChildren()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function showMenusHeader()
    {
        return DB::table('menus')->where('parent_id', 0)->where('page_id', 1)->get();
    }
}