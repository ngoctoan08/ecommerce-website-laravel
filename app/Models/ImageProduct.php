<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageProduct extends Model
{
    use SoftDeletes;
    // protected $fillable = ['name', 'slug'];
    protected $guarded = []; //tat ca cac field dc phep insert

}