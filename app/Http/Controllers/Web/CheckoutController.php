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
            return redirect()->back();
        }
        // Thong tin seller
        $namePartner = $request->name;
        $phonePartner = $request->phone;
        $emailPartner = $request->email;
        $province = $request->text_province;
        $district = $request->text_district;
        $ward = $request->text_ward;
        $address = $request->address;
        $payment = $request->payment;
        $note = $request->note;
        $finalAddressPartner = $address.', '.$ward.', '.$district.', '.$province;
        // Thong tin san pham
        // insert to tbl partners
        $dataPartnerCreate = [
            'name_partner' => $request->name,
            'type_partner_id' => 1,
            'area_id' => 1,
            'address' => $finalAddressPartner,
            'tel' => $request->phone,
            'email' => $request->email,
            'note' => 'Khach le',
        ];
        // return $dataPartnerCreate;
        $partnerId = $this->partner->create($dataPartnerCreate)->id;
        // insert to tbl import_export_products
        $now = Carbon::now()->toDateTimeString();
        $billCode = 'HDBL_'.rand().time();
        $totalAmount = $request->total_money;
        $typeImportExport = 3; //xuat ban le
        
        $dataImportExport = [
            'bill_code' => $billCode,
            'day' => $now,
            'type_partner_id' => 1,
            'total_amount' =>  $totalAmount,
            'tax_money' =>  0,
            'discount' =>  0,
            'into_money' =>  0,
            'paymented' =>  0,
            'note' => 'xuất bán lẻ',
            'partner_id' =>  $partnerId,
            'type_import_export_id' =>  3, //1: 2: 3: xuat ban le
        ];
        // $importExportId = $this->importExport->create($dataImportExport)->id;
        
        //1. xac dinh co bao nhieu san pham
        // foreach theo id va size
        foreach(session('cart') as $productId) {
            foreach($productId as $productDetail) {
                $dataImportExportDetail = [ 
                    // 'import_export_product_id' => $importExportId,
                    'product_id' => $productDetail['product_id'],
                    'size' => $productDetail['product_size'],
                    'quantity' =>  $productDetail['product_qty'],
                    'unit' =>  'Đôi',
                    'price' =>  $productDetail['product_retail_price'],
                    'total_amount' =>  $productDetail['product_retail_price'] * $productDetail['product_qty'],
                    'tax_money' =>  0,
                    'discount' =>  0,
                    'into_money' =>  $productDetail['product_retail_price'] * $productDetail['product_qty'],
                    'note' => 'xuất bán lẻ sản phẩm '.$productDetail['product_name'],
                    'partner_id' =>  $partnerId,
                    'type_import_export_id' =>  3, //1: 2: 3: xuat ban le
                ];

                // Update store
                $test = DB::table('product_size_stores')
                ->where('product_id', $productDetail['product_id'])
                ->where('size_name', $productDetail['product_size'])
                ->get();
                return $test;
            }
        }
        
        session_start();
        
        return session()->get('cart');

    }

    // 

    
}