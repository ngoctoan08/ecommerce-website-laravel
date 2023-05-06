<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ImportExportProduct extends Model
{
    use HasFactory;
    protected $guarded = []; //tat ca cac field dc phep insert

    public function showListOrderByTypeImportExport($id)
    {
        return DB::table('type_import_export_products')
        ->select('import_export_products.*', 'partners.name_partner', 'partners.address', 'partners.tel')
        // ->latest('import_export_products.created_at')
        ->join('import_export_products', 'type_import_export_products.id', '=', 'import_export_products.type_import_export_id')
        ->join('partners', 'import_export_products.partner_id', '=' , 'partners.id')
        ->where('type_import_export_products.id', '=', $id)
        ->orderBy('import_export_products.status', 'asc')
        ->get();
    }

    // userId: tài khoản đặt cái đơn hàng đó
    public function showOrdered($userId)
    {
        return DB::table('type_import_export_products')
        ->select('import_export_products.*', 'partners.name_partner', 'partners.address', 'partners.tel')
        ->latest('import_export_products.created_at')
        ->join('import_export_products', 'type_import_export_products.id', '=', 'import_export_products.type_import_export_id')
        ->join('partners', 'import_export_products.partner_id', '=' , 'partners.id')
        ->join('users', 'import_export_products.user_id', '=', 'users.id')
        ->where('users.id', '=', $userId)
        ->where('import_export_products.type_import_export_id', '=', 3)
        ->get();
    }

    // lấy thông tin của người đặt hàng
    public function getInfoPartnerOrdered($id)
    {
        return DB::table('partners')
        ->join('import_export_products', 'import_export_products.partner_id', '=', 'partners.id')
        ->where('import_export_products.id', '=', $id)
        ->select('partners.*', 'import_export_products.id as ie_id', 'import_export_products.note', 'import_export_products.day', 'import_export_products.payment_method', 'import_export_products.status')
        ->first();
    }
    
}