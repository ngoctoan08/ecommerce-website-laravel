<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportExportDetail;
use App\Models\ImportExportProduct;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductSizeStore;
use App\Models\Size;
use App\Models\StoreProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ImportExportController extends Controller
{
    private $product;
    private $importExport;
    private $importExportDetail;
    private $partner;
    private $size;
    private $store;
    private $productSizeStore;
    public function __construct(Product $productModel, ImportExportProduct $importExportModel, ImportExportDetail $importExportDetailModel, Partner $partnerModel, Size $sizeModel, StoreProduct $storeModel , ProductSizeStore $productSizeStoreModel)
    {
        $this->product = $productModel;
        $this->importExport = $importExportModel;
        $this->importExportDetail = $importExportDetailModel;
        $this->size = $sizeModel;
        $this->partner = $partnerModel;
        $this->store = $storeModel;
        $this->productSizeStore = $productSizeStoreModel;
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
        $billCode = !strcmp($request->bill_code, '') ? 'IE'.rand() : $request->bill_code;
        $status = 'Đã giao hàng';
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
        ];
        // insert table
        try {
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
                    $this->importExportDetail->create($dataImportExportDetails);
                    $this->productSizeStore->create($dataProductSizeStores);
                }
            }
            // insert table product_size_stores
            // Back to show list items page
            return redirect()->route('import_export.show', $request->type)->with('success', 'Nhập hàng thành công!'); //config message
        } catch (\Throwable $th) {
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
        $products = $this->product->get();
        $sizes = $this->size->get();
        $partners = $this->partner->get();
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
        // $products = $this->product->get();
        // $sizes = $this->size->get();
        // $partners = $this->partner->get();
        $ieProducts = DB::table('type_import_export_products')->join('import_export_products', 'type_import_export_products.id', '=', 'import_export_products.type_import_export_id')->join('partners', 'import_export_products.partner_id', '=' , 'partners.id')->join('users', 'users.id', '=', 'import_export_products.user_id')->select('import_export_products.*', 'partners.name_partner', 'partners.address', 'partners.tel', 'users.name')->get();
        
        return view('admin.import_export.index')->with([
            'type_import_export' => $id,
            'ieProducts' => $ieProducts,
        ]);
    }

    /**
     * Show list items of import-export-product record.
     *
     * @param  int  $id of import-export-product record.
     * @return \Illuminate\Http\Response
     */
     
    public function showDetail($id)
    {
        $orderItems = DB::table('import_export_details')->join('products', 'import_export_details.product_id', '=', 'products.id')->where('import_export_details.import_export_product_id', '=', $id)->select('products.name', 'products.path_image', 'import_export_details.*')->get();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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