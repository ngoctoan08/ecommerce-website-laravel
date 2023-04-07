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
                                                    <input class="plus is-form change_qty" type="button" value="+" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}">
                                                    <input class="minus is-form change_qty" type="button" value="-" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}">
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
