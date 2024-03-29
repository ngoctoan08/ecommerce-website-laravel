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