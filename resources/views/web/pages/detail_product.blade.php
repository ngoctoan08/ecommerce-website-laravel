@extends('web.index')
@section('title')
<title>Sản phẩm</title>
@endsection
    
    <!-- mini-menu -->
    <section class="mini-menu-header">
        <div class="box-mini-menu">
            <ul class="custom-nav menu-header-product-detail d-flex jtf-center alg-center">
                <li>
                    <a href="{{route('trang-chu')}}">Trang chủ</a>
                </li>
                <li>/</li>
                <li>
                    <a href="{{route('web-product.index', $title)}}">{{$title}}</a>
                </li>
                <li>/</li>
                <li>
                    <a href=""></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- product-detail -->
    <section class="product-detail">
        <div class="container">
            <div class="row">
                <!-- img-product -->
                <div class="col-md-7">
                    <div class="box-img-product d-flex alg-center">
                        <div class="thumbnails">
                                @foreach($images as $img)
                                <div class="thumb">
                                    <a class="zoom" href="javascript:void(0)">
                                        <img src="{{asset($img->path_sub_image)}}" alt="{{$img->name_sub_image}}" onmouseover="changeImage({{$img->img_id}})" id="{{$img->img_id}}">
                                    </a>
                                </div>
                                @endforeach

                            <div class="thumb">
                                <a class="zoom" href="javascript:void(0)">
                                    <img src="{{asset($product->path_image)}}" alt="{{$product->name_image}}" onmouseover="changeImage('six')" id="six">
                                </a>
                            </div>

                        </div>
                        <div class="big-slide-img">
                            <img src="{{asset($product->path_image)}}" id="img-main" alt="{{$product->name_image}}">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="content-product-detail">
                        <h1 class="title-product-detail">{{$product->name}}</h1>
                        <div class="price-product">
                            <del style="opacity: 0.5;">{{$product->retail_price * 100 / 10}}</del>
                            <span>{{$product->retail_price}}</span>
                        </div>
                        {{-- Choose size --}}

                        <div class="choose-size">
                            <p>Size</p>
                            <div class="box-border-choose-size d-flex mb-15 ">
                                @foreach($sizes as $size)
                                <div class="border-choose-size" product-size = "{{$size->size_name}}">
                                    <span>{{$size->size_name}}</span>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" min = "1" max ="6" class="product-size" name="size" value="1">
                        </div>

                        <div class="choose-quantity d-flex alg-center">
                            <p>Chọn số lượng</p>
                            <div class="quantity-custom d-flex">
                                <input aria-label="quantity" class="input-qty" min="1" max="10" name="quantity" type="number" value="1">
                                <div class="btn-up-down">
                                    <input class="plus is-form" type="button" value="+">
                                    <input class="minus is-form" type="button" value="-">
                                </div>
                            </div>
                        </div>
                        <div class="tutorial-choose-size mt-30">
                            <div class="btn-tutorial-choose-size">
                                <img src="./image/icon/ruler.png" alt="">
                                <span>Hướng dẫn chọn size</span>
                            </div>
                        </div>
                        <div class="btn-product-detail">
                            <a href="">
                                <button class="btn-submit-product-detail txt-center pay_now" value="{{$product->id}}">
                                    <span>Thêm vào giỏ hàng</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="detail-info">
        <div class="container">
            
            <!-- Thông tin chi tiết sản phẩm -->
            <div class="col-md-6">
                <div class="info-detail-product">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- 1 -->
                        <div class="panel panel-default border-product-detail">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Thông tin chi tiết
                                        <span>+</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    {{$product->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="popup-choose-size">
    <div class="img-choose-size">
        <img src="./image/produc-detail/chon-size-giay.png" alt="">
        <div class="btn-close">
            <span>
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
    </div>
</section>

<!-- assess-customer -->
<section class="assess-customer mt-30">
    <div class="check-user">
        <div class="form-check-user">
                <div class="title-form-check">
                    <span>Đánh giá</span>
                </div>
                <form action="{{route('web-product.store-feedback', $product->id)}}" name="feed_back" method="POST" enctype="multipart/form-data">
                    <div class="inp-check-user text-center">
                        <ul class="ul-star">
                            <li data-val = 1><i class="fa-regular fa-star"></i><p>Rất tệ</p></li>
                            <li data-val = 2><i class="fa-regular fa-star"></i><p>Tệ</p></li>
                            <li data-val = 3><i class="fa-regular fa-star"></i><p>Bình Thường</p></li>
                            <li data-val = 4><i class="fa-regular fa-star"></i><p>Tốt</p></li>
                            <li data-val = 5><i class="fa-regular fa-star"></i><p>Rất tốt</p></li>
                        </ul>
                    <input type="hidden" value="" class="rate_score" name="rate">
                    </div>
                    <div class="inp-check-user">
                        <input type="text" name="name" placeholder="Họ tên..." required>
                    </div>
                    <div class="inp-check-user">
                        <input type="tel" name="phone"  placeholder="Số điện thoại..." required>
                    </div>
                    <div class="inp-check-user">
                        <textarea name="comment" cols="30" rows="3" placeholder="Mời bạn chia sẻ cảm nhận vê sản phẩm..." required></textarea>
                        
                    </div>
                    
                    <div class="inp-check-user">
                        <a class="inp-check-user " id="trigger_file" href="javascript:void(0)">
                            <i class="fa-solid fa-image"></i>
                            <span>Gửi hình chụp thực tế </span> 
                        </a>
                        <div class="view_feedback">
                            <input style="display:none;" type="file" id="img_feedback" name="img_feedback[]" multiple="" accept="image/png, image/jpeg, image/jpg">
                        </div>
                    </div>
                    


                    <div class="btn-check-user d-flex jtf-center">
                        <button type="submit" name="btn-feedback" onclick="return confirm('Gửi đánh giá?')">
                            <span>Đánh giá</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <span> <?=!empty($error['noti']) ? $error['noti'] : '' ?>  </span>
                </form>
                
            <div class="close-check-user">
                <span>
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>
        </div>
    </div>
</section>