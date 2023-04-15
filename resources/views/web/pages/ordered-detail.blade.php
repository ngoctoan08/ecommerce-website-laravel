@extends('web.index')
@section('title')
<title>Chi tiết</title>
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
                <a href="">Theo dõi đơn hàng</a>
            </li>
        </ul>
        <div class="name-page">
            <span>Theo dõi đơn hàng</span>
        </div>
    </div>
</section>

<!-- infor-pay -->
<section class="ordered">
    <div class="container">
		<table class="table table-bordered  mt-5">
			<thead>
				<tr>
					<th>Avatar</th>
                    <th>Tên</th>
                    <th>Đơn vị</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Ghi chú</th>
				</tr>
			</thead>
			<tbody>
                @foreach($listItem as $orderItem)
				<tr>
					<td><a href="">
                        <img style="width: 150px;" src="{{asset($orderItem->path_image)}}" alt="">
                    </a></td>
                    <td>{{$orderItem->name}}</td>
                    <td>{{$orderItem->unit}}</td>
                    <td>{{$orderItem->size}}</td>
                    <td>{{$orderItem->quantity}}</td>
                    <td>@formatMoney($orderItem->price)</td>
                    <td>@formatMoney($orderItem->into_money)</td>
                    <td>{{$orderItem->note}}</td>
				</tr>
                @endforeach

            </tbody>
		</table>
    </div>
    <div class="btn">
        <a class="btn-submit-product-detail txt-center" href="{{url('san-pham/giay-tay-nam')}}">Tiếp tục mua hàng</a>
    </div>

</section>


{{-- Section Script --}}
@section('script')
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    {{-- Handle Cart --}}
    {{-- Handle add to cart --}}
    <script>
        Validator({
            form: '#frm_checkout',
            errorSelector: '.form-error',
            rules: [
                // Validator.isRequired('#name'),
                // Validator.isRequired('#email'),
                // Validator.isEmail('#email'),
                // Validator.isRequired('#phone'),
                // Validator.isRequired('#province'),
                // Validator.isRequired('#district'),
                // Validator.isRequired('#ward'),
                // Validator.isRequired('#address'),
                // Validator.isRequired('input[name="payment"]'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                checkOut(data.url_checkout, data);
            }
        });
    </script>
    <script>
        function checkOut(url, data) {
            // Body API
            var options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // 'accept': '*',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data), // body data type must match "Content-Type" header
            };
            // Fetch API
            fetch(url, options)
                .then((response) => response.json())
                .then((data) => {
                    if (data.status == 201) {
                        toastr['success'](data.message);
                    } else {
                        alert(data.status);
                        
                    }
                });
        }
    </script>
@endsection