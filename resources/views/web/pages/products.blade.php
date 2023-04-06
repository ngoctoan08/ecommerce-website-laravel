@extends('web.index')
@section('title')
<title>Sản phẩm</title>
@endsection

<!-- banner -->
<section class="banner">
    <div class="img-banner">
        <img src="{{asset('web/image/banner/banner-product.jpg')}}" alt="">
    </div>
    <div class="mini-list-banner">
        <ul class="custom-nav d-flex jtf-center alg-center">
            <li>
                <a href="{{route('/')}}">Trang chủ</a>
            </li>
            <li>/</li>
            <li>
                <a href="{{route('web-product.index', $title)}}">Sản phẩm</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Sản phẩm</span>
        </div>
    </div>
</section>

 <!-- list-detail-product -->
<section class="list-detail-product">
    <div class="container">
        <div class="row">
            <!-- filter -->
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="filter-list-product">
                    <!-- filter-name-product -->
                    <div class="filter-product">
                        <div class="title-filter">
                            <span>Sản phẩm</span>
                        </div>
                        <div class="box-list-filter">
                            <ul class="list-filter">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{$category->category_slug}}"> <span>{{$category->category_qty}}</span> {{$category->category_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- filter-price -->
                    <div class="filter-price mt-60">
                        <select name="arrange_price" id="" class="inp-choose-size">
                            <option value="">Sắp sắp theo giá</option>
                            <option value="">Từ cao đến thấp</option>
                            <option value="">Từ thấp đến cao</option>
                        </select>
                        <!-- <div class="title-filter">
                            <span>Lọc theo giá tiền</span>
                        </div>
                        <div class="range-slide">
                            <div class="slide">
                                <div class="line-range-input" id="line-range-input" style="left: 0%; right: 0%;"></div>
                                <span class="thumb-range-input" id="thumbMin" style="left: 0%;"></span>
                                <span class="thumb-range-input" id="thumbMax" style="left: 100%;"></span>
                            </div>
                            <input id="rangeMin" type="range" max="100" min="10" step="5" value="0">
                            <input id="rangeMax" type="range" max="100" min="10" step="5" value="100">
                        </div>
                        <div class="txt-filter-price d-flex alg-center">
                            <div class="btn-filter-price">
                                <button>
                                    <span>Lọc</span>
                                </button>
                            </div>
                            <div class="txt-values">
                                <span>Giá</span>
                                <span id="min">1,200,000 ₫</span>
                                <span>-</span>
                                <span id="max">2,350,000 ₫</span>
                            </div>
                        </div> -->
                    </div>

                    <!-- filter-size -->
                    
                </div>
            </div>
            <!-- content-list-detail-product -->
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="content-list-detail-product">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a href="{{route('web-product.show',['title'=> $title, 'id' => $product->id, 'slug' =>  $product->slug])}}">
                                <div class="box-list-detail">
                                    <div class="img-list-detail">
                                        <img src="{{asset($product->path_image)}}" alt="{{$product->name_image}}">
                                    </div>
                                    <div class="box-text-list-detail">
                                        <div class="name-product">
                                            <span>{{$product->name}} </span>
                                        </div>
                                        <div class="text-price">
                                            <span class="text-price-gray">@formatMoney($product->retail_price * 11 / 10) </span>
                                            <span> @formatMoney($product->retail_price) </span>
                                        </div>
                                    </div>
                                    <div class="sale-off">
                                        <span>-10%</span>
                                    </div>
                            </a>

                            <form action="{{route('web-product.add-to-cart')}}" method="post" id="form_add_to_cart_{{$product->id}}" name="form_add_to_cart_{{$product->id}}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="product_name" value="{{$product->name}}">
                                <input type="hidden" name="product_retail_price" value="{{$product->retail_price}}">
                                <input type="hidden" name="product_path_image" value="{{$product->path_image}}">
                                <input type="hidden" name="product_qty" value="1">
                            <div class="btn-add">
                                <button type="submit" class="icon-add add_to_cart add_item_to_cart" value="{{$product->id}}" url = "{{route('web-product.add-to-cart')}}">
                                    <span>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </span>
                                </button>
                                <span class="icon-add icon-view-infor view-infor" product-id = "{{$product->id}} ">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                            {{-- Chọn size --}}
                            <div class="inp-choose-size">
                                @if($product->productSizes->count() > 0)
                                <select name="product_size" class="product_size_{{$product->id}}">
                                    @foreach($product->productSizes as $size)
                                        <option class="product_size_op" value="{{$size->size_name}}">{{$size->size_name}}</option>
                                    @endforeach
                                </select>
                                @endif
                                <div class="final"></div>
                            </div>
                        </form>
                        </div>
                    </div>
                        @endforeach
                    </div>

                    {{-- thiếu phần phân trang --}}
                    <div class="post-product">
                        <h1>Giày tăng chiều cao nam cao cấp Laforce – Độn đế cao 5 – 7cm</h1>
                        <p>Giày tăng chiều cao nam Laforce cao bao nhiêu cm? Kết hợp thế nào? Mẫu giày độn nam nào bán chạy nhất?,…Là những băn khoăn hàng đầu của khách hàng khi mua giày đế cao nam tại Laforce. Đừng bỏ lỡ bài viết nếu bạn đang quan tâm tới dòng sản phẩm thời thượng này nhé.</p>
                        <h2>I – Giày cao nam Laforce cao bao nhiêu cm? Hợp với phong cách nào?</h2>
                        <p>Giày tăng chiều cao nam hay còn được biết đến với tên gọi giày cao, giày độn đế, giày đế cao. Đây là loại phụ kiện hoàn hảo giúp tăng thêm sự lịch lãm và cải thiện chiều cao siêu đỉnh của nam giới.</p>
                        <p>Với thế mạnh hơn 10 năm nghiên cứu sản xuất đồ da, quy tụ hàng trăm nghệ nhân chế tác giày, Laforce đã khẳng định được vị thế số 1 trên thị trường giày cao nam.</p>
                        <p>
                            <img src="./image/produc-detail/post-product-detail (1).png" alt="">
                        </p>
                        <p>
                            <i>Giày nam tăng chiều cao tại Laforce có thể giúp cải thiện chiều cao tới 5 – 7cm.</i>
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, nostrum cumque aspernatur blanditiis nam tenetur tempore numquam itaque, quos mollitia iusto quaerat sed assumenda vel placeat quibusdam tempora rem dolorem.
                        </p>
                    </div>
                    <div class="btn-readmore">
                        <span>đọc thêm</span>
                        <div class="btn-readmore-post">
                            <span>thu gọn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- popup-infor-product -->
