<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ImportExportDetail;
use App\Models\ImportExportProduct;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\ProductSizeStore;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CheckoutController extends Controller
{

    private $menu;
    private $partner;
    private $importExport;
    private $importExportDetail;
    private $productSizeStore;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, Partner $partnerModel, ImportExportProduct $importExportModel, ImportExportDetail $importExportDetailModel, ProductSizeStore $productSizeStoreModel)
    {
        $this->menu = $menuModel;
        $this->partner = $partnerModel;
        $this->importExport = $importExportModel;
        $this->importExportDetail = $importExportDetailModel;
        $this->productSizeStore = $productSizeStoreModel;

    }
    
    public function index()
    {
        $menus = $this->menu->showMenusHeader();
        return view('web.pages.checkout')->with([
            'menus' => $menus,
        ]);
    }
    // Xây dựng hàm khởi tạo, gọi đến các model...
    
    // Xử lý check out
    // học pattern stragy pay
    public function handleCheckout(Request $request)
    {
        if(!session()->get('cart')) {
            return response()->json([
                'status' => 400,
                'message' => 'Không tìm thấy giỏ hàng!'
            ]);
        } 
        try {
            DB::beginTransaction(); 
            // Thong tin san pham
            // insert to tbl partners
            $dataPartnerCreate = [
                'name_partner' => $request->name,
                'type_partner_id' => 2, //1: NCC, 2: Khach le
                'area_id' => 1,
                'address' => $request->address . ', ' . $request->text_ward . ', ' . $request->text_district . ', ' . $request->text_province,
                'tel' => $request->phone,
                'email' => $request->email,
                'note' => 'Khach le',
            ];
            // Insert to partner
            $partnerId = $this->partner->create($dataPartnerCreate)->id; //get last partnerId
            
            $now = Carbon::now()->toDateTimeString();
            $billCode = 'HDBL_'.Str::random(10);
            $totalAmount = $request->total_money;
            $typeImportExport = 3; //xuat ban le
            
            $dataImportExport = [
                'bill_code' => $billCode,
                'day' => $now,
                'total_amount' =>  $totalAmount,
                'tax_money' =>  0,
                'discount' =>  0,
                'into_money' =>  0,
                'paymented' =>  0,
                'note' => 'xuất bán lẻ',
                'partner_id' =>  $partnerId,
                'type_import_export_id' =>  3, //1: 2: 3: xuat ban le
                'user_id' =>  Auth::user()->id, //thong tin account cua nguoi dat hang
            ];
            // insert to tbl import_export_products
            $importExportId = $this->importExport->create($dataImportExport)->id;

            //1. xac dinh co bao nhieu san pham
            // foreach theo id va size
            foreach(session('cart') as $productId) {
                foreach($productId as $productDetail) {
                    $dataImportExportDetail = [ 
                        'import_export_product_id' => $importExportId,
                        'product_id' => $productDetail['product_id'],
                        'size' => $productDetail['product_size'],
                        'quantity' =>  $productDetail['product_qty'],
                        'unit' =>  'Đôi',
                        'price' =>  $productDetail['product_retail_price'],
                        'total_amount' =>  $productDetail['product_retail_price'] * $productDetail['product_qty'], //tổng tiền chưa thuế + discount
                        'tax_money' =>  0,
                        'discount' =>  0,
                        'into_money' =>  $productDetail['product_retail_price'] * $productDetail['product_qty'], //thành tiền
                        'note' => 'xuất bán lẻ sản phẩm '.$productDetail['product_name'],
                        'store_product_id' => 1, //defaul 1.
                    ];
                    // Insert tbl detail
                    $this->importExportDetail->create($dataImportExportDetail);
                    
                    // Update store
                    $numrows = DB::table('product_size_stores')
                    ->where('product_id', $productDetail['product_id'])
                    ->where('size_name', $productDetail['product_size'])
                    ->decrement('quantity', $productDetail['product_qty']);
                }
            }
            
            DB::commit();
            // hủy bỏ session
            session()->forget('cart');
            return response()->json([
                'status' => 201,
                'message' => 'Bạn đã đặt hàng thành công!',
                'redirect'=> route('web-order.index') 
            ]);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
    }

    // 

}
}