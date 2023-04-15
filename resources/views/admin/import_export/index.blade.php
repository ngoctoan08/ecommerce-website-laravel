@extends('admin.index')
@section('title')
    <title>Nhập xuất hàng hóa</title>
@endsection

@section('content')
<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
        {{-- @include('admin.partials.action') --}}
        <a type="button" href="{{route('import_export.add', $type_import_export)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-plus-square"></i>Create
        </a>
        <button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small">
            <i class="fa fa-upload"></i>Import
        </button>
        <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="fa fa-download"></i>Export
        </button>
        <a type="button" href="{{route('category.trash')}}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
            <i class="fa fa-trash"></i>Trash
        </a>
          <div class="row m-t-30">
              <div class="col-md-12">
                @if(!empty($ieProducts))
                <form action="{{route('category.handle-action')}}" method="POST" class="form_container">
                    @csrf
                    @include('admin.partials.function')
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center list-ieProduct justify-content-center">
                            <thead>
                                <tr >
                                    <th>No</th>
                                    <th>
                                        <input type="checkbox" id="check_all">
                                    </th>
                                    {{-- <th>Nhân viên</th> --}}
                                    <th>Mã</th>
                                    <th>Ngày</th>
                                    {{-- <th>Tên NCC</th> --}}
                                    {{-- <th>Địa chỉ</th> --}}
                                    {{-- <th>Tel</th> --}}
                                    <th>Tổng tiền</th>
                                    <th>VAT</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_ieProduct">
                                @foreach($ieProducts as $ieProduct)
                                <tr class="tr-shadow" id="item_{{$ieProduct->id}}">
                                    <td style="line-height: 145px;">{{ $loop->index + 1}}</td>
                                    <td><input type="checkbox" name="item[]" value="{{$ieProduct->id}}"></td>
                                    {{-- <td>{{$ieProduct->name}}</td> --}}
                                    <td>{{$ieProduct->bill_code}}</td>
                                    <td>{{$ieProduct->day}}</td>
                                    {{-- <td>{{$ieProduct->name_partner}}</td> --}}
                                    {{-- <td>{{$ieProduct->address}}</td> --}}
                                    {{-- <td>{{$ieProduct->tel}}</td> --}}
                                    <td>@formatMoney($ieProduct->total_amount)</td>
                                    <td>@formatMoney($ieProduct->tax_money)</td>
                                    <td>@formatMoney($ieProduct->into_money)</td>
                                    <td>
                                        @if($ieProduct->status == 1)
                                        {{-- Select option --}}
                                        <select url="{{route('import_export.update-status', [$type_import_export, $ieProduct->id])}}" name="status" data-id = "{{$ieProduct->id}}" data-total = "{{$ieProduct->into_money}} " data-payment = "{{$ieProduct->payment_method}}" data-partner = "{{$ieProduct->partner_id}}" id="update_status" class="form-control">
                                            <option value="1"> Chờ xử lý </option>
                                            <option value="2"> Đã hoàn thành </option>
                                        </select>
                                        @else
                                        Đã hoàn thành
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature justify-content-center">
                                            <a class="item" title="Edit" href="{{route('import_export.show-detail', [
                                                'id' => $type_import_export, 'idImportExport' => $ieProduct->id
                                            ] )}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a data-id = "{{$ieProduct->id}}" class="item btn btn-del-item" href = "{{route('import_export.destroy', $ieProduct->id )}}" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </form>
                @endif
                @empty($ieProducts)
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
    <script src="{{asset('shared/js/sweetalert.js')}}"></script>
    <!-- Helper Function -->
    <script src="{{asset('admin/js/helper.js')}}"></script>
    <!-- Handle validate form -->
    <script src="{{asset('client/js/validator.js')}}"></script>
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

        function updateStatusById(request, url) {
            // Body API
            var options = {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(request)
            }
            // Fetch API 
            fetch(url, options)
            .then((response) => response.json())
            .then((data) => {
                if(data.status === 201) {
                    alertSuccess(data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
                else {
                    alertError(data.message);
                }
            })
        }

        // update status
        $(document).ready(function () {
            $('#update_status').on('change', function() {
                var id = $(this).attr('data-id');
                var payment_method = $(this).attr('data-payment');
                var into_money = $(this).attr('data-total');
                var partner_id =$(this).attr('data-partner');;
                var status = $(this).val();
                var url = $(this).attr('url');
                if (status != 1) {
                    Swal.fire({
                    title: 'Xử lý đơn hàng?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var request = {id, payment_method, into_money , status, partner_id};
                            console.log(request);
                            updateStatusById(request, url)
                        }
                    })
                }
            });
        });
        
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