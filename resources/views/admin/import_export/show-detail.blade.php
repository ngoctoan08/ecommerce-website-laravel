@extends('admin.index')
@section('title')
    <title>Chi tiết nhập xuất</title>
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- @include('admin.partials.action') --}}
            <a type="button" href="{{route('import_export.show', $type_import_export)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="fa fa-plus-square"></i>List
            </a>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="card m-t-30">
                        <div class="card-header">
                            <strong>Thông tin đơn hàng</strong>
                        </div>
                        <div class="card-body card-block text-left">
                            
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static">Mã đơn hàng: <b>{{$infoPartner->ie_id}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static">Khách hàng: {{$infoPartner->name_partner}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <div class="input-group">
                                                <p class="form-control-static">Ngày đặt hàng: {{$infoPartner->day}}</p>
                                                <!-- <div class="input-group-addon">
                                                    <i class="far fa-calculator"></i>
                                                    <i class="far fa-envelope"></i>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static">Số điện thoại: {{$infoPartner->tel}}</p>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static ">Trạng thái: <b class="@cssStatusOrdered($infoPartner->status)">@checkStatusOrdered($infoPartner->status)</b></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static">Email: {{$infoPartner->email}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static"> Thanh toán: {{$infoPartner->payment_method}}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 col-md-12">
                                            <p class="form-control-static">Địa chỉ giao hàng: {{$infoPartner->address}}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="textarea-input" class=" form-control-label col-6">Ghi chú</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea disabled name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control"> {{$infoPartner->note}}</textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    @if(!empty($orderItems))
                    <form action="{{route('category.handle-action')}}" method="POST" class="form_container">
                        @csrf
                        <!-- DATA TABLE-->
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center list-orderItem justify-content-center">
                                <thead>
                                    <tr >
                                        <th>No</th>
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
                                <tbody id="list_orderItem">
                                    @foreach($orderItems as $orderItem)
                                    <tr class="tr-shadow" id="item_{{$orderItem->id}}">
                                        <td style="line-height: 145px;">{{ $loop->index + 1}}</td>
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
                        <!-- END DATA TABLE-->
                    </form>
                    @endif
                    @empty($orderItems)
                        No record! 
                        {{-- <button  type="button" class="btn-create-item" data-toggle="modal" data-target="#staticModal"> Create one?</button> --}}
                        <a class="item btn" href="{{route('category.trash')}}"> Go to Trash list</a>
                    @endempty
                    {{-- {{$products->links()}} --}}
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



 
@endsection

@section('js')
    <!-- Config URL API-->
    <script src="{{asset('admin/js/config.js')}}"></script>
    <!-- Alert CDN -->
    <script src="{{asset('admin_template/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
    {{-- Handle Product page --}}
    <script src="{{asset('client/js/productController.js')}}"></script>
    {{-- Handle Action --}}
    <script src="{{asset('client/js/handleAction.js')}}"></script>
    <!-- Handle Validate Form -->
    
    <script>
        // Format currency

        // Validator
        Validator({
            form: '#form-create-unit',
            errorSelector: '.form-error',
            rules: [
                Validator.isRequired('#conversion_unit'),
                // Validator.isRequired('#price'),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
                createUnit(data);
            }
        });
    </script>
    {{-- Handle ckeditor --}}
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        // filebrowserUploadMethod: 'form'
    };
    </script>
    <script>
    CKEDITOR.replace('description', options);
    </script>


    {{-- Handle alert response from server to client --}}
    @if(Session::has('success'))
    <script>
        alertSuccess('{{Session::get('success')}}')
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        alertError('{{Session::get('error')}}')
    </script>
    @endif
@endsection