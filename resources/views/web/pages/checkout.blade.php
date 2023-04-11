@extends('web.index')
@section('title')
<title>Thanh toán</title>
@endsection
<!-- banner -->
<section class="banner">
    <div class="img-banner">
        <img src="{{asset('web/image/banner/banner-product.jpg')}}" alt="">
    </div>
    <div class="mini-list-banner">
        <ul class="custom-nav d-flex jtf-center alg-center">
            <li>
                <a href="trang-chu">Trang chủ</a>
            </li>
            <li>/</li>
            <li>
                <a href="">Thanh toán</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Thanh toán</span>
        </div>
    </div>
</section>

<!-- infor-pay -->
<section class="infor-pay">
    <div class="container">
        <div class="row">
            @if(session()->has('cart'))
                <?php $total = 0; ?>
            <!-- form-infor-customer -->
            <div class="col-md-6">
                <div class="form-infor-customer">
                    <div class="title-form">
                        <span>Thông tin cá nhân</span>
                    </div>
                    <form action="{{route('web-checkout.store')}}" method="POST" name="frm_checkout" id="frm_checkout">
                        <div class="box-inp-infor">
                            <input type="text" name="name" id="name" placeholder="Họ và tên" value="Doan Toan">
                        </div>
                        <div class="box-inp-infor">
                            <input type="email" name="email" id="email" placeholder="Địa chỉ email" require
                                value="toannd158@gmail.com">
                        </div>
                        <div class="box-inp-infor">
                            <input type="tel" name="phone" id="phone" placeholder="Số điện thoại"
                                value="0868642605">
                        </div>
                        <div class="box-input-short-cart">
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="province" name="province" onchange="getText('province','text_province')">
                                    <option value="">chọn thành phố</option>
                                </select>
                            </div>
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="district" name="district" onchange="getText('district', 'text_district')">
                                    <option value=""> chọn quận</option>
                                </select>
                                
                            </div>
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="ward" name="ward" onchange="getText('ward', 'text_ward')">
                                    <option value=""> chọn phường</option>
                                </select>
                                
                            </div>
                            <!-- address-city -->
                            
                                    @foreach(session('cart') as $productId)
                                        @foreach($productId as $productDetail)
                                        <?php 
                                            $total +=  $productDetail['product_retail_price'] * $productDetail['product_qty'];
                                        ?>
                                        @endforeach
                                    @endforeach
                            {{-- input hidden --}}
                            <input type="hidden" name="text_province" id="text_province" value="" />
                            <input type="hidden" name="text_district" id="text_district" value="" />
                            <input type="hidden" name="text_ward" id="text_ward" value="" />
                            <input type="hidden" name="total_money" id="total_money" value="<?=$total?>" />
                            <input type="hidden" name="url_checkout" id="url_checkout" value="{{route('web-checkout.store')}}" />
                            <div class="box-inp-infor">
                                <input type="text" name="address" id="address" placeholder="Địa chỉ của bạn"
                                    value="Kim Son">
                            </div>
                        </div>
                        <div class="box-inp-infor ">
                            <!-- <label for="note">Yêu cầu thêm của bạn về giao hàng</label> -->
                            <textarea name="note" id="note" cols="30" rows="5"
                                placeholder="Yêu cầu thêm của bạn về giao hàng...">giao nhanh cho em</textarea>
                        </div>
                        <div class="box-radio-infor">
                            <div class="radio-infor">
                                <input type="radio" class="input-radio" name="payment" id="checkout_live" value="code">
                                <label for="checkout_live">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="radio-infor">
                                <input type="radio" class="input-radio" name="payment" id="checkout_vnpay" value="vnpay">
                                <label for="checkout_vnpay"> <img width="120px" src="{{asset('web/image/icon/logo-vnpay.webp')}}"
                                        alt=""> VNPAY</label>
                            </div>
                        </div>
                        <div class="btn-pay">
                            <button type="submit" name="redirect">
                                <span class="order-product">Thanh toán</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- infor-product-pay -->
            <div class="col-md-6">
                <div class="infor-product-pay">
                    <div class="infor-product">
                        <div class="tb-infor-product">
                            @if(session()->has('cart'))
                                <?php $total = 0; ?>
                                <table class="content-tb-infor-product">
                                    @foreach(session('cart') as $productId)
                                        @foreach($productId as $productDetail)
                                        <?php 
                                            $total +=  $productDetail['product_retail_price'] * $productDetail['product_qty'];
                                        ?>
                                    <!-- 1 -->
                                    <tr>
                                        <td class="product-name-pay d-flex">
                                            <div class="img-infor-product-pay">
                                                <a href="">
                                                    <img src="{{asset($productDetail['product_path_image'])}}" alt="">
                                                </a>
                                            </div>
                                            <!-- text -->
                                            <div class="text-product-in-cart">
                                                <a href="">
                                                    <p class="name-product-in-cart">{{$productDetail['product_name']}} (Size: {{$productDetail['product_size']}}) </p>
                                                </a>
                                                <div class="price-product-in-cart">
                                                    {{$productDetail['product_qty']}} x <span> @formatMoney($productDetail['product_retail_price'])</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                        </div>
                    </div>
                    <div class="total-money">
                        <div class="box-inp-infor d-flex coupon">
                            <input type="text" name="name" id="name" placeholder="Mã giảm giá">
                            <button class="" type="button">Áp dụng</button>
                        </div>
                        <ul style="margin-left: 0px" class="list-total-money">
                            <li>
                                <p>Tổng tiền: </p>
                                <p>
                                    <span> @formatMoney($total)</span>
                                </p>
                            </li>
                            <li>
                                <p class="txt-total-money">Thành tiền:</p>
                                <p>
                                    <span class="txt-total-money"> @formatMoney($total)</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Section Script --}}
@section('script')
    <script>
        Validator({
            form: '#frm_checkout',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#name'),
                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#phone'),
                Validator.isRequired('#province'),
                Validator.isRequired('#district'),
                Validator.isRequired('#ward'),
                Validator.isRequired('#address'),
                Validator.isRequired('input[name="payment"]'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                checkOut(data.url_checkout, data);
            }
        });
    </script>
    <script>
        function checkOut(url, data) {
            // Body API
            var options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // 'accept': '*',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data), // body data type must match "Content-Type" header
            };
            // Fetch API
            fetch(url, options)
                .then((response) => response.json())
                .then((data) => {
                    if (data.status == 201) {
                        alertSuccess(data.message)
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    } else {
                        alertError(data.message)
                    }
                });
        }
    </script>
@endsection