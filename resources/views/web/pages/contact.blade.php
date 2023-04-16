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
                <a href="lien-he">Liên hệ</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Liên hệ</span>
        </div>
    </div>
</section>

<!-- contact -->
<section class="contact">
    <div class="container">
        <div class="title-name-content">
            <span>Liên hệ </span>
        </div>
        <div class="box-content-contact d-flex jtf-between">
            <!-- 1 --> 
            <div class="content-contact d-flex alg-center">
                <div class="number-content-contact">
                    <span>01</span>
                </div>
                <div class="infor-contact ml-15">
                    <p>Bán hàng online</p>
                    <p>0868.642.605</p>
                </div>
            </div>
            <!-- 2 --> 
            <div class="content-contact d-flex alg-center">
                <div class="number-content-contact">
                    <span>02</span>
                </div>
                <div class="infor-contact ml-15">
                    <p>Liên hệ làm đại lý</p>
                    <p>0868.642.605</p>
                </div>
            </div>
            <!-- 3 --> 
            <div class="content-contact d-flex alg-center">
                <div class="number-content-contact">
                    <span>03</span>
                </div>
                <div class="infor-contact ml-15">
                    <p>E-mail</p>
                    <p>admin@laforce.vn</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-location">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463201.1656904762!2d105.3724813963128!3d20.973446116777176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135008e13800a29%3A0x2987e416210b90d!2zSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e1!3m2!1svi!2s!4v1662603616979!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<!-- contact-for-us -->
<section class="contact-for-us">
    <div class="container">
        <div class="title-contact">
            <span>Liên hệ với chúng tôi</span>
        </div>
        <div class="form-contact">
            <form action="">
                <div class="box-inp-short">
                    <div class="inp-short">
                        <input type="text" name="name" id="name" placeholder="Họ và tên" required>  
                    </div>
                    <div class="inp-short">
                        <input type="email" name="email" id="email" placeholder="Địa chỉ email" required>  
                    </div>
                    <div class="inp-short">
                        <input type="text" name="your-subject" id="your-subject" placeholder="Tiêu đề" required>  
                    </div>
                </div>
                <div class="inp-short">
                    <textarea rows="7" cols="40" name="contetn" id="content" placeholder="Nội dung"></textarea>
                </div>
                <div class="btn-send-form">
                    <button type="submit">
                        <span>Gửi tin nhắn</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
