<header id="header" class="header">
    <div class="container-fluid">
        <div class="header-inner alg-center jtf-between d-flex">
            <!-- logo -->
            <div class="icon-menu-respon">
                <span>
                    <i class="fa-solid fa-bars"></i>
                </span>
            </div>

            <div class="icon-logo ml-60">
                <a href="{{route('/')}}">
                    <img src="{{asset('web/image/logo/logo.png')}}" alt="">
                </a>
            </div>

            <div class="box-list-menu-header">
                <div class="icon-close-menu-respon">
                    <span>
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>
                <ul class="custom-nav list-menu-header d-flex">
                    @foreach($menus as $menu) 
                        <li class="">
                            <a href="{{route($menu->slug)}}">{{$menu->name}}</a>
                            {{-- @if($menu->menuChildren->count())
                                <div class="d-flex alg-center jtf-between">
                                    <div class="icon-mini-menu">
                                        <span>
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="custom-nav mini-box-list-menu">
                                    <li class="menu-item-has-children">
                                        <ul class="custom-nav sub-menu">
                                            @foreach($menu->menuChildren as $menuChidlren)
                                                <li>
                                                    <a href="{{$menuChidlren->slug}}">{{$menuChidlren->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            @endif --}}
                        </li>
                    @endforeach
                </ul>
            </div>  

            <div class="box-cart_search d-flex mr-60">
                <!-- cart -->
                <div class="box-icon-cart cart-order">
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
                                <a href="{{route('web-checkout.index')}}">
                                    <button>
                                        <span>Thanh toán</span>
                                    </button>
                                </a>
                                <div class="continue-shopping">
                                    <a href="{{url('san-pham/giay-tay-nam')}}">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        @else
                            <span>Không có sản phẩm nào</span>
                            @endif
                        
                    </div>
                </div>
                <!-- search -->
                <div class="box-icon-search ml-30 mr-30">
                    <div class="icon-search">
                        <span> 
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                    <div class="form-inp-search">
                        <div class="inp-search">
                            <input type="text" url = "{{route('web-product.search-item')}}" name="inp-search" class="search_product" placeholder="Nhập tên sản phẩm cần tìm ..." autocomplete="off">
                        </div>
                        <div class="search-suggestions">
                            <ul class="custom-nav list-search-suggestions">
                            
                            </ul>
                        </div>
                    </div>
                </div>
                @if(!Auth::user())
                {{-- login/register --}}
                <div class="login-register">
                    <a href="{{route('login')}}" class="btn btn-login-register">LOGIN</a>
                    <a href="{{route('register')}}" class="btn btn-login-register">REGISTER</a>
                </div>
                @else
                <?php
                    $user = Auth::user();
                    $profile = $user->profile;
                ?>
                <div class="box-icon-cart">
                    <div class="name-user">
                        <a href="">{{$profile->name}}</a>
                    </div>
                    
                    <div class="list-action-account list-cart">
                        <ul class="custom-nav">
                            <li><a class="btn" href="{{route('web-order.index')}}">Theo dõi đơn hàng</a></li>
                            <li><a class="btn" href="">Cập nhật thông tin</a></li>
                            <li>
                                <a href="http://127.0.0.1:8000/logout" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <i class="zmdi zmdi-power"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>                            
                    </div>
                </div>
                @endif
            </div>  
        </div>
    </div>
</header>

