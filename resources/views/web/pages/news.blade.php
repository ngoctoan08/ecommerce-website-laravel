@extends('web.index')
@section('title')
<title>Tin tức</title>
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
                <a href="{{route('tin-tuc')}}">Tin tức</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Tin tức</span>
        </div>
    </div>
</section>

<!-- list-news  -->
<section class="list-news">
    <div class="container">
        <div class="row">
                <!-- row-1 -->
            <!-- 1 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (1).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (2).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Bảng size giày Fila Hàn Quốc trẻ em nam nữ cập nhật mới nhất</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (3).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>

                <!-- row-2 -->
            <!-- 1 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (4).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (5).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Bảng size giày Fila Hàn Quốc trẻ em nam nữ cập nhật mới nhất</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (6).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>

                <!-- row-3 -->
            <!-- 1 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (7).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (8).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Bảng size giày Fila Hàn Quốc trẻ em nam nữ cập nhật mới nhất</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (9).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>

                <!-- row-4 -->
            <!-- 1 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (10).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (11).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Bảng size giày Fila Hàn Quốc trẻ em nam nữ cập nhật mới nhất</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="conntetnt-list-news mb-60">
                    <div class="img-page-news">
                        <img src="{{asset('web/image/news/page_news (12).png')}}" alt="">
                    </div>
                    <div class="text-page-news">
                        <p>31/08/2022</p>
                        <a href="#">
                            <h3>Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</h3>
                            <span class="seen-more">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="box-pagination mb-60">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="" aria-label="Previous">
                        <span aria-hidden="true">&#60;</span>
                        </a>
                    </li>
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">...</a></li>
                    <li><a href="">12</a></li>
                    <li>
                        <a href="" aria-label="Next">
                        <span aria-hidden="true">&#62;</span>
                        </a>
                    </li>
                    <li><a href="">trang cuối</a></li>
                </ul>
                </nav>
        </div>
    </div>
</section>


@endsection
