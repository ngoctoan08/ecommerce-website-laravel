<div class="icon-cart">
    <a href="{{route('web-cart.index')}}">
        <span>
            <span>
                <i class="fa-solid fa-bag-shopping"></i>
            </span>
           <?php $qty = 0;?>
            @if(session()->has('cart'))
                @foreach(session('cart') as $productId)
                   @foreach($productId as $productDetail)
                        <?php $qty += $productDetail['product_qty'] ?>
                   @endforeach
                @endforeach
            @endif
            <span class="count count-order"><?=$qty?></span>
        </span>
        
    </a>
</div>

<div class="list-cart">
    <!-- title -->
    @if(session()->has('cart'))
        <?php $total = 0; ?>
        <div class="title-cart">
            <span>Đơn hàng (<?= $qty?> sản phẩm)</span>
        </div>
        <!-- list-product-cart -->
        <ul class="custom-nav box-mini-cart">
            @foreach(session('cart') as $productId)
                @foreach($productId as $productDetail)
                
            <li class="d-flex alg-center jtf-between mb-15">
                <!-- content-list-product -->
                <div class="d-flex alg-center">
                    <!-- img -->
                    <div class="img-product-in-cart">
                        <a href="">
                            <img src="{{asset($productDetail['product_path_image'])}}" alt="">
                        </a>
                    </div>
                    <!-- text -->
                    <div class="text-product-in-cart mr-30">
                        <a href="">
                            <span class="name-product-in-cart">{{$productDetail['product_name']}} ({{$productDetail['product_size']}})</span>
                        </a>
                        <div class="price-product-in-cart mr-30">
                            {{$productDetail['product_qty']}} x <span> @formatMoney($productDetail['product_retail_price']) </span>
                        </div>
                    </div>
                </div>
                <!-- icon-close -->
                <div class="icon-product-remove-pay">
                    <span class="del_order" id-product = "{{$productDetail['product_id']}}" size-product = "{{$productDetail['product_size']}}" url = "{{route('web-product.del-item-in-cart')}}">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>
            </li>
                    <?php 
                        $total +=  $productDetail['product_retail_price'] * $productDetail['product_qty'];
                    ?>
                @endforeach
            @endforeach
        </ul>
        <!-- total money -->
        <div class="total-money-cart d-flex alg-center jtf-between mb-15">
            <div class="text-total-money">
                <span>Tổng số tiền cần thanh toán:</span>
            </div>
            <div class="price-product-in-cart">
                <span> @formatMoney($total) </span>
            </div>
        </div>
        <!-- pay-cart -->
        <div class="btn-pay-cart">
            <a href="{{route('web-cart.index')}}">
                <button>
                    <span>Thanh toán</span>
                </button>
            </a>
            <div class="continue-shopping">
                <a href="san-pham/giay-tay">Tiếp tục mua hàng</a>
            </div>
        </div>
    @endif
</div>