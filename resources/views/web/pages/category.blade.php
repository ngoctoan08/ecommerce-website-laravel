@extends('web.index')
@section('title')
<title>Danh mục</title>
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
                <a href="{{$slug}}">{{$title}}</a>
            </li>
        </ul>
        <div class="name-page">
            <span>{{$title}}</span>
        </div>
    </div>
</section>

        <!-- list-product shoes -->
<section class="box-list-product mb-15">
    <div class="container">
        <div class="title-boc-cart-list">
            <span>Giày da nam</span>
        </div>
        <div class="list-product row">
            <!-- 1 -->
            @foreach($categories as $category)
            <div class="col-md-6">
                <div class="box-content">
                    <a href="{{route('web-product.index', $category->category_slug)}}">
                        <div class="img-product-page">
                            <img src="{{asset('web/image/product/product-shoes (1).png')}}" alt="">
                        </div>
                        <div class="cate-list-title">
                            <p>{{$category->category_name}}</p>
                            <span>{{$category->category_qty}} sản phẩm</span>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
    <!-- banner -->

    

 