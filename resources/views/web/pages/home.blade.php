@extends('web.index')
@section('title')
<title>Trang chủ</title>
@endsection

@section('content')
<!-- banner -->
<section class="banner">
    <div class="img-banner">
        <img src="{{asset('web/image/banner/banner-index.jpg')}}" alt="">
    </div>
    <div class="content-banner">
        <div class="note-title-banner">
            <span>New collection</span>
        </div>
        <div class="title-banner mb-60">
            <span>Summer - Autumn Lookbook 2022</span>
        </div>
        <div class="mini-note-title-banner">
            <span>How to be a gentleman</span>
        </div>
        <div class="text-banner">
            <span>Ấn tượng, lịch lãm và đầy nam tính cùng với những xu hướng phụ kiện Hè Thu 2022 của LaForce</span>
        </div>
    </div>
</section>

<!-- product -->
<section class="product d-flex">
    <!-- left -->
    <div class="box-product">
        <div class="box-content-product color-box-left" >
            <a href="index.php?page=product&method=western">
                <div class="img-product d-flex jtf-center">
                    <img src="{{asset('web/image/index-product (1).png')}}" alt="">
                </div>
                <div class="text-img-product">
                    <h2>Giày da nam</h2>
                    <p>230 sản phẩm</p>
                </div>
            </a>
        </div>
    </div>
    <!-- right -->
    <div class="box-product box-product-right">
        <!-- 1 -->
        <div class="box-content-product">
            <a href="./list-detail-product.html">
                <div class="img-product d-flex jtf-center">
                    <img src="{{asset('web/image/index-product (2).png')}}" alt="">
                </div>
                <div class="text-img-product">
                    <h2>Ví da nam</h2>
                    <p>230 sản phẩm</p>
                </div>
            </a>
        </div>
        <!-- 2 -->
        <div class="box-content-product color-box-right-gray">
            <a href="./list-detail-product.html">
                <div class="img-product d-flex jtf-center">
                    <img src="{{asset('web/image/index-product (3).png')}}" alt="">
                </div>
                <div class="text-img-product">
                    <h2>Túi xách nam</h2>
                    <p>230 sản phẩm</p>
                </div>
            </a>
        </div>
        <!-- 3 -->
        <div class="box-content-product color-box-right-gray">
            <a href="./list-detail-product.html">
                <div class="img-product d-flex jtf-center">
                    <img src="{{asset('web/image/index-product (4).png')}}" alt="">
                </div>
                <div class="text-img-product">
                    <h2>Thắt lưng nam</h2>
                    <p>230 sản phẩm</p>
                </div>
            </a>
        </div>
        <!-- 4 -->
        <div class="box-content-product color-box-right-green">
            <a href="index.php?page=category">
                <div class="text-img-product-seen-more">
                    <h3>xem thêm</h3>
                    <h3>các sản phẩm khác</h3>
                    <span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- about-the-product -->
<section class="about-the-product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="widget-title d-flex jtf-between">
                    <span>01</span>
                    <span>Về sản phẩm</span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box-text-content">
                    <div class="note-text-content">
                        <span>Về chất liệu</span>
                        <p>Chất liệu da nguyên tấm</p>
                    </div>
                    <div class="text-content">
                        <p>Tất cả các sản phẩm của LaForce được làm từ chất liệu da nguyên tấm, đây là phần da đắt tiền nhất lấy từ lớp da trên cùng của con bò, giữ lại được tất cả kết cấu nguyên thủy của da, mang đến chất lượng tốt nhất, chính vì thế chúng rất bền và khó bị hỏng.</p>
                        <p>Đó cũng là điểm khác biệt lớn nhất trong sản phẩm của LaForce so với các sản phẩm làm bằng da thông thường khác. Đối với những sản phẩm da thông thường, bề mặt chúng được phủ lên một lớp da tổng hợp nên rất dễ bị nổ hoặc gấp nếp.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="img-about-the-product">
                    <img src="./image/chatlieuda.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 1 -->
<section class="about-the-product quytrinh_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="img-about-the-product">
                    <img src="{{asset('web/image/cach-tao-ra-sp.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-text-content">
                    <div class="note-text-content txt-right">
                        <span>QUY TRÌNH</span>
                        <p>Cách tạo ra 1 sản phẩm</p>
                    </div>
                    <div class="text-content">
                        <p>Chế tạo những sản phẩm từ da nguyên tấm là cả một nghệ thuật. Chúng được áp dụng những kĩ thuật truyền thống kết hợp với công nghệ hiện đại nhất. Cả quá trình được diễn ra khép kín và không hề có ảnh hưởng từ môi trường bên ngoài. Khi sản phẩm đã được chế xuất, chúng sẽ được hoàn thiện thông qua bàn tay khéo léo của những người thợ có kinh nghiệm lâu năm. Chính vì thế, bạn có thể cảm nhận rõ được chất liệu của sản phẩm qua những đặc tính của sản phẩm như màu sắc ẩn sâu bên trong sản phẩm, khác với những đồ da rẻ tiền.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="line-content-about-product">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2 -->
<section class="about-the-product quytrinh_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="line-content-about-product">
                    <span></span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box-text-content">
                    <div class="note-text-content">
                        <span>Sản phẩm</span>
                        <p>Thiết kế độc đáo —sáng tạo</p>
                    </div>
                    <div class="text-content">
                        <p>LaForce mang đến cho người dùng những trải nghiệm tuyệt vời về các sản phẩm. Thiết kế độc đáo và đầy sáng tạo làm nổi bật tính cách của sản phẩm khiến bất cứ khách hàng nào cũng muốn sở hữu. Những ý tưởng thiết kế tuyệt vời được phối hợp nhuần nhuyễn qua bàn tay của những thợ thủ công có nhiều năm kinh nghiệm cùng với những chất liệu xa xỉ, cao cấp để tạo ra những sản phẩm không những chỉ tốt về chất lượng mà còn hợp thời trang, thẩm mỹ của người dùng.</p>
                        <p>LaForce luôn cập nhật, phát triển theo xu hướng thời trang thế giới nhưng vẫn luôn giữ lại những nét đẹp trong thiết kế để tạo cho khách hàng những sản phẩm không chỉ sang trọng, đẳng cấp mà còn hợp thời trang, có tính thẩm mỹ.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="img-about-the-product">
                    <img src="{{asset('web/image/Thiet-ke-sang-tao.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- about-the-La-forcet -->
<section class="about-the-La-force">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget-title d-flex jtf-between">
                    <span>02</span>
                    <span>Về La-force</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box-text-content">
                    <div class="note-text-content txt-right ">
                        <p>Chất liệu 100% da bò nhập khẩu</p>
                    </div>
                    <div class="text-content">
                        <p>LaForce với hệ thống 23 cửa hàng trên toàn quốc và tiếp tục mở rộng trong tương lai, chúng tôi mong muốn sẽ mang đến những sản phẩm đồ da chất lượng nhất cho khách hàng.</p>
                        <p>LaForce – sản phẩm đồ da của người Việt.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
