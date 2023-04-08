@extends('web.index')
@section('title')
<title>Giỏ hàng</title>
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
                <a href="">Gio hang</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Giỏ hàng</span>
        </div>
    </div>
</section>

<!-- infor-pay -->
<section class="infor-pay">
    <div class="container">
        <div class="row">
            <!-- form-infor-customer -->
            <div class="col-md-6">
                <div class="form-infor-customer">
                    <div class="title-form">
                        <span>Thông tin cá nhân</span>
                    </div>
                    <form action="{{route('web-checkout.store')}}" method="POST" name="frm_checkout" id="frm_checkout">
                        <div class="box-inp-infor">
                            <input type="text" name="name" id="name" placeholder="Họ và tên">
                        </div>
                        <div class="box-inp-infor">
                            <input type="email" name="email" id="email" placeholder="Địa chỉ email" require
                                value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            <span style="color: #dc3545;"><?= isset($error['email']) ? $error['email'] : '' ?></span>
                        </div>
                        <div class="box-inp-infor">
                            <input type="tel" name="phone" id="phone" placeholder="Số điện thoại"
                                value="<?=isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                            <span style="color: #dc3545;"><?= isset($error['phone']) ? $error['phone'] : '' ?></span>
                        </div>
                        <div class="box-input-short-cart">
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="province" name="province" onchange="getText('province','text_province')">
                                    <option value="">chọn thành phố</option>
                                </select>
                                <span
                                    style="color: #dc3545;"><?= isset($error['province']) ? $error['province'] : '' ?></span>
                            </div>
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="district" name="district" onchange="getText('district', 'text_district')">
                                    <option value=""> chọn quận</option>
                                </select>
                                <span
                                    style="color: #dc3545;"><?= isset($error['district']) ? $error['district'] : '' ?></span>
                            </div>
                            <!-- address-city -->
                            <div class="box-inp-infor">
                                <select id="ward" name="ward" onchange="getText('ward', 'text_ward')">
                                    <option value=""> chọn phường</option>
                                </select>
                                <span style="color: #dc3545;"><?= isset($error['ward']) ? $error['ward'] : '' ?></span>
                            </div>
                            <!-- address-city -->
                            <input type="hidden" name="text_province" id="text_province" value="" />
                            <input type="hidden" name="text_district" id="text_district" value="" />
                            <input type="hidden" name="text_ward" id="text_ward" value="" />
                            <input type="hidden" name="url_checkout" id="url_checkout" value="{{route('web-checkout.store')}}" />
                            <div class="box-inp-infor">
                                <input type="text" name="address" id="address" placeholder="Địa chỉ của bạn"
                                    value="<?=isset($_POST['address']) ? $_POST['address'] : '' ?>">
                                <span
                                    style="color: #dc3545;"><?= isset($error['address']) ? $error['address'] : '' ?></span>
                            </div>
                        </div>
                        <div class="box-inp-infor ">
                            <!-- <label for="note">Yêu cầu thêm của bạn về giao hàng</label> -->
                            <textarea name="note" id="note" cols="30" rows="5"
                                placeholder="Yêu cầu thêm của bạn về giao hàng..."></textarea>
                        </div>
                        <div class="box-radio-infor">
                            <div class="radio-infor">
                                <input type="radio" class="input-radio" name="payment" id="checkout_live"
                                    <?=isset($_POST['payment']) && $_POST['payment'] == 'code' ? 'checked' : ''?>
                                    value="code">
                                <label for="checkout_live">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="radio-infor">
                                <input type="radio" class="input-radio" name="payment" id="checkout_vnpay"
                                    <?=isset($_POST['payment']) && $_POST['payment'] == 'vnpay' ? 'checked' : ''?>
                                    value="vnpay">
                                <label for="checkout_vnpay"> <img width="120px" src="{{asset('web/image/icon/logo-vnpay.webp')}}"
                                        alt=""> VNPAY</label>
                            </div>
                            <span
                                style="color: #dc3545;"><?= isset($error['payment']) ? $error['payment'] : '' ?></span>

                        </div>
                        <div class="btn-pay">
                            <button type="submit" name="redirect">
                                <span class="order-product">Đặt hàng</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- infor-product-pay -->
            <div class="col-md-6">
                <div class="infor-product-pay">
                    <div class="quantity-product">
                        <?php $qty = 0;?>
                            @if(session()->has('cart'))
                                @foreach(session('cart') as $productId)
                                    @foreach($productId as $productDetail)
                                        <?php $qty += $productDetail['product_qty'] ?>
                                    @endforeach
                                @endforeach
                        <p>Đơn hàng (<?= $qty?> sản phẩm) </p>
                        @else
                        <p>Không có sản phẩm nào</p>
                            @endif
                    </div>
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
                                                    <span class="name-product-in-cart">{{$productDetail['product_name']}}  </span>
                                                </a>
                                                <div class="price-product-in-cart">
                                                    {{$productDetail['product_qty']}} x <span> @formatMoney($productDetail['product_retail_price'])</span>
                                                    <p class="text-size-pay">Size: <span>{{$productDetail['product_size']}}</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-quantity-remove">
                                            <div class="icon-product-remove-pay">
                                                <span class="del_order" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}" url = "{{route('web-product.del-item-in-cart')}}">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </span>
                                            </div>
                                            <div class="quantity-custom d-flex mb-30">
                                                <input aria-label="quantity" class="product_{{$productDetail['product_id']}}" min="1" max="10" name="" type="number" value="{{$productDetail['product_qty']}}">
                                                <div class="btn-up-down">
                                                    <input class="plus is-form change_qty" type="button" value="+" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}" url="{{route('web-product.update-qty-in-cart')}}">
                                                    <input class="minus is-form change_qty" type="button" value="-" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}" url="{{route('web-product.update-qty-in-cart')}}">
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
                        <ul class="list-total-money">
                            <li>
                                <p>Giá trị sản phẩm: </p>
                                <p>
                                    <span> @formatMoney($total)</span>
                                    <span>Miễn phí vận chuyển </span> 
                                </p>
                            </li>
                            <li>
                                <p class="txt-total-money">Tổng tiền thanh toán:</p>
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
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    {{-- Handle Cart --}}
    {{-- Handle add to cart --}}
    <script>
        Validator({
            form: '#frm_checkout',
            errorSelector: '.form-error',
            rules: [
                // Validator.isRequired('#name'),
                // Validator.isRequired('#email'),
                // Validator.isEmail('#email'),
                // Validator.isRequired('#phone'),
                // Validator.isRequired('#province'),
                // Validator.isRequired('#district'),
                // Validator.isRequired('#ward'),
                // Validator.isRequired('#address'),
                // Validator.isRequired('input[name="payment"]'),
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
                        toastr['success'](data.message);
                    } else {
                        alert(data.status);
                        
                    }
                });
        }
    </script>
@endsection