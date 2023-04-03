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
                <a href="tin-tuc">@yield('title-banner')</a>
            </li>
        </ul>
        <div class="name-page">
            <span>@yield('title-banner')</span>
        </div>
    </div>
</section>