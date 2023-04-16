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
                <a href="gioi-thieu">Giới thiệu</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Giới thiệu</span>
        </div>
    </div>
</section>

<!-- introduce -->
<section class="introduce">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget-title d-flex jtf-between">
                    <span>01</span>
                    <span>Về La-force</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box-text-content">
                    <div class="note-text-content">
                        <span>Về chúng tôi</span>
                        <p>Nhiệm vụ, tầm nhìn và  giá trị thương hiệu.</p>
                    </div>
                    <div class="text-content">
                        <p>LaForce hướng tới mục tiêu trở thành thương hiệu đồ da hàng đầu Việt Nam, chúng tôi luôn nỗ lực không ngừng để đưa thương hiệu LaForce trở nên gần gũi hơn và là thương hiệu cung cấp những sản phẩm đồ da, bao gồm: giày, túi, ví, thắt lưng, dây đồng hồ, găng tay. Mang chất lượng tốt nhất, thỏa mãn nhu cầu mua sắm của quý khách hàng.</p>
                    </div>
                    <div class="img-signature">
                        <img src="{{asset('web/image/chuky.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- genera-introduce -->
<section class="genera-introduce">  
    <div class="container">
        <div class="title-name-content">
            <span>Giới thiệu chung</span>
        </div>
        <div class="vid-genera-introduct">
            <img src="{{asset('web/image/maxresdefault.png')}}" alt="">
        </div>
    </div>
</section>

<!-- why choose us  -->
<section class="why-choose-us">
    <div class="container">
        <div class="title-name-content">
            <span>Tại sao bạn nên chọn Laforce</span>
        </div>
        <div class="row">
            <!-- 1 -->
            <div class="col-md-4">
                <div class="box-why-choose-us">
                    <div class="img-why-choose-us">
                        <img src="{{asset('web/image/introduce/introduce (1).jpg')}}" alt="">
                    </div>
                    <div class="name-why-choose-us">
                        <span>Đồ da Laforce - da thật 100%</span>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4">
                <div class="box-why-choose-us">
                    <div class="img-why-choose-us">
                        <img src="{{asset('web/image/introduce/introduce (2).jpg')}}" alt="">
                    </div>
                    <div class="name-why-choose-us">
                        <span>Đồ da Laforce - da thật 100%</span>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4">
                <div class="box-why-choose-us">
                    <div class="img-why-choose-us">
                        <img src="{{asset('web/image/introduce/introduce (3).jpg')}}" alt="">
                    </div>
                    <div class="name-why-choose-us">
                        <span>Đồ da Laforce - da thật 100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-post-introduce">
            <h3>Tại sao bạn nên lựa chọn LaForce?</h3>

            <p>Sản phẩm đồ da LaForce được làm từ da bò thật nguyên miếng, giữ nguyên được kết cấu của da nên có thể dùng được lâu dài, tuổi thọ trung bình đạt từ 3 đến 5 năm.</p>

            <p>Với thiết kế độc đáo, lịch lãm và không kém phần hiện đại, các sản phẩm của LaForce phù hợp với nhiều đối tượng, tôn lên sự nam tính cho các quý ông hiện đại. Các sản phẩm đều được kiểm tra kỹ lưỡng trước khi mang bán ra thị trường, mang đến những sản phẩm với chất lượng tốt nhất tới quý khách hàng.</p>

            <p>Ngoài ra, với hệ thống cửa hàng rộng khắp cả nước cùng đội ngũ nhân viên bán hàng chuyên nghiệp, LaForce hứa hẹn mang đến quý khách hàng dịch vụ khách hàng tốt nhất cùng chính sách bảo hành, bảo trì trọn đời cho các sản phẩm da từ LaForce như lời cam kết về uy tín và chất lượng của chúng tôi đến với khách hàng.</p>
        </div>
    </div>
</section>

<!-- news-introduct -->
<section class="news-introduce">
    <div class="container">
        <div class="title-name-content">
            <span>Tin tức</span>
        </div>
        <div class="row">
            <!-- 1 -->
            <div class="col-md-4">
                <div class="content-news-introduce">
                    <div class="name-news-introduce d-flex">
                        <p class="number-content-contact mr-15">1</p>
                        <p>
                            <a href="#">Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</a>
                        </p>
                    </div>
                    <div class="text-news-introduce">
                        <span>Trong quá trình sử dụng dây đồng hồ, chắc hẳn ai cũng từng có nhu cầu tháo dây đồng hồ để tiến hành vệ sinh, thay thế hoặc sửa chữa....</span>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-md-4">
                <div class="content-news-introduce">
                    <div class="name-news-introduce d-flex">
                        <p class="number-content-contact mr-15">2</p>
                        <p>
                            <a href="#">Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</a>
                        </p>
                    </div>
                    <div class="text-news-introduce">
                        <span>Trong quá trình sử dụng dây đồng hồ, chắc hẳn ai cũng từng có nhu cầu tháo dây đồng hồ để tiến hành vệ sinh, thay thế hoặc sửa chữa....</span>
                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-md-4">
                <div class="content-news-introduce">
                    <div class="name-news-introduce d-flex">
                        <p class="number-content-contact mr-15">3</p>
                        <p>
                            <a href="#">Hướng dẫn cách tháo dây đồng hồ đeo tay đơn giản nhất tại nhà</a>
                        </p>
                    </div>
                    <div class="text-news-introduce">
                        <span>Trong quá trình sử dụng dây đồng hồ, chắc hẳn ai cũng từng có nhu cầu tháo dây đồng hồ để tiến hành vệ sinh, thay thế hoặc sửa chữa....</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