<section class="popup-infor-product">
    <div class="box-list-popup-infor">
        <!-- 1 -->
        <div class="content-popup-infor">
            <div class="name-list-popup">
                <span>Thông tin chi tiết</span>
            </div>
            <div class="content-list-popup">
                {{-- Xử lý ajax --}}
            </div>
        </div>
        <!-- close-popup -->
        <div class="close-popup">
            <span>
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
    </div>
</section>



@section('lookbook')
<!-- look-book -->
<section class="look-book">
    <div class="title-lookbook">
        <a href="#">
            <span>LOOKBOOK</span>
        </a>
    </div>
    <div class="slider-look-book">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- 1 -->
                <div class="swiper-slide">
                    <div class="img-lookbook">
                        <a href="#">
                            <img src="{{asset('web/image/produc-detail/lookbook-product (1).png')}}" alt="">
                            <div class="text-img-lookbook">
                                <span>All Bags Collection for Men in 2022</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- 2 -->
                <div class="swiper-slide">
                    <div class="img-lookbook">
                        <a href="#">
                            <img src="{{asset('web/image/produc-detail/lookbook-product (2).png')}}" alt="">
                            <div class="text-img-lookbook">
                                <span>All Bags Collection for Men in 2022</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- 3 -->
                <div class="swiper-slide">
                    <div class="img-lookbook">
                        <a href="#">
                            <img src="{{asset('web/image/produc-detail/lookbook-product (3).png')}}" alt="">
                            <div class="text-img-lookbook">
                                <span>All Bags Collection for Men in 2022</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- 4 -->
                <div class="swiper-slide">
                    <div class="img-lookbook">
                        <a href="#">
                            <img src="{{asset('web/image/produc-detail/lookbook-product (4).png')}}" alt="">
                            <div class="text-img-lookbook">
                                <span>All Bags Collection for Men in 2022</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
@endsection

