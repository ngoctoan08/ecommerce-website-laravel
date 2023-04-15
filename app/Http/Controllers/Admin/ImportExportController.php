<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportExportDetail;
use App\Models\ImportExportProduct;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductSizeStore;
use App\Models\RevenueExpenditure;
use App\Models\Size;
use App\Models\StoreProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ImportExportController extends Controller
{
    private $product;
    private $importExport;
    private $importExportDetail;
    private $partner;
    private $size;
    private $store;
    private $productSizeStore;
    private $revenueExpenditure;
    
    public function __construct(Product $productModel, ImportExportProduct $importExportModel, ImportExportDetail $importExportDetailModel, Partner $partnerModel, Size $sizeModel, StoreProduct $storeModel , ProductSizeStore $productSizeStoreModel, RevenueExpenditure $revenueExpenditureModel)
    {
        $this->product = $productModel;
        $this->importExport = $importExportModel;
        $this->importExportDetail = $importExportDetailModel;
        $this->size = $sizeModel;
        $this->partner = $partnerModel;
        $this->store = $storeModel;
        $this->productSizeStore = $productSizeStoreModel;
        $this->revenueExpenditure = $revenueExpenditureModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $now = Carbon::now()->toDateTimeString();
        $billCode = !strcmp($request->bill_code, '') ? 'HD_NHAP_'.Str::random(10) : $request->bill_code;
        $status = '2'; //Đã giao hàng
        // insert table import-export-products
        $dataImportExports = [
            'bill_code'=> $billCode,
            'day'=> $now,
            'total_amount' => $request->total_amount,
            'discount' => 0,
            'tax_money' => $request->bill_tax_money,
            'into_money' => $request->bill_into_money,
            'paymented' => $request->bill_into_money,
            'note' => 'import-export',
            'status' => $status,
            'partner_id' => $request->partner_id,
            'type_import_export_id' => $request->type,
            'user_id' =>  $request->user_id,
            'payment_method' => 'code'
        ];
        // insert table
        try {
            DB::beginTransaction(); 
            $importExportId = $this->importExport->create($dataImportExports)->id;
            // dd($lastId);
            // Insert table import-export-details
            if(!empty($request->size)) {
                $length = sizeof($request->size);
                for ($i = 0; $i < $length; $i++) {
                    $dataImportExportDetails = [
                        'import_export_product_id' => $importExportId,
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                        'unit' => $request->unit,
                        'price' => $request->price,
                        'total_amount' => $request->price * $request->quantity,
                        'tax_money' => 0,
                        'discount' => 0,
                        'into_money' => $request->price * $request->quantity,
                        'note' => 'import-export-details',
                        'store_product_id' => 1,
                        'size' => $request->size[$i]
                    ];
                    $dataProductSizeStores = [
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                        'ps_unit' => $request->unit,
                        'store_product_id' => 1,
                        'size_name' => $request->size[$i]
                    ];
                    // 
                    $this->importExportDetail->create($dataImportExportDetails);
                    // insert table product_size_stores
                    $this->productSizeStore->create($dataProductSizeStores);
                    // insert bảng thu chi, nội dung
                    
                }
            }
            DB::commit();
            // Back to show list items page
            return redirect()->route('import_export.show', $request->type)->with('success', 'Nhập hàng thành công!'); //config message
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $now = Carbon::now()->format('d-m-Y');
        $products = $this->product->showInfoProducts();
        $sizes = $this->size->get();
        $partners = $this->partner->where('type_partner_id', '=', 1)->get();
        // $ieProducts = $this->importExport->where('type_import_export_id', $id)->get();
        // $ieProducts = $this->importExport->join('type_import_export_products', $id, '=', 'type_import_export_products_id')->join('partners', 'partner_id', '=', );
        $ieProducts = DB::table('type_import_export_products')->join('import_export_products', 'type_import_export_products.id', '=', 'import_export_products.type_import_export_id')->join('partners', 'import_export_products.partner_id', '=' , 'partners.id')->join('users', 'users.id', '=', 'import_export_products.user_id')->select('import_export_products.*', 'partners.name_partner', 'partners.address', 'partners.tel', 'users.name')->get();
        // dd($ieProducts);
        return view('admin.import_export.add')->with([
            'type_import_export' => $id,
            'now' => $now,
            'ieProducts' => $ieProducts,  
            'sizes' => $sizes,
            'products' => $products,
            'partners' => $partners
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //idL type import export
        $ieProducts = $this->importExport->showListOrderByTypeImportExport($id);
        // dd($ieProducts);
        return view('admin.import_export.index')->with([
            'type_import_export' => $id,
            'ieProducts' => $ieProducts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $newStatus = $request->status;
        $paymentMethod = $request->payment_method;
        $totalMoney = $request->into_money;
        $partnerId = $request->partner_id;
        $contentRevenueExpenditureId = 1; //phiếu thu
        try {
            DB::beginTransaction();
            // Cập nhật trạng thái đơn hàng
            // 1: chờ xử lý
            // 2: đã giao hàng
            
            // B1. lấy ra phương thức thanh toán của đơn hàng đó
            if($paymentMethod != 'momo') {
                
                DB::table('import_export_products')
                ->where('id', $id)
                ->update([
                    'status' => $newStatus,
                    'paymented' => DB::raw('into_money')
                ]);
                // xuất phiếu chi -> insert table 
                $dataRevenueExpenditure = [
                    'user_id' => Auth::user()->id,
                    'partner_id' => $partnerId,
                    'content_revenue_expenditure_id' => $contentRevenueExpenditureId,
                    're_amount_money' => $totalMoney,
                    'import_export_id' => $id,
                    're_content' => 'Thu tiền bán hàng đơn hàng '.$id. ' của khách hàng '.$partnerId,
                ];
                $this->revenueExpenditure->create($dataRevenueExpenditure);
            }
            DB::commit();
            $response = [
                'status' => 201,
                'message' => "Cập nhật trạng thái đơn hàng thành công!"
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 400,
                'message' => $th
            ];
        }
        return response()->json($response);
    }

    /**
     * Show list items of import-export-product record.
     *
     * @param  int  $id of import-export-product record.
     * @return \Illuminate\Http\Response
     */
     
    public function showDetail($id, $idImportExport)
    {
        $orderItems = DB::table('import_export_details')->join('products', 'import_export_details.product_id', '=', 'products.id')->where('import_export_details.import_export_product_id', '=', $idImportExport)->select('products.name', 'products.path_image', 'import_export_details.*')->get();
        
        return view('admin.import_export.show-detail')->with([
            'type_import_export' => $id,
            'orderItems' => $orderItems,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id id of import export detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}