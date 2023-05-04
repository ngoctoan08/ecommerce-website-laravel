@extends('web.index')
@section('title')
<title>Giỏ hàng</title>
@endsection

@section('content')
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
            <!-- infor-product-pay -->
            <div class="col-md-12">
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
                        <div class="btn-action-summary">
                            <a style="width: 200px;" href="{{route('danh-muc')}}">Tiếp tục mua hàng</a>
                        </div>
                            @endif
                    </div>
                    <div class="cart-container d-flex">
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
                            <h3>Giỏ hàng</h3>
                            
                            <ul style="margin-left: 0px" class="list-total-money">
                                <li>
                                    <p>Tổng tiền: </p>
                                    <p>
                                        <span> @formatMoney($total)</span>
                                        {{-- <span>Miễn phí vận chuyển </span>  --}}
                                    </p>
                                </li>
                                <li>
                                    <p class="txt-total-money">Thành tiền:</p>
                                    <p>
                                        <span class="txt-total-money"> @formatMoney($total)</span>
                                    </p>
                                </li>
                            </ul>
                            <div class="btn-action-summary">
                                <a href="{{route('web-checkout.index')}}">Thanh toán</a>
                                <a href="{{route('danh-muc')}}">Tiếp tục mua hàng</a>
                            </div>
                            
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


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