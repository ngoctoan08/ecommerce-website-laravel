<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class CheckoutController extends Controller
{

    // Xây dựng hàm khởi tạo, gọi đến các model...
    
    // Xử lý check out
    public function handleCheckout(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $province = $request->text_province;
        $district = $request->text_district;
        $ward = $request->text_ward;
        $payment = $request->payment;
        $note = $request->note;
        
    }

    // 

    
}