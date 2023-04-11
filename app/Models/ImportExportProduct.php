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
        ->join('import_export_products', 'type_import_export_products.id', '=', 'import_export_products.type_import_export_id')->join('partners', 'import_export_products.partner_id', '=' , 'partners.id')
        ->join('users', 'users.id', '=', 'import_export_products.user_id')
        ->select('import_export_products.*', 'partners.name_partner', 'partners.address', 'partners.tel', 'users.name')
        ->where('type_import_export_products.id', '=', $id)
        ->get();
    }
}