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
                <a href="trang-chu">
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
                <div class="box-icon-cart mr-15 cart-order">
                    <div class="icon-cart">
                        <a href="gio-hang">
                            <span>
                                <span>
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </span>
                                <?php
                                    $qty = 0;
                                    if(isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
                                        foreach($_SESSION['cart'] as $id) {
                                            foreach($id as $product) {
                                                $qty += $product['qty'];
                                            }
                                        }
                                    }
                                ?>
                                <span class="count count-order"><?=$qty?></span>
                            </span>
                            
                        </a>
                    </div>
                    
                    <div class="list-cart">
                        <!-- title -->
                        <?php
                        if(isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
                            $total = 0;
                        ?>
                        <div class="title-cart">
                            <span>Đơn hàng (<?= $qty?> sản phẩm)</span>
                        </div>
                        <!-- list-product-cart -->
                        <ul class="custom-nav box-mini-cart">
                            <?php
                                foreach($_SESSION['cart'] as $id) {
                                    foreach($id as $product) {
                            ?>
                            <li class="d-flex alg-center jtf-between mb-15">
                                <!-- content-list-product -->
                                <div class="d-flex alg-center">
                                    <!-- img -->
                                    <div class="img-product-in-cart">
                                        <a href="san-pham/<?=$product['id']?>/<?=converSlugUrl($product['name'])?>">
                                            <img src="./store_img/<?=$product['avatar']?>" alt="">
                                        </a>
                                    </div>
                                    <!-- text -->
                                    <div class="text-product-in-cart mr-30">
                                        <a href="san-pham/<?=$product['id']?>/<?=converSlugUrl($product['name'])?>">
                                            <span class="name-product-in-cart"><?=$product['name']?> (<?=$product['size']?>)</span>
                                        </a>
                                        <div class="price-product-in-cart mr-30">
                                            <?=$product['qty']?>x<span> <?=currency_format($product['price'])?>  </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- icon-close -->
                                <div class="icon-product-remove-pay">
                                    <span class="del_order" id-product = "<?=$product['id']?>" size-product = "<?=$product['size']?>">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            </li>
                            <?php 
                                $total += $product['price']*$product['qty'];
                                }
                            }
                            ?>
                        </ul>
                        <!-- total money -->
                        <div class="total-money-cart d-flex alg-center jtf-between mb-15">
                            <div class="text-total-money">
                                <span>Tổng số tiền cần thanh toán:</span>
                            </div>
                            <div class="price-product-in-cart">
                                <span> <?=currency_format($total)?> </span>
                            </div>
                        </div>
                        <!-- pay-cart -->
                        <div class="btn-pay-cart">
                            <a href="gio-hang">
                                <button>
                                    <span>Thanh toán</span>
                                </button>
                            </a>
                            <div class="continue-shopping">
                                <a href="san-pham/giay-tay">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <?php }
                        else {
                                ?>
                                <li class="d-flex alg-center mb-15">
                                    Không có sản phẩm nào!
                                </li>
                            <?php
                            }
                            ?>
                        
                    </div>
                </div>
                <!-- search -->
                <div class="box-icon-search ml-15">
                        <div class="icon-search">
                            <span> 
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                        <div class="form-inp-search">
                            <!-- <form action=""> -->
                                <div class="inp-search">
                                    <input type="text" name="inp-search" class="search_product" placeholder="Nhập tên sản phẩm cần tìm ..." autocomplete="off">
                                </div>
                                <!-- <div class="btn-search-header">
                                    <button type="submit" class="btn_search_product">Tìm </button>
                                </div> -->
                            <!-- </form> -->
                            <div class="search-suggestions">
                                <ul class="custom-nav list-search-suggestions">
                                
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</header>