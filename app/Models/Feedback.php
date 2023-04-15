<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Feedback extends Model
{
    // use HasFactory;
    protected $guarded = []; //tat ca cac field dc phep insert

    public function showListImageFeedback($feedbackId)
    {
        return DB::table('feedback')
        ->join('feedback_images', 'feedback.id', '=', 'feedback_images.feedback_id')
        ->where('feedback.id', '=', $feedbackId)
        ->get();
    }

    // Show list feedback
    public function showListFeedback($feedbackModel ,$productId)
    {
        // show name users
        // show images feedback
        return $feedbackModel
        ->join('products', 'products.id', '=', 'feedback.product_id')
        ->join('users', 'users.id', '=', 'feedback.user_id')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        // ->join('import_export_products')
        ->select('feedback.*', 'profiles.name')
        ->where('products.id', '=', $productId)
        ->get();
    }
}