@section('feedback')
<!-- feedback -->
<!-- feedback -->
<section class="feedback">
    <div class="box-feedback d-flex jtf-between ">
        <!-- left -->
        <div class="box-feedback-left">
            <div class="title-feedback">
                <span>Đánh giá từ</span>
                <h3>Khách hàng</h3>
            </div>
            <div class="text-feedback">
                <p>+ 35,243</p>
                <span>Hàng nghìn khách hàng đã tin tưởng và ủng hộ sản phẩm của laforce</span>
            </div>
        </div>
        <!-- right -->
        <div class="box-feedback-right">
            <div class="slider-feedback">
                <div class="swiper mySwiper-feedback">
                    <div class="swiper-wrapper">
                        <!-- 1 -->
                        <div class="swiper-slide">
                            <div class="box-customer-comment">
                                <div class="ava-customer">
                                    <img src="{{asset('web/image/produc-detail/ava-customer (1).png')}}" alt="">
                                </div>
                                <div class="comment-customer">
                                    <div class="author">
                                        <span class="name-author">DV Tiến Lộc</span>
                                        <span class="assess"> đã đánh giá </span>
                                    </div>
                                    <div class="content-comment">
                                        <p>"LaForce đáp ứng đủ các tiêu chí của mình như chất liệu da nhập khẩu, thiết kế theo chuẩn Châu Âu, … nên những năm qua mình sử dụng sản phẩm của LaForce khá thường xuyên"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="swiper-slide">
                            <div class="box-customer-comment">
                                <div class="ava-customer">
                                    <img src="{{asset('web/image/produc-detail/ava-customer (2).png')}}" alt="">
                                </div>
                                <div class="comment-customer">
                                    <div class="author">
                                        <span class="name-author">DV Tiến Lộc</span>
                                        <span class="assess"> đã đánh giá </span>
                                    </div>
                                    <div class="content-comment">
                                        <p>"LaForce đáp ứng đủ các tiêu chí của mình như chất liệu da nhập khẩu, thiết kế theo chuẩn Châu Âu, … nên những năm qua mình sử dụng sản phẩm của LaForce khá thường xuyên"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="swiper-slide">
                            <div class="box-customer-comment">
                                <div class="ava-customer">
                                    <img src="{{asset('web/image/produc-detail/ava-customer (1).png')}}" alt="">
                                </div>
                                <div class="comment-customer">
                                    <div class="author">
                                        <span class="name-author">DV Tiến Lộc</span>
                                        <span class="assess"> đã đánh giá </span>
                                    </div>
                                    <div class="content-comment">
                                        <p>"LaForce đáp ứng đủ các tiêu chí của mình như chất liệu da nhập khẩu, thiết kế theo chuẩn Châu Âu, … nên những năm qua mình sử dụng sản phẩm của LaForce khá thường xuyên"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 4 -->
                        <div class="swiper-slide">
                            <div class="box-customer-comment">
                                <div class="ava-customer">
                                    <img src="{{asset('web/image/produc-detail/ava-customer (2).png')}}" alt="">
                                </div>
                                <div class="comment-customer">
                                    <div class="author">
                                        <span class="name-author">DV Tiến Lộc</span>
                                        <span class="assess"> đã đánh giá </span>
                                    </div>
                                    <div class="content-comment">
                                        <p>"LaForce đáp ứng đủ các tiêu chí của mình như chất liệu da nhập khẩu, thiết kế theo chuẩn Châu Âu, … nên những năm qua mình sử dụng sản phẩm của LaForce khá thường xuyên"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next next-feedback"></div>
                <div class="swiper-button-prev prev-feedback"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('news')
<!-- news -->
<!-- news -->
<section class="news">
    <div class="container">
        <div class="title-box-news">
            <a href="">
                <span>BÁO CHÍ NÓI VỀ LAFORCE</span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box-content-news">
                    <a href="index.php?page=detail_news">
                        <div class="img-content-news">
                            <img src="{{asset('web/image/news/news (1).png')}}" alt="">
                        </div>
                        <div class="name-content-new">
                            <span>Sao nam Việt bật mí địa chỉ thời trang yêu thích</span>
                        </div>
                        <div class="seen-more">
                            <span>Xem thêm</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box-content-news">
                    <a href="index.php?page=detail_news">
                        <div class="img-content-news">
                            <img src="{{asset('web/image/news/news (2).png')}}" alt="">
                        </div>
                        <div class="name-content-new">
                            <span>Sao nam Việt bật mí địa chỉ thời trang yêu thích</span>
                        </div>
                        <div class="seen-more">
                            <span>Xem thêm</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box-content-news">
                    <a href="index.php?page=detail_news">
                        <div class="img-content-news">
                            <img src="{{asset('web/image/news/news (3).png')}}" alt="">
                        </div>
                        <div class="name-content-new">
                            <span>Sao nam Việt bật mí địa chỉ thời trang yêu thích</span>
                        </div>
                        <div class="seen-more">
                            <span>Xem thêm</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="box-content-news">
                    <a href="index.php?page=detail_news">
                        <div class="img-content-news">
                            <img src="{{asset('web/image/news/news (4).png')}}" alt="">
                        </div>
                        <div class="name-content-new">
                            <span>Sao nam Việt bật mí địa chỉ thời trang yêu thích</span>
                        </div>
                        <div class="seen-more">
                            <span>Xem thêm</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>  
</section>
@endsection

@section('script')
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    {{-- Handle Cart --}}
    {{-- Handle add to cart --}}
    <script>
       $(document).ready(function () {
            $('.add_item_to_cart').click(function(e) {
                // Lấy tất cả dữ liệu của sản phẩm đó lên
                // id, name, retail_price, name_image, path_image, qty
                var idProduct = $(this).val();
                var url = $(this).attr('url');
                Validator({
                    form: '#form_add_to_cart_' + idProduct,
                    errorSelector: '.form-error',
                    rules: [
                        
                    ],
                    onSubmit: function(data) {
                        // Call API
                        console.log(data);
                        addToCart(url, data);
                    }
                });
            });
       });
    </script>
@endsection