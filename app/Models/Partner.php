<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $guarded = []; //tat ca cac field dc phep insert

    // insert to partner
    public function insertPartner($request)
    {
        // $dataProductCreate = [
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'category_id' => $request->category_id,
        //     'description' => $request->description,
        //     'entry_price' => $request->entry_price,
        //     'wholesale_price' => $request->wholesale_price,
        //     'retail_price' => $request->retail_price,
        //     'standard_stock' => $request->standard_stock,
        //     'conversion_unit' => $request->conversion_unit,
        //     'code_id' => $codeId,
        //     'user_id' => $request->user_id,
        // ];
    }
}