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
use App\Models\RevenueExpenditure;
class CheckoutController extends Controller
{

    private $menu;
    private $partner;
    private $importExport;
    private $importExportDetail;
    private $productSizeStore;
    private $revenueExpenditure;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Menu $menuModel, Partner $partnerModel, ImportExportProduct $importExportModel, ImportExportDetail $importExportDetailModel, ProductSizeStore $productSizeStoreModel, RevenueExpenditure $revenueExpenditureModel)
    {
        $this->menu = $menuModel;
        $this->partner = $partnerModel;
        $this->importExport = $importExportModel;
        $this->importExportDetail = $importExportDetailModel;
        $this->productSizeStore = $productSizeStoreModel;
        $this->revenueExpenditure = $revenueExpenditureModel;
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
        $now = Carbon::now()->toDateTimeString();
        $billCode = 'HD_BL_'.time() .'';
        $totalAmount = $request->total_money;
        $typeImportExport = 3; //xuat ban le
        $paymentMethod = $request->payment_method;
        $dataPartnerCreate = [
            'name_partner' => $request->name,
            'type_partner_id' => 2, //1: NCC, 2: Khach le
            'area_id' => 1,
            'address' => $request->address . ', ' . $request->text_ward . ', ' . $request->text_district . ', ' . $request->text_province,
            'tel' => $request->phone,
            'email' => $request->email,
            'note' => 'Khach le',
        ];
        if($paymentMethod == 'momo_wallet') {
            // Lưu thông tin người đặt vào session, để lấy insert ở trang thành công
            session(['customer' => $dataPartnerCreate]);
            return $this->momoPayment($request); //nếu thành công trả về link trang thành công!
        }
        try {
            DB::beginTransaction(); 
            // Thong tin san pham
            // insert to tbl partners
            // Insert to partner
            $partnerId = $this->partner->create($dataPartnerCreate)->id; //get last partnerId
            
            $dataImportExport = [
                'bill_code' => $billCode,
                'day' => $now,
                'total_amount' =>  $totalAmount,
                'tax_money' =>  0,
                'discount' =>  0,
                'into_money' =>  $totalAmount,
                'paymented' =>  0,
                'note' => empty($request->note) ? 'Xuất bán lẻ' : $request->note,
                'partner_id' =>  $partnerId,
                'type_import_export_id' =>  3, //1: 2: 3: xuat ban le
                'user_id' =>  Auth::user()->id, //thong tin account cua nguoi dat hang
                'payment_method' => $paymentMethod
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
                'redirect'=> route('web-order.show', $importExportId) 
            ]);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    // 

    // Xử lý thanh toán bằng app momo
    public function momoPayment($request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo của khách hàng ".$request->name;
        $amount = $request->total_money;
        $orderId = time() ."";
        $redirectUrl = route('web-checkout.pay-success');
        $ipnUrl = route('web-checkout.pay-success');
        
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            return $result;
    }

    public function paySuccess()
    {
        if(isset($_GET['resultCode'])){
            // thanh toán momo thành công
            if($_GET['resultCode'] == 0) {
                // insert to database:
                $orderId = $_GET['orderId'];
                $amount = $_GET['amount'];
                $paymentMethod = $_GET['orderType'];
                // lấy thông tin khách hàng từ session
                $dataCustomer = session()->get('customer');
                try {
                    DB::beginTransaction();
                    $now = Carbon::now()->toDateTimeString();
                    $partnerId = $this->partner->create($dataCustomer)->id; //get last partnerId
            
                    $dataImportExport = [
                        'bill_code' => 'HD_BL_'.$orderId,
                        'day' => $now,
                        'total_amount' =>  $amount,
                        'tax_money' =>  0,
                        'discount' =>  0,
                        'into_money' =>  $amount,
                        'paymented' =>  $amount,
                        'note' => 'xuất bán lẻ',
                        'partner_id' =>  $partnerId,
                        'type_import_export_id' =>  3, //1: 2: 3: xuat ban le
                        'user_id' =>  Auth::user()->id, //thong tin account cua nguoi dat hang
                        'payment_method' => $paymentMethod
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
                    // xuất phiếu thu -> insert table 
                    $contentRevenueExpenditureId = 1; //phiếu thu
                    $dataRevenueExpenditure = [
                        'user_id' => Auth::user()->id,
                        'partner_id' => $partnerId,
                        'content_revenue_expenditure_id' => $contentRevenueExpenditureId,
                        're_amount_money' => $amount,
                        'import_export_id' => $importExportId,
                        're_content' => 'Thu tiền bán hàng đơn hàng '.$importExportId. ' của khách hàng '.$partnerId,
                    ];
                    $this->revenueExpenditure->create($dataRevenueExpenditure);
                    DB::commit();
                    // hủy bỏ session
                    session()->forget('cart');
                    session()->forget('customer');
                    return redirect()->route('web-order.show', $importExportId)->with([
                        'status' => 201,
                        'message' => 'Bạn đã đặt hàng thành công!'
                    ]);
                    }
                catch (\Throwable $th) {
                    dd($th);
                }
            }
            else {
                dd("Lỗi");
            }
        } 
    }

    // thêm dữ liệu vào các bảng khi thanh toán thành công
    public function storeOrder($infoOrder)
    {
        
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}