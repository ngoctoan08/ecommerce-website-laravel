<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ImportExportDetail extends Model
{
    use HasFactory;
    protected $guarded = []; //tat ca cac field dc phep insert
    
    public function showOrderedItemByOrderId($id)
    {
        return DB::table('import_export_details')
        ->join('products', 'import_export_details.product_id', '=', 'products.id')
        ->where('import_export_details.import_export_product_id', '=', $id)
        ->select('products.name', 'products.path_image', 'import_export_details.*')
        
        ->get();
    }
}