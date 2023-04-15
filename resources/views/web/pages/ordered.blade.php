@extends('web.index')
@section('title')
<title>Theo dõi đơn hàng</title>
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
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Mã</th>
					<th>Ngày</th>
					<th>Tổng tiền</th>
					<th>VAT</th>
					<th>Thành tiền</th>
					<th>Trạng thái</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody>
                @foreach($listOrdered as $order)
				<tr>
					<td>{{$order->bill_code}}</td>
					<td>{{$order->day}}</td>
					<td>@formatMoney($order->total_amount)</td>
					<td>{{$order->tax_money}}</td>
					<td>@formatMoney($order->into_money)</td>
					<td><?= $order->status == 1 ? 'Chờ xử lý' : 'Đã hoàn thành' ?></td>
					<td>
                        <div class="table-data-feature justify-content-center">
                            <a class="item" title="Chi tiết" href="{{route('web-order.show', $order->id )}}">
                                <i class="fa fa-eye"></i>
                                Xem chi tiết
                            </a>
                        </div>
                    </td>
				</tr>
                @endforeach

            </tbody>
		</table>
